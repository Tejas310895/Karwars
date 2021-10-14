<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Raise Delivery Bonus</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?del_bonus_sheet" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form id="insert_purchase" method="post" action="">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Seller Name</label>
                    <select class="form-control" name="client_id" id="exampleFormControlSelect1" required>
                    <?php 
                                echo "<option disabled selected value>Choose the Seller</option>";
                                $get_merchant = "select * from merchants";
                                $run_merchant = mysqli_query($con,$get_merchant);
                                
                                while ($row_merchant=mysqli_fetch_array($run_merchant)){
                                    
                                    $merchant_id = $row_merchant['merchant_id'];
                                    $merchant_name = $row_merchant['merchant_name'];
                                    
                                    echo "
                                    
                                    <option value='$merchant_id'> $merchant_name </option>
                                    
                                    ";
                                    
                                }
                                
                                ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                <label for="">Purchase Invoice</label>
                <input type="text" name="purchase_invoice_no" id="purchase_invoice_no" class="form-control" placeholder="Enter Purchase Invoice" aria-describedby="helpId" required>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                <label for="">Purchase Invoice Date</label>
                <input type="date" name="purchase_invoice_date" id="purchase_invoice_date" class="form-control" placeholder="Enter Invoice Date" aria-describedby="helpId" required>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                <label for="">Purchase Payment Date</label>
                <input type="date" name="purchase_payment_date" id="purchase_payment_date" class="form-control" placeholder="Enter Payment Date" aria-describedby="helpId" required>
                </div>
            </div>
        </div>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control mt-2" id="exampleFormControlSelect1" name="product_id[]" id="product_id" required>
            <?php
            
                echo "<option disabled selected value>Choose the products</option>";
                $get_products = "select * from products";
                $run_products = mysqli_query($con,$get_products);
                while($row_products=mysqli_fetch_array($run_products)){

                    $product_id = $row_products['product_id'];
                    $product_title = $row_products['product_title'];
                    $product_desc = $row_products['product_desc'];

                echo "<option value='$product_id'>$product_title $product_desc</option>";

                }
            
            ?>
            </select>
            <input type="text" name="product_qty[]" id="product_qty" class="form-control mt-2" placeholder="Enter Purchase Quantity" required/>
            <input type="text" name="vendor_price[]" id="vendor_price" class="form-control mt-2" placeholder="Enter Purchase Price" required/>
            <input type="text" name="gst_rate[]" id="gst_rate" class="form-control mt-2" placeholder="Enter Gst Rate %" required/>
            <div class="input-group-addon mx-3 mt-1"> 
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="submit" id="add_del_bonus"  class="btn btn-lg btn-primary mx-5 mt-5 float-left">Submit</button>
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
    <select class="form-control mt-2" id="exampleFormControlSelect1" name="product_id[]" id="product_id" required>
            <?php
            
                echo "<option disabled selected value>Choose the products</option>";
                $get_products = "select * from products";
                $run_products = mysqli_query($con,$get_products);
                while($row_products=mysqli_fetch_array($run_products)){

                    $product_id = $row_products['product_id'];
                    $product_title = $row_products['product_title'];
                    $product_desc = $row_products['product_desc'];

                echo "<option value='$product_id'>$product_title $product_desc</option>";

                }
            
            ?>
            </select>
            <input type="text" name="product_qty[]" id="product_qty" class="form-control mt-2" placeholder="Enter Purchase Quantity" required/>
            <input type="text" name="vendor_price[]" id="vendor_price" class="form-control mt-2" placeholder="Enter Purchase Price" required/>
            <input type="text" name="gst_rate[]" id="gst_rate" class="form-control mt-2" placeholder="Enter Gst Rate %" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="fmr/js/fmr.js"></script>
<?php 

if(isset($_POST['submit'])){
    $merchant_id = $_POST['client_id'];
    $purchase_invoice_no = $_POST['purchase_invoice_no'];
    $purchase_invoice_date = $_POST['purchase_invoice_date'];
    $product_idArr = $_POST['product_id'];
    $product_qtyArr = $_POST['product_qty'];
    $vendor_priceArr = $_POST['vendor_price'];
    $gst_rateArr = $_POST['gst_rate'];
    $purchase_payment_date = $_POST['purchase_payment_date'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");
            $product_array = array();
            if(!empty($product_idArr)){
                for($i = 0; $i < count($product_idArr); $i++){
                    if(!empty($product_idArr[$i])){
                        $product_id = $product_idArr[$i];
                        $product_qty = $product_qtyArr[$i];
                        $vendor_price = $vendor_priceArr[$i];
                        $gst_rate = $gst_rateArr[$i];

                        $raw_array = array($product_id,$product_qty,$vendor_price,$gst_rate);
                        array_push($product_array,$raw_array);
                        
                    }
                }
            }

            $serialized_array = serialize($product_array); 

            $insert_purchase = "insert into purchase_invoice_entry (seller_id,
                                                                    purchase_invoice_no,
                                                                    purchase_invoice_date,
                                                                    product_array,
                                                                    payment_status,
                                                                    stock_update_status,
                                                                    purchase_payment_date,
                                                                    updated_date)
                                                                     values
                                                                     ('$merchant_id',
                                                                      '$purchase_invoice_no',
                                                                      '$purchase_invoice_date',
                                                                      '$serialized_array',
                                                                      'unpaid',
                                                                      'inactive',
                                                                      '$purchase_payment_date',
                                                                      '$today')";
            $run_insert_purchase = mysqli_query($con,$insert_purchase);

            // $stock_update = "update products set warehouse_stock=warehouse_stock+'$product_qty' where product_id='$product_id'";
            // $run_stock_update = mysqli_query($con,$stock_update);

            if($run_insert_purchase){
                echo "<script>alert('Purchase Invoice Inserted')</script>";
                echo "<script>window.open('index.php?purchase_invoice_entries','_self')</script>";
            }else{
                echo "<script>alert('Failed Try Again')</script>";
            }

} 

}

?>
