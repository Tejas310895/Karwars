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

  if(isset($_POST['add_city'])){

    $city_name = $_POST['city_name'];
  
    $insert_city = "insert into city (city_name) values ('$city_name')";
  
    $run_insert_city = mysqli_query($con,$insert_city);
  
  
      echo "<script>alert('City Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_POST['add_area'])){

    $city_id = $_POST['city_id'];

    $area_name = $_POST['area_name'];
  
    $insert_area = "insert into area (area_name,city_id) values ('$area_name','$city_id')";
  
    $run_insert_area = mysqli_query($con,$insert_area);
  
  
      echo "<script>alert('Area Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_POST['add_landmark'])){

    $area_id = $_POST['area_id'];

    $landmark_name = $_POST['landmark_name'];
  
    $insert_landmark = "insert into landmark (landmark_name,area_id) values ('$landmark_name','$area_id')";
  
    $run_insert_landmark = mysqli_query($con,$insert_landmark);
  
  
      echo "<script>alert('Landmark Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_GET['update_pos'])){

    $pro_id = $_GET['update_pos'];

    $position = $_POST['position'];

    $check_count = "SELECT * FROM products where store_id=(SELECT store_id FROM products WHERE product_id='$pro_id')";

    $run_check_count = mysqli_query($con,$check_count);

    $count = mysqli_num_rows($run_check_count);

    // $row_check_count = mysqli_fetch_array($run_check_count);

    // $store_id = $row_check_count['store_id'];


    if($position<=$count){

      $update_position = "UPDATE products SET product_position='$position' WHERE product_id='$pro_id'";

      $run_update_position = mysqli_query($con,$update_position);
  
      echo "<script>alert('Position Updated')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";

    }else{

      echo "<script>alert('Products less then position number')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
    }

  
  
  }


  if(isset($_GET['Y'])){

    $pro_id = $_GET['Y'];

    $update_visibility = "UPDATE products SET product_visibility='Y' WHERE product_id='$pro_id'";
  
    $run_update_visibility = mysqli_query($con,$update_visibility);
  
  
      echo "<script>alert('Product Visible')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

  if(isset($_GET['N'])){

    $pro_id = $_GET['N'];

    $update_visibility = "UPDATE products SET product_visibility='N' WHERE product_id='$pro_id'";
  
    $run_update_visibility = mysqli_query($con,$update_visibility);
  
  
      echo "<script>alert('Product Visible')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

?>