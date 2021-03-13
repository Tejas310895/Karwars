<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>    
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">INSERT STAFF</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_staff" class="btn btn-primary pull-right">Back</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
        <div class="col-lg-6 my-3">
        <label> Staff Name </label>
        <input type="text" class="form-control" name="staff_name" placeholder="Enter Vendor Name">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Email </label>
        <input type="email" class="form-control" name="staff_email" placeholder="Enter Vendor Email">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Contact </label>
        <input type="text" class="form-control" name="staff_phone"  placeholder="Enter Vendor Contact">
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Address </label>
        <input type="text" class="form-control" name="staff_address" placeholder="Enter Vendor Address">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Gender</label>
                <select class="form-control" name="staff_gender" id="exampleFormControlSelect1">
                <option>Male</option>
                <option>Female</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff DOB </label>
        <input type="date" class="form-control" name="staff_dob">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Role</label>
                <select class="form-control" name="staff_role" id="exampleFormControlSelect1">
                <option>Admin</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Addhar </label>
        <input type="text" class="form-control" name="staff_addhar" placeholder="Enter Products Type">
        </div>
        <div class="col-lg-6 my-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Staff Ststus</label>
                <select class="form-control" name="staff_status" id="exampleFormControlSelect1">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 my-3">
        <label> Staff Password </label>
        <input type="text" class="form-control" name="staff_pass" placeholder="Enter Products Type">
        </div>

        <div class="col-lg-12 my-3">
        <button type="submit" name="insert" class="btn btn-primary">Add Staff</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['insert'])){
    
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
    
    $insert_staff = "insert into employees (employee_name,
                                            employee_email,
                                            employee_contact,
                                            employee_address,
                                            employee_gender,
                                            employee_dob,
                                            employee_role,
                                            employee_addhar,
                                            employee_status,
                                            employee_pass,
                                            updated_date) 
                                    values ('$staff_name',
                                             '$staff_email',
                                             '$staff_phone',
                                             '$staff_address',
                                             '$staff_gender',
                                             '$staff_dob',
                                             '$staff_role',
                                             '$staff_addhar',
                                             '$staff_status',
                                             '$staff_pass',
                                             '$today')";
    
    $run_insert = mysqli_query($con,$insert_staff);
    
    if($run_insert){
        
        echo "<script>alert('Staff Added sucessfully')</script>";
        echo "<script>window.open('index.php?view_staff','_self')</script>";       
    }

}

?>


<?php } ?>