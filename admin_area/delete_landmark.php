<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{


?>

<?php 

    if(isset($_GET['delete_landmark'])){
        
        $delete_landmark= $_GET['delete_landmark'];

        $delete_l = "delete from landmark where landmark_id='$delete_landmark'";
        
        $run_delete_l = mysqli_query($con,$delete_l);
        
        if($run_delete_l){
            
            echo "<script>alert('Landmark Deleted')</script>";
            
            echo "<script>window.open('index.php?view_area','_self')</script>";
            
        }
        
    }

?>




<?php } ?>