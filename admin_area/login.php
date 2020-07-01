<?php 

    session_start();
    include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="dashboard/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="dashboard/assets/img/favicon.png">
  <title>
    Black Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sty le.css">
  <!-- Nucleo Icons -->
  <link href="dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="dashboard/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="dashboard/assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container-fluid p-0 w-100">
        <div class="row">
            <div class="col-lg-6">
            <img src="admin_images/login-banner.jpg" alt="" class="img-fluid rounded-0" width="100%">
            </div>
            <div class="col-lg-6">
                <img src="admin_images/logo.png" alt="" class="img-fluid mx-auto d-block border-0" width="300px">
                <div class="col-lg-11">
                <form action="" class="form-login" method="post"><!-- form-login begins -->
                <h1 class="card-title text-center py-5"> Admin Login </h1>

                <input type="text" class="form-control my-5" placeholder="Email Address" name="admin_email" required>

                <input type="password" class="form-control my-5" placeholder="Your Password" name="admin_pass" required>

                <button class="btn btn-lg btn-primary btn-block my-5" name="admin_login"> Login </button>

                </form><!-- form-login ends -->
                </div>
            </div>
        </div>
    </div>    
</body>
</html>

<?php 

    if(isset($_POST['admin_login'])){

        $admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);

        $admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

        $get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";

        $run_admin = mysqli_query($con,$get_admin);

        $count = mysqli_num_rows($run_admin);

        if($count==1){

            $_SESSION['admin_email']=$admin_email;

            echo "<script>alert('Logged in. Welcome Back')</script>";

            echo "<script>window.open('index.php?view_orders','_self')</script>";

        }else{

            echo "<script>alert('Email or Password is Worng')</script>"; 

        }

    }

?>