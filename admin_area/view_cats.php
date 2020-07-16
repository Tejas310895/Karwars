<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">CATEGORY (20)</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_cat" class="btn btn-success pull-right">NEW CATEGORY</a>
           </div>
       </div>

<div class="row">
<table class="table">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Category Name</th>
            <th>Image</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
            <?php
            
            $get_cat = "select * from categories";

            $run_cat = mysqli_query($con,$get_cat);

            $counter = 0;

            while($row_cat=mysqli_fetch_array($run_cat)){

                $cat_id = $row_cat['cat_id'];

                $cat_title = $row_cat['cat_title'];
                
                $cat_image = $row_cat['cat_image'];
            
            ?>
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td><?php echo $cat_title; ?></td>
            <td>
                <img src="<?php echo $cat_image; ?>" alt="" class="img-thumbnail" width="60px">
            </td>
            <td class="td-actions text-right">
                <a href="index.php?edit_cat=<?php echo $cat_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                    <i class="tim-icons icon-settings"></i>
                </a>
                <a  href="index.php?delete_cat=<?php echo $cat_id; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="tim-icons icon-simple-remove"></i>
                </a>
            </td>
        </tr>
            <?php } ?>
    </tbody>
</table>
</div>


<?php } ?>