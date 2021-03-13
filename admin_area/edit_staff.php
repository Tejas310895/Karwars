<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php 
if(isset($_GET['edit_staff'])){

    $edit_id = $_GET['edit_staff'];
    $get_staff = "select * from employees where employee_id='$edit_id'";
    $run_staff = mysqli_query($con,$get_staff);
    $row_staff = mysqli_fetch_array($run_staff);
    $employee_name = $row_staff['employee_name'];
    $employee_email = $row_staff['employee_email'];
    $employee_contact = $row_staff['employee_contact'];
    $employee_address = $row_staff['employee_address'];
    $employee_gender = $row_staff['employee_gender'];
    $employee_dob = $row_staff['employee_dob'];
    $employee_role = $row_staff['employee_role'];
    $employee_addhar = $row_staff['employee_addhar'];
    $employee_status = $row_staff['employee_status'];
    $employee_pass = $row_staff['employee_pass'];

}

?>  
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">EDIT STAFF</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_staff" class="btn btn-primary pull-right">Back</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
        <div class="col-lg-6 my-3">
        <label> Staff Name </label>
        <input type="text" class="form-control" name="staff_name" placeholder="Enter Vendor Name" value="<?php echo $employee_name; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Email </label>
        <input type="email" class="form-control" name="staff_email" placeholder="Enter Vendor Email" value="<?php echo $employee_email; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Contact </label>
        <input type="text" class="form-control" name="staff_phone"  placeholder="Enter Vendor Contact" value="<?php echo $employee_contact; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Address </label>
        <input type="text" class="form-control" name="staff_address" placeholder="Enter Vendor Address" value="<?php echo $employee_address; ?>">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Gender</label>
                <select class="form-control" name="staff_gender" id="exampleFormControlSelect1">
                <option> <?php echo $employee_gender; ?></option>
                <option>Male</option>
                <option>Female</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff DOB </label>
        <input type="date" class="form-control" name="staff_dob"  value="<?php echo $employee_dob; ?>">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Role</label>
                <select class="form-control" name="staff_role" id="exampleFormControlSelect1">
                <option><?php echo $employee_role; ?></option>
                <option>Admin</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Addhar </label>
        <input type="text" class="form-control" name="staff_addhar" placeholder="Enter Products Type" value="<?php echo $employee_addhar; ?>">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Ststus</label>
                <select class="form-control" name="staff_status" id="exampleFormControlSelect1">
                <option  value="<?php echo $employee_status; ?>"><?php echo $employee_status; ?></option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Password </label>
        <input type="text" class="form-control" name="staff_pass" placeholder="Enter Products Type"  value="<?php echo $employee_pass; ?>">
        </div>

        <div class="col-lg-12 my-3">
        <button type="submit" name="edit" class="btn btn-primary">Update Staff</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['edit'])){
    
    $staff_name = $_POST['staff_name'];
    $staff_email = $_POST['staff_email'];
    $staff_phone = $_POST['staff_phone'];
    $staff_address = $_POST['staff_address'];
    $staff_gender = $_POST['staff_gender'];
    $staff_dob = $_POST['staff_dob'];
    $staff_role = $_POST['staff_role'];
    $staff_addhar = $_POST['staff_addhar'];
    $staff_status = $_POST['staff_status'];
    $staff_pass = $_POST['staff_pass'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");
    
    $update_staff = "UPDATE employees SET 
                        employee_name='$staff_name',
                        employee_email='$staff_email',
                        employee_contact='$staff_phone',
                        employee_address='$staff_address',
                        employee_gender='$staff_gender',
                        employee_dob='$staff_dob',
                        employee_role='$staff_role',
                        employee_addhar='$staff_addhar',
                        employee_status='$staff_status',
                        employee_pass='$staff_pass',
                        updated_date='$today'
                        WHERE employee_id='$edit_id'";

$run_staff = mysqli_query($con,$update_staff);

    
    if($run_staff){
        
        echo "<script>alert('Staff Edited sucessfully')</script>";
        echo "<script>window.open('index.php?view_staff','_self')</script>";       
    }

}

?>


<?php } ?>