<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>
<?php 

$get_total_sales = "SELECT sum(due_amount) AS total FROM customer_orders where order_status='Delivered'";

$run_total_sales = mysqli_query($con,$get_total_sales);

$row_total_sales = mysqli_fetch_array($run_total_sales);

$total_sales = $row_total_sales['total'];

$get_today_sales = "SELECT sum(due_amount) AS total FROM customer_orders WHERE order_date=DATE(now()) AND order_status='Delivered'";

$run_today_sales = mysqli_query($con,$get_today_sales);

$row_today_sales = mysqli_fetch_array($run_today_sales);

$today_sales = $row_today_sales['total'];

$get_total_count = "SELECT DISTINCT invoice_no FROM customer_orders where order_status='Delivered'";

$run_total_count = mysqli_query($con,$get_total_count);

$total_count = mysqli_num_rows($run_total_count);

//$total_count = $row_total_count['count'];

$get_today_count = "SELECT DISTINCT invoice_no FROM customer_orders WHERE order_date=DATE(now()) AND order_status='Delivered'";

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



?>
        
        <div class="row">
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Sales</h5>
                <h3 class="card-title"><i class="tim-icons icon-coins"></i>₹ <?php if($total_sales>0){echo $total_sales;}else{echo '0';}; ?> </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Daily Sales</h5>
                <h3 class="card-title"><i class="tim-icons icon-coins"></i>₹ <?php if($today_sales>0){echo $today_sales;}else{echo '0';} ?> </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Orders</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast"></i> <?php if($total_count>0){echo $total_count;}else{echo '0';} ?> </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Today Orders</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast"></i> <?php if($today_count>0){echo $today_count;}else{echo '0';} ?> </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Sales Lost</h5>
                <h3 class="card-title"><i class="tim-icons icon-coins"></i>₹ <?php if($cancel_sales>0){echo $cancel_sales;}else{echo '0';} ?> </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Orders Cancelled</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast"></i> <?php if($cancel_count>0){echo $cancel_count;}else{echo '0';} ?> </h3>
              </div>
            </div>
          </div>
        </div>
          <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
            <th>STATUS</th>
            <th>ORD ID</th>
            <th>ORDER DATE</th>
            <th>ORDER BY</th>
            <th>CONTACT</th>
            <th>ADDRESS</th>
            <th>ITEMS</th>
            <th>COST</th>
            <th>PAYMENT TYPE</th>
            <th>ACTION</th>
		</tr>
	</thead>
	<tbody>
    <?php
                
                $get_invoice = "SELECT DISTINCT invoice_no FROM customer_orders ORDER BY order_id DESC";

                $run_invoice = mysqli_query($con,$get_invoice);

                while($row_invoice=mysqli_fetch_array($run_invoice)){

                    $invoice_id = $row_invoice['invoice_no'];

                    $order_status = 'Order Placed';

                    $get_orders = "select * from customer_orders where invoice_no='$invoice_id'";

                    $run_orders = mysqli_query($con,$get_orders);

                    $order_count = mysqli_num_rows($run_orders);

                    $row_orders = mysqli_fetch_array($run_orders);

                    $c_id = $row_orders['customer_id'];

                    $date = $row_orders['order_date'];

                    $add_id = $row_orders['add_id'];

                    $status = $row_orders['order_status'];

                    $order_date = $row_orders['order_date'];

                    $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id'";

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

                    $get_txn = "select * from paytm where ORDERID='$invoice_id'";

                    $run_txn = mysqli_query($con,$get_txn);

                    $row_txn = mysqli_fetch_array($run_txn);

                    $txn_status = $row_txn['STATUS'];

                  ?>
                          <tr class="text-center">
                          <td style="font-size:0.8rem;"><?php echo $status; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $invoice_id; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $order_date; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $c_name; ?></td>
                          <td style="font-size:0.8rem;">+91 <?php echo $c_contact; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $customer_address; ?>, 
                              <?php echo $customer_phase; ?>, 
                              <?php echo $customer_landmark; ?>, 
                              <?php echo $customer_city; ?> .
                          </td>
                          <td style="font-size:0.7rem; text-align:center;"><?php echo $order_count; ?></td>
                          <td style="font-size:0.7rem;">₹ <?php echo $total; ?>/-</td>
                          <td><?php if($txn_status=='TXN_SUCCESS'){echo"ONLINE";}else{echo"OFFLINE";} ; ?></td>
                          <td class="td-actions" >
                          <button id="show_details" class="btn btn-info btn-sm p-1" style="font-size:0.7rem;" data-toggle="modal" data-target="#KK<?php echo $invoice_id; ?>">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#fff"/><stop offset="1" stop-color="#fff"/></linearGradient><g><g><path d="m509.188 247.27c-4.571-6.387-114.526-156.27-253.188-156.27s-248.617 149.883-253.187 156.27c-3.75 5.215-3.75 12.246 0 17.461 4.57 6.386 114.525 156.269 253.187 156.269s248.617-149.883 253.188-156.27c3.75-5.214 3.75-12.246 0-17.46zm-253.188 143.73c-105.176 0-197.143-103.813-222.074-135 24.931-31.187 116.898-135 222.074-135s197.143 103.813 222.074 135c-24.931 31.187-116.898 135-222.074 135zm0-240c-57.891 0-105 47.109-105 105s47.109 105 105 105 105-47.109 105-105-47.109-105-105-105zm0 180c-41.367 0-75-33.647-75-75s33.633-75 75-75 75 33.647 75 75-33.633 75-75 75zm0-120c-24.814 0-45 20.186-45 45s20.186 45 45 45 45-20.186 45-45-20.186-45-45-45zm0 60c-8.262 0-15-6.724-15-15s6.738-15 15-15 15 6.724 15 15-6.738 15-15 15zm0-211c8.291 0 15-6.709 15-15v-30c0-8.291-6.709-15-15-15s-15 6.709-15 15v30c0 8.291 6.709 15 15 15zm0 392c-8.291 0-15 6.709-15 15v30c0 8.291 6.709 15 15 15s15-6.709 15-15v-30c0-8.291-6.709-15-15-15zm-117.979-370.36c4.081 7.12 13.237 9.65 20.479 5.493 7.178-4.146 9.639-13.315 5.479-20.493l-15-25.986c-4.131-7.178-13.359-9.624-20.479-5.493-7.178 4.146-9.639 13.315-5.479 20.493zm235.958 348.72c-4.102-7.192-13.301-9.653-20.479-5.493-7.178 4.146-9.639 13.315-5.479 20.493l15 25.986c4.081 7.12 13.237 9.65 20.479 5.493 7.178-4.146 9.639-13.315 5.479-20.493zm-20.479-343.227c7.242 4.157 16.399 1.625 20.479-5.493l15-25.986c4.16-7.178 1.699-16.348-5.479-20.493-7.148-4.087-16.348-1.67-20.479 5.493l-15 25.986c-4.16 7.177-1.699 16.347 5.479 20.493zm-195 337.734c-7.148-4.116-16.348-1.685-20.479 5.493l-15 25.986c-4.16 7.178-1.699 16.348 5.479 20.493 7.242 4.157 16.399 1.625 20.479-5.493l15-25.986c4.16-7.177 1.699-16.347-5.479-20.493z" fill="url(#SVGID_1_)"/></g></g></svg>
                        </button>
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
                                            <th class="text-center">Sl.no.</th>
                                            <th class="text-center">IMAGE</th>
                                            <th class="text-center">ITEMS</th>
                                            <th class="text-center">PACK</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-right">PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                    $get_pro_id = "select * from customer_orders where invoice_no='$invoice_id'";

                                    $run_pro_id = mysqli_query($con,$get_pro_id);

                                    $counter = 0;

                                    while($row_pro_id = mysqli_fetch_array($run_pro_id)){

                                    $pro_id = $row_pro_id['pro_id'];

                                    $qty = $row_pro_id['qty'];

                                    $get_pro = "select * from products where product_id='$pro_id'";

                                    $run_pro = mysqli_query($con,$get_pro);

                                    $row_pro = mysqli_fetch_array($run_pro);

                                    $pro_title = $row_pro['product_title'];

                                    $pro_img1 = $row_pro['product_img1'];

                                    $pro_price = $row_pro['product_price'];

                                    $pro_desc = $row_pro['product_desc'];
                                    
                                    $sub_total = $pro_price * $qty;
                                    
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$counter; ?></td>
                                            <td class="text-center">
                                              <img src="product_images/<?php echo $pro_img1; ?>" alt="" class="img-thumbnail border-0" width="60px">
                                            </td>
                                            <td class="text-center"><?php echo $pro_title; ?></td>
                                            <td class="text-center"><?php echo $pro_desc; ?></td>
                                            <td class="text-center"><?php echo $qty; ?> x ₹ <?php echo $pro_price; ?></td>
                                            <td class="text-right">₹ <?php echo $sub_total; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                                    <h3 class="card-title">Total - ₹ <?php echo $total; ?>/-</h3>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a href="print.php?print=<?php echo $invoice_id; ?>" id="show_details" class="btn btn-danger btn-sm p-1" >
                          <svg id="Capa_1" enable-background="new 0 0 512 512" fill="#fff" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><g><path d="m422.5 99v-24c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v24z"/><path d="m118.5 319v122 26 15c0 16.568 13.431 30 30 30h214c16.569 0 30-13.432 30-30v-15-26-122zm177 128h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15zm0-64h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/><path d="m436.5 129h-361c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h13v-80h-9c-8.284 0-15-6.716-15-15s6.716-15 15-15h24 304 24c8.284 0 15 6.716 15 15s-6.716 15-15 15h-9v80h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-309 94h-48c-8.284 0-15-6.716-15-15s6.716-15 15-15h48c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/></g></svg>
                        </a>
                          </td>
                          </tr>
                          <?php } ?>
	</tbody>
</table>

                </div>
          </div>
          <!-- partial -->
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='js/datatable.js'></script>
<?php } ?>