<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['edit_slide'])){
        
        $edit_slide_id = $_GET['edit_slide'];
        
        $edit_slide = "select * from slider where slide_id='$edit_slide_id'";
        
        $run_edit_slide = mysqli_query($con,$edit_slide);
        
        $row_edit_slide = mysqli_fetch_array($run_edit_slide);
        
        $slide_id = $row_edit_slide['slide_id'];
        
        $slide_name = $row_edit_slide['slide_name'];
        
        $slide_img = $row_edit_slide['slide_image'];

        $slide_url = $row_edit_slide['slide_url'];
        
    }

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">EDIT SLIDE</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_slides" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" ><!-- form-horizontal begin -->
                <div class="row mt-5"><!-- row 2 begin -->
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            
                                <input name="slide_name" type="text" placeholder="Slide Name " value="<?php echo $slide_name; ?>" class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <!-- <label class="custom-file-label"  for="inputGroupFile01">Choose Slide Image</label> -->
                                <input type="text" name="slide_image" class="form-control" value="<?php echo $slide_img; ?>" required>
                            </div>
                            <img src="<?php echo $slide_img; ?>" alt="" class="img-thumbnail border-0" width="200px">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                                <!-- <label class="custom-file-label"  for="inputGroupFile01">Choose Slide Image</label> -->
                                <input type="text" name="slide_url" class="form-control" placeholder="Slide url" value="<?php echo $slide_url; ?>" required>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <select class="form-control" name="image_type">
                            <option value="head_slide">head_slide</option>
                            <option value="promo_images">promo_images</option>
                            <option value="foot_slide">foot_slide</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group"><!-- form-group begin -->
                                            
                        <div class="col-lg-12"><!-- col-md-6 begin -->
                        
                            <input value="Submit" name="update" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
            </div><!-- row 2 finish -->
    </form><!-- form-horizontal finish -->

<?php  

    if(isset($_POST['update'])){
        
        $slide_name = $_POST['slide_name'];
        
        $slide_image = $_POST['slide_image'];

        $slide_url = $_POST['slide_url'];

        $image_type = $_POST['image_type'];
        
        //$temp_name = $_FILES['slide_image']['tmp_name'];
        
        //move_uploaded_file($temp_name,"slides_images/$slide_image");
        
        $update_slide = "update slider set slide_name='$slide_name',slide_image='$slide_image',slide_url='$slide_url',image_type='$image_type' where slide_id='$slide_id'";
        
        $run_update_slide = mysqli_query($con,$update_slide);
        
        if($run_update_slide){
            
            echo "<script>alert('Your Slide has been updated Successfully')</script>"; 
        
            echo "<script>window.open('index.php?view_slides','_self')</script>";
            
        }
        
    }

?>

<?php } ?>