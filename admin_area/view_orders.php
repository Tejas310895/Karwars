<?php 
  
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

      $active='view_orders';

      
    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d");

?>

<?php 

$get_total_sales = "SELECT sum(due_amount) AS total FROM customer_orders where order_status='Delivered'";

$run_total_sales = mysqli_query($con,$get_total_sales);

$row_total_sales = mysqli_fetch_array($run_total_sales);

$total_sales = $row_total_sales['total'];

$get_today_sales = "SELECT sum(due_amount) AS total FROM customer_orders WHERE CAST(order_date as DATE)='$today' AND order_status in ('Order Placed','Delivered','Packed')";

$run_today_sales = mysqli_query($con,$get_today_sales);

$row_today_sales = mysqli_fetch_array($run_today_sales);

$today_sales = $row_today_sales['total'];

$get_total_count = "SELECT DISTINCT invoice_no FROM customer_orders where order_status='Delivered'";

$run_total_count = mysqli_query($con,$get_total_count);

$total_count = mysqli_num_rows($run_total_count);

//$total_count = $row_total_count['count'];

$get_today_count = "SELECT DISTINCT invoice_no FROM customer_orders WHERE CAST(order_date as DATE)='$today' AND order_status in ('Order Placed','Delivered','Packed')";

$run_today_count = mysqli_query($con,$get_today_count);

$today_count = mysqli_num_rows($run_today_count);

// $today_count = $row_today_count['count'];

$get_cancel_sales = "SELECT sum(due_amount) AS total FROM customer_orders where order_status='Cancelled'";

$run_cancel_sales = mysqli_query($con,$get_cancel_sales);

$row_cancel_sales = mysqli_fetch_array($run_cancel_sales);

$cancel_sales = $row_cancel_sales['total'];

$get_cancel_count = "SELECT DISTINCT invoice_no FROM customer_orders where order_status='Cancelled'";

$run_cancel_count = mysqli_query($con,$get_cancel_count);

$cancel_count = mysqli_num_rows($run_cancel_count);

//$cancel_count = $row_cancel_count['count'];

$get_cancel_sales_today = "SELECT sum(due_amount) AS total FROM customer_orders where CAST(order_date as DATE)='$today' AND order_status='Cancelled'";

$run_cancel_sales_today = mysqli_query($con,$get_cancel_sales_today);

$row_cancel_sales_today = mysqli_fetch_array($run_cancel_sales_today);

$cancel_sales_today = $row_cancel_sales_today['total'];

$get_cancel_count_today = "SELECT DISTINCT invoice_no FROM customer_orders where CAST(order_date as DATE)='$today' AND order_status='Cancelled'";

$run_cancel_count_today = mysqli_query($con,$get_cancel_count_today);

$cancel_count_today = mysqli_num_rows($run_cancel_count_today);

$get_stock_g = "select * from products where client_id='6'";
$run_stock_g = mysqli_query($con,$get_stock_g);
$stock_fund = array();
while ($row_stock_g=mysqli_fetch_array($run_stock_g)) {
    $vendor_price = $row_stock_g['vendor_price'];
    $warehouse_stock = $row_stock_g['warehouse_stock'];
    if($vendor_price>=1){
        $stock_amount = $vendor_price*$warehouse_stock;
    }else {
        $stock_amount = 0;
    }
    array_push($stock_fund, $stock_amount);
}

