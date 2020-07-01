<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
    <div class="col-lg-6 col-md-6">
    <h2 class="card-title">SLIDES</h2>
    </div>
    <div class="col-lg-6 col-md-6">
    <a href="index.php?insert_slide" class="btn btn-success pull-right">NEW Slide</a>
    </div>
</div>

<div class="row"><!-- row 2 begin -->
            
                <?php 
                
                    $get_slides = "select * from slider";
        
                    $run_slides = mysqli_query($con,$get_slides);
        
                    while($row_slides=mysqli_fetch_array($run_slides)){
                        
                        $slide_id = $row_slides['slide_id'];
                        
                        $slide_name = $row_slides['slide_name'];
                        
                        $slide_image = $row_slides['slide_image'];
                
                ?>
                
                <div class="col-lg-3 col-md-3"><!-- col-lg-3 col-md-3 begin -->
                    <div class="panel panel-primary"><!-- panel panel-primary begin -->
                        <div class="panel-heading"><!-- panel-heading begin -->
                            <h3 class="panel-title" align="center"><!-- panel-title begin -->
                            
                                <?php echo $slide_name; ?>
                                
                            </h3><!-- panel-title finish -->
                        </div><!-- panel-heading finish -->
                        
                        <div class="panel-body"><!-- panel-body begin -->
                            
                            <img src="slides_images/<?php echo $slide_image; ?>" alt="<?php echo $slide_name; ?>" class="img-responsive">
                            
                        </div><!-- panel-body finish -->
                        
                        <div class="panel-footer"><!-- panel-footer begin -->
                            <center><!-- center begin -->
                                
                                <a href="index.php?delete_slide=<?php echo $slide_id; ?>" class="btn btn-danger btn-sm btn-icon pull-right"><!-- pull-right begin -->
                                
                                <i class="tim-icons icon-simple-remove"></i>
                                
                                </a><!-- pull-right finish -->
                                
                                <a href="index.php?edit_slide=<?php echo $slide_id; ?>" class="btn btn-success btn-sm btn-icon pull-left"><!-- pull-left begin -->
                                
                                <i class="tim-icons icon-pencil"></i>
                                
                                </a><!-- pull-left finish -->
                                
                                <div class="clearfix"></div>
                                
                            </center><!-- center finish -->
                        </div><!-- panel-footer finish -->
                        
                    </div><!-- panel panel-primary finish -->
                </div><!-- col-lg-3 col-md-3 finish -->
                
                <?php } ?>
</div><!-- row 2 finish -->


<?php } ?>