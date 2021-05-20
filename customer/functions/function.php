<?php

$db = mysqli_connect('localhost:3308','root','','wrngrocery');

/// begin getRealIpUser functions ///

function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
    
}

/// finish getRealIpUser functions ///

/// begin add_cart functions ///

function add_cart(){
    
    global $db;
    
    if(isset($_GET['add_cart'])){
        
        $ip_add = getRealIpUser();
        
        $p_id = $_GET['add_cart'];
        
        // $product_qty = $_POST['product_qty'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            $update_qty= "update cart set qty=qty+1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('shop.php','_self')</script>";
            
        }else{
            
            $query = "insert into cart (p_id,ip_add,qty) values ('$p_id','$ip_add','1')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('shop.php','_self')</script>";
            
        }
        
    }
    
}

/// finish add_cart functions ///

/// begin add_index_cart functions ///

function add_index_cart(){
    
    global $db;
    
    if(isset($_GET['add_index_cart'])){
        
        $ip_add = getRealIpUser();
        
        $p_id = $_GET['add_index_cart'];
        
        // $product_qty = $_POST['product_qty'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            $update_qty= "update cart set qty=qty+1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('index.php','_self')</script>";
            
        }else{
            
            $query = "insert into cart (p_id,ip_add,qty) values ('$p_id','$ip_add','1')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('index.php','_self')</script>";
            
        }
        
    }
    
}

/// finish add_index_cart functions ///

/// begin add_checkout functions ///

function add_checkout(){
    
    global $db;
    
    if(isset($_GET['add_checkout'])){
        
        $ip_add = getRealIpUser();
        
        $p_id = $_GET['add_checkout'];
        
        // $product_qty = $_POST['product_qty'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            $update_qty= "update cart set qty=qty+1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('cart.php','_self')</script>";
            
        }
        
    }
    
}

/// finish add_checkout functions ///

/// begin delete_cart functions ///

function delete_cart(){

    global $db;

    if(isset($_GET['delete_cart'])){

        $ip_add = getRealIpUser();

        $p_id = $_GET['delete_cart'];

        $check_cart = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_cart);

        $row_check = mysqli_fetch_array($run_check);

        $qty = $row_check['qty'];

        if($qty>1){

            $update_qty= "update cart set qty=qty-1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('shop.php','_self')</script>";

        }else{

            $delete_qty= "delete from cart where p_id='$p_id'";

            $run_delete_qty = mysqli_query($db,$delete_qty);

            echo "<script>window.open('shop.php','_self')</script>";

        }
    }

}

/// finish delete_cart functions ///

/// begin delete_cart functions ///

function delete_index_cart(){

    global $db;

    if(isset($_GET['delete_index_cart'])){

        $ip_add = getRealIpUser();

        $p_id = $_GET['delete_index_cart'];

        $check_cart = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_cart);

        $row_check = mysqli_fetch_array($run_check);

        $qty = $row_check['qty'];

        if($qty>1){

            $update_qty= "update cart set qty=qty-1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('index.php','_self')</script>";

        }else{

            $delete_qty= "delete from cart where p_id='$p_id'";

            $run_delete_qty = mysqli_query($db,$delete_qty);

            echo "<script>window.open('index.php','_self')</script>";

        }
    }

}

/// finish delete_cart functions ///

/// begin delete_checkout functions ///

function delete_checkout(){

    global $db;

    if(isset($_GET['delete_checkout'])){

        $ip_add = getRealIpUser();

        $p_id = $_GET['delete_checkout'];

        $check_cart = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_cart);

        $row_check = mysqli_fetch_array($run_check);

        $qty = $row_check['qty'];

        if($qty>1){

            $update_qty= "update cart set qty=qty-1 where p_id='$p_id'";

            $run_update_qty = mysqli_query($db,$update_qty);

            echo "<script>window.open('cart.php','_self')</script>";

        }else{

            $delete_qty= "delete from cart where p_id='$p_id'";

            $run_delete_qty = mysqli_query($db,$delete_qty);

            echo "<script>window.open('cart.php','_self')</script>";

        }
    }

}

