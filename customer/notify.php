<?php


session_start();

    if(!isset($_SESSION['customer_email'])){

        echo "<script>window.open('../checkout.php','_self')</script>";

    }else{
    
    include("includes/db.php");
    include("functions/function.php");

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
    <!-- bootstrap link -->
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <!-- swiper -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <!-- font-awesome -->
    <!-- styles -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- styles -->
</head>
<body>
<?php 

if(isset($_GET['pro_id'])){

    $p_id = $_GET['pro_id'];

    $get_pro = "select * from products where product_id='$p_id'";

    $run_pro = mysqli_query($con,$get_pro);

    $row_pro = mysqli_fetch_array($run_pro);

    $product_title = $row_pro['product_title'];

}

?>
<div class="container">
        <form method="post">
            <div class="form-group">
              <label> Product </label>
              <input type="text" name="product_name" id="" class="form-control" value='<?php echo $product_title; ?>' placeholder="" aria-describedby="helpId" readonly>
            </div>
            <div class="form-group">
              <label> Required Quantity </label>
              <input type="number" name="product_qty" id="" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <button type="submit" name="submit" id="" class="btn btn-success btn-lg btn-block"> NOTIFY </button>
            </div>
        </form>
</div>


<?php 

if(isset($_POST['submit'])){ 

    $product_name = $_POST['product_name'];

    $product_qty = $_POST['product_qty'];

    $to = 'tshirsat700@gmail.com';
    $subject = 'Notifications';
    $from = 'tshirsat700@gmail.com';
    $message = 'Product :'.$product_name.'</br> Required Qty :'.$product_qty; 
 
    // Sending email
    if(mail($to, $subject, $message)){
        echo "<script>alert('We will review your enquiry')</script>";
        echo "<script>window.open('../store','_self')</script>";
    } else{
        echo "<script>alert('Not sent Please try again')</script>";
    }

}
?>

<?php 

include("includes/footer.php");

?>
<?php } ?>
