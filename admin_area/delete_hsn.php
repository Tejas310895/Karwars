<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_hsn'])){
        
        $delete_hsn_id = $_GET['delete_hsn'];
        
        $delete_hsn = "delete from taxes where tax_id='$delete_hsn_id'";
        
        $run_delete_hsn = mysqli_query($con,$delete_hsn);
        
        if($run_delete_hsn){
            
            echo "<script>alert('One of Your HSN Section Has Been Deleted')</script>";
            
            echo "<script>window.open('index.php?view_hsn','_self')</script>";
            
        }
        
    }

?>




<?php } ?>