<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 
if(isset($_GET['edit_merchant'])){

    $edit_id = $_GET['edit_merchant'];
    $get_merchants = "select * from merchants where merchant_id='$edit_id'";
    $run_merchants = mysqli_query($con,$get_merchants);
    $row_merchants = mysqli_fetch_array($run_merchants);
    $merchant_name = $row_merchants['merchant_name'];
    $merchant_mobile = $row_merchants['merchant_mobile'];
    $merchant_email = $row_merchants['merchant_email'];
    $merchant_gst = $row_merchants['merchant_gst'];

}


?>
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">INSERT CLIENT</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_merchants" class="btn btn-primary pull-right">Back</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
    <div class="col-lg-6 my-3">
        <label> Merchant Name </label>
        <input type="text" class="form-control" name="merchant_name" value="<?php echo $merchant_name; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Merchant Email </label>
        <input type="email" class="form-control" name="merchant_email" value="<?php echo $merchant_email; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> Merchant Contact </label>
        <input type="text" class="form-control" name="merchant_mobile"  value="<?php echo $merchant_mobile; ?>">
        </div>
        <div class="col-lg-6 my-3">
        <label> GSTN </label>
        <input type="text" class="form-control" name="merchant_gst" value="<?php echo $merchant_gst; ?>">
        </div>
        <div class="col-lg-12 my-3">
        <button type="submit" name="update" class="btn btn-primary">Update Details</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['update'])){
    
    $merchant_name_u = $_POST['merchant_name'];
    $merchant_email_u = $_POST['merchant_email'];
    $merchant_mobile_u = $_POST['merchant_mobile'];
    $merchant_gst_u = $_POST['merchant_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $update_client = "UPDATE clients SET 
                                            merchant_name='$merchant_name_u',
                                            merchant_mobile='$merchant_mobile_u',
                                            merchant_email='$merchant_email_u',
                                            merchant_gst='$merchant_gst_u',
                                            merchant_updated_at='$today'
                                            WHERE merchant_id='$edit_id'";

$run_client = mysqli_query($con,$update_client);


if($run_client){

echo "<script>alert('Merchant details has been Updated sucessfully')</script>";
echo "<script>window.open('index.php?view_client','_self')</script>";

}

}

?>


<?php } ?>