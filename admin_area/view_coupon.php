<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>
        <div class="coupon_alert" role="alert">
           
        </div>
       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PROMO COUPONS</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_coupon" class="btn btn-success pull-right">NEW COUPON</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Promo Code</th> 
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Expiry</th>
                    <th>Utilized</th>
                    <th>Status</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            $get_coupon = "select * from coupons order by coupon_status asc";
            $run_coupon = mysqli_query($con,$get_coupon);

            $counter = 0;

            while($row_coupon=mysqli_fetch_array($run_coupon)){

                $coupon_id = $row_coupon['coupon_id'];
                $coupon_code = $row_coupon['coupon_code'];
                $coupon_desc = $row_coupon['coupon_desc'];
                $eligible_customers = $row_coupon['eligible_customers'];
                $coupon_type = $row_coupon['coupon_type'];
                $coupon_usage_limit = $row_coupon['coupon_usage_limit'];
                $min_order = $row_coupon['min_order'];
                $coupon_start_date = $row_coupon['coupon_start_date'];
                $coupon_expiry_date = $row_coupon['coupon_expiry_date'];
                $coupon_status = $row_coupon['coupon_status'];

                $get_coupon_req = "select * from coupon_controls where coupon_code='$coupon_code'";
                $run_coupon_req = mysqli_query($con,$get_coupon_req);
                $row_coupon_req = mysqli_fetch_array($run_coupon_req);

                $coupon_unit = $row_coupon_req['coupon_unit'];
                $coupon_use_id = $row_coupon_req['coupon_use_id'];
                $upto_limit = $row_coupon_req['upto_limit'];

                if($coupon_type==='percent'){
                    $promo_unit = $coupon_unit."% OFF UPTO ".$upto_limit." ON ORDER ABOVE ".$min_order;
                }elseif ($coupon_type==='amount') {
                    $promo_unit = "GET ₹".$coupon_unit." FLAT OFF ON ORDER ABOVE ".$min_order;
                }elseif ($coupon_type==='product') {
                    
                    $get_promo_pro = "select * from products where product_id='$coupon_use_id'";
                    $run_promo_pro = mysqli_query($con,$get_promo_pro);
                    $row_promo_pro = mysqli_fetch_array($run_promo_pro);

                    $promo_pro_title = $row_promo_pro['product_title'];
                    $promo_pro_desc = $row_promo_pro['product_desc'];
                    $promo_pro_price = $row_promo_pro['product_price'];

                    $promo_unit = "GET ".$promo_pro_title." ".$promo_pro_desc." @ ₹".$promo_pro_price;
                }

                $get_utilized = "select * from customer_discounts where coupon_code='$coupon_code'";
                $run_utilized = mysqli_query($con,$get_utilized);
                $total_utilized = mysqli_num_rows($run_utilized);
                
            ?>
                <tr class="text-center">
                    <td ><?php echo ++$counter; ?></td>
                    <td ><?php echo $coupon_code; ?></td>
                    <td><?php echo $coupon_desc; ?></td>
                    <td><?php echo $promo_unit; ?></td>
                    <td>&#8377; <?php echo date('d/M/Y',strtotime($coupon_expiry_date)); ?><span class="badge badge-light"></span></td>
                    <td><?php echo $total_utilized; ?></td>
                    <td>
                        <a href="ajax_coupon.php?coupon_id=<?php echo $coupon_id; ?>&coupon_status=<?php if($coupon_status==='active'){echo"inactive";}else{echo"active";}; ?>" class="btn btn-<?php if($coupon_status==='active'){echo"danger";}else{echo"success";} ?> btn-md"><?php  if($coupon_status==='active'){echo"Inactive";}else{echo"Active";} ?></a>
                    </td>
                    <td class="td-actions text-center">
                        <a  href="index.php?edit_coupon=<?php echo $coupon_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                            <i class="tim-icons icon-settings"></i>
                        </a>
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
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script  src='js/datatable.js'></script>

    <?php } ?>