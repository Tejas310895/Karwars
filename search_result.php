<?php 

include("includes/db.php");

if(isset($_GET['searchVal'])){

    $keyword = $_GET['searchVal'];

    $get_result = "select DISTINCT product_id AS product_id from products where LOWER(product_keywords) LIKE LOWER('%$keyword%')";

    $run_result = mysqli_query($con,$get_result);

    while($row_result=mysqli_fetch_array($run_result)){

        $product_id = $row_result['product_id'];

        $get_pro = "select * from products where product_id='$product_id'";

        $run_pro = mysqli_query($con,$get_pro);

        $row_pro = mysqli_fetch_array($run_pro);

        $pro_id = $row_pro['product_id'];

        $pro_name = $row_pro['product_title'];

        $pro_desc = $row_pro['product_desc'];

        $pro_img = $row_pro['product_img1'];

        $store_id = $row_pro['store_id'];

        $get_name = "select * from store where store_id='$store_id'";

        $run_name = mysqli_query($con,$get_name);

        $row_name = mysqli_fetch_array($run_name);

        $store_title = $row_name['store_title'];

        if(isset($store_title)){

            echo "
            <a href='shop?store_id=$store_id#$pro_id'>
            <div class='row'>
            <div class='col-2 p-2'>
            <img src='$pro_img' alt='' class='img-thumbnail border-0' width='100%' height='100%'>
            </div>
            <div class='col-10 pt-2'>
            <h5 class='mb-1' style='font-size:1rem;'>$pro_name-$pro_desc</h5>
            <h6 class='mb-1' style='font-size:0.8rem;'>In $store_title</h6>
            </div>
            </div>
            <hr class='my-0'>
            </a>
            ";

        }
        
    }

}

?>
