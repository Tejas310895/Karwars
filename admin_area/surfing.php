<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">SURFING</h2>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Customer Mobile</th> 
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                
                $get_user = "select * from cart where LENGTH(user_id)<10 group by user_id order by exp_date desc";
                $run_user = mysqli_query($con,$get_user);
                $counter = 0;
                while($row_user = mysqli_fetch_array($run_user)){
                    
                    $user_id = $row_user['user_id'];
                    $exp_date = $row_user['exp_date'];

                    if(strlen($user_id)<10){
                        $get_customer = "select * from customers where customer_id='$user_id'";
                        $run_customer = mysqli_query($con,$get_customer);
                        $row_customer = mysqli_fetch_array($run_customer);

                        $customer_name = $row_customer['customer_name'];
                        $customer_contact = $row_customer['customer_contact'];
                    }else{
                        $customer_name = 'N/A';
                        $customer_contact = 'N/A';
                    }
                ?>
                <tr>
                    <td><?php echo date('d/M/Y(h:i a)',strtotime($exp_date)); ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_contact; ?></td>
                    <td>
                        <button id="show_details" class="btn btn-primary text-white" data-toggle="modal" data-target="#KK<?php echo $user_id;?>" title="view">
                            <i class="tim-icons icon-alert-circle-exc text-white"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal modal-black fade" id="KK<?php echo $user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
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
                                              </tr>
                                          </thead>
                                          <tbody>

                                          <?php
                                          
                                          $get_pro_id = "select * from cart where user_id='$user_id'";

                                          $run_pro_id = mysqli_query($con,$get_pro_id);

                                          $counter = 0;

                                          while($row_pro_id = mysqli_fetch_array($run_pro_id)){

                                          $p_id = $row_pro_id['p_id'];

                                          $qty = $row_pro_id['qty'];

                                          $get_pro = "select * from products where product_id='$p_id'";

                                          $run_pro = mysqli_query($con,$get_pro);

                                          $row_pro = mysqli_fetch_array($run_pro);

                                          $pro_title = $row_pro['product_title'];

                                          $pro_img1 = $row_pro['product_img1'];

                                          // $pro_price = $row_pro['product_price'];

                                          $pro_desc = $row_pro['product_desc'];
                                          
                                          // $sub_total = $pro_price * $qty;

                                          ?>
                                              <tr>
                                                  <td class="text-center">
                                                    <img src="<?php echo $pro_img1; ?>" alt="" class="img-thumbnail border-0" width="40px">
                                                  </td>
                                                  <td class="text-center"><?php echo $pro_title; ?><br><?php echo $pro_desc; ?></td>
                                                  <td class="text-center"><?php echo $qty; ?></td>
                                              </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!-- Modal -->
                    </td>
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
<script  src='js/datatable.js'></script>


<?php } ?>