<?php 

    include("includes/header.php");


?>

<?php 

if($_POST['pay_type']==='POD'){

    include("codorder.php");

}elseif($_POST['pay_type']==='CASHFREE'){

    include("cashfree_order.php");

}else{

    echo "<script>window.open('./','_self')</script>";

}

?>

<?php 

    include("includes/footer.php");


?>