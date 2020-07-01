<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">CUSTOMERS</h2>
           </div>
</div>
<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> No: </th>
                                <th> User Name: </th>
                                <th> User Image: </th>
                                <th> User E-Mail: </th>
                                <th> User Country: </th>
                                <th> User Job: </th>
                                <th> User Contact: </th>
                                <th> Edit: </th>
                                <th> Delete: </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            
                            <?php 
          
                                $i=0;
                            
                                $get_users = "select * from admins";
                                
                                $run_users = mysqli_query($con,$get_users);
          
                                while($row_users=mysqli_fetch_array($run_users)){
                                    
                                    $user_id = $row_users['admin_id'];
                                    
                                    $user_name = $row_users['admin_name'];
                                    
                                    $user_img = $row_users['admin_image'];
                                    
                                    $user_email = $row_users['admin_email'];
                                    
                                    $user_country = $row_users['admin_country'];
                                    
                                    $user_job = $row_users['admin_job'];
                                    
                                    $user_contact = $row_users['admin_contact'];
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr><!-- tr begin -->
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $user_name; ?> </td>
                                <td> <img src="../admin_area/admin_images/<?php echo $user_img; ?>" width="60" height="60"></td>
                                <td> <?php echo $user_email; ?> </td>
                                <td> <?php echo $user_country; ?></td>
                                <td> <?php echo $user_job; ?> </td>
                                <td> <?php echo $user_contact ?> </td>
                                <td>    
                                     
                                     <a href="index.php?user_profile=<?php echo $user_id; ?>">
                                     
                                        <i class="fa fa-pencil"></i> Edit
                                    
                                     </a> 
                                     
                                </td>
                                <td> 
                                     
                                     <a href="index.php?delete_user=<?php echo $user_id; ?>">
                                     
                                        <i class="fa fa-trash-o"></i> Delete
                                    
                                     </a> 
                                     
                                </td>
                            </tr><!-- tr finish -->
                            
                            <?php } ?>
                            
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->

<?php } ?>