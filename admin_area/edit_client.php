<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 
if(isset($_GET['edit_client'])){

    $edit_id = $_GET['edit_client'];
    $get_client = "select * from clients where client_id='$edit_id'";
    $run_client = mysqli_query($con,$get_client);
    $row_client = mysqli_fetch_array($run_client);
    $client_name = $row_client['client_name'];
    $client_shop = $row_client['client_shop'];
    $client_email = $row_client['client_email'];
    $client_phone = $row_client['client_phone'];
    $client_address = $row_client['client_address'];
    $client_gstn = $row_client['client_gstn'];
    $client_pro_type = $row_client['client_pro_type'];

}


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
        <input type="text" class="form-control" name="client_name" value="<?php echo $client_name; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Shop Name </label>
        <input type="text" class="form-control" name="client_shop" value="<?php echo $client_shop; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Email </label>
        <input type="email" class="form-control" name="client_email" value="<?php echo $client_email; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Contact </label>
        <input type="text" class="form-control" name="client_phone"  value="<?php echo $client_phone; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Vendor Address </label>
        <input type="text" class="form-control" name="client_address" value="<?php echo $client_address; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> GSTN </label>
        <input type="text" class="form-control" name="client_gstn" value="<?php echo $client_gstn; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Products Type </label>
        <input type="text" class="form-control" name="client_pro_type" value="<?php echo $client_pro_type; ?>">
        </div>
        <div class="col-lg-12 my-3">
        <button type="submit" name="update" class="btn btn-primary">Update Details</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['update'])){
    
    $client_name = $_POST['client_name'];
    $client_shop = $_POST['client_shop'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'];
    $client_address = $_POST['client_address'];
    $client_gstn = $_POST['client_gstn'];
    $client_pro_type = $_POST['client_pro_type'];

    
    $update_client = "UPDATE clients SET 
                                            client_name='$client_name',
                                            client_shop='$client_shop',
                                            client_email='$client_email',
                                            client_phone='$client_phone',
                                            client_address='$client_address',
                                            client_gstn='$client_gstn',
                                            client_pro_type='$client_pro_type'
                                            WHERE client_id='$edit_id'";

$run_client = mysqli_query($con,$update_client);


if($run_client){

echo "<script>alert('Client details has been Updated sucessfully')</script>";
echo "<script>window.open('index.php?view_client','_self')</script>";

}

}

?>


<?php } ?>