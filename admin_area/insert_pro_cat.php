<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

         <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT PRODUCT CATEGORY</h2>
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
                                <input name="pro_cat_title" type="text" placeholder="Category Title " class="form-control" required>
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            <label for="exampleFormControlSelect1">Category Description</label>
                                <input name="pro_cat_desc" type="text" placeholder="Category Description " class="form-control" required>
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            <label for="exampleFormControlSelect1">Minimum Price</label>
                                <input name="min_price" type="text" placeholder="Minimum Price" class="form-control" required>
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select class="form-control" name="cat" id="exampleFormControlSelect1" required>
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
                                <label class="custom-file-label"  for="inputGroupFile01">Choose Catagory Image</label>
                                <input type="file" name="pro_cat_image" class="custom-file-input" id="inputGroupFile01" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4"><!-- form-group begin -->
                                            
                        <div class="col-lg-12"><!-- col-md-6 begin -->
                        
                            <input value="Submit" name="submit" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
            </div><!-- row 2 finish -->
    </form><!-- form-horizontal finish -->


<?php  

          if(isset($_POST['submit'])){
              
              $pro_cat_title = $_POST['pro_cat_title'];

              $pro_cat_desc = $_POST['pro_cat_desc'];

              $min_price = $_POST['min_price'];

              $cat = $_POST['cat'];
              
              $pro_cat_image = $_FILES['pro_cat_image']['name'];
    
              $temp_name = $_FILES['pro_cat_image']['tmp_name'];
              
              move_uploaded_file($temp_name,"other_images/store_images/$pro_cat_image");
              
              $insert_cat = "insert into store (cat_id,store_title,store_desc,store_img,min_price) 
              values ('$cat','$pro_cat_title','$pro_cat_desc','$pro_cat_image','$min_price')";
              
              $run_cat = mysqli_query($con,$insert_cat);
              
              if($run_cat){
                  
                  echo "<script>alert('Your New Category Has Been Inserted')</script>";
                  
                  echo "<script>window.open('index.php?view_pro_cat','_self')</script>";
                  
              }
              
          }

?>

<?php } ?>