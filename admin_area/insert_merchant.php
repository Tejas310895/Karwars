<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>    
   <div class="row"><!-- row Begin -->
    
    <div class="col-lg-6 col-md-6">
        <h2 class="card-title">INSERT MERCHANT</h2>
    </div>
    <div class="col-lg-6 col-md-6">
        <a href="index.php?view_merchant" class="btn btn-primary pull-right">Back</a>
    </div>
 
</div><!-- row Finish -->

<form method="post">
    <div class="row">
        <div class="col-lg-6 my-3">
        <label> Merchant Name </label>
        <input type="text" class="form-control" name="merchant_name" placeholder="Enter Merchant Name">
        </div>
        <div class="col-lg-6 my-3">
        <label> Merchant Email </label>
        <input type="email" class="form-control" name="merchant_email" placeholder="Enter Merchant Email">
        </div>
        <div class="col-lg-6 my-3">
        <label> Merchant Contact </label>
        <input type="text" class="form-control" name="merchant_mobile"  placeholder="Enter Merchant Contact">
        </div>
        <div class="col-lg-6 my-3">
        <label> GSTN </label>
        <input type="text" class="form-control" name="merchant_gst" placeholder="Enter GSTN">
        </div>
        <div class="col-lg-12 my-3">
        <button type="submit" name="insert" class="btn btn-primary">Add Client</button>
        </div>
    </div>
</form>



<?php 

if(isset($_POST['insert'])){
    
    $merchant_name = $_POST['merchant_name'];
    $merchant_email = $_POST['merchant_email'];
    $merchant_mobile = $_POST['merchant_mobile'];
    $merchant_gst = $_POST['merchant_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    
    $insert_client = "insert into merchants (merchant_name,
                                             merchant_mobile,
                                             merchant_email,
                                             merchant_gst,
                                             merchant_bank_name,
                                             merchant_account_number,
                                             merchant_ifsc_code,
                                             merchant_account_type,
                                             merchant_created_at,
                                             merchant_updated_at) 
                                    values ('$merchant_name',
                                             '$merchant_mobile',
                                             '$merchant_email',
                                             '$merchant_gst',
                                             'nil',
                                             'nil',
                                             'nil',
                                             'nil',
                                             '$today',
                                             '$today')";
    
    $run_insert = mysqli_query($con,$insert_client);
    
    if($run_insert){
        
        echo "<script>alert('Merchant Added sucessfully')</script>";
        echo "<script>window.open('index.php?view_merchant','_self')</script>";       
    }

}

?>


<?php } ?>