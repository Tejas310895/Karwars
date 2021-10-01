<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php if(isset($_GET['merchant_products'])){
    
    $merchant_id = $_GET['merchant_products'];

    $get_merchant = "select * from merchants where merchant_id='$merchant_id'";
        
    $run_merchant = mysqli_query($con,$get_merchant);
    
    $row_merchant=mysqli_fetch_array($run_merchant);
    
    $merchant_name = $row_merchant['merchant_name'];
    
    ?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title"><?php echo $merchant_name; ?> Products</h2>
           </div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Product Name</th>
            <th>Warehouse Stock</th>
            <th>Vendor Price</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
        $get_mer_pro = "select * from products where merchant_id='$merchant_id'";
        $run_mer_pro = mysqli_query($con,$get_mer_pro);
        $counter = 0;
        while ($row_mer_pro=mysqli_fetch_array($run_mer_pro)) {
            $product_title = $row_mer_pro['product_title'];
            $product_desc = $row_mer_pro['product_desc'];
            $warehouse_stock = $row_mer_pro['warehouse_stock'];
            $vendor_price = $row_mer_pro['vendor_price'];
    ?>
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td><?php echo $product_title." ".$product_desc; ?></td>
            <td><?php echo $warehouse_stock; ?></td>
            <td><?php echo $vendor_price; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='js/datatable.js'></script>

<?php } ?>
<?php } ?>