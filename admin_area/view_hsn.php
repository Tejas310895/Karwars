<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">TAX HSN CODE LIBRARY</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_hsn" class="btn btn-primary pull-right">Add New</a>
           </div>
       </div>
       <div class="row">
                <?php 
                
                    $get_hsn = "select * from taxes";
        
                    $run_hsn = mysqli_query($con,$get_hsn);
        
                    while($run_hsn_section=mysqli_fetch_array($run_hsn)){
                        
                        $tax_id = $run_hsn_section['tax_id'];

                        $hsn_code = $run_hsn_section['hsn_code'];

                        $cgst = $run_hsn_section['cgst'];

                        $sgst = $run_hsn_section['sgst'];

                        $cess = $run_hsn_section['cess'];
                        
                        $tax_for = substr($run_hsn_section['tax_for'],0,100);
                
                ?>
                
                <div class="col-lg-4 col-md-4"><!-- col-lg-4 col-md-4 begin -->
                    <div class="panel panel-primary"><!-- panel panel-primary begin -->
                        <div class="panel-heading"><!-- panel-heading begin -->
                            <h3 class="panel-title" align="center"><!-- panel-title begin -->
                            
                                <?php echo $hsn_code; ?>
                                
                            </h3><!-- panel-title finish -->
                        </div><!-- panel-heading finish -->
                        
                        <div class="panel-body"><!-- panel-body begin -->
                        
                        CGST : <?php echo $cgst; ?>% / SGST : <?php echo $sgst; ?>% / CESS : <?php echo $cess; ?>%.
                        <br>
                        <?php echo $tax_for; ?>
                            
                        </div><!-- panel-body finish -->
                        
                        <div class="panel-footer"><!-- panel-footer begin -->
                            <center><!-- center begin -->
                                
                                <a href="index.php?delete_hsn=<?php echo $tax_id; ?>" class="pull-right"><!-- pull-right begin -->
                                
                                 <i class="fa fa-trash"></i> Delete
                                
                                </a><!-- pull-right finish -->
                                
                                <a href="index.php?edit_hsn=<?php echo $tax_id; ?>" class="pull-left"><!-- pull-left begin -->
                                
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