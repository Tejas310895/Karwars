<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
    
    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT HSN DETAILS</h2>
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
                                
                                <input name="hsn_code" type="text" class="form-control" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                        
                        <label class="col-md-3 control-label"> CGST </label> 
                        
                        <div class="col-md-6"><!-- col-md-6 Begin -->
                            
                            <input name="cgst" type="number" class="form-control" required>
                            
                        </div><!-- col-md-6 Finish -->
                    
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                            
                            <label class="col-md-3 control-label"> SGST </label> 
                            
                            <div class="col-md-6"><!-- col-md-6 Begin -->
                                
                                <input name="sgst" type="number" class="form-control" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                    <div class="form-group"><!-- form-group Begin -->
                            
                            <label class="col-md-3 control-label"> CESS </label> 
                            
                            <div class="col-md-6"><!-- col-md-6 Begin -->
                                
                                <input name="cess" type="number" class="form-control" required>
                                
                            </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> GST FOR </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <textarea name="tax_for" cols="19" rows="6" class="form-control" required></textarea>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="submit" value="Create HSN" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->

    </div>

</div>

<?php 

if(isset($_POST['submit'])){

    $hsn_code = $_POST['hsn_code'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $cess = $_POST['cess'];
    $tax_for = $_POST['tax_for'];

    $insert_hsn = "insert into taxes (hsn_code,tax_for,cgst,sgst,cess) 
    values ('$hsn_code','$tax_for','$cgst','$sgst','$cess')";

    $run_hsn = mysqli_query($con,$insert_hsn);

    if($run_hsn){

        echo "<script>alert('Your HSN Has Been Created')</script>";
        echo "<script>window.open('index.php?view_hsn','_self')</script>";

    }

}

?>

    <?php } ?>
