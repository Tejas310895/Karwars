<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{


?>

<?php 

    if(isset($_GET['delete_area'])){
        
        $delete_area= $_GET['delete_area'];

        $delete_a = "delete from area where area_id='$delete_area'";
        
        $run_delete_a = mysqli_query($con,$delete_a);

        $delete_landmark = "delete from landmark where area_id='$delete_area'";

        $run_delete_landmark = mysqli_query($con,$delete_landmark);
        
        if($run_delete_a){
            
            echo "<script>alert('Area Deleted')</script>";
            
            echo "<script>window.open('index.php?view_area','_self')</script>";
            
        }
        
    }

?>




<?php } ?>