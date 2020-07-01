<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['edit_cat'])){
        
        $edit_cat_id = $_GET['edit_cat'];
        
        $edit_cat_query = "select * from categories where cat_id='$edit_cat_id'";
        
        $run_edit = mysqli_query($con,$edit_cat_query);
        
        $row_edit = mysqli_fetch_array($run_edit);
        
        $cat_id = $row_edit['cat_id'];
        
        $cat_title = $row_edit['cat_title'];
        
        $cat_img = $row_edit['cat_image'];
        
    }

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">EDIT CATEGORY</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_cats" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" ><!-- form-horizontal begin -->
                <div class="row mt-5"><!-- row 2 begin -->
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            
                                <input name="cat_title" type="text" placeholder="Category Title " value="<?php echo $cat_title; ?>" class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <label class="custom-file-label"  for="inputGroupFile01">Choose Product Image</label>
                                <input type="file" name="cat_image" class="custom-file-input" id="inputGroupFile01" required>
                            </div>
                            <img src="other_images/<?php echo $cat_img; ?>" alt="" class="img-thumbnail" width="100px">
                        </div>
                    </div>
                    <div class="form-group"><!-- form-group begin -->
                                            
                        <div class="col-lg-12"><!-- col-md-6 begin -->
                        
                            <input value="Update" name="update" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
            </div><!-- row 2 finish -->
    </form><!-- form-horizontal finish -->

<?php  

          if(isset($_POST['update'])){
              
            $cat_title = $_POST['cat_title'];
              
            $cat_image = $_FILES['cat_image']['name'];
  
            $temp_name = $_FILES['cat_image']['tmp_name'];
            
            move_uploaded_file($temp_name,"other_images/$cat_image");
              
              $update_cat = "update categories set cat_title='$cat_title',cat_image='$cat_image' where cat_id='$cat_id'";
              
              $run_cat = mysqli_query($con,$update_cat);
              
              if($run_cat){
                  
                  echo "<script>alert('Your Category Has Been Updated')</script>";
                  
                  echo "<script>window.open('index.php?view_cats','_self')</script>";
                  
              }
              
          }

?>



<?php } ?> 