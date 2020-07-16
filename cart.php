<?php 

    include("includes/header.php");

?>

<!-- fixed nav -->
    <div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" href="store">
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
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    <!-- breadcrumb -->

    </div>
<!-- fixed nav -->

<!-- product cart -->

        <?php 
            
            $ip_add = getRealIpUser();

            $user_id = getuserid();
    
            $select_cart = "select * from cart where ip_add='$ip_add' AND user_id='$user_id'";
    
            $run_cart = mysqli_query($con,$select_cart);
    
            $count = mysqli_num_rows($run_cart);
    
        ?>
    <div class="container-fluid pro_cart">
        <?php add_checkout(); ?>
        <?php delete_checkout(); ?>
        <?php 
            
            $total = 0;

            $save_total = 0;

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

                        $save = $dis_price*$pro_qty;

                        $total += $sub_total;

                        $save_total += $save;

                        $you_save = $save_total-$total;

            if($count>0){

                $get_products = "select * from products where product_id='$pro_id'";

                $run_prodcuts = mysqli_query($con,$get_products);

                $row_products = mysqli_fetch_array($run_prodcuts);

                $product_title = $row_products['product_title'];

                $product_desc = $row_products['product_desc'];

                $product_img1 = $row_products['product_img1'];

                echo"
                
                <div class='row bg-white py-2 mt-1' id='hidScroll'>
                    <div class='col-4 px-0'>
                        <img src='$product_img1' alt='' class='img-thumbnail border-0 w-75'>
                    </div>
                        <div class='col-8 pl-0 pt-2'>
                            <h5 class='pro_cart_title'>$product_title - $product_desc</h5>
                            <div class='row'>
                                <div class='col-6'>
                                    <div class='row pl-3'>
                                        <button class='btn btn-qty px-1 py-1 del' type='button' id='$pro_id'><i style='font-size:0.9rem; color:#fff;' class='fas fa-minus'></i></button>
                                        <input type='numeric' class='shop_qty' placeholder='' value='$pro_qty' aria-describedby='helpId' readonly>
                                        <button class='btn btn-qty px-1 py-1 add' type='button' id='$pro_id'><i style='font-size:0.9rem; color:#fff;' class='fas fa-plus'></i></button>
                                    </div> 
                                </div>
                                    <div class='col-6 pt-1 pl-5'>
                                        <h5 class='order_again_price'>₹ $sub_total </h5>
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


<!-- show lobo -->

        <div class="container" style="display:<?php if($count>0){echo"none";}else{echo"block";} ?>;">
                    <div class="row">
                        <div class="col-lg"><img src="admin_area/other_images/cart_lobo.png" class="img-fluid w-75 mx-auto d-block" alt="..."></div>
                        <div class="col-lg"><h5 class="order_again">Lobo is waiting for your order</h5></div>
                        <div class="col-lg px-5"><a href="store" class="btn btn-warning btn-block order_again_bottom d-block p-1">Start Shopping</a></div>
                    </div>
                </div>

<!-- show lobo -->

<?php 

    $get_min = "select * from admins";

    $run_min = mysqli_query($con,$get_min);

    $row_min = mysqli_fetch_array($run_min);

    $min_price = $row_min['min_order'];

    $del_charges = $row_min['del_charges'];

?>

<!-- bill Section -->
    <div class="container bg-white mt-2 mb-5 fixed-bottom" style="display:<?php if($count>0){echo"block";}else{echo"none";} ?>;">
        <table class="table table-sm table-borderless bill_section ">
            <tbody>
                <thead>
                <tr>
                    <th scope="row" class="bill_head">Bill Details</th>
                </tr>
                </thead>
                <tr>
                    <th scope="row" class="bill_sub_total">Item Total:</th>
                    <td class="bill_sub_total text-center">₹ <?php echo $total; ?></td>
                </tr>
                <tr style="display:<?php if($del_charges>0){echo"table-row";}else{echo"none";} ?>;">
                    <th scope="row" class="bill_charges" >Delivery Charges:</th>
                    <td class="bill_charges text-center">₹ <?php echo $del_charges; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="bill_total">TOTAL:</th>
                    <td class="bill_total text-center">₹ <?php echo $total+$del_charges; ?></td>
                </tr>
            </tbody>
        </table>
        <h5 class="save_total text-center <?php if($save_total>0){echo "show";}else{echo "d-none";} ?>" >You saved ₹<?php echo $you_save; ?> on this order</h5>
    </div>
    
  
<!-- bill Section -->

<!-- checkout float -->
    <div class="container-fluid fixed-bottom " style="display:<?php if($count>0){echo"block";}else{echo"none";} ?>;">
        <div class="row cart_bottom">
            <div class="col-6 pl-3">
                <h5 class="item_count pt-1 mb-0"><?php echo $count; ?> Items</h4>
                <h4 class="item_cost mb-0">₹ <?php echo $total+$del_charges; ?></h3>
            </div>
            <div class="col-6 p-0">
                <?php if($min_price>$total){

                    $required = $min_price-$total;

                    echo "
                    
                    <a class='btn btn-success pull-right bill_checkout' style='color:#fff;'>
                    Add $required More
                    </a>
                    
                    ";

                }else{
                    echo "
                    
                    <a href='checkout' class='btn btn-success pull-right bill_checkout'>
                    Checkout
                    <i style='font-size:1.2rem; color:#fff;' class='fas fa-angle-double-right'></i>
                    </a>
                    
                    ";
                }
                 ?>
            </div>
        </div>
    </div>
<!-- checkout float -->


<?php 

include("includes/footer.php");

?>