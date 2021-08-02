<?php 

    include("includes/db.php");

?>

<?php 

    if(isset($_GET['coupon_id'])){

        $coupon_id = $_GET['coupon_id'];
        $coupon_status = $_GET['coupon_status'];

        $update_coupon = "update coupons set coupon_status='$coupon_status' where lower('coupon_id')=lower('$coupon_id')";
        $run_update_coupon = mysqli_query($con,$update_coupon);

        if($run_update_coupon){
            echo "<script>alert('Coupon Updated Successfully.');</script>";
            echo "<script>window.open('index.php?view_coupon','_self')</script>";
        }else {
            echo "<script>alert('Coupon Updated Failed ! Try again.');</script>";
            echo "<script>window.open('index.php?view_coupon','_self')</script>";
        }

    }

    if(isset($_POST['coupon_duli'])){

    $coupon_code = $_POST['coupon_duli'];
        
    $get_coupon_duli = "select * from coupons where coupon_code='$coupon_code'";
    $run_coupon_duli = mysqli_query($con,$get_coupon_duli);
    $count_coupon_duli = mysqli_num_rows($run_coupon_duli);

    if($count_coupon_duli>=1){
        echo 1;
    }else {
        echo 2;
    }
    }

?>