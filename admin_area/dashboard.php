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

$get_today_count = "SELECT sum(due_amount) AS count FROM customer_orders WHERE order_date=DATE(now()) AND order_status='Delivered'";

$run_today_count = mysqli_query($con,$get_today_count);

$row_today_count = mysqli_fetch_array($run_today_count);

$today_count = $row_today_count['count'];

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
            <div class="card card-tasks mb-0">
              <div class="card-header ">
                <h4 class="title text-center">ORDERS DATA</h4>
              </div>
              <div class="card-body" id="refresh">
                <div class="table-full-width table-responsive" id="time">
                <table class="table">
                              <thead>
                                  <tr class="text-center">
                                      <th>STATUS</th>
                                      <th>ORD ID</th>
                                      <th>Order Date</th>
                                      <th>Order By</th>
                                      <th>Contact</th>
                                      <th>Address</th>
                                      <th>Items</th>
                                      <th>Cost</th>
                                      <th>View</th>
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
                                <td class="td-actions" >
                                <button id="show_details" class="btn btn-success card-link pull-right px-2 py-1" style="font-size:0.7rem;" data-toggle="modal" data-target="#KK<?php echo $invoice_id; ?>">View</button>
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
                                </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                </table>

                                  
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>

    <?php } ?>