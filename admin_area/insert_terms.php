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
            <a href="index.php?view_terms" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Term Title </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="term_title" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Term Desc </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <textarea name="term_desc" cols="19" rows="6" class="form-control"></textarea>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="submit" value="Create Term" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->

<?php 

if(isset($_POST['submit'])){

    $term_title = $_POST['term_title'];
    $term_desc = $_POST['term_desc'];

    $insert_term = "insert into terms (term_title,term_desc) values ('$term_title','$term_desc')";

    $run_term = mysqli_query($con,$insert_term);

    if($run_term){

        echo "<script>alert('Your Term Has Been Created')</script>";
        echo "<script>window.open('index.php?view_terms','_self')</script>";

    }

}

?>

    <?php } ?>
