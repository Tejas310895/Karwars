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
    <title>Karwar Grocery</title>
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
<!-- fixed top -->
    <div class="container-fuild fixed-top">
        <!-- nav -->
            <ul class="nav bg-white accounttop ">
                <li class="nav-item">
                    <a class="nav-link" href="my_account">
                        <i style="font-size: 1.5rem;" class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <h5 class="account mt-2">Order Details</h5>
                </li>
            </ul>
        <!-- nav -->
        <div class="row">
            <div class="col-12 pr-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page" my-0 mx-0 rounded-0>Order ID - <?php echo $_GET['invoice_no']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
<!-- fixed top -->
<!-- Order Details -->

    <div class="container bg-white mt-0 pt-1 px-1" style="overflow-y:auto;height:76vh;">
    <?php 

    if(isset($_GET['invoice_no'])){

        $invoice_no = $_GET['invoice_no'];

        $get_status = "select * from customer_orders where invoice_no='$invoice_no'";

        $run_status = mysqli_query($con,$get_status);

        $row_status = mysqli_fetch_array($run_status);

        $order_status = $row_status['order_status'];

        $get_pro_id = "select * from customer_orders where invoice_no='$invoice_no'";

        $run_pro_id = mysqli_query($con,$get_pro_id);

        $get_total = "SELECT sum(due_amount) as sum_total FROM customer_orders WHERE invoice_no='$invoice_no' and product_status='Deliver'";

        $run_total = mysqli_query($con,$get_total);

        $get_min = "select * from admins";

        $run_min = mysqli_query($con,$get_min);

        $row_min = mysqli_fetch_array($run_min);

        $del_charges = $row_min['del_charges'];

        $row_total = mysqli_fetch_array($run_total);

        $get_discount = "select * from customer_discounts where invoice_no='$invoice_no'";
        $run_discount = mysqli_query($con,$get_discount);
        $row_discount = mysqli_fetch_array($run_discount);
    
        $discount_type = $row_discount['discount_type'];
        $discount_amount = $row_discount['discount_amount'];

        while($row_pro_id = mysqli_fetch_array($run_pro_id)){
            
        $pro_id = $row_pro_id['pro_id'];

        $qty = $row_pro_id['qty'];

        $sub_total = $row_pro_id['due_amount'];

        if($row_pro_id['product_status']==='Deliver'){
            $product_status = 'Delivered';
            $sta_color = 'text-success';
        }else{
            $product_status = 'Undelivered';
            $sta_color = 'text-danger';
        }
        $get_pro = "select * from products where product_id='$pro_id'";

        $run_pro = mysqli_query($con,$get_pro);

        while($row_pro = mysqli_fetch_array($run_pro)){

            // $total =0;

            $pro_title = $row_pro['product_title'];

            $pro_img1 = $row_pro['product_img1'];

            $pro_desc = $row_pro['product_desc'];

            $pro_price = $row_pro['product_price'];

            // $sub_total = $row_pro['product_price']*$qty;
            
            // $total += $sub_total;


            echo "

            <div class='row '>
                    <div class='col-3'>
                        <img class='img-thumbnail mb-2 border-0' src='$pro_img1' alt=''>
                    </div>
                    <div class='col-4 px-0'>
                        <h5 class='view_title mt-0 mb-0'>$pro_title</h5>
                        <p class='view_qty'>$pro_desc</p>
                    </div>
                    <div class='col-1 px-0 pt-3'>
                        <p class='view_qty'>X $qty</p>
                    </div>
                    <div class='col-4 px-0 pt-1'>
                        <h5 class='view_total text-center mb-0'>₹ $sub_total</h5>
                    </div>
                </div>
            
            ";


            }

        }

    }else{

        echo "<script>window.open('../','_self')</script>";

    }

    ?>
            <div class="row fixed-bottom px-3 <?php if($row_total['sum_total']>=1){echo 'show';}else{echo 'd-none';}?>" style="background-color:#999;">
                <div class="col-6">
                    <h6 class="text-left mb-0 mt-2 mb-0"><strong><?php echo $discount_type; ?>:</strong></h6>
                    <h5 class="total_sum text-left mb-0 mt-1">Total:</h5>
                </div>
                <div class="col-6">
                    <h5 class="text-right mb-0 mt-2"><strong>- ₹ <?php echo $discount_amount; ?></strong></h5>
                    <h5 class="total_sum text-right">₹ <?php echo ($row_total['sum_total']+$del_charges)-$discount_amount; ?></h5>
                </div>
                <!-- <div class="col-4 bg-warning px-0 <?php //if($order_status==='Delivered'){echo "show";}else{echo"d-none";} ?>">
                    <a href="invoice?pdf=<?php //echo $_GET['invoice_no']; ?>" class="btn px-1 pt-3 pb-0" style="font-size:1.2rem;padding-top:12px!important;color:#fff;" download><i class="fas fa-download"></i> INVOICE</a>
                </div> -->
            </div>
    </div>


    <?php

    include("includes/footer.php");

    ?>

    <?php 

    }

    ?>
<!-- Order Details -->