<?php 

    include("includes/header.php");

?>
<?php 

if(!empty($_COOKIE['user'])){

    $customer_id = $_COOKIE['user'];

    $get_add_count = "select * from cart where user_id='$customer_id'";

    $run_add_count = mysqli_query($con,$get_add_count);

    $C_count = mysqli_num_rows($run_add_count);

}

?>
<form action="order.php" class="add_form" method="post" id="order_submit">
<!-- fixed nav -->
    <div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc">
                    <li class="nav-item">
                        <a class="nav-link" onClick="window.history.back()">
                            <i style="font-size: 1.8rem;" class="fas fa-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <h5 class="cart_head">Cart</h5>
                    </li>
                </ul>
            <!-- nav -->

    <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pt-1">
                    <li class="breadcrumb-item active" aria-current="page"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
    <!-- breadcrumb -->

    </div>
<!-- fixed nav -->

<!-- form content -->
    <div class="container-fluid px-0 pro_cart bg-light">
        <!-- Delivery Address -->
            <div class="row pt-2 px-3 bg-white <?php if(empty($_COOKIE['user']) || $C_count<=0){echo "d-none";} ?>">
                <div class="col-6">
                    <h6 class="del_lable pt-1">Delivery Address</h6>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-success del_new_btn pull-right p-1" data-toggle="modal" data-target="#inseradd" data-whatever="$add_id" >ADD NEW ADDRESS</button>
                </div>
            </div>
            <input type="hidden" name="c_id" class="form-control" value="<?php echo $customer_id; ?>">
            <div class="row <?php if(empty($_COOKIE['user']) || $C_count<=0){echo "d-none";} ?>">
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control del_add pl-3" id="exampleFormControlSelect1" name='add_id' oninvalid="this.setCustomValidity('Select the delivery address first')" oninput="this.setCustomValidity('')" required>
                        <?php
                    
                        $get_c_add = "select * from customer_address where customer_id='$customer_id'";

                        $run_c_add = mysqli_query($con,$get_c_add);

                        while($row_c_add=mysqli_fetch_array($run_c_add)){
                        
                            $add_id = $row_c_add['add_id'];

                            $customer_city = $row_c_add['customer_city'];

                            $customer_landmark = $row_c_add['customer_landmark'];

                            $customer_phase = $row_c_add['customer_phase'];

                            $customer_address = $row_c_add['customer_address'];

                            $add_type = $row_c_add['add_type'];

                        ?>
                            <option value="<?php echo $add_id; ?>">
                            <?php echo $add_type; ?> :- <?php echo $customer_address." ,".$customer_phase." ,".$customer_landmark." ,".$customer_city; ?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        <!-- Delivery Address -->
        <!-- Order Schedule Date -->
            <!-- <div class="row <?php //if(empty($_COOKIE['user']) || $C_count<=0){echo "d-none";} ?>">
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control del_add pl-3 shadow-none" name="schedule_date" id="exampleFormControlSelect1" oninvalid="this.setCustomValidity('Select the delivery schedule')" oninput="this.setCustomValidity('')" required>
                        <option selected disabled value="">Select Delivery Schedule</option> -->
                        <?php
        
                        date_default_timezone_set('Asia/Kolkata');

                        $today = date("Y-m-d");
                        $today_nght = date("H:i");

                        // $get_today_order = "SELECT * FROM customer_orders WHERE CAST(order_date as DATE)='$today' AND order_status in ('Order Placed','Packed') group by invoice_no";
                        // $run_today_order = mysqli_query($con,$get_today_order);
                        // $count_today_order = mysqli_num_rows($run_today_order);

                        // if($count_today_order<=20){
                        //     date_default_timezone_set('Asia/Kolkata');
                        //     $this_day = date("Y-m-d");
                        //     echo  "<option value=".date('Y-m-d', strtotime('+1 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+1 day', strtotime($this_day)))."</option>";
                        //     echo  "<option value=".date('Y-m-d', strtotime('+2 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+2 day', strtotime($this_day)))."</option>";
                        //     echo  "<option value=".date('Y-m-d', strtotime('+3 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+3 day', strtotime($this_day)))."</option>";
                        // }elseif($count_today_order>20 && $count_today_order<=40){
                        //     date_default_timezone_set('Asia/Kolkata');
                        //     $this_day = date("Y-m-d");
                        //     echo  "<option value=".date('Y-m-d', strtotime('+2 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+2 day', strtotime($this_day)))."</option>";
                        //     echo  "<option value=".date('Y-m-d', strtotime('+3 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+3 day', strtotime($this_day)))."</option>";
                        // }elseif($count_today_order>40 && $count_today_order<=75){
                        //     date_default_timezone_set('Asia/Kolkata');
                        //     $this_day = date("Y-m-d");
                        //     echo  "<option value=".date('Y-m-d', strtotime('+3 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+3 day', strtotime($this_day)))."</option>";
                        //     echo  "<option value=".date('Y-m-d', strtotime('+4 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+4 day', strtotime($this_day)))."</option>";
                        // }elseif($count_today_order>75 && $count_today_order<=100){
                        //     date_default_timezone_set('Asia/Kolkata');
                        //     $this_day = date("Y-m-d");
                        //     echo  "<option value=".date('Y-m-d', strtotime('+4 day', strtotime($this_day))).">".date('l d-M-Y', strtotime('+4 day', strtotime($this_day)))."</option>";
                        // }
                        ?>
                        <!-- </select>
                    </div>
                </div>
            </div> -->
        <!-- Order Schedule Date -->
        <!-- Promo Section -->
            <div class="row bg-white <?php if(isset($_COOKIE['promo']) || !isset($_COOKIE['user']) || $C_count<=0){echo "d-none";} ?>">
                <div class="col-8">
                    <div class="row">
                        <div class="col-3 pr-2">
                            <img src="admin_area/admin_images/discount_percentage.png" alt="" class="img-thumbnail border-0 bg-transparent pull-right" width="35px">
                        </div>
                        <div class="col-9 px-0 pt-2">
                            <h6 class="promo_text">Select Promo Codes</h6>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-link promo_btn" data-toggle="modal" data-target="#promo_sec">
                        View Offers
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="promo_sec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header py-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Available Offers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php 
                                    $get_coupon = "select * from coupons where ( '$today' BETWEEN coupon_start_date AND coupon_expiry_date) and coupon_status='active'";
                                    $run_coupon = mysqli_query($con,$get_coupon);
                                    $coupon_count = mysqli_num_rows($run_coupon);
                                    while($row_coupon=mysqli_fetch_array($run_coupon)){
                                    
                                    $coupon_id = $row_coupon['coupon_id'];
                                    $coupon_code = $row_coupon['coupon_code'];
                                    $coupon_desc = $row_coupon['coupon_desc'];
                                    $coupon_type = $row_coupon['coupon_type'];
                                    $eligible_customers = $row_coupon['eligible_customers'];
                                    $coupon_usage_limit = $row_coupon['coupon_usage_limit'];
                                        
                                    $get_customer_limit = "select * from customer_discounts where coupon_code='$coupon_code' and customer_id='$customer_id'";
                                    $run_customer_limit = mysqli_query($con,$get_customer_limit);
                                    $count_customer_limit = mysqli_num_rows($run_customer_limit);

                                    $get_coupon_det = "select * from coupon_controls where coupon_code='$coupon_code'";
                                    $run_coupon_det = mysqli_query($con,$get_coupon_det);
                                    $row_coupon_det = mysqli_fetch_array($run_coupon_det);

                                    $coupon_unit = $row_coupon_det['coupon_unit'];
                                    $coupon_use_id = $row_coupon_det['coupon_use_id'];
                                    $upto_limit = $row_coupon_det['upto_limit'];
                                    
                                        if($eligible_customers!='all'){

                                            $myArr = unserialize($eligible_customers);

                                            if(in_array($customer_id, $myArr)){

                                                if(($coupon_usage_limit<$count_customer_limit) || ($coupon_usage_limit==$count_customer_limit)){

                                                    $coupon_visible='false';
                                                    
                                                }else {
                                                    $coupon_visible='true';
                                                }
                                                
                                            }else {
                                                $coupon_visible='false';
                                            }
                                            
                                        }else {

                                            if(($coupon_usage_limit<$count_customer_limit) || ($coupon_usage_limit==$count_customer_limit)){

                                                $coupon_visible='false';
                                                
                                            }else {
                                                $coupon_visible='true';
                                            }

                                        }

                                        if($coupon_visible==='true'){

                                            echo "
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='coupon_code' id='coupon_code' value='$coupon_id'>
                                                <label class='form-check-label' for='exampleRadios1'>
                                                    <h6 class='mb-0 p-1 bg-warning w-100 text-center text-white pb-0'>$coupon_code</h6>
                                                    $coupon_desc
                                                </label>
                                            </div>
                                            <hr>
                                            ";    

                                        }
                                    }
                                    ?>
                                    <?php 
                                    
                                    if(($coupon_count<=0) || ($coupon_visible==='false')){
                                        echo "
                                            <h5 class='text-center'>No Coupons Available for now will update shortly</h5>
                                        ";
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-white <?php if(!isset($_COOKIE['promo']) || !isset($_COOKIE['user'])){echo "d-none";} ?>">
                <div class="col-8 pl-4 pr-0">
                    <h6 class="promo_text pt-2">Promo Code Applied Successfully</h6>
                </div>
                <div class="col-4 pl-0">
                    <button class="btn btn-link text-danger pull-right pl-0" id="coupon_del" style="text-decoration:none;"><i class="far fa-times-circle"></i>&nbspRemove</button>
                </div>
            </div>
        <!-- Promo Section -->
        <?php 

                    //$ip_add = getRealIpUser();
        
                    $user_id = getuserid();
            
                    $total_cart = "select * from cart where user_id='$user_id'";
            
                    $run_total_cart = mysqli_query($con,$total_cart);
            
                    $cart_count = mysqli_num_rows($run_total_cart);
                    
                    $total = 0;

                    $save_total = 0;

                    while($row_total_cart = mysqli_fetch_array($run_total_cart)){

                        $pro_total_id = $row_total_cart['p_id'];

                        $pro_total_qty = $row_total_cart['qty'];

                            $get_pro_total = "select * from products where product_id='$pro_total_id'";

                            $run_pro_total = mysqli_query($con,$get_pro_total);

                            while($row_pro_total = mysqli_fetch_array($run_pro_total)){

                                $unit_price = $row_pro_total['product_price'];

                                $unit_dis_price = $row_pro_total['price_display'];

                                $unit_sub_total = $row_pro_total['product_price']*$pro_total_qty;

                                $save = $unit_dis_price*$pro_total_qty;

                                $total += $unit_sub_total;

                                $save_total += $save;

                                $you_save = $save_total-$total;
                    
                }
            }

            $get_min = "select * from admins";

            $run_min = mysqli_query($con,$get_min);
        
            $row_min = mysqli_fetch_array($run_min);
        
            $min_price = $row_min['min_order'];
        
            $del_charges = $row_min['del_charges'];

            if($total>=499){$add_del=0;}else{$add_del=$del_charges;}
            
        ?>
        <!-- Billing Section -->
        <div class="row bg-white mt-2 px-4 py-2 text-dark <?php if($cart_count<1){echo"d-none";}else{echo"show";}?>">
            <div class="col-12 mb-2">
                <h4 class="bill_head mb-0">Billing Details</h4>
            </div>
            <div class="col-6 pull-left">
                <h5 class="bill-text total_text mb-1">Item Total</h5>
            </div>
            <div class="col-6 pull-right">
                <h5 class="bill-text text-right mb-1">₹ <?php echo $total; ?></h5>
                <input type="hidden" id="item_total_price" value="<?php echo $total; ?>">
            </div>
            <div class="col-6 pull-left <?php if($total>=499){echo"d-none";}else{echo"show";}?>">
                <h5 class="del-text mb-1">Delivery Charges</h5>
            </div>
            <div class="col-6 pull-right <?php if($total>=499){echo"d-none";}else{echo"show";}?>">
                <h5 class="del-text mb-1 text-right">₹ <?php echo $del_charges; ?></h5>
            </div>
            <?php 
            
            if(isset($_COOKIE['promo'])){
                $coupon_dis_id = $_COOKIE['promo'];
                $get_coupon_dis = "select * from coupons where coupon_id='$coupon_dis_id'";
                $run_coupon_dis = mysqli_query($con,$get_coupon_dis);
                $row_coupon_dis = mysqli_fetch_array($run_coupon_dis);

                $dis_coupon_code = $row_coupon_dis['coupon_code'];
                $dis_coupon_type = $row_coupon_dis['coupon_type'];
                $dis_min_order = $row_coupon_dis['min_order'];

                $get_coupon_dis_req = "select * from coupon_controls where coupon_code='$dis_coupon_code'";
                $run_coupon_dis_req = mysqli_query($con,$get_coupon_dis_req);
                $row_coupon_dis_req = mysqli_fetch_array($run_coupon_dis_req);

                $dis_coupon_unit = $row_coupon_dis_req['coupon_unit'];
                $dis_coupon_use_id = $row_coupon_dis_req['coupon_use_id'];
                $dis_upto_limit = $row_coupon_dis_req['upto_limit'];

                if($dis_coupon_type==='percent'){
                    $percent_off = $total * ($dis_coupon_unit/100);
                    if($percent_off>$dis_upto_limit){
                        $dis_amt = $dis_upto_limit;
                        $grand_total = ($total+$add_del)-$dis_amt;
                    }else{
                        $dis_amt = $percent_off;
                        $grand_total = ($total+$add_del)-$dis_amt;
                    }
                }elseif ($dis_coupon_type==='amount') {
                    $dis_amt = $dis_coupon_unit;
                    $grand_total = ($total+$add_del)-$dis_amt;
                }elseif ($dis_coupon_type==='product') {
                    $get_off_pro_det = "select * from products where product_id='$dis_coupon_use_id'";
                    $run_off_pro_det = mysqli_query($con,$get_off_pro_det);
                    $row_off_pro_det = mysqli_fetch_array($run_off_pro_det);

                    $off_product_det_product_price = $row_off_pro_det['product_price'];
                    $dis_amt=0;
                    $grand_total = ($total+$add_del)+$off_product_det_product_price;
                }

                if($total<$dis_min_order){
                    echo "<script>alert('Offers is valid for orders above $dis_min_order');</script>";
                    echo "<script>location.reload(false);</script>";
                    setcookie("promo", "", time() - 1);
                }

            ?>
            <div class="col-9 pull-left text-success">
                <h5 class="cou-text mb-0">Discount <small class="text-uppercase">(<?php echo $dis_coupon_code; ?> Applied)</small></h5>
            </div>
            <div class="col-3 pull-right text-success">
                <h5 class="cou-text mb-0 text-right"><?php if($dis_amt>0){echo "-₹".$dis_amt;}?></h5>
                <input type="hidden" name="coupon_id" value="<?php echo $coupon_dis_id; ?>">
            </div>
            <div class="col-12">
                <small class="text-center text-success <?php if($dis_coupon_type==='product'){echo 'show';}else{echo 'd-none';} ?>" style="margin-top:10px;">Get the offer product in order</small>
            </div>
            <?php }else{$grand_total = ($total+$add_del);} ?>
            <div class="col-6 pull-left">
                <h5 class="Grand-text mb-0 pt-2">Grand Total</h5>
                <p class="inc-tax mb-0">(Inc. Of all taxes)</p>
            </div>
            <div class="col-6 pull-right">
                <h5 class="Grand-text text-right mb-0 pt-3">₹ <?php echo $grand_total; ?></h5>
            </div>
            <div class="col-12 <?php if($total>=499){echo"d-none";}else{echo"show";}?>">
                <h6 class="min_cart_ord text-danger pt-1 text-center">
                    Get Free Delivery Above ₹499
                </h6>
            </div>
        </div>
        <!-- Billing Section -->
    <!-- product cart -->

        <div class="container-fluid mt-2 <?php if($cart_count<1){echo"d-none";}else{echo"show";}?>">
            <h5 class="cart_pro_text text-dark">Total <?php echo $cart_count; ?> Items In Your Cart</h5>
            <?php add_checkout(); ?>
            <?php delete_checkout(); ?>
            <?php 

                $select_cart = "select * from cart where user_id='$user_id'";
                            
                $run_cart = mysqli_query($con,$select_cart);

                $count = mysqli_num_rows($run_cart);

                while($row_cart = mysqli_fetch_array($run_cart)){

                    $pro_id = $row_cart['p_id'];

                    $pro_qty = $row_cart['qty'];

                        $get_products = "select * from products where product_id='$pro_id'";

                        $run_products = mysqli_query($con,$get_products);

                        while($row_products = mysqli_fetch_array($run_products)){

                            $product_title = $row_products['product_title'];

                            $product_img1 = $row_products['product_img1'];

                            $only_price = $row_products['product_price'];

                            $dis_price = $row_products['price_display'];

                            $sub_total = $row_products['product_price']*$pro_qty;

                if($count>0){

                    $get_products = "select * from products where product_id='$pro_id'";

                    $run_prodcuts = mysqli_query($con,$get_products);

                    $row_products = mysqli_fetch_array($run_prodcuts);

                    $product_title = $row_products['product_title'];

                    $product_desc = $row_products['product_desc'];

                    $product_img1 = $row_products['product_img1'];

                    echo"
                    
                    <div class='row bg-white py-1 mt-1' id='hidScroll'>
                        <div class='col-3 px-0'>
                            <img src='$product_img1' alt='' class='img-thumbnail mx-auto d-block border-0 w-75' style='border-radius:0px;'>
                        </div>
                        <div class='col-9 pl-0 pt-2'>
                            <h5 class='pro_cart_title mb-1'>$product_title - $product_desc</h5>
                            <div class='row'>
                                <div class='col-6 pt-1 pl-3'>
                                    <h5 class='order_again_price'>₹ $sub_total </h5>
                                </div>
                                <div class='col-6'>
                                    <div class='row pr-3 pull-right'>
                                        <button class='btn btn-qty px-1 py-1 del' type='button' id='$pro_id'><i style='font-size:0.9rem; color:#fff;' class='fas fa-minus'></i></button>
                                        <input type='numeric' class='shop_qty' placeholder='' value='$pro_qty' aria-describedby='helpId' readonly>
                                        <button class='btn btn-qty px-1 py-1 add' type='button' id='$pro_id'><i style='font-size:0.9rem; color:#fff;' class='fas fa-plus'></i></button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        </div>     
                    ";

                }
                
            }
        }


            ?>

        </div>
    <!-- product cart -->
    </div>
<!-- form content -->

<!-- show lobo -->

        <div class="container mt-5" style="display:<?php if($count>0){echo"none";}else{echo"block";} ?>;">
                    <div class="row">
                        <div class="col-lg"><img src="admin_area/other_images/cart_lobo.png" class="img-fluid w-75 mx-auto d-block" alt="..."></div>
                        <div class="col-lg"><h5 class="order_again">We are waiting for your order</h5></div>
                        <div class="col-lg px-5"><a href="store" class="btn btn-warning btn-block order_again_bottom d-block p-1">Start Shopping</a></div>
                    </div>
                </div>

<!-- show lobo -->

<!-- bill Section -->
    <!-- <div class="container bg-white mt-2 mb-5 fixed-bottom" style="display:<?php //if($count>0){echo"block";}else{echo"none";} ?>;">
        <table class="table table-sm table-borderless bill_section ">
            <tbody>
                <thead>
                <tr>
                    <th scope="row" class="bill_head">Bill Details</th>
                </tr>
                </thead>
                <tr>
                    <th scope="row" class="bill_sub_total">Item Total:</th>
                    <td class="bill_sub_total text-center">₹ <?php //echo $total; ?></td>
                </tr>
                <tr style="display:<?php //if($del_charges>0){echo"table-row";}else{echo"none";} ?>;">
                    <th scope="row" class="bill_charges" >Delivery Charges:</th>
                    <td class="bill_charges text-center">₹ <?php// echo $del_charges; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="bill_total">TOTAL:</th>
                    <td class="bill_total text-center">₹ <?php// echo $total+$del_charges; ?></td>
                </tr>
            </tbody>
        </table>
        <h5 class="save_total text-center <?php //if($save_total>0){echo "show";}else{echo "d-none";} ?>" >You saved ₹<?php //echo $you_save; ?> on this order</h5>
    </div> -->
    
  
<!-- bill Section -->

<!-- checkout float -->
    <div class="container-fluid px-0 fixed-bottom " style="display:<?php if($count>0){echo"block";}else{echo"none";} ?>;">
        <div class="row">
            <?php 
            
            if(isset($_COOKIE['user'])){
            
            ?>
            <div class="col-12">
                <?php if($min_price>$total){

                    $required = $min_price-$total;

                    echo "
                    
                    <a class='btn btn-block btn-success bill_checkout' style='color:#fff;'>
                    Add ₹ $required More items
                    </a>
                    
                    ";

                }else{
                    echo "
                    <div class='row fixed-bottom'>
                        <div class='col-12 px-0'>
                            <button type='button' id='order_submit_btn' class='btn btn-success btn-block add_head_btn pl-0 pt-1' data-toggle='modal' data-target='#pay_mode'>
                                Select Payment Mode
                            </button>
                        </div>
                    </div>
                    ";
                }
                 ?>
            </div>
            <?php }else{ ?>
            <div class="col-12 pr-2">
                <a href='checkout' class='btn btn-success btn-block btn-md pt-1 pb-0'>
                    <h6 class="login_title mb-0">Login / SignUp</h6>
                    <small class="login_sub">You are one step away to order</small>
                </a>                   
            </div>
            <?php } ?>
        </div>
    </div>
<!-- checkout float -->
    <!-- Paymode -->
    <div class="modal fade" id="pay_mode" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog m-0" role="document" style="border-radius:20px 20px 0px 0px;">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div> -->
                <div class="modal-body pb-2">
                    <div class="alert alert-primary mb-3 px-2 py-1">
                        <div class="row">
                            <div class="col-1">
                                <img src="admin_area/admin_images/cod.png" width="20">
                            </div>
                            <div class="col-9">
                                <label class="form-check-label cod_text" for="exampleRadios1">
                                    <h5 class="mb-0">Pay on Delivery</h5>
                                </label>
                            </div>
                            <div class="col-1">
                                <input class="form-check-input mt-2 mx-0" type="radio" name="pay_type" value="POD" checked>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-primary mb-2 px-2 py-1">
                        <div class="row">
                            <div class="col-1">
                                <img src="admin_area/admin_images/card.png" width="20">
                            </div>
                            <div class="col-9">
                                <label class="form-check-label paytm_text" for="exampleRadios2">
                                    <h5 class="mb-0">Wallet/Cards/Upi</h5>
                                </label>
                            </div>
                            <div class="col-1">
                                <input class="form-check-input mt-2 mx-0" type="radio" name="pay_type"  value="CASHFREE">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:0;">
                    <button type="submit" class="btn btn-success btn-block"><h5 class="mb-0" style="font-family: Josefin Sans;">Place Order</h5></button>
                </div>
            </div>
        </div>
    </div>
</form>


 <!-- insertadd -->

 <div class="modal fade" id="inseradd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-radius: 20px 20px 0px 0px;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">ADD NEW ADDRESS</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="register_form mt-0">
                    <input type="hidden" name="c_city" value="Karwar">
                    <div class="form-group">
                        <label>Area</label>
                        <input type="text" name="c_landmark" class="form-control" placeholder="Example:habbuwada" required>
                    </div>
                    <div class="form-group">
                        <label>Landmark</label>
                        <input type="text" name="c_phase" class="form-control" placeholder="Example:Near bus stand" required>
                    </div>
                    <div class="form-group ">
                        <label>Society & Flat No/ House No</label>
                        <input type="text" class="form-control" id="address" name="c_address" aria-describedby="emailHelp" placeholder="Enter Address" required>
                    </div>
                    <div class="form-group ">
                        <label>Address type</label>
                        <input type="text" class="form-control" id="ctype" name="add_type" aria-describedby="emailHelp" placeholder="Home/Office/Others" required>
                    </div>
                    <button type="submit" name="insertadd" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <?php 

            if(isset($_POST['insertadd'])){

                $user_c_id = $_COOKIE['user'];

                $c_city = $_POST['c_city'];

                $c_landmark = $_POST['c_landmark'];

                $c_phase = $_POST['c_phase'];

                $c_address = $_POST['c_address'];

                $add_type = $_POST['add_type'];
                
                // $get_user_id = "select * from customers where customer_email='$c_mail'";

                // $run_user_id = mysqli_query($con,$get_user_id);

                // $row_user_id = mysqli_fetch_array($run_user_id);

                // $user_c_id = $row_user_id['customer_id'];

                $insert_add = "insert into customer_address (customer_id,customer_city,customer_landmark,customer_phase,customer_address,add_type) 
                values ('$user_c_id','$c_city','$c_landmark','$c_phase','$c_address','$add_type')";

                $run_add = mysqli_query($con,$insert_add);


                if($insert_add){

                    echo "<script>alert('Address Updated')</script>";

                    echo "<script>window.open('cart','_self')</script>";

                }else{

                    echo "<script>alert('Sorry Address not updated try again')</script>";

                    echo "<script>window.open('cart','_self')</script>";

                }
                

            }

            ?>
<!-- insertadd -->
</div>

<?php 

include("includes/footer.php");

?>