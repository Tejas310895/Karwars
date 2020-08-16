<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_client'])){
        
        $delete_client_id = $_GET['delete_client'];
        
        $delete_slide = "delete from clients where client_id='$delete_client_id'";
        
        $run_delete = mysqli_query($con,$delete_slide);
        
        if($run_delete){
            
            echo "<script>alert('Client Deleted')</script>";
            
            echo "<script>window.open('index.php?view_client','_self')</script>";
            
        }
        
    }

?>




<?php } ?>