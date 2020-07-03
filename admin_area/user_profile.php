<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
   <?php 

   $session_email = $_SESSION['admin_email'];
   
   $get_user = "select * from admins where admin_email='$session_email'";

   $run_user = mysqli_query($con,$get_user);

   $row_user = mysqli_fetch_array($run_user);

   $admin_id = $row_user['admin_id'];

   $admin_name = $row_user['admin_name'];

   $admin_email = $row_user['admin_email'];

   $admin_pass = $row_user['admin_pass'];

   $admin_contact = $row_user['admin_contact'];

   $min_order = $row_user['min_order'];

   $del_charges = $row_user['del_charges'];
   
   ?>

    
       
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">EDIT USER</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_area" class="btn btn-primary pull-right">Service Area</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
        <div class="col-lg-6 my-3">
        <label> Name </label>
        <input type="text" class="form-control" name="admin_name" value="<?php echo $admin_name; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Email </label>
        <input type="email" class="form-control" name="admin_email" value="<?php echo $admin_email; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Contact </label>
        <input type="text" class="form-control" name="admin_contact"  value="<?php echo $admin_contact; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> MIn-Order Amount </label>
        <input type="text" class="form-control" name="min_order"  value="<?php echo $min_order; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> OLd Password </label>
        <input type="password" class="form-control" name="old_pass" placeholder="Old Password">
        </div>
        <div class="col-lg-6 my-3">
        <label> Delivery Charges </label>
        <input type="text" class="form-control" name="del_charges"  value="<?php echo $del_charges; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> New Password </label>
        <input type="password" class="form-control" name="admin_pass" placeholder="New Password">
        </div>
        <div class="col-lg-12 my-3">
        <button type="submit" name="update" class="btn btn-primary">Update Details</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['update'])){
    
    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_contact = $_POST['admin_contact'];
    $min_order = $_POST['min_order'];
    $del_charges = $_POST['del_charges'];
    $old_pass = $_POST['old_pass'];
    $user_pass = $_POST['admin_pass'];

    if($admin_pass == $old_pass){
    
    $update_user = "update admins set admin_name='$user_name',admin_email='$user_email',admin_pass='$user_pass',admin_contact='$user_contact',min_order='$min_order',del_charges='$del_charges' where admin_id='$admin_id'";
    
    $run_user = mysqli_query($con,$update_user);
    
    if($run_user){
        
        echo "<script>alert('User has been updated sucessfully')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        
        session_destroy();
        
    }

}else{
    echo "<script>alert('Please Enter valid Password')</script>";
}
    
}

?>


<?php } ?>