?>
<div class="row">
    <div class="col-lg-3">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Total Sales</h5>
                <h3 class="card-title mb-0"><i class="tim-icons icon-coins"></i>₹ <?php if($total_sales>0){echo $total_sales;}else{echo '0';}; ?></h3>
                <h5 class="text-primary">Today Sales : ₹ <?php if($today_sales>0){echo $today_sales;}else{echo '0';}; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Total Orders</h5>
                <h3 class="card-title mb-0"><i class="tim-icons icon-delivery-fast"></i> <?php if($total_count>0){echo $total_count;}else{echo '0';}; ?> </h3>
                <h5 class="text-primary">Today Orders : <?php if($today_count>0){echo $today_count;}else{echo '0';}; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Warehouse Stock</h5>
                <h3 class="card-title mb-0"><i class="tim-icons icon-delivery-fast"></i> <?php echo array_sum($stock_fund); ?> </h3>
                <!-- <h5 class="text-primary">Today Orders : <?php //if($today_count>0){echo $today_count;}else{echo '0';}; ?></h5> -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <nav class="nav nav-pills nav-fill" id="order_panel">
            <a class="nav-item nav-link rounded-0 active" href="#">Pending Orders (20)</a>
            <a class="nav-item nav-link rounded-0 active mx-2" href="index.php?purchase_orders">Purchase Orders (20)</a>
            <a class="nav-item nav-link rounded-0 active mx-1" href="index?notify">REQUIREMENT</a>
            <a class="nav-item nav-link rounded-0 active mx-1" href="index?stock_report">ORDER STOCK</a>
            <a class="nav-item nav-link rounded-0 active mx-1" href="index?order_report">REPORTS</a>
            <a class="nav-item nav-link rounded-0 active mx-2" href="index?promo_store">PROMOTION</a>
            <a class="nav-item nav-link rounded-0 active" href="index?vendor_report">DAILY REPORT</a>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-tasks border border-primary rounded-0 mb-0 p-2" id="order-basket">
        <?php
        
        $get_invoice = "SELECT DISTINCT invoice_no FROM customer_orders WHERE order_status in ('Order Placed','Out for Delivery','Packed') ORDER BY order_id DESC";

        $run_invoice = mysqli_query($con,$get_invoice);

        while($row_invoice=mysqli_fetch_array($run_invoice)){

            $invoice_id = $row_invoice['invoice_no'];

            $get_orders = "select * from customer_orders where invoice_no='$invoice_id' and product_status='Deliver'";

            $run_orders = mysqli_query($con,$get_orders);

            $order_count = mysqli_num_rows($run_orders);

            $row_orders = mysqli_fetch_array($run_orders);

            $c_id = $row_orders['customer_id'];

            $date = $row_orders['order_date'];

            $add_id = $row_orders['add_id'];

            $order_date = $row_orders['order_date'];

            $d_date = date('d-M-y H:m A',strtotime($order_date));

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

            if($discount_type==='amount'){

                $grand_total = ($total+$del_charges)-$discount_amount;

              }elseif ($discount_type==='product') {

                $get_off_pro = "select * from products where product_id='$discount_amount'";
                $run_off_pro = mysqli_query($con,$get_off_pro);
                $row_off_pro = mysqli_fetch_array($run_off_pro);

                $off_product_price = $row_off_pro['product_price'];

                $grand_total = ($total+$del_charges)+$off_product_price;
                
              }elseif (empty($discount_type)) {

                $grand_total = $total+$del_charges;
                
              }
              
              if(isset($coupon_code)){
                  $promo_code = "<span class='badge text-success bg-white text-dark text-uppercase font-weight-bold'>Promo Applied (".$coupon_code.")</span>";
                }else{
                    $promo_code = "";
                }

                $get_payment_status = "select * from paytm where ORDERID='$invoice_id'";
                $run_payment_status = mysqli_query($con,$get_payment_status);
                $row_payment_status = mysqli_fetch_array($run_payment_status);

                $txn_status = $row_payment_status['STATUS'];
                $TXNAMOUNT = $row_payment_status['TXNAMOUNT'];

                if($txn_status==='SUCCESS'){

                    $payment_check = "<div class='alert alert-success p-1 text-center mb-0' role='alert'>
                                            PREPAID
                                        </div>";
                    if($TXNAMOUNT!==$grand_total){
                        $refund_amt = $TXNAMOUNT-$grand_total;
                        $refund_check = "<div class='alert alert-warning p-1 text-center mb-0' role='alert'>
                                                Refund Rs $refund_amt/-
                                            </div>";
                    }else {
                        $refund_check = "";
                    }
                }else {
                    $payment_check = "<div class='alert alert-info p-1 text-center mb-0' role='alert'>
                                            POSTPAID
                                        </div>";
                                        
                                        $get_link = "select * from payment_links where invoice_id='$invoice_id'";
                                        $run_link = mysqli_query($con,$get_link);
                                        $row_link = mysqli_fetch_array($run_link);
                                        $link_count = mysqli_num_rows($run_link);
                                        
                                        if($link_count<=0){
                                            $payment_link = "
                                                            <a href='pay_link.php?order_id=$invoice_id' class='btn btn-success text-white' title='Generate Link'>
                                                                <i class='tim-icons icon-link-72 text-white'></i>
                                                            </a>
                                                            ";
                                        }else {
                                            $payment_link = "
                                                            <a href='process_orders.php?order_link=$invoice_id' class='btn btn-success text-white' title='Send Link'>
                                                                <i class='tim-icons icon-chat-33 text-white'></i>
                                                            </a>
                                                            ";
                                        }
                    $refund_check = "";
                }


            echo "
                <div class='card'>
                    <div class='card-body bg-primary p-2'>
                        <div class='row'>
                            <div class='col-md-3 col-lg-3 border-right pl-4'>
                                <div class='row'>
                                    <div class='col-8'><h5 class='card-title mt-2 mb-1'>Order Id- $invoice_id $promo_code</h5></div>
                                    <div class='col-4'>$payment_check</div>
                                </div>
                                <div class='row'>
                                    <div class='col-6'>
                                        <h5 class='card-title'>Amount -₹".$grand_total."/-";
                                        if($del_charges>=1){
                                            if(empty($discount_type)){
                                                echo "(".$total."+".$del_charges."dlc";
                                            }elseif ($discount_type==='amount') {
                                                echo "(".$total."+".$del_charges."dlc -".$discount_amount."dc";
                                            }elseif ($discount_type==='product') {
                                                $get_off_pro = "select * from products where product_id='$discount_amount'";
                                                $run_off_pro = mysqli_query($con,$get_off_pro);
                                                $row_off_pro = mysqli_fetch_array($run_off_pro);
                                
                                                $off_product_price = $row_off_pro['product_price'];
                                                            
                                                echo "(".$total."+".$del_charges."dlc +".$off_product_price."dc";    
                                            }
                                        }else {

                                            if(empty($discount_type)){
                                                echo "(".$total;
                                            }elseif ($discount_type==='amount') {
                                                echo "(".$total."-".$discount_amount."dc";
                                            }elseif ($discount_type==='product') {
                                                $get_off_pro = "select * from products where product_id='$discount_amount'";
                                                $run_off_pro = mysqli_query($con,$get_off_pro);
                                                $row_off_pro = mysqli_fetch_array($run_off_pro);
                                
                                                $off_product_price = $row_off_pro['product_price'];
                                                            
                                                echo "(".$total."-".$off_product_price."dc";    
                                            }
                                            
                                        }
                                        echo ")</h5>
                                    </div>
                                    <div class='col-6'>$refund_check</div>
                                </div>
                            </div>
                            <div class='col-md-4 col-lg-4 border-right'>
                                <h5 class='card-title text-uppercase  mt-2 mb-1'>Name- $c_name(Date:$d_date)</h5>
                                <h5 class='card-title text-uppercase  mt-2 mb-1'>Name- $c_contact</h5>
                                <h5 class='card-title'>
                                    Address - $customer_address $customer_phase $customer_landmark $customer_city.
                                </h5>
                            </div>
                            <div class='col-md-5 col-lg-5 text-right'>
                                <button id='show_details' class='btn btn-success text-white' data-toggle='modal' data-target='#KK$invoice_id' title='view'>
                                    <i class='tim-icons icon-alert-circle-exc text-white'></i>
                                </button>
                                <a class='btn btn-info' href='dprint.php?print=$invoice_id' target='_blank'>
                                    <i class='fas fa-print text-white'></i>
                                </a>
                                <a class='btn btn-info' href='kot.php?print=$invoice_id' target='_blank'>
                                    <i class='tim-icons icon-paper text-white'></i>
                                </a>
                                <a class='btn btn-success' href='index.php?confirm_order=$invoice_id' title='Edit'>
                                    <i class='tim-icons icon-pencil text-white'></i>
                                </a>
                                <a class='btn btn-success' href='process_order.php?cancel_order=$invoice_id' onclick=\"return confirm('Are you sure?')\" title='Cancel Order'>
                                    <i class='tim-icons icon-trash-simple text-white'></i>
                                </a>
                                <a class='btn btn-success' href='process_order.php?update_order=$invoice_id&status=Delivered' title='Update Delivered'>
                                    <i class='tim-icons icon-delivery-fast text-white'></i>
                                </a>
                                ";
                                $get_del_boy_count = "select * from orders_delivery_assign where invoice_no='$invoice_id'";
                                $run_del_boy_count = mysqli_query($con,$get_del_boy_count);
                                $row_del_boy_count = mysqli_fetch_array($run_del_boy_count);
                                $delivery_partner_show_id = $row_del_boy_count['delivery_partner_id'];

                                $get_del_show = "select * from delivery_partner where delivery_partner_id='$delivery_partner_show_id'";
                                $run_del_show = mysqli_query($con,$get_del_show);
                                $row_del_show = mysqli_fetch_array($run_del_show);
                                $delivery_partner_name = $row_del_show['delivery_partner_name'];
                                $del_boy_count = mysqli_num_rows($run_del_boy_count);
                                if($del_boy_count<=0){
                                echo"
                                <form action='ajax_orders.php' method='post' class='mt-2'>
                                    <div class='input-group'>
                                        <input type='hidden' name='del_inc_id' value='$invoice_id'>
                                        <select class='custom-select' name='del_id' required>
                                            <option selected value=''>Choose the Delivery Agent</option>";
                                            $get_del_boy = "select * from delivery_partner";
                                            $run_del_boy = mysqli_query($con,$get_del_boy);
                                            while($row_del_boy = mysqli_fetch_array($run_del_boy)){
                                                $del_boy_id = $row_del_boy['delivery_partner_id'];
                                                $del_boy_name = $row_del_boy['delivery_partner_name'];
                                                echo "
                                                    <option value='$del_boy_id'>$del_boy_name</option>
                                                ";
                                            }
                                        echo "</select>
                                        <input type='text' class='form-control bg-white text-dark rounded-0' name='del_charge' placeholder='Enter Del Amount' aria-label='Username' required>
                                        <div class='input-group-append border-0'>
                                            <button class='btn btn-md btn-dark mt-0' type='submit'>Submit</button>
                                        </div>
                                    </div>
                                </form>";

                            }else {
                                echo "<small class='text-white pr-3 font-weight-bold text-uppercase'>$delivery_partner_name</small><a class='btn btn-info' href='ajax_orders.php?assign_id=$invoice_id'>Change Delivery Agent</a>";
                            }
                            echo "</div>
                        </div>
                    </div>
                </div>
            ";?>
            <!-- Modal -->
            <div class="modal modal-black fade" id="KK<?php echo $invoice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Order Id - <?php echo $invoice_id; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                    <div class="modal-body my-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">IMAGE</th>
                                <th class="text-center">ITEMS</th>
                                <th class="text-center">QTY</th>
                                <th class="text-right">PRICE</th>
                                <th class="text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                        $get_vendor = "select * from customer_orders where invoice_no='$invoice_id' group by client_id";
                        $run_vendor = mysqli_query($con,$get_vendor);
                        while ($row_vendor=mysqli_fetch_array($run_vendor)) {
                        $vendor_id = $row_vendor['client_id'];

                        $get_client = "select * from clients where client_id='$vendor_id'";

                        $run_client = mysqli_query($con,$get_client);

                        $row_client = mysqli_fetch_array($run_client);

                        $client_name = $row_client['client_shop'];

                        echo "<td colspan='5' class='text-center'>$client_name</td>";

                        $get_pro_id = "select * from customer_orders where invoice_no='$invoice_id' and client_id='$vendor_id'";

                        $run_pro_id = mysqli_query($con,$get_pro_id);

                        $counter = 0;

                        while($row_pro_id = mysqli_fetch_array($run_pro_id)){

                        $pro_id = $row_pro_id['pro_id'];

                        $qty = $row_pro_id['qty'];

                        $sub_total = $row_pro_id['due_amount'];

                        $client_id = $row_pro_id['client_id'];

                        $pro_price = $sub_total/$qty;                                  

                        $pro_status = $row_pro_id['product_status'];

                        $get_pro = "select * from products where product_id='$pro_id'";

                        $run_pro = mysqli_query($con,$get_pro);

                        $row_pro = mysqli_fetch_array($run_pro);

                        $pro_title = $row_pro['product_title'];

                        $pro_img1 = $row_pro['product_img1'];

                        $warehouse_stock = $row_pro['warehouse_stock'];

                        // $pro_price = $row_pro['product_price'];

                        $pro_desc = $row_pro['product_desc'];
                        
                        // $sub_total = $pro_price * $qty;

                        $get_min = "select * from admins";

                        $run_min = mysqli_query($con,$get_min);

                        $row_min = mysqli_fetch_array($run_min);

                        $min_price = $row_min['min_order'];

                        // $del_charges = $row_min['del_charges'];

                        $get_today_stock = "SELECT sum(qty) AS today_qty FROM customer_orders WHERE CAST(order_date as DATE)='$today' AND order_status in ('Order Placed','Packed') AND pro_id='$pro_id'";
                        $run_today_stock = mysqli_query($con,$get_today_stock);
                        $row_today_stock = mysqli_fetch_array($run_today_stock);

                        $today_qty = $row_today_stock['today_qty'];

                        $exceed_stock = $today_qty+$qty;
                        
                        $get_del_charges = "select * from order_charges where invoice_id='$invoice_id'";
                        $run_del_charges = mysqli_query($con,$get_del_charges);
                        $row_del_charges = mysqli_fetch_array($run_del_charges);

                        $del_charges = $row_del_charges['del_charges'];

                        ?>
                            <tr>
                                <td class="text-center">
                                <img src="<?php echo $pro_img1; ?>" alt="" class="img-thumbnail border-0" width="40px">
                                </td>
                                <td class="text-center"><?php echo $pro_title; ?><br><?php echo $pro_desc; ?><br><span class="badge badge-warning <?php if(($warehouse_stock*2)<=$exceed_stock){echo"show";}else{echo"d-none";}?>">Stock warning</span></td>
                                <td class="text-center"><?php echo $qty; ?> x ₹ <?php echo $pro_price; ?></td>
                                <td class="text-right">₹ <?php echo $sub_total; ?></td>
                                <td class="text-right"><?php echo $pro_status; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            <?php 
                            
                            if($discount_type==='product'){

                            $get_off_pro_det = "select * from products where product_id='$discount_amount'";
                            $run_off_pro_det = mysqli_query($con,$get_off_pro_det);
                            $row_off_pro_det = mysqli_fetch_array($run_off_pro_det);

                            $off_product_det_client_id = $row_off_pro_det['client_id'];
                            $off_product_det_product_img1 = $row_off_pro_det['product_img1'];
                            $off_product_det_product_title = $row_off_pro_det['product_title'];
                            $off_product_det_product_desc = $row_off_pro_det['product_desc'];
                            $off_product_det_product_price = $row_off_pro_det['product_price'];

                            $get_off_client = "select * from clients where client_id='$off_product_det_client_id'";
                            $run_off_client = mysqli_query($con,$get_off_client);
                            $row_off_client = mysqli_fetch_array($run_off_client);

                            $off_client_name = $row_off_client['client_name'];
                            
                            ?>
                            <tr>
                            <td colspan="6">
                                <h5 class="card-title text-center mb-0 text-uppercase" colspan="6">Offer Product Zone</h5>
                            </td>
                            </tr>
                            <tr>
                                <td class="text-center"><?php echo $off_client_name; ?></td>
                                <td class="text-center">
                                <img src="<?php echo $off_product_det_product_img1; ?>" alt="" class="img-thumbnail border-0" width="40px">
                                </td>
                                <td class="text-center" colspan="2"><?php echo $off_product_det_product_title; ?><br><?php echo $off_product_det_product_desc; ?></td>
                                <td class="text-right" colspan="2">₹ <?php echo $off_product_det_product_price; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                        <?php 
                        
                        if($discount_type==='amount'){
                        $modal_total = ($total+$del_charges)-$discount_amount;
                        }elseif ($discount_type==='product') {
                        $modal_total = $total+$del_charges+$off_product_det_product_price;
                        }else {
                            $modal_total = $total+$del_charges;
                        }
                        
                        ?>
                        <h3 class="card-title">Total - ₹ <?php echo $modal_total; ?>/-</h3>
                    </div>
                    </div>
                </div>
            </div>
        <!-- Modal -->
        <?php 

            }
        ?>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<?php } ?>
