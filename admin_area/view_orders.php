<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>

       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PRODUCTS (<?php echo $count_products; ?>)</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_product" class="btn btn-success pull-right">NEW PRODUCT</a>
           </div>
       </div>
       <div class="row">
       <table class="table table-fixed">
            <thead class="fixed-head">
                <tr class="text-center">
                    <th>Pro Id</th>
                    <th>Category</th> 
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Positions</th>
                    <th>Visiblity</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            $get_product = "select * from products order by product_id DESC";

            $run_product = mysqli_query($con,$get_product);

            $counter = 0;

            while($row_product=mysqli_fetch_array($run_product)){

                $product_id = $row_product['product_id'];

                $product_title = $row_product['product_title'];

                $product_img1 = $row_product['product_img1'];

                $product_desc = $row_product['product_desc'];

                $product_price = $row_product['product_price'];

                $product_stock = $row_product['product_stock'];

                $product_position = $row_product['product_position'];

                $product_visibility = $row_product['product_visibility'];

                $store_id = $row_product['store_id'];

                $get_store = "select * from store where store_id='$store_id'";

                $run_store = mysqli_query($con,$get_store);

                $row_store = mysqli_fetch_array($run_store);

                $store_title = $row_store['store_title'];
            
            ?>
                <tr class="text-center">
                    <td ><?php echo ++$counter; ?></td>
                    <td ><?php echo $store_title; ?></td>
                    <td>
                        <img src="product_images/<?php echo $product_img1; ?>" alt="" class="img-thumbnail border-0" width="60px">
                    </td>
                    <td><?php echo $product_title; ?></td>
                    <td><?php echo $product_desc; ?></td>
                    <td>&#8377; <?php echo $product_price; ?></td>
                    <td>
                        <form action="process_order.php?update_stock=<?php echo $product_id; ?>" class="form-group" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="stock" value="<?php echo $product_stock; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-md btn-icon" type="submit"><i class="tim-icons icon-refresh-02"></i></button>
                            </div>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="process_order.php?update_pos=<?php echo $product_id; ?>" class="form-group" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="position" value="<?php echo $product_position; ?>" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-md btn-icon" type="submit"><i class="tim-icons icon-refresh-02"></i></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>
                      <div class="form-group">
                            <a href="process_order.php?Y=<?php echo $product_id; ?>" class="btn btn-success <?php if($product_visibility=='Y'){echo"d-none";}else{echo"show";} ?>">Show</a>
                            <a href="process_order.php?N=<?php echo $product_id; ?>" class="btn btn-danger <?php if($product_visibility=='N'){echo"d-none";}else{echo"show";} ?>">Hide</a>
                      </div>
                    </td>
                    <td class="td-actions text-center">
                        <a  href="index.php?edit_product=<?php echo $product_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                            <i class="tim-icons icon-settings"></i>
                        </a>
                        <!-- <a href="index.php?delete_product=<?php //echo $product_id; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                            <i class="tim-icons icon-simple-remove"></i>
                        </a> -->
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
       </div>

    <?php } ?>

    