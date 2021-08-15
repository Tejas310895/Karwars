<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">FMR Members</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?register_del" class="btn btn-success pull-right">Register DEL EXE</a>
           </div>
       </div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Registered On</th>
            <th>DEL Code</th>
            <th>Name</th>
            <th>Orders</th>
            <th>Amount</th>
            <th>Earnings</th>
            <th>Bonus</th>
            <th>Debits</th>
            <th>Order Stm</th>
            <th>Salary Stm</th>
            <th>Pending AMT</th>
            <th>Pending Pay</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $counter = 0;
        $get_del_details = "select * from delivery_partner";
        $run_del_details = mysqli_query($con,$get_del_details);
        while($row_del_details=mysqli_fetch_array($run_del_details)){
        $delivery_partner_id = $row_del_details['delivery_partner_id'];
        $delivery_partner_code = $row_del_details['delivery_partner_code'];
        $delivery_partner_name = $row_del_details['delivery_partner_name'];
        $delivery_partner_contact = $row_del_details['delivery_partner_contact'];
        $delivery_partner_date = $row_del_details['delivery_partner_date'];

        $get_del_earnings = "select sum(delivery_charges) as total_earnings from orders_delivery_assign where delivery_partner_id='$delivery_partner_id'";
        $run_del_earnings = mysqli_query($con,$get_del_earnings);
        $row_del_earnings = mysqli_fetch_array($run_del_earnings);
        
        $total_earnings = $row_del_earnings['total_earnings'];
        

        $get_orders_count = "select * from orders_delivery_assign where delivery_partner_id='$delivery_partner_id'";
        $run_orders_count = mysqli_query($con,$get_orders_count);
        $orders_count = mysqli_num_rows($run_orders_count);

        $get_bonus = "select sum(bonus_amt) as total_bonus from del_bonus where delivery_partner_id='$delivery_partner_id'";
        $run_bonus = mysqli_query($con,$get_bonus);
        $row_bonus = mysqli_fetch_array($run_bonus);

        $total_bonus = $row_bonus['total_bonus'];

        $get_debits = "select sum(del_debit_amt) as total_debits from del_debits where delivery_partner_id='$delivery_partner_id'";
        $run_debits = mysqli_query($con,$get_debits);
        $row_debits = mysqli_fetch_array($run_debits);

        $total_debits = $row_debits['total_debits'];

        $get_settelments = "select sum(settlement_amt) as total_settelments from del_settlements where delivery_partner_id='$delivery_partner_id'";
        $run_settelments = mysqli_query($con,$get_settelments);
        $row_settelments = mysqli_fetch_array($run_settelments);

        $total_settelments = $row_settelments['total_settelments'];
        
        $get_salary = "select sum(salary_amt) as total_salary from del_payroll where delivery_partner_id='$delivery_partner_id'";
        $run_salary = mysqli_query($con,$get_salary);
        $row_salary = mysqli_fetch_array($run_salary);

        $total_salary = $row_salary['total_salary'];

        $order_total = 0;
        $get_order_count = "select * from orders_delivery_assign where delivery_partner_id='$delivery_partner_id'";
        $run_order_count = mysqli_query($con,$get_order_count);
        while ($row_orders_count=mysqli_fetch_array($run_order_count)) {
            $del_count_invoice_no = $row_orders_count['invoice_no'];

            $get_order_status = "select * from customer_orders where invoice_no='$del_count_invoice_no'";
            $run_order_status = mysqli_query($con,$get_order_status);
            $row_order_status = mysqli_fetch_array($run_order_status);

            $order_status_bal = $row_order_status['order_status'];

            $get_order_amount = "select sum(due_amount) as order_amount from customer_orders where invoice_no='$del_count_invoice_no' and order_status='Delivered' and product_status='Deliver'";
            $run_order_amount = mysqli_query($con,$get_order_amount);
            $row_order_amount = mysqli_fetch_array($run_order_amount);

            $order_amount = $row_order_amount['order_amount'];

            $get_payment_status = "select * from paytm where ORDERID='$del_count_invoice_no'";
            $run_payment_status = mysqli_query($con,$get_payment_status);
            $row_payment_status = mysqli_fetch_array($run_payment_status);

            $txn_status = $row_payment_status['STATUS'];

            $get_discount = "select * from customer_discounts where invoice_no='$del_count_invoice_no'";
            $run_discount = mysqli_query($con,$get_discount);
            $row_discount = mysqli_fetch_array($run_discount);

            $coupon_code = $row_discount['coupon_code'];
            $discount_type = $row_discount['discount_type'];
            $discount_amount = $row_discount['discount_amount'];

            $get_del_charges = "select * from order_charges where invoice_id='$del_count_invoice_no'";
            $run_del_charges = mysqli_query($con,$get_del_charges);
            $row_del_charges = mysqli_fetch_array($run_del_charges);

            if($order_status_bal==='Delivered'){
              $del_charges = $row_del_charges['del_charges'];
            }else{
              $del_charges = 0;
            }

            if($txn_status==='SUCCESS'){
              $grand_total = 0;
          }else {

            if($discount_type==='amount'){

                $grand_total = ($order_amount+$del_charges)-$discount_amount;
                $order_total += $grand_total;

              }elseif ($discount_type==='product') {

                $get_off_pro = "select * from products where product_id='$discount_amount'";
                $run_off_pro = mysqli_query($con,$get_off_pro);
                $row_off_pro = mysqli_fetch_array($run_off_pro);

                $off_product_price = $row_off_pro['product_price'];

                    $grand_total = ($order_amount+$del_charges)+$off_product_price;
                    $order_total += $grand_total;
                
              }elseif (empty($discount_type)) {

                    $grand_total = $order_amount+$del_charges;
                    $order_total += $grand_total;
              }
        }
      }

        ?>
        <tr>
            <td><?php echo ++$counter;?></td>
            <td><?php echo date("d/M/y",strtotime($delivery_partner_date));?></td>
            <td><?php echo $delivery_partner_code;?></td>
            <td><?php echo $delivery_partner_name;?></td>
            <td><?php echo $orders_count;?></td>
            <td><?php echo $order_total;?></td>
            <td><?php echo $total_earnings;?></td>
            <td><?php echo $total_bonus;?></td>
            <td><?php echo $total_debits;?></td>
            <td><?php echo $total_settelments;?></td>
            <td><?php echo $total_salary;?></td>
            <td><?php echo $order_total-$total_settelments;?></td>
            <td><?php echo ($total_earnings+$total_bonus)-($total_salary+$total_debits);?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='./js/datatable.js'></script>
<?php } ?>