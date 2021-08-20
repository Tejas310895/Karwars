<?php 

if(isset($_POST['del_code'])){
    include("../includes/db.php");

    $del_code = $_POST['del_code'];

    $get_del = "SELECT * from delivery_partner where delivery_partner_code='$del_code'";
    $run_del = mysqli_query($con,$get_del);
    $row_del = mysqli_fetch_array($run_del);

    $check_del = mysqli_num_rows($run_del);

    $delivery_partner_id = $row_del['delivery_partner_id'];
    $delivery_partner_code = $row_del['delivery_partner_code'];
    $delivery_partner_name = $row_del['delivery_partner_name'];
    $delivery_partner_email = $row_del['delivery_partner_email'];
    $delivery_partner_contact = $row_del['delivery_partner_contact'];
    $delivery_partner_date = $row_del['delivery_partner_date'];


    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d");

    if(isset($delivery_partner_id)){

?>

<div class="container">
        <div class="row rounded p-2" style="box-shadow:1px 1px 10px 2px #fff;">
            <div class="col-6">
                <h5><?php echo $delivery_partner_code;?></h5>
                <h5>Joining Date : <?php echo date('d/M/Y@h:i a',strtotime($delivery_partner_date)); ?></h5>
                <h5>Name : <?php echo $delivery_partner_name;?></h5>
                <h5>Email : <?php echo $delivery_partner_email;?></h5>
                <h5>Contact : <?php echo $delivery_partner_contact;?></h5>
            </div>
            <div class="col-6">
            </div>
        </div>
        <ul class="nav nav-pills nav-justified mb-3 mt-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-earnings" role="tab" aria-controls="pills-home" aria-selected="true">EARNINGS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-bonus" role="tab" aria-controls="pills-profile" aria-selected="false">BONUS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-debits" role="tab" aria-controls="pills-contact" aria-selected="false">DEBITS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-settel" role="tab" aria-controls="pills-contact" aria-selected="false">SETTELMENTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-salary" role="tab" aria-controls="pills-contact" aria-selected="false">SALARY</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-earnings" role="tabpanel" aria-labelledby="pills-home-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Order Id</th>
                            <th>Name</th>
                            <th>Total Amount</th>
                            <th>Total Charges Earned</th>
                        </tr>
                    </thead>
                    <?php 
                    
                    $get_del_earnings = "select * from orders_delivery_assign where delivery_partner_id='$delivery_partner_id'";
                    $run_del_earnings = mysqli_query($con,$get_del_earnings);
                    $counter = 0;
                    while($row_del_earnings = mysqli_fetch_array($run_del_earnings)){
                    $counter = ++$counter;
                    $invoice_no = $row_del_earnings['invoice_no'];
                    $delivery_charges = $row_del_earnings['delivery_charges'];

                    $get_cust_details = "select * from customer_orders where invoice_no='$invoice_no'";
                    $run_cust_details = mysqli_query($con,$get_cust_details);
                    $row_cust_details = mysqli_fetch_array($run_cust_details);
                    
                    $customer_id = $row_cust_details['customer_id'];

                    $get_customer = "select * from customers where customer_id='$customer_id'";
                    $run_customer = mysqli_query($con,$get_customer);
                    $row_customer = mysqli_fetch_array($run_customer);

                    $customer_name = $row_customer['customer_name'];

                    $get_order_status = "select * from customer_orders where invoice_no='$invoice_no'";
                    $run_order_status = mysqli_query($con,$get_order_status);
                    $row_order_status = mysqli_fetch_array($run_order_status);
        
                    $order_status_bal = $row_order_status['order_status'];
        
                    $get_order_amount = "select sum(due_amount) as order_amount from customer_orders where invoice_no='$invoice_no' and order_status='Delivered' and product_status='Deliver'";
                    $run_order_amount = mysqli_query($con,$get_order_amount);
                    $row_order_amount = mysqli_fetch_array($run_order_amount);
        
                    $order_amount = $row_order_amount['order_amount'];
        
                    $get_payment_status = "select * from paytm where ORDERID='$invoice_no'";
                    $run_payment_status = mysqli_query($con,$get_payment_status);
                    $row_payment_status = mysqli_fetch_array($run_payment_status);
        
                    $txn_status = $row_payment_status['STATUS'];
        
                    $get_discount = "select * from customer_discounts where invoice_no='$invoice_no'";
                    $run_discount = mysqli_query($con,$get_discount);
                    $row_discount = mysqli_fetch_array($run_discount);
        
                    $coupon_code = $row_discount['coupon_code'];
                    $discount_type = $row_discount['discount_type'];
                    $discount_amount = $row_discount['discount_amount'];
        
                    $get_del_charges = "select * from order_charges where invoice_id='$invoice_no'";
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
        
                      }elseif ($discount_type==='product') {
        
                        $get_off_pro = "select * from products where product_id='$discount_amount'";
                        $run_off_pro = mysqli_query($con,$get_off_pro);
                        $row_off_pro = mysqli_fetch_array($run_off_pro);
        
                        $off_product_price = $row_off_pro['product_price'];
        
                            $grand_total = ($order_amount+$del_charges)+$off_product_price;
                        
                      }elseif (empty($discount_type)) {
        
                            $grand_total = $order_amount+$del_charges;
                      }
                }
                    
                    ?>
                    <tbody>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $invoice_no; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $grand_total; ?></td>
                        <td><?php echo $delivery_charges; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-bonus" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Bonus Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_bonus = "select * from del_bonus where delivery_partner_id='$delivery_partner_id'";
                    $run_bonus = mysqli_query($con,$get_bonus);
                    $counter = 0;
                    while($row_bonus = mysqli_fetch_array($run_bonus)){
                    $bonus_amt = $row_bonus['bonus_amt'];
                    $bonus_remark = $row_bonus['bonus_remarks'];
                    $bonus_date = $row_bonus['updated_date'];
                    $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($bonus_date)); ?></td>
                        <td><?php echo $bonus_amt; ?></td>
                        <td><?php echo $bonus_remark; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-debits" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Debit Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_debits = "select * from del_debits where delivery_partner_id='$delivery_partner_id'";
                    $run_debits = mysqli_query($con,$get_debits);
                    $counter = 0;
                    while($row_debits = mysqli_fetch_array($run_debits)){
                        $fmr_debit_amt = $row_debits['fmr_debit_amt'];
                        $fmr_debit_comment = $row_debits['fmr_debit_comment'];
                        $debit_date = $row_debits['updated_date'];
                        $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($debit_date)); ?></td>
                        <td><?php echo $fmr_debit_amt; ?></td>
                        <td><?php echo $fmr_debit_comment; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-settel" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Settlement Amount</th>
                            <th>Settlement Type</th>
                            <th>Settlement Ref.Id</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_credits = "select * from del_settlements where delivery_partner_id='$delivery_partner_id'";
                    $run_credits = mysqli_query($con,$get_credits);
                    while($row_credits = mysqli_fetch_array($run_credits)){
                        $settlement_amt = $row_credits['settlement_amt'];
                        $settlement_type = $row_credits['settlement_type'];
                        $settlement_ref_id = $row_credits['settlement_ref_id'];
                        $settlement_date = $row_credits['updated_date'];
                        $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($settlement_date)); ?></td>
                        <td><?php echo $settlement_amt; ?></td>
                        <td><?php echo $settlement_type; ?></td>
                        <td><?php echo $settlement_ref_id; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-salary" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Salary Amount</th>
                            <th>Salary Type</th>
                            <th>Salary Ref.Id</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_salary = "select * from del_payroll where delivery_partner_id='$delivery_partner_id'";
                    $run_salary = mysqli_query($con,$get_salary);
                    while($row_salary = mysqli_fetch_array($run_salary)){
                        $salary_amt = $row_salary['salary_amt'];
                        $salary_type = $row_salary['salary_type'];
                        $salary_ref_id = $row_salary['salary_ref_id'];
                        $salary_date = $row_salary['updated_date'];
                        $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($salary_date)); ?></td>
                        <td><?php echo $salary_amt; ?></td>
                        <td><?php echo $salary_type; ?></td>
                        <td><?php echo $salary_ref_id; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php 

}else{

    echo "
    <div class='container'>
    <h5 class='text-center'> Wrong DEL CODE TRY AGAIN </h5>
    </div>
    ";}
    
    }else{

        echo "
        <div class='container'>
        <h5 class='text-center'> Wrong DEL CODE TRY AGAIN </h5>
        </div>
        ";

    } ?>