/// finish delete_checkout functions ///


/// begin index_delete_cart functions ///

    // function delete_index_cart(){

    //     global $db;

    //     if(isset($_GET['delete_index_cart'])){

    //         $ip_add = getRealIpUser();

    //         $p_id = $_GET['delete_index_cart'];

    //         $check_cart = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
            
    //         $run_check = mysqli_query($db,$check_cart);

    //         $row_check = mysqli_fetch_array($run_check);

    //         $qty = $row_check['qty'];

    //         if($qty>1){

    //             $index_update_qty= "update cart set qty=qty-1 where p_id='$p_id'";

    //             $run_index_update_qty = mysqli_query($db,$index_update_qty);

    //             echo "<script>window.open('shop.php','_self')</script>";

    //         }else{

    //             $index_delete_qty= "delete from cart where p_id='$p_id'";

    //             $run_index_delete_qty = mysqli_query($db,$index_delete_qty);

    //             echo "<script>window.open('shop.php','_self')</script>";

    //         }
    //     }

    // }

/// finish index_delete_cart functions ///

/// begin getPro functions ///

    // function getPro(){
        
    //     global $db;
        
    //     $get_products = "select * from products order by rand() LIMIT 0,7";
        
    //     $run_products = mysqli_query($db,$get_products);
        
    //     while($row_products=mysqli_fetch_array($run_products)){
            
    //         $pro_id = $row_products['product_id'];
            
    //         $pro_title = $row_products['product_title'];

    //         $pro_desc = $row_products['product_desc'];
            
    //         $pro_price = $row_products['product_price'];
            
    //         $pro_img1 = $row_products['product_img1'];
            
    //         echo "


    //         <div class='swiper-slide'>
    //                     <div class='card pro_card my-2' style='width: 18rem;'>
    //                                 <img src='admin_area/product_images/$pro_img1' class='card-img-top pro_img p-1' alt='image responsive' height='100'>
    //                                 <div class='card-body p-1'>
    //                                 <p class='card-text text-left px-2 pro_title'>$pro_title</p>
    //                                 <p class='card-text text-left px-2 pro_Desc'>$pro_desc</p>   
    //                                     <div class='row'>
    //                                         <div class='col-6'>
    //                                         <p class='card-text text-left pro_price pl-1'>₹ $pro_price</p>
    //                                         </div>
    //                                     <form action='index.php?add_index_cart=$pro_id' class='form-horizontal' method='post'>
    //                                     <div class='col-6 px-0'>
    //                                     <button class='btn btn-outline-success px-1 py-0 ml-4  pull-left addqty'>ADD</a>
    //                                     </div>
    //                                     </form>
    //                                     </div> 
    //                             </div>
    //                     </div>
    //             </div>
            
    //         ";
            
    //     }
        
    // }

/// finish getPro functions ///

/// begin getCats functions ///

function getCats(){
    
    global $db;
    
    $get_cats = "select * from categories";
    
    $run_cats = mysqli_query($db,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats)){
        
        $cat_id = $row_cats['cat_id'];
        
        $cat_title = $row_cats['cat_title'];
        
        echo "
        
        <a href='shop.php?cat=$cat_id' class='pn-ProductNav_Link'>$cat_title</a>
        
        ";
        
    }
    
}
    
/// finish getCats functions ///

