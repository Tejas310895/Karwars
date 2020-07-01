<?php 

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?>

<?php 

    if(isset($_GET['edit_product'])){

        $edit_id = $_GET['edit_product'];

        $get_p = "select * from products where product_id='$edit_id'";

        $run_edit = mysqli_query($con,$get_p);

        $row_edit = mysqli_fetch_array($run_edit);

        $p_id = $row_edit['product_id'];

        $p_title = $row_edit['product_title'];

        $store = $row_edit['store_id'];

        $p_image1 = $row_edit['product_img1'];

        $p_price = $row_edit['product_price'];

        $d_price = $row_edit['price_display'];

        $p_keywords = $row_edit['product_keywords'];

        $p_desc = $row_edit['product_desc'];

        $p_stock = $row_edit['product_stock'];

        $hsn = $row_edit['hsn'];

    }

        $get_store = "select * from store where store_id='$store'";

        $run_store = mysqli_query($con,$get_store);

        $row_store = mysqli_fetch_array($run_store);

        $store_title = $row_store['store_title'];

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">EDIT PRODUCT</h2>
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
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_title" value="<?php echo $p_title; ?>" placeholder="Product Title" required>
                </div>
                </div>
                <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Pack</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_desc" value="<?php echo $p_desc; ?>" placeholder="Product Pack" required>
                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">MRP</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="display_price" value="<?php echo $d_price; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sold Price</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="product_price" value="<?php echo $p_price; ?>" placeholder="Product Price" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Keywords</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_keywords" value="<?php echo $p_keywords; ?>" placeholder="Product Keywords" required>
                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Stock</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="product_stock" value="<?php echo $p_stock; ?>" placeholder="Product Stock" required>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select class="form-control" name="store" id="exampleFormControlSelect1" required>
                        <option value="<?php echo $store; ?>"><?php echo $store_title; ?></option>
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
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select class="form-control" name="hsn_code" id="exampleFormControlSelect1" required>
                        <option value="<?php echo $hsn; ?>"><?php echo $hsn; ?></option>
                        <?php 
                                
                                $get_hsn = "select * from taxes";
                                $run_hsn = mysqli_query($con,$get_hsn);
                                
                                while ($row_hsn=mysqli_fetch_array($run_hsn)){
                                    
                                    $hsn_code = $row_hsn['hsn_code'];
                                    $tax_for = $row_hsn['tax_for'];
                                    
                                    echo "
                                    
                                    <option value='$hsn_code'> $hsn_code-$tax_for </option>
                                    
                                    ";
                                    
                                }
                                
                                ?>
                        </select>
                    </div>
                </div>
                    <div class="col-lg-6 col-md-6 mt-5">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <label class="custom-file-label"  for="inputGroupFile01">Choose Product Image</label>
                                <input type="file" name="product_img1" class="custom-file-input" value="<?php echo $p_image1; ?>" id="inputGroupFile01" required>
                            </div>
                            <img src="product_images/<?php echo $p_image1; ?>" alt="" class="img-thumbnail" width="100px">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mt-5">
                <div class="form-group pull-left">
                    <input type="submit" name="update" value="Submit Now" class="btn btn-success form-control">
                </div>
                </div>
            </div> 
       </form>

       <?php
       
       if(isset($_POST['update'])){

        $product_title = $_POST['product_title'];
        $store = $_POST['store'];
        $product_price = $_POST['product_price'];
        $display_price = $_POST['display_price'];
        $product_keywords = $_POST['product_keywords'];
        $product_desc = $_POST['product_desc'];
        $product_stock = $_POST['product_stock'];

        $hsn = $_POST['hsn_code'];
        
        $product_img1 = $_FILES['product_img1']['name'];
        
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        
        move_uploaded_file($temp_name1,"product_images/$product_img1");
    
        $update_product = "UPDATE products SET 
                            store_id='$store',
                            date=NOW(),
                            product_title='$product_title',
                            product_img1='$product_img1',
                            product_price='$product_price',
                            price_display='$display_price',
                            product_keywords='$product_keywords',
                            product_desc='$product_desc',
                            product_stock='$product_stock',
                            hsn='$hsn'
                            WHERE product_id='$p_id'";
        
        $run_product = mysqli_query($con,$update_product);
    
    
        if($run_product){
            
            echo "<script>alert('Product has been Updated sucessfully')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
            
        }
        
    }
       
       ?>

<?php } ?>