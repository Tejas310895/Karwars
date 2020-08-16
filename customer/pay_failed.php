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
    <link href='https://fonts.googleapis.com/css?family=Quantico' rel='stylesheet'>
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
<body style="background-color:#fff; padding-top:3%;">
    <div class="container-fluid mt-5 share">
        <div class="row">
            <div class="col-12">
                <img src="../admin_area/admin_images/alert.svg" alt="" class="mx-auto d-block" width="50px">
                <h3 class="mb-0 text-center mt-3" style="font-family:Laila;font-size:1.5rem;">Payment Failed</h3>
                <h3 class="mb-0 text-center mt-0" style="font-family:Laila;font-size:1.5rem;">Order Successfully Placed</h3>
                <img src="../admin_area/admin_images/ordersuc.jpg" alt="" class="img-fluid px-5">
                <h3 class="mb-0 text-center mt-1" style="font-family:Quantico;font-size:1.1rem;">Order will be delivered on time<br>If You want to cancle the order<br>Call Us @ 9867765397/Chat</h3>
            </div>
            <div class="w-100"></div>
            <div class="row fixed-bottom">
            <div class="col-6 px-0">
              <a href="../" class="btn btn-warning text-white text-center d-block rounded-0">Go To Home</a>
            </div>
            <div class="col-6 px-0">
              <a href="my_account" class="btn btn-success text-white text-center d-block rounded-0">My Order</a>
            </div>
            </div>
        </div>
    </div>
    <script>
        history.pushState(null, null, location.href);
        history.back();
        history.forward();
        window.onpopstate = function () { history.go(1); };
    </script> 
    <?php

    include("includes/footer.php");

    ?>

    <?php 

    }

    ?>