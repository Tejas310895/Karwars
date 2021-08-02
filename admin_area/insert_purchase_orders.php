<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
<div class="row">
    <div class="col-lg-6 col-md-6">
    <h2 class="card-title">NEW PURCHASE ORDER</h2>
    </div>
    <div class="col-lg-6 col-md-6">
    <a href="index.php?purchase_orders" class="btn btn-primary pull-right">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-tasks border border-primary rounded-0 mb-0 p-2" id="order-basket">
        <form action="" method="post" id="purchase_entry_form">
                <div class="card-header purchase_entry_top">
                    <div class="dropdown">
                        <button class="btn btn-success" name="purchase_order_submit" type='submit'>Generate Order</button>
                    </div>
                    <h4 class="title d-inline">Pending order to be sent for purchase (5)</h4>
                    <div class="form-check mt-1 ml-2">
                        <label class="form-check-label">
                            <input class="form-check-input" id="purchase_order_all" type="checkbox" value="">
                            <span class="form-check-sign">
                            <span class="check">Select All</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table" id="table-scroll">
                        <tbody>
                        <?php
                        $invoice_basket = array();
                        $get_invoice_check = "select * from purchase_entry";
                        $run_invoice_check = mysqli_query($con,$get_invoice_check);
                        while($row_invoice_check=mysqli_fetch_array($run_invoice_check)){
                            $purchase_invoices_array = $row_invoice_check['purchase_entry_invoices'];
                            $purchase_invoices_unser = unserialize($purchase_invoices_array);
                            foreach ($purchase_invoices_unser as $invoices) {
                                array_push($invoice_basket, $invoices);
                            }
                        }
                
                      $get_invoice = "SELECT DISTINCT invoice_no FROM customer_orders WHERE order_status in ('Order Placed','Out for Delivery','Packed') ORDER BY order_id DESC";

                      $run_invoice = mysqli_query($con,$get_invoice);

                      while($row_invoice=mysqli_fetch_array($run_invoice)){
                        
                          $invoice_id = $row_invoice['invoice_no'];

                          if (!in_array($invoice_id, $invoice_basket)){

                          $get_orders = "select * from customer_orders where invoice_no='$invoice_id' and product_status='Deliver'";

                          $run_orders = mysqli_query($con,$get_orders);

                          $order_count = mysqli_num_rows($run_orders);

                          $row_orders = mysqli_fetch_array($run_orders);

                          $c_id = $row_orders['customer_id'];

                          $date = $row_orders['order_date'];

                          $add_id = $row_orders['add_id'];

                          $order_date = $row_orders['order_date'];

                          $order_schedule = $row_orders['order_schedule'];

                          $order_status = $row_orders['order_status'];

                          $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver'";

                          $run_total = mysqli_query($con,$get_total);

                          $row_total = mysqli_fetch_array($run_total);

                          $total = $row_total['total'];

                          $get_customer = "select * from customers where customer_id='$c_id'";

                          $run_customer = mysqli_query($con,$get_customer);

                          $row_customer = mysqli_fetch_array($run_customer);

                          $c_name = $row_customer['customer_name'];

                          $c_contact = $row_customer['customer_contact'];

                          $get_add = "select * from customer_address where add_id='$add_id'";

                          $run_add = mysqli_query($con,$get_add);

                          $row_add = mysqli_fetch_array($run_add);

                          $customer_address = $row_add['customer_address'];

                          $customer_phase = $row_add['customer_phase'];

                          $customer_landmark = $row_add['customer_landmark'];

                          $customer_city = $row_add['customer_city'];

                          $get_min = "select * from admins";

                          $run_min = mysqli_query($con,$get_min);

                          $row_min = mysqli_fetch_array($run_min);

                          $min_price = $row_min['min_order'];

                          // $del_charges = $row_min['del_charges'];

                          $get_txn = "select * from paytm where ORDERID='$invoice_id'";

                          $run_txn = mysqli_query($con,$get_txn);

                          $row_txn = mysqli_fetch_array($run_txn);

                          $txn_status = $row_txn['STATUS'];

                          $get_discount = "select * from customer_discounts where invoice_no='$invoice_id'";
                          $run_discount = mysqli_query($con,$get_discount);
                          $row_discount = mysqli_fetch_array($run_discount);

                          $coupon_code = $row_discount['coupon_code'];
                          $discount_type = $row_discount['discount_type'];
                          $discount_amount = $row_discount['discount_amount'];

                          $get_del_charges = "select * from order_charges where invoice_id='$invoice_id'";
                          $run_del_charges = mysqli_query($con,$get_del_charges);
                          $row_del_charges = mysqli_fetch_array($run_del_charges);

                          $del_charges = $row_del_charges['del_charges'];

                          $get_value_diff = "select * from bill_controller where invoice_no='$invoice_id'";
                          $run_value_diff = mysqli_query($con,$get_value_diff);
                          $diff_amount_total = 0;
                          while($row_value_diff = mysqli_fetch_array($run_value_diff)){
      
                          $value_diff_amount = $row_value_diff['bill_amount'];
                          $diff_amount_total += $value_diff_amount;
                          }


                          ?>
                            <tr>
                            <td>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="purchase_order_id" type="checkbox" name="purchase_inc[]" value="<?php echo $invoice_id; ?>">
                                    <span class="form-check-sign">
                                    <span class="check"></span>
                                    </span>
                                </label>
                                </div>
                            </td>
                            <td>
                                <p class="title">Order Id - <?php echo $invoice_id; ?> / Name - <?php echo $c_name; ?> / Amount - ₹ <?php echo $total; ?> /-</p>
                                <p class="text-muted">Address - <?php echo $customer_address." ".$customer_phase." ".$customer_landmark." ".$customer_city; ?>.</p>
                            </td>
                            <td class="td-actions text-right">
                            </td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                        <tfoot class="">
                                
                        </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<?php 
} 
?>

<?php 

if(isset($_POST['purchase_order_submit'])){

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    if(empty($_POST['purchase_inc'])){
        echo "<script>alert('Select any one order to generate purchase order')</script>";
    }else {

        $purchase_entry_invoices = serialize($_POST['purchase_inc']);

        $get_last_id = "select * from purchase_entry order by purchase_entry_id desc limit 1";
        $run_last_id = mysqli_query($con,$get_last_id);
        $row_last_id = mysqli_fetch_array($run_last_id);

        $last_id = $row_last_id['purchase_entry_id'];

        $next_id = $last_id+1;

        $purchase_entry_no = rand(10000000,99999999).$next_id;
       
        $insert_purchase_order = "insert into purchase_entry (purchase_entry_no,
                                                              purchase_entry_invoices,
                                                              purchase_entry_created_at,
                                                              purchase_entry_updated_at)
                                                              values
                                                              ('$purchase_entry_no',
                                                              '$purchase_entry_invoices',
                                                              '$today',
                                                              '$today')";
        $run_purchase_order = mysqli_query($con,$insert_purchase_order);

        if($run_purchase_order){
            echo "<script>alert('Purchase Order Generated')</script>";
            echo "<script>window.open('index.php?purchase_orders','_self')</script>";        
        }else {
            echo "<script>alert('Purchase Order Failed')</script>";
            echo "<script>window.open('index.php?insert_purchase_orders','_self')</script>";        
        }
        
    }
}

?>