<?php 

session_start();

session_destroy();

setcookie("user", "", time() - 1);

echo "<script>window.open('./','_self')</script>";

?>