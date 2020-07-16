<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

        <?php
            
            if(isset($_GET['edit_pro_cat'])){

            $edit_id = $_GET['edit_pro_cat'];

            $get_store = "select * from store where store_id='$edit_id'";

            $run_store = mysqli_query($con,$get_store);

                $row_store=mysqli_fetch_array($run_store);

                $store_id = $row_store['store_id'];

                $cat = $row_store['cat_id'];

                $store_title = $row_store['store_title'];
                
                $store_desc = $row_store['store_desc'];

                $store_image = $row_store['store_img'];

                $min_price = $row_store['min_price'];

            }

            $get_cat = "select * from categories where cat_id='$cat'";

            $run_cat = mysqli_query($con,$get_cat);
    
            $row_cat = mysqli_fetch_array($run_cat);
    
            $cat_title = $row_cat['cat_title'];
            
            ?>

         <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">EDIT PRODUCT CATEGORY</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_pro_cat" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" ><!-- form-horizontal begin -->
                <div class="row mt-5"><!-- row 2 begin -->
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                                <label for="exampleFormControlSelect1">Category Title</label>
                                <input name="pro_cat_title" type="text" value="<?php echo $store_title; ?>" placeholder="Category Title" class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            <label for="exampleFormControlSelect1">Category Description</label>
                                <input name="pro_cat_desc" type="text" value="<?php echo $store_desc; ?>" placeholder="Category Description " class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            <label for="exampleFormControlSelect1">Minimum Price</label>
                                <input name="min_price" type="text" value="<?php echo $min_price; ?>" class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select class="form-control" name="cat" id="exampleFormControlSelect1" required>
                        <option value='<?php echo $cat; ?>'> <?php echo $cat_title; ?> </option>
                        <?php 
                                
                                $get_cat = "select * from categories";
                                $run_cat = mysqli_query($con,$get_cat);
                                
                                while ($row_cat=mysqli_fetch_array($run_cat)){
                                    
                                    $cat_id = $row_cat['cat_id'];
                                    $cat_title = $row_cat['cat_title'];
                                    
                                    echo "
                                    
                                    <option value='$cat_id'> $cat_title </option>
                                    
                                    ";
                                    
                                }
                                
                                ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <!-- <label class="custom-file-label"  for="inputGroupFile01">Choose Catagory Image</label> -->
                                <input type="text" name="pro_cat_image" value="<?php echo $store_image; ?>" class="form-control" id="inputGroupFile01" required>
                            </div>
                            <img src="<?php echo $store_image; ?>" alt="" class="img-thumbnail border-0" width="100px">
                        </div>
                    </div>
                    <div class="form-group mt-4"><!-- form-group begin -->
                                            
                        <div class="col-lg-12"><!-- col-md-6 begin -->
                        
                            <input value="Submit" name="update" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
            </div><!-- row 2 finish -->
    </form><!-- form-horizontal finish -->


<?php  

          if(isset($_POST['update'])){
              
              $pro_cat_title = $_POST['pro_cat_title'];

              $pro_cat_desc = $_POST['pro_cat_desc'];

              $min_price = $_POST['min_price'];

              $cat = $_POST['cat'];
              
              $pro_cat_image = $_POST['pro_cat_image'];
    
              //$temp_name = $_FILES['pro_cat_image']['tmp_name'];
              
              //move_uploaded_file($temp_name,"other_images/store_images/$pro_cat_image");
              
              $update_pro_cat = "UPDATE store SET 
                                    cat_id ='$cat',
                                    store_title ='$pro_cat_title',
                                    store_desc ='$pro_cat_desc',
                                    store_img ='$pro_cat_image',
                                    min_price ='$min_price'
                                    WHERE store_id='$store_id'";
              
              $run_pro_cat = mysqli_query($con,$update_pro_cat);
              
              if($run_pro_cat){
                  
                  echo "<script>alert('Your New Category Has Been Updated')</script>";
                  
                  echo "<script>window.open('index.php?view_pro_cat','_self')</script>";
                  
              }
              
          }

?>

<?php } ?>