<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT PRODUCT</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_products" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" >
        <div class="row">
                <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_title" placeholder="Product Title" required>
                </div>
                </div>
                <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Pack</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_desc" placeholder="Product Pack" required>
                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-6 col-md-6 mt-5">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">MRP</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="display_price" placeholder="MRP" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Vendor Price</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="vendor_price" placeholder="Vendor Price" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sold Price</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="product_price" placeholder="Selling Price" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Keywords</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_keywords" placeholder="Product Keywords" required>
                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Stock</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_stock" placeholder="Product Stock" required>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select class="form-control" name="store" id="exampleFormControlSelect1" required>
                    <?php 
                              
                              $get_store = "select * from store";
                              $run_store = mysqli_query($con,$get_store);
                              
                              while ($row_store=mysqli_fetch_array($run_store)){
                                  
                                  $store_id = $row_store['store_id'];
                                  $store_title = $row_store['store_title'];
                                  
                                  echo "
                                  
                                  <option value='$store_id'> $store_title </option>
                                  
                                  ";
                                  
                              }
                              
                              ?>
                    </select>
                </div>
                </div>
                <div class="w-100"></div>
                    <div class="col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label>Choose Product Image</label>
                            <input type="text" name="product_img1" class="form-control" placeholder="Product image link" required>
                        </div>
                   </div>
                   <div class="col-lg-6 col-md-6 mt-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Client</label>
                    <select class="form-control" name="client" id="exampleFormControlSelect1" required>
                    <?php 
                              
                              $get_client = "select * from clients";
                              $run_client = mysqli_query($con,$get_client);
                              
                              while ($row_client=mysqli_fetch_array($run_client)){
                                  
                                  $client_id = $row_client['client_id'];
                                  $client_title = $row_client['client_shop'];
                                  
                                  echo "
                                  
                                  <option value='$client_id'> $client_title </option>
                                  
                                  ";
                                  
                              }
                              
                              ?>
                    </select>
                </div>
                </div>
                   <div class="w-100"></div>
                   <div class="col-4">
                        <div class="form-group">
                            <label>HSN CODE</label>
                            <input type="number" name="product_hsn" step="0.01" class="form-control" placeholder="Enter Hsn Code" required>
                        </div>
                   </div>
                   <div class="col-2">
                        <div class="form-group">
                            <label>CGST</label>
                            <input type="number" name="product_cgst" step="0.01" class="form-control" placeholder="Enter CGST" required>
                        </div>
                   </div>
                   <div class="col-2">
                       <div class="form-group">
                            <label>SGST</label>
                            <input type="number" name="product_sgst" step="0.01" class="form-control" placeholder="Enter SGST" required>
                        </div>
                   </div>
                   <div class="col-2">
                        <div class="form-group">
                            <label>IGST</label>
                            <input type="number" name="product_igst" step="0.01" class="form-control" placeholder="Enter IGST" required>
                        </div>
                   </div>
                   <div class="col-2">
                        <div class="form-group">
                            <label>CESS</label>
                            <input type="number" name="product_cess" step="0.01" class="form-control" placeholder="Enter CESS" required>
                        </div>
                   </div>
                   <div class="w-100"></div>
                <div class="col-lg-12 col-md-12 mt-5">
                <div class="form-group pull-left">
                    <input type="submit" name="submit" value="Submit Now" class="btn btn-success form-control">
                </div>
                </div>
            </div> 
       </form>


<?php 

if(isset($_POST['submit'])){
    
    $product_title = $_POST['product_title'];
    $store = $_POST['store'];
    $product_price = $_POST['product_price'];
    $display_price = $_POST['display_price'];
    $vendor_price = $_POST['vendor_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_desc'];
    $product_stock = $_POST['product_stock'];
    $product_hsn = $_POST['product_hsn'];
    $product_cgst = $_POST['product_cgst'];
    $product_sgst = $_POST['product_sgst'];
    $product_igst = $_POST['product_igst'];
    $product_cess = $_POST['product_cess'];
    $client = $_POST['client'];
    
    $product_img1 = $_POST['product_img1'];
    
    //$temp_name1 = $_FILES['product_img1']['tmp_name'];
    
    //move_uploaded_file($temp_name1,"product_images/$product_img1");
    
    $insert_product = "insert into products (store_id,
                                            date,
                                            product_title,
                                            product_img1,
                                            vendor_price,
                                            product_price,
                                            price_display,
                                            product_keywords,
                                            product_desc,
                                            product_stock,
                                            product_hsn,
                                            product_cgst,
                                            product_sgst,
                                            product_igst,
                                            product_cess,
                                            product_visibility,
                                            client_id) 
                                    values ('$store',
                                             NOW(),
                                             '$product_title',
                                             '$product_img1',
                                             '$vendor_price',
                                             '$product_price',
                                             '$display_price',
                                             '$product_keywords',
                                             '$product_desc',
                                             '$product_stock',
                                             '$product_hsn',
                                             '$product_cgst',
                                             '$product_sgst',
                                             '$product_igst',
                                             '$product_cess',
                                             'Y',
                                             '$client')";
    
    $run_product = mysqli_query($con,$insert_product);
    
    if($run_product){
        
        echo "<script>alert('Product has been inserted sucessfully')</script>";
        echo "<script>window.open('index.php?view_products','_self')</script>";
        
    }
    
}
?>

<?php 
} 
?>