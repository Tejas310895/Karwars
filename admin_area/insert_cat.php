<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

         <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT CATEGORY</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_cats" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" ><!-- form-horizontal begin -->
                <div class="row mt-5"><!-- row 2 begin -->
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            
                                <input name="cat_title" type="text" placeholder="Category Title " class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <label class="custom-file-label"  for="inputGroupFile01">Choose Catagory Image</label>
                                <input type="file" name="cat_image" class="custom-file-input" id="inputGroupFile01" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><!-- form-group begin -->
                                            
                        <div class="col-lg-12"><!-- col-md-6 begin -->
                        
                            <input value="Submit" name="submit" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
            </div><!-- row 2 finish -->
    </form><!-- form-horizontal finish -->


<?php  

          if(isset($_POST['submit'])){
              
              $cat_title = $_POST['cat_title'];
              
              $cat_image = $_FILES['cat_image']['name'];
    
              $temp_name = $_FILES['cat_image']['tmp_name'];
              
              move_uploaded_file($temp_name,"other_images/$cat_image");
              
              $insert_cat = "insert into categories (cat_title,cat_image) values ('$cat_title','$cat_image')";
              
              $run_cat = mysqli_query($con,$insert_cat);
              
              if($run_cat){
                  
                  echo "<script>alert('Your New Category Has Been Inserted')</script>";
                  
                  echo "<script>window.open('index.php?view_cats','_self')</script>";
                  
              }
              
          }

?>

<?php } ?>