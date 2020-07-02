<?php 

    session_start();
    
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
    <meta name="description" content="The best online grocery store in palava. We can fulfill all your grocery needs ranging from grains,pulses,kitchen needs to fresh vegetables and fruits"/>
    <link rel="shortcut icon" type="image/png" href="../admin_area/admin_images/wrnlogo.png"/>
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
    <script>
    // function saves scroll position
    function fScroll(val)
    {
            var hidScroll = document.getElementById('hidScroll');
            hidScroll.value = val.scrollTop;
    }

    // function moves scroll position to saved value
    function fScrollMove(what)
    {
            var hidScroll = document.getElementById('hidScroll');
            document.getElementById(what).scrollTop = hidScroll.value;
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- date -->
    <!-- styles -->
    <link rel="stylesheet" href="styles/style.css?version=11">
    <!-- styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
   