<?php 

include("includes/db.php");

if(isset($_GET['searchVal'])){

    $keyword = $_GET['searchVal'];

    $get_result = "select DISTINCT store_id AS store_id from products where LOWER(product_keywords) LIKE LOWER('%$keyword%')";

    $run_result = mysqli_query($con,$get_result);

    while($row_result=mysqli_fetch_array($run_result)){

        $store_id = $row_result['store_id'];

        $get_name = "select * from store where store_id='$store_id'";

        $run_name = mysqli_query($con,$get_name);

        $row_name = mysqli_fetch_array($run_name);

        $store_title = $row_name['store_title'];

        if(isset($store_title)){

            echo "
            <div class='row'>
            <div class='col-12 pl-5 pt-2'>
            <a href='shop?store_id=$store_id'><h5>$store_title</h5></a>
            </div>
            </div>
            
            ";

        }
        
    }

}

?>