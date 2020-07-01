<?php 

session_start();

session_destroy();

echo "<script>window.open('./','_self')</script>";

?>