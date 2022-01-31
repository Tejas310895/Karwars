<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?>
<div class="row">
    <div class="col-lg-6 col-md-6">
    <h2 class="card-title">INSERT COUPON</h2>
    </div>
    <div class="col-lg-6 col-md-6">
    <a href="index.php?view_coupon" class="btn btn-primary pull-right">Back</a>
    </div>
</div>
<form action="" method="post">
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="form-group">
          <label for="">Coupon Code</label>
          <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" aria-describedby="helpId" required>
          <small id="coupon_duli" class="form-text text-success d-none">Dublicate Code Use different code.</small>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="form-group">
          <label for="">Coupon Description</label>
          <input type="text" name="coupon_desc" id="coupon_desc" class="form-control" placeholder="Enter Coupon Description" aria-describedby="helpId" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col">
                <label for="">Coupon Type</label>
                <select class="form-control" name="coupon_type" id="coupon_type" required>
                    <option selected disabled value="">Choose Type</option>
                    <option value="amount">Amount</option>
                    <option value="percent">Percentage</option>
                    <option value="product">Product</option>
                </select>
            </div>
            <div class="col" id="cou_amount">
                <label for="">Coupon Unit</label>
                        <input type="text" class="form-control d-none" name="amount_unit" id="amount_unit" placeholder="Percent/Amount">
                <select class="form-control d-none" name="product_unit" id="product_unit">
                    <option selected disabled value="">Choose product</option>
                    <?php 
                    
                    $get_product_for = "select * from products";
                    $run_product_for = mysqli_query($con,$get_product_for);
                    while($row_product_for=mysqli_fetch_array($run_product_for)){
                        echo "<option value='".$row_product_for['product_id']."'>".$row_product_for['product_title']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
            <label for="">Coupon Limit</label>
            <input type="text" class="form-control" name="coupon_usage_limit" placeholder="Usage Limit/Customer" required>
            </div>
            <div class="col">
            <label for="">Minimum Order</label>
            <input type="text" class="form-control" name="min_order" placeholder="Minimum Order For Coupon" required>
            </div>
            <div class="col">
            <label for="">Discount Upto</label>
            <input type="text" class="form-control" name="upto_limit" placeholder="Enter Discount upto" required>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="form-group">
            <label for="">Start Date</label>
            <input type="date" name="coupon_start_date" id="coupon_start_date" min="2021-07-02" class="form-control" placeholder="Enter Coupon Code" aria-describedby="helpId" onkeydown="return false" required>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="form-group">
            <label for="">End Date</label>
            <input type="date" name="coupon_expiry_date" id="coupon_expiry_date" class="form-control" placeholder="Enter Coupon Code" aria-describedby="helpId" onkeydown="return false" required>
        </div>
    </div>
    <button type="submit" name="coupon_submit" class="btn btn-primary btn-block pull-right">Submit</button>
</div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<?php 

if(isset($_POST['coupon_submit'])){

    $coupon_code = $_POST['coupon_code'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $coupon_desc = $_POST['coupon_desc'];
    $coupon_type = $_POST['coupon_type'];
    if($coupon_type==='amount'){
        $coupon_unit = $_POST['amount_unit'];
        $coupon_use_id = 0;
    }elseif ($coupon_type==='percent') {
        $coupon_unit = $_POST['amount_unit'];
        $coupon_use_id = 0;
    }elseif ($coupon_type==='product') {
        $coupon_unit = 0;
        $coupon_use_id = $_POST['product_unit'];
    }
    $coupon_usage_limit = $_POST['coupon_usage_limit'];
    $min_order = $_POST['min_order'];
    $upto_limit = $_POST['upto_limit'];
    $coupon_start_date = $_POST['coupon_start_date'];
    $coupon_expiry_date = $_POST['coupon_expiry_date'];

    $insert_coupon = "insert into coupons (coupon_code,
                                           coupon_desc,
                                           eligible_customers,
                                           coupon_type,
                                           coupon_usage_limit,
                                           min_order,
                                           coupon_start_date,
                                           coupon_expiry_date,
                                           coupon_status,
                                           coupon_created_at,
                                           coupon_updated_at)
                                           values
                                           ('$coupon_code',
                                            '$coupon_desc',
                                            'all',
                                            '$coupon_type',
                                            '$coupon_usage_limit',
                                            '$min_order',
                                            '$coupon_start_date',
                                            '$coupon_expiry_date',
                                            'active',
                                            '$today',
                                            '$today')";
    $run_insert_coupon = mysqli_query($con,$insert_coupon);

    if($run_insert_coupon){

        $insert_coupon_controls = "insert into coupon_controls (coupon_code,
                                                                coupon_unit,
                                                                coupon_use_id,
                                                                upto_limit,
                                                                coupon_type_created_at,
                                                                coupon_type_updated_at)
                                                                values 
                                                                ('$coupon_code',
                                                                 '$coupon_unit',
                                                                 '$coupon_use_id',
                                                                 '$upto_limit',
                                                                 '$today',
                                                                 '$today')";
        $run_coupon_controls = mysqli_query($con,$insert_coupon_controls);
            if($run_coupon_controls){
                echo "<script>alert('Coupon Inserted')</script>";
                echo "<script>window.open('index.php?view_coupon','_self')</script>";
            }else{
                echo "<script>alert('Insert Failed !try Again')</script>";
                echo "<script>window.open('index.php?view_coupon','_self')</script>";
            }
    }

    
}

?>
<?php 
} 
?>