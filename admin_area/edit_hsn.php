<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

if(isset($_GET['edit_hsn'])){

    $edit_id = $_GET['edit_hsn'];
    $get_hsn = "select * from taxes where tax_id='$edit_id'";
    $run_hsn = mysqli_query($con,$get_hsn);
    $row_hsn = mysqli_fetch_array($run_hsn);
    $tax_id = $row_hsn['tax_id'];
    $hsn_code = $row_hsn['hsn_code'];
    $tax_for = $row_hsn['tax_for'];
    $cgst = $row_hsn['cgst'];
    $sgst = $row_hsn['sgst'];
    $cess = $row_hsn['cess'];

}

?>
    
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">EDIT TERM</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_hsn" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       
       <div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->
                   
                    <div class="form-group"><!-- form-group Begin -->
                        
                            <label class="col-md-3 control-label"> HSN CODE </label> 
                            
                            <div class="col-md-6"><!-- col-md-6 Begin -->
                                
                                <input name="hsn_code" type="text" class="form-control" value="<?php echo $hsn_code; ?>" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                        
                        <label class="col-md-3 control-label"> CGST </label> 
                        
                        <div class="col-md-6"><!-- col-md-6 Begin -->
                            
                            <input name="cgst" type="number" class="form-control" value="<?php echo $cgst; ?>" required>
                            
                        </div><!-- col-md-6 Finish -->
                    
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                            
                            <label class="col-md-3 control-label"> SGST </label> 
                            
                            <div class="col-md-6"><!-- col-md-6 Begin -->
                                
                                <input name="sgst" type="number" class="form-control" value="<?php echo $sgst; ?>" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                            
                            <label class="col-md-3 control-label"> CESS </label> 
                            
                            <div class="col-md-6"><!-- col-md-6 Begin -->
                                
                                <input name="cess" type="number" class="form-control" value="<?php echo $cess; ?>" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> GST FOR </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <textarea name="tax_for" cols="19" rows="6" class="form-control" required><?php echo $tax_for; ?></textarea>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="update" value="Update HSN" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->

    </div>

</div>

<?php 

if(isset($_POST['update'])){

    $hsn_code = $_POST['hsn_code'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $cess = $_POST['cess'];
    $tax_for = $_POST['tax_for'];


    $update_hsn = "update taxes set hsn_code='$hsn_code',cgst='$cgst',sgst='$sgst',cess='$cess',tax_for='$tax_for' where tax_id='$tax_id'";
    $run_hsn = mysqli_query($con,$update_hsn);

    if($run_hsn){

        echo "<script>alert('Your HSN Has Been Updated')</script>";
        echo "<script>window.open('index.php?view_hsn','_self')</script>";

    }
    
}

?>

    <?php } ?>
