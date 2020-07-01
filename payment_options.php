<?php 

$session_email = $_SESSION['customer_email'];

?>

<?php 
          
          $get_customer_id = "select * from customers where customer_email='$session_email'";

          $run_customer_id = mysqli_query($con,$get_customer_id);

          $row_customer_id = mysqli_fetch_array($run_customer_id);

          $customer_id = $row_customer_id['customer_id'];
          
          
          ?>

<!-- fixed nav -->
    <div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" href="cart">
                            <i style="font-size: 1.8rem;" class="fas fa-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <h5 class="cart_head">Place Order</h5>
                    </li>
                </ul>
            <!-- nav -->

    </div>
<!-- fixed nav -->

<!-- Date Address -->

    <div class="container-fluid my-5">
        <div class="row bg-white p-5 rounded">


        <?php 
                
                $get_add_count = "select * from customer_address where customer_id='$customer_id'";

                $run_add_count = mysqli_query($con,$get_add_count);

                $count = mysqli_num_rows($run_add_count);
                
                ?>
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#inseradd" data-whatever="$add_id" style="display:<?php if($count>0){echo 'none';}else{echo 'block';} ?>;">ADD NEW ADDRESS</button>
                <form action="order.php" class="add_form" method="post" style="display:<?php if($count>0){echo 'block';}else{echo 'none';} ?>;">
                <input type="hidden" name="c_id" class="form-control" value="<?php echo $customer_id; ?>">
                <h5 class="add_head">Select Your Address</h5>
                <div class="form-group">
                    <select class="custom-select select_address" name='add_id'>
                    <?php
                    
                    $get_c_add = "select * from customer_address where customer_id='$customer_id'";

                    $run_c_add = mysqli_query($con,$get_c_add);

                    while($row_c_add=mysqli_fetch_array($run_c_add)){
                    
                        $add_id = $row_c_add['add_id'];

                        $customer_city = $row_c_add['customer_city'];

                        $customer_landmark = $row_c_add['customer_landmark'];

                        $customer_phase = $row_c_add['customer_phase'];

                        $customer_address = $row_c_add['customer_address'];

                        $add_type = $row_c_add['add_type'];

                    ?>
                        <option value="<?php echo $add_id; ?>">
                        <?php echo $add_type; ?> :- <?php echo $customer_address." ,".$customer_phase." ,".$customer_landmark." ,".$customer_city; ?>
                        </option>
                    <?php } ?>

                    </select>
                </div>
                <div class="form-group my-4">
                <h5 class="add_head my-3">Schedule your Delivery</h5>
                <input type="text" class="form-control select_address" name="date" id="datepicker" required>
                </div>
                <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="p_type" value="COD" checked>
                <label class="form-check-label cod_text" for="exampleRadios1">
                    Cash on Delivery
                </label>
                </div>
                <div class="form-check mb-0">
                <input class="form-check-input" type="radio" name="p_type"  value="PAYTM">
                <label class="form-check-label paytm_text" for="exampleRadios2">
                    Pay Online
                </label>
                </div>
            <button type="submit" class="btn btn-success btn-block add_head_btn fixed-bottom">Place Order</button>
        </form>
        </div>
    </div>


<!-- Date Address -->

 <!-- insertadd -->

    <div class="modal fade" id="inseradd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">ADD NEW ADDRESS</h5>
                </div>
                <div class="modal-body">
                    <form action="checkout.php" method="post" class="register_form mt-0">
                    <div class="form-group">
                        <label>City</label>
                        <select name="c_city" class="form-control" required>
                            <option>Mumbai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Landmark</label>
                        <select name="c_landmark" class="form-control" required>
                            <option>Palava City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phase</label>
                        <select name="c_phase" class="form-control" required>
                            <option>Casa Rio</option>
                            <option>Casa Rio Gold</option>
                            <option>Casa Bella</option>
                            <option>Casa Bella Gold</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" name="c_address" aria-describedby="emailHelp" placeholder="Enter Address" required>
                    </div>
                    <div class="form-group ">
                        <label>Address type</label>
                        <input type="text" class="form-control" id="ctype" name="add_type" aria-describedby="emailHelp" placeholder="Enter Address Type" required>
                    </div>
                    <button type="submit" name="insertadd" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <?php 

            if(isset($_POST['insertadd'])){

                $c_mail = $_SESSION['customer_email'];

                $c_city = $_POST['c_city'];

                $c_landmark = $_POST['c_landmark'];

                $c_phase = $_POST['c_phase'];

                $c_address = $_POST['c_address'];

                $add_type = $_POST['add_type'];
                
                $get_user_id = "select * from customers where customer_email='$c_mail'";

                $run_user_id = mysqli_query($con,$get_user_id);

                $row_user_id = mysqli_fetch_array($run_user_id);

                $user_c_id = $row_user_id['customer_id'];

                $insert_add = "insert into customer_address (customer_id,customer_city,customer_landmark,customer_phase,customer_address,add_type) 
                values ('$user_c_id','$c_city','$c_landmark','$c_phase','$c_address','$add_type')";

                $run_add = mysqli_query($con,$insert_add);


                if($insert_add){

                    echo "<script>alert('Address Updated')</script>";

                    echo "<script>window.open('checkout','_self')</script>";

                }else{

                    echo "<script>alert('Sorry Address not updated try again')</script>";

                    echo "<script>window.open('checkout','_self')</script>";

                }
                

            }

            ?>
<!-- insertadd -->



