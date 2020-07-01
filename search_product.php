<?php 

    
    include("includes/db.php");
    include("functions/function.php");

?>

<?php 

if(isset($_GET['pro_id'])){
    
    $product_id = $_GET['pro_id'];
    
    $get_product = "select * from products where product_id='$product_id'";
    
    $run_product = mysqli_query($con,$get_product);
    
    $row_product = mysqli_fetch_array($run_product);
    
    $pro_title = $row_product['product_title'];
    
    $pro_price = $row_product['product_price'];
    
    $pro_desc = $row_product['product_desc'];
    
    $pro_img1 = $row_product['product_img1'];
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Wernear Grocery</title>
    <!-- google font -->
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Jost' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Laila' rel='stylesheet'>
    <!-- google font -->
    <!-- bootstrap link -->
    <link rel="stylesheet" href="styles/bootstrap.min.css" >
    <link rel="stylesheet" href="styles/bootstrap.css" >
    <!-- bootstrap link -->
    <!-- swiper -->
    <link rel="stylesheet" href="styles/swiper.css">
    <link rel="stylesheet" href="styles/swiper.min.css">
    <!-- swiper -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <!-- font-awesome -->
    <!-- date -->
    <link rel="stylesheet" href="styles/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <script>
    jQuery(function($) {
        var today = new Date();
        $("#datepicker").datepicker({
           dateFormat: "dd-mm-yy",
           minDate: today.getHours() >= 17 ? 2 : 1
        
         });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="js/script.js"></script>
    <!-- date -->
    <!-- styles -->
    <style>
    
    body{
        background: rgb(255, 246, 233);
        margin-top: 16%;
    }

    a{
        text-decoration:none;
        color:#999 !important;
    }

    </style>
    <!-- styles -->
</head>
<body>

<div class="container-fluid py-2 fixed-top bg-white">
    <div class="row">
        <div class="col-2 pr-0 py-1"> <a href="./"><i class="fas fa-arrow-left" style="color:#999;font-size:1.7rem;"></i></a> </div>
        <div class="col-10 pl-0">
            <form action="search_product" method="post">
                <div class="input-group mb-1 px-0">
                    <input type="text" name="search" class="form-control border-0 search" placeholder="Search your product">
                        <!-- <div class="input-group-append">
                            <button type="submit" name="submit" class="btn"><i class="fas fa-search"></i></button>
                        </div> -->
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5 bg-white" id="display">

</div>
<?php

include("includes/footer.php");

?>