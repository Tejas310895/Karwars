<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>    
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">INSERT CLIENT</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_client" class="btn btn-primary pull-right">Back</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
        <div class="col-lg-6 my-3">
        <label> Vendor Name </label>
        <input type="text" class="form-control" name="client_name" placeholder="Enter Vendor Name">
        </div>
        <div class="col-lg-6 my-3">
        <label> Shop Name </label>
        <input type="text" class="form-control" name="client_shop" placeholder="Enter Shop Name">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Email </label>
        <input type="email" class="form-control" name="client_email" placeholder="Enter Vendor Email">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Contact </label>
        <input type="text" class="form-control" name="client_phone"  placeholder="Enter Vendor Contact">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Address </label>
        <input type="text" class="form-control" name="client_address" placeholder="Enter Vendor Address">
        </div>
        <div class="col-lg-6 my-3">
        <label> GSTN </label>
        <input type="text" class="form-control" name="client_gstn" placeholder="Enter GSTN">
        </div>
        <div class="col-lg-6 my-3">
        <label> Products Type </label>
        <input type="text" class="form-control" name="client_pro_type" placeholder="Enter Products Type">
        </div>
        <div class="col-lg-12 my-3">
        <button type="submit" name="insert" class="btn btn-primary">Add Client</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['insert'])){
    
    $client_name = $_POST['client_name'];
    $client_shop = $_POST['client_shop'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'];
    $client_address = $_POST['client_address'];
    $client_gstn = $_POST['client_gstn'];
    $client_pro_type = $_POST['client_pro_type'];

    
    $insert_client = "insert into clients (client_name,
                                            client_shop,
                                            client_email,
                                            client_phone,
                                            client_address,
                                            client_gstn,
                                            client_pro_type) 
                                    values ('$client_name',
                                             '$client_shop',
                                             '$client_email',
                                             '$client_phone',
                                             '$client_address',
                                             '$client_gstn',
                                             '$client_pro_type')";
    
    $run_insert = mysqli_query($con,$insert_client);
    
    if($run_insert){
        
        echo "<script>alert('Client Added sucessfully')</script>";
        echo "<script>window.open('index.php?view_client','_self')</script>";       
    }

}

?>


<?php } ?>