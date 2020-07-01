<?php 

    include("includes/header.php");


?>

<?php 

if($_POST['p_type']==='COD'){

    include("codorder.php");

}elseif($_POST['p_type']==='PAYTM'){

    include("paytmorder.php");

}else{

    echo "<script>window.open('./','_self')</script>";

}


?>