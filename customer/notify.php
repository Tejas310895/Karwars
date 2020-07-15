<?php


session_start();

    if(!isset($_SESSION['customer_email'])){

        echo "<script>window.open('../checkout.php','_self')</script>";

    }else{
    
    include("includes/db.php");
    include("functions/function.php");

?>

<?php 

if(isset($_GET['pro_id'])){

    $p_id = $_GET['pro_id'];

    $customer_email = $_SESSION['customer_email'];

    $get_customer = "select * from customers where customer_email='$customer_email'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $customer_id = $row_customer['customer_id'];

    $insert_notify = "insert into notify (product_id,customer_id,notify_date) values ('$p_id','$customer_id',NOW())";

    $run_insert = mysqli_query($con,$insert_notify);

    // $to = 'tshirsat700@gmail.com';
    // $subject = 'Notifications';
    // $from = 'tshirsat700@gmail.com';
    // $message = 'Product :'.$product_name.'</br> Required Qty :'.$product_qty; 
 
    // Sending email
    if($run_insert){
        echo "<script>alert('We will review your enquiry')</script>";
        echo "<script>window.history.back()</script>";
    } else{
        echo "<script>alert('Not sent Please try again')</script>";
        echo "<script>window.history.back();</script>";
    }

}


?>

<?php 

include("includes/footer.php");

?>
<?php } ?>
