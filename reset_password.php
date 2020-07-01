<?php 

include("includes/db.php");
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
    <link rel="stylesheet" href="styles/style.css?version=1">
    <!-- styles -->
</head>
<body>


<img src="admin_area/admin_images/wrnlogo.png" class="img-thumbnail rounded mx-auto d-block border-0" alt="..." width="50%" style="background-color:transparent;">
<form class="px-5" action="" method="post">
<div class="form-group text-center">
  <label>Enter Registered email</label>
  <input type="email" name="c_email" id="" class="form-control" placeholder="Enter Email">
</div>
<div class="form-group text-center">
  <input type="submit" name="submit" value="Send mail" id="" class="btn btn-success">
</div>
</form>

<?php 

if(isset($_POST['submit'])){

    $c_email = $_POST['c_email'];

    $verify_email = "select * from customers where customer_email='$c_email'";

    $run_verify = mysqli_query($con,$verify_email);

    if(mysqli_num_rows($run_verify)>0){

        function rand_string( $length ) {

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars),0,$length);
            
            }

            $pass = rand_string(6);

            $c_pass = password_hash($pass, PASSWORD_DEFAULT);
            

            //HTML mail function

            $to = $c_email;
            $subject = 'Reset Password';
            $from = 'tshirsat700@gmail.com';

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            $message = '<html><body>';
            $message .= '<img src="http://www.wernear.in/admin_area/admin_images/mailhead.jpg" width="100%">';
            $message .= '<h1 style="color:#999;font-size:1.5rem;text-align:center;">Your Temporary Password</h1>';
            $message .= '<h1 style="color:#999;font-size:2rem;text-align:center;">'.$pass.'</h1>';
            $message .= '</body></html>';

            mail($to, $subject, $message, $headers);

            $update_pass = "update customers set customer_pass='$c_pass' where customer_email='$c_email'";

            $run_pass = mysqli_query($con,$update_pass);
                    
                        if($run_pass){
                    
                          echo "<script>alert('Temporary password sent on mail, change once logged in')</script>";
                    
                          echo "<script>window.open('checkout','_self')</script>";
                    
                        }

    }else{

        echo "<script>alert('Email Does not exist')</script>";

        echo "<script>window.open('enter_email','_self')</script>";

    }


}

?>

<?php 

include("includes/footer.php");

?>