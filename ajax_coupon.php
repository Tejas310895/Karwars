<?php 

session_start();
ob_start();
include("includes/db.php");
include("functions/function.php");

?>
<?php 

    if(isset($_POST['coupon_id'])){

        setcookie("promo", "", time() - 1);

        $coupon_id = $_POST['coupon_id'];
        $item_total = $_POST['item_total'];

        $get_min_order = "select * from coupons where coupon_id='$coupon_id'";
        $run_min_order = mysqli_query($con,$get_min_order);
        $row_min_order = mysqli_fetch_array($run_min_order);

        $min_order = $row_min_order['min_order'];

        if($item_total>=$min_order){

        setcookie("promo", $coupon_id, time()+7200); 
        
        echo "Coupon Applied Successfully";
        }else{

            echo "Offers is valid for orders above ".$min_order;
        }

    }

    if(isset($_POST['coupon_delete'])){

        setcookie("promo", "", time() - 1);
        echo "Promo Code Removed Successfully";
    }


?>
<?php ob_end_flush(); ?>