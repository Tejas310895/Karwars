<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{


?>

<?php 

    if(isset($_GET['delete_city'])){
        
        $delete_city= $_GET['delete_city'];

        $get_a = "select * from area where city_id='$delete_city'";

        $run_a = mysqli_query($con,$get_a);

        $row_a = mysqli_fetch_array($run_a);

        $area_id = $row_a['area_id'];
        
        $delete_c = "delete from city where city_id='$delete_city'";

        $run_delete_c = mysqli_query($con,$delete_c);

        $delete_a = "delete from area where city_id='$delete_city'";
        
        $run_delete_a = mysqli_query($con,$delete_a);

        $delete_landmark = "delete from landmark where area_id='$area_id'";

        $run_delete_landmark = mysqli_query($con,$delete_landmark);
        
        if($run_delete_c){
            
            echo "<script>alert('City Deleted')</script>";
            
            echo "<script>window.open('index.php?view_area','_self')</script>";
            
        }
        
    }

?>




<?php } ?>