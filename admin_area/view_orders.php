<?php 
  
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

      $active='view_orders';

?>

<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks mb-0">
              <div class="card-header ">
                <h3 class="title d-inline ml-4">ORDERS</h3>
                <a href="index?notify" class="btn btn-primary pull-right">REQUIREMENT</a>
                <a href="index?stock_report" class="btn btn-primary pull-right">ORDER STOCK</a>
                <a href="index?order_report" class="btn btn-primary pull-right">REPORTS</a>
              </div>
              <div class="card-body" id="refresh">
                <div class="table-full-width table-responsive" id="time">
                  <!-- <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Arival at export process</p>
                          <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table> -->
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

                          $del_charges = $row_min['del_charges'];

                          $get_txn = "select * from paytm where ORDERID='$invoice_id'";

                          $run_txn = mysqli_query($con,$get_txn);

                          $row_txn = mysqli_fetch_array($run_txn);

                          $txn_status = $row_txn['STATUS'];
                  ?>
                      <div class="card">
                            <div class="card-body card_shadow mx-3 mt-2 mb-0">
                                <div class="row">
                                  <div class="col"><h4 class="card-text mb-2">Order on - <?php echo date('d/M/Y,h:i:s a',strtotime($order_date)); ?></h4></div>
                                  <div class="col"><h4 class="card-title pull-right">Delivery by - <?php echo $date; ?></h4></div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                  <h5 class="card-subtitle">ID - <?php echo $invoice_id; ?></h5>
                                  <h4 class="card-subtitle mt-2">Order by - <?php echo $c_name; ?></h4>
                                  <h4 class="card-subtitle mt-2">Contact - +91 <?php echo $c_contact; ?></h4>
                                  <h4 class="card-text mt-3">Address - <?php echo $customer_address; ?>, 
                                                                      <?php echo $customer_phase; ?>, 
                                                                      <?php echo $customer_landmark; ?>, 
                                                                      <?php echo $customer_city; ?> .
                                                                      </h4>
                                  </div>
                                  <div class="col">
                                    <h6 class="card-title mt-2 pull-right p-2 rounded font-weight-bold <?php if($txn_status==='TXN_SUCCESS'){echo "bg-success";}else{echo "bg-danger";} ?>">
                                      <?php if($txn_status==='TXN_SUCCESS'){echo "PAID ONLINE";}else{echo "TAKE CASH";} ?>
                                    </h6>
                                    <h3 class="card-subtitle mt-2 pull-right">
                                      <?php echo $order_count; ?> Items -  ₹<?php echo $total+$del_charges; ?>/-  <br>
                                      REFUND OF ₹<?php 
                                      
                                      $get_refund = "SELECT sum(due_amount) AS refund FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Undeliver'";

                                      $run_refund = mysqli_query($con,$get_refund);

                                      $row_refund = mysqli_fetch_array($run_refund);

                                      $refund = $row_refund['refund'];

                                      if($refund>1){

                                        echo "$refund";

                                      }else{

                                        echo '0';

                                      }
                                      
                                      ?>/- 
                                    </h3>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button id="show_details" class="btn btn-success card-link pull-left mt-2" data-toggle="modal" data-target="#KK<?php echo $invoice_id; ?>">View</button>
                                        <a href="print.php?print=<?php echo $invoice_id; ?>" target="_blank" id="show_details" class="btn btn-info card-link pull-left mt-2 text-white" >Delivery Statement</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="row">
                                      <div class="col-6">
                                      <button type="button" class="btn btn-danger <?php if($order_status==='Order Placed'){echo"show";}else {echo"d-none";} ?>" data-toggle="modal" data-target="#cancle">Cancle Order</button>
                                      <div class="modal fade" id="cancle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="exampleModalLabel">ARE YOU SURE YOU WANT TO CANCEL</h3>
                                            </div>
                                            <div class="modal-footer">
                                              <a href="process_order.php?cancel_order=<?php echo $invoice_id;?>" type="button" class="btn btn-primary">YES</a>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                        </div>
                                        <div class="col-6">
                                          <?php 
                                          
                                          if($order_status==='Order Placed'){
                                            echo "
                                            <a href='index.php?confirm_order=$invoice_id' class='btn btn-primary d-block'>Confirm Order</a>
                                            ";
                                          }elseif ($order_status==='Packed') {
                                            echo "
                                            <a href='process_order.php?update_order=$invoice_id&status=Out for Delivery' class='btn btn-primary d-block'>Out for Delivery</a>
                                            ";
                                          }elseif($order_status==='Out for Delivery'){
                                            echo "
                                            <a href='process_order.php?update_order=$invoice_id&status=Delivered' class='btn btn-primary d-block'>Update Delivered</a>
                                            ";
                                          }
                                          
                                          ?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="w-100">
                                    <div class="col-12">
                                    <div class="form-group">
                                        <form action="clientbill.php" method="get" target="_blank">
                                            <input type="hidden" name="bill" value="<?php echo $invoice_id; ?>">
                                              <select class="form-control mt-2" name="client">
                                              <?php 
                                              
                                              $get_client_id = "select * from customer_orders where invoice_no='$invoice_id'";

                                              $run_client_id = mysqli_query($con,$get_client_id);

                                              while($row_client_id = mysqli_fetch_array($run_client_id)){

                                              $client_id = $row_client_id['client_id'];

                                              $get_client = "select * from clients where client_id='$client_id'";
                                              
                                              $run_client = mysqli_query($con,$get_client);

                                              $row_client = mysqli_fetch_array($run_client);

                                              $client_name = $row_client['client_shop'];

                                              echo "<option value='$client_id'>$client_name</option>";

                                              }
                                              
                                              ?>
                                              </select>
                                                <button class="btn btn-primary w-100" type="submit">Client Bill</button>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
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
                                                  <th class="text-center">VENDOR</th>
                                                  <th class="text-center">IMAGE</th>
                                                  <th class="text-center">ITEMS</th>
                                                  <th class="text-center">QTY</th>
                                                  <th class="text-right">PRICE</th>
                                                  <th class="text-right">Status</th>
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

                                          $sub_total = $row_pro_id['due_amount'];

                                          $client_id = $row_pro_id['client_id'];

                                          $pro_price = $sub_total/$qty;                                  

                                          $pro_status = $row_pro_id['product_status'];

                                          $get_pro = "select * from products where product_id='$pro_id'";

                                          $run_pro = mysqli_query($con,$get_pro);

                                          $row_pro = mysqli_fetch_array($run_pro);

                                          $pro_title = $row_pro['product_title'];

                                          $pro_img1 = $row_pro['product_img1'];

                                          // $pro_price = $row_pro['product_price'];

                                          $pro_desc = $row_pro['product_desc'];
                                          
                                          // $sub_total = $pro_price * $qty;

                                          $get_min = "select * from admins";

                                          $run_min = mysqli_query($con,$get_min);

                                          $row_min = mysqli_fetch_array($run_min);

                                          $min_price = $row_min['min_order'];

                                          $del_charges = $row_min['del_charges'];

                                          $get_client = "select * from clients where client_id='$client_id'";

                                          $run_client = mysqli_query($con,$get_client);

                                          $row_client = mysqli_fetch_array($run_client);

                                          $client_name = $row_client['client_shop'];

                                          ?>
                                              <tr>
                                                  <td class="text-center"><?php echo $client_name; ?></td>
                                                  <td class="text-center">
                                                    <img src="<?php echo $pro_img1; ?>" alt="" class="img-thumbnail border-0" width="40px">
                                                  </td>
                                                  <td class="text-center"><?php echo $pro_title; ?><br><?php echo $pro_desc; ?></td>
                                                  <td class="text-center"><?php echo $qty; ?> x ₹ <?php echo $pro_price; ?></td>
                                                  <td class="text-right">₹ <?php echo $sub_total; ?></td>
                                                  <td class="text-right"><?php echo $pro_status; ?></td>
                                              </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                                          <h3 class="card-title">Total - ₹ <?php echo $total+$del_charges; ?>/-</h3>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
              </div>
            </div>
    
</div>

<script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 60000);
</script>

<?php } ?>