<?php 

    include("includes/header.php");

?> 


           <div class="container-fluid"><!-- container-fluid begin -->

                <?php 
                
                if(!isset($_SESSION['customer_email'])){

                        include("customer/customer_login.php");

                }else{

                    echo "<script>window.open('./','_self')</script>";

                }
                
                ?>
           
           </div><!-- container-fluid ends -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>



