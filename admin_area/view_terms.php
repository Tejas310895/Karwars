<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">TERMS & CONDITIONS</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_terms" class="btn btn-primary pull-right">Add New</a>
           </div>
       </div>
       <div class="row">
                <?php 
                
                    $get_terms = "select * from terms";
        
                    $run_terms = mysqli_query($con,$get_terms);
        
                    while($run_terms_section=mysqli_fetch_array($run_terms)){
                        
                        $term_id = $run_terms_section['term_id'];
                        
                        $term_title = $run_terms_section['term_title'];
                        
                        $term_desc = substr($run_terms_section['term_desc'],0,400);
                
                ?>
                
                <div class="col-lg-4 col-md-4"><!-- col-lg-4 col-md-4 begin -->
                    <div class="panel panel-primary"><!-- panel panel-primary begin -->
                        <div class="panel-heading"><!-- panel-heading begin -->
                            <h3 class="panel-title" align="center"><!-- panel-title begin -->
                            
                                <?php echo $term_title; ?>
                                
                            </h3><!-- panel-title finish -->
                        </div><!-- panel-heading finish -->
                        
                        <div class="panel-body"><!-- panel-body begin -->
                            
                        <?php echo $term_desc; ?>
                            
                        </div><!-- panel-body finish -->
                        
                        <div class="panel-footer"><!-- panel-footer begin -->
                            <center><!-- center begin -->
                                
                                <a href="index.php?delete_term=<?php echo $term_id; ?>" class="pull-right"><!-- pull-right begin -->
                                
                                 <i class="fa fa-trash"></i> Delete
                                
                                </a><!-- pull-right finish -->
                                
                                <a href="index.php?edit_term=<?php echo $term_id; ?>" class="pull-left"><!-- pull-left begin -->
                                
                                 <i class="fa fa-pencil"></i> Edit
                                
                                </a><!-- pull-left finish -->
                                
                                <div class="clearfix"></div>
                                
                            </center><!-- center finish -->
                        </div><!-- panel-footer finish -->
                        
                    </div><!-- panel panel-primary finish -->
                </div><!-- col-lg-4 col-md-4 finish -->
                
                <?php } ?>
            
</div><!-- row 2 finish -->


<?php } ?>