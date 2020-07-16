<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT SLIDE</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_slides" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" ><!-- form-horizontal begin -->
                <div class="row mt-5"><!-- row 2 begin -->
                    <div class="col-lg-6">
                        <div class="form-group"><!-- form-group begin -->
                            
                                <input name="slide_name" type="text" placeholder="Slide Name" class="form-control">
                            
                        
                        </div><!-- form-group finish -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <!-- <label class="custom-file-label"  for="inputGroupFile01">Choose Slide Image</label> -->
                                <input type="text" name="slide_image" class="form-control" placeholder="Slide image link" required>
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
        
        $slide_name = $_POST['slide_name'];
        
        $slide_image = $_POST['slide_image'];
        
        //$temp_name = $_FILES['slide_image']['tmp_name'];
        
        $view_slides = "select * from slider";
        
        $view_run_slide = mysqli_query($con,$view_slides);
        
        $count = mysqli_num_rows($view_run_slide);
        
        if($count<8){
            
            //move_uploaded_file($temp_name,"slides_images/$slide_image");
            
            $insert_slide = "insert into slider (slide_name,slide_image) values ('$slide_name','$slide_image')";
            
            $run_slide = mysqli_query($con,$insert_slide);
            
            echo "<script>alert('Your new slide image has been inserted')</script>";
            
            echo "<script>window.open('index.php?view_slides','_self')</script>";
            
        }else{
            
           echo "<script>alert('You have already inserted 4 slides')</script>"; 
            
        }
        
    }

?>

<?php } ?>