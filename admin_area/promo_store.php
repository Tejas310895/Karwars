<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
        <div class="row">
            <div class="col-lg-12 col-md-12" id="promo_alerts">

            </div>
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PROMOTIONAL DISPLAY</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_orders" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <?php
       
       $get_promo = "select * from promo_products";
       $run_promo = mysqli_query($con,$get_promo);
       while($row_promo = mysqli_fetch_array($run_promo)){

        $promo_id = $row_promo['promo_id'];
        $promo_store_id = $row_promo['store_id'];

        $get_promo_store = "select * from store where store_id='$promo_store_id'";
        $run_promo_store = mysqli_query($con,$get_promo_store);
        $row_promo_store = mysqli_fetch_array($run_promo_store);

        $promo_store_title = $row_promo_store['store_title'];

       ?>
       <form action="stock_data.php" method="post">
            <div class="row mt-5">
                <div class="col-md-2 col-lg-2">
                    <button type="button" class="btn btn-primary">
                        Position <?php echo $promo_id; ?>
                    </button>
                </div>
                <input type="hidden" name="promo_id" value="<?php echo $promo_id; ?>">
                <div class="col-md-8 col-lg-8 mt-2">
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="store_id">
                        <option value="<?php echo $promo_store_id; ?>"><?php echo $promo_store_title; ?></option>
                        <?php
                            $get_store = "select * from store";
                            $run_store = mysqli_query($con,$get_store);
                            while($row_store=mysqli_fetch_array($run_store)){
                                $store_id = $row_store['store_id'];
                                $store_title = $row_store['store_title'];
                                echo "<option value='".$store_id."'>".$store_title."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2">
                    <button class="btn btn-success" name="add_promo">
                        Submit
                    </button>
                </div>
            </div>
        </form>
       <?php } ?>

<?php 
} 
?>