/// begin getcatpro functions ///

    // function getcatpro(){
        
    //     global $db;
        
    //     if(isset($_GET['cat'])){
            
    //         $cat_id = $_GET['cat'];
            
    //         // $get_cat = "select * from categories where cat_id='$cat_id'";
            
    //         // $run_cat = mysqli_query($db,$get_cat);
            
    //         // $row_cat = mysqli_fetch_array($run_cat);
            
    //         // $cat_title = $row_cat['cat_title'];
            
    //         // $cat_desc = $row_cat['cat_desc'];
            
    //         $get_cat = "select * from products where cat_id='$cat_id'";
            
    //         $run_products = mysqli_query($db,$get_cat);
            
    //         $count = mysqli_num_rows($run_products);
            
    //         if($count==0){
                
                
    //             echo "
                
    //                 <div class='container'>
                    
    //                     <h1 class='no_pro text-center'> No Product Found In This Category </h1>
                    
    //                 </div>
                
    //             ";
                
    //         }else{
            
    //             while($row_products=mysqli_fetch_array($run_products)){
                    
    //                 $pro_id = $row_products['product_id'];
                    
    //                 $pro_title = $row_products['product_title'];
                    
    //                 $pro_price = $row_products['product_price'];
                    
    //                 $pro_desc = $row_products['product_desc'];
                    
    //                 $pro_img1 = $row_products['product_img1'];
                    
    //                 echo "
                    
    //                     <div class='row bg-white mt-1 py-2'>
    //                             <div class='col-4'>
    //                                 <img src='admin_area/product_images/$pro_img1' alt='...' class='img-thumbnail border-0'>
    //                             </div>
    //                         <div class='col-8'>
    //                             <h5 class='pro_list_title'>$pro_title</h5>
    //                             <h5 class='pro_list_desc'>$pro_desc</h5>
    //                             <div class='row'>
    //                                 <div class='col-6'>
    //                                     <h5 class='pro_list_price'>₹ $pro_price</h5>
    //                                 </div>
    //                                 <form action='shop.php?add_cart=$pro_id' class='form-horizontal' method='post'>
    //                                 <input type='hidden' name='product_qty' value='1'> 
    //                                 <div class='col-6'>
    //                                     <button class='btn px-4 py-1 ml-4  pull-left pro_list_addqty'>ADD</button>
    //                                 </div>
    //                                 </form>
    //                             </div>
    //                         </div>
    //                     </div>
                    
    //                 ";
    //             }
                
    //     }
            
    //     }
        
    // }

/// finish getcatpro functions ///

/// finish items functions ///


function items(){

    global $db;

    $ip_add = getRealIpUser();

    $get_items = "select * from cart where ip_add='$ip_add'";

    $run_items = mysqli_query($db,$get_items);

    $count_items = mysqli_num_rows($run_items);

    echo $count_items;

}

/// finish items functions ///

/// begins total_price functions ///

function total_price(){

    global $db;

    $ip_add = getRealIpUser();

    $total = 0;

    $select_cart = " select * from cart where ip_add='$ip_add' ";

    $run_cart = mysqli_query($db,$select_cart);

    while($records=mysqli_fetch_array($run_cart)){

        $pro_id = $records['p_id'];

        $pro_qty = $records['qty'];

        $get_price = "select * from products where product_id='$pro_id'";

        $run_price = mysqli_query($db,$get_price);

        while($row_price=mysqli_fetch_array($run_price)){

            $sub_total = $row_price['product_price']*$pro_qty;

            $total += $sub_total;

        }

    }

    echo $total;

}

/// finish total_price functions ///

/// Begin display functions ///

function diaplay_cart(){

    global $db;

    $ip_add = getRealIpUser();

    $show_cart = "select * from cart where ip_add='$ip_add'";

    $run_show_cart = mysqli_query($db,$show_cart);
    
    $count=mysqli_num_rows($run_show_cart);
    
    if($count>0){
        
        echo "d-block";
    
    }else{

        echo "d-none";

    }
 }

/// finish display functions ///

function delete_address(){

    global $db;

    if(isset($_GET['delete_address'])){

        $add_id = $_GET['delete_address'];

        $delete_add = "delete from customer_address where add_id='$add_id'";

        $run_delete = mysqli_query($db,$delete_add);

        if($run_delete){
            echo "<script>alert('Address Deleted')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }else{
            echo "<script>alert('Try Again')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }

}

}

?>
