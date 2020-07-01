<?php 

include("includes/db.php");

if(isset($_GET['update_order'])){

  $update_order = $_GET['update_order'];

  $status = $_POST['status'];

  $update_status_del = "UPDATE customer_orders SET order_status='$status' WHERE invoice_no='$update_order'";

  $run_status_del = mysqli_query($con,$update_status_del);


    echo "<script>alert('Status Updated')</script>";

    echo "<script>window.open('index.php?view_orders','_self')</script>";


}

// if(isset($_GET['cancel_order'])){

//     $update_order = $_GET['cancel_order'];
  
//     $update_status_del = "UPDATE customer_orders SET order_status='Cancelled' WHERE invoice_no='$update_order'";
  
//     $run_status_del = mysqli_query($con,$update_status_del);
  
  
//       echo "<script>alert('Order Cancelled')</script>";
  
//       echo "<script>window.open('index.php?view_orders','_self')</script>";
  
  
//   }

  if(isset($_GET['update_stock'])){

    $pro_id = $_GET['update_stock'];

    $stock = $_POST['stock'];
  
    $update_stock = "UPDATE products SET product_stock='$stock' WHERE product_id='$pro_id'";
  
    $run_update_stock = mysqli_query($con,$update_stock);
  
  
      echo "<script>alert('Stock Updated')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

  

?>