<div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" href="./">
                            <i style="font-size: 1.8rem;" class="fas fa-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-1">
                        <h5 class="cart_head">Log in</h5>
                    </li>
                </ul>
            <!-- nav -->

    <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-1">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </nav>
    <!-- breadcrumb -->

    </div>
<!-- login form -->
<div class="container">
        <form action="checkout" method="post" class="register_form">
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" id="email" name="c_email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="pass" name="c_pass" placeholder="Password" required>
        </div>
        <button name="login" class="btn btn-success btn-lg btn-block text-center">LOG IN</button>
        </form>
    </div>
<!-- login form -->

<div class="container px-5">
    <a href="./reset_password" class="btn btn-link text-center btn-block pt-2">Forgot Password</a>
    <h5 class=" text-center register_link mt-2">Not a Member?</h5>
    <a href="./customer_register" class="btn btnregister_link text-center btn-block p-0">Register Here</a>
</div>

<?php

    if(isset($_POST['login'])){

        $customer_email = $_POST['c_email'];
        
        $customer_pass = $_POST['c_pass'];

        $select_customer = "select * from customers where customer_email='$customer_email' ";

        $run_customer = mysqli_query($con,$select_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        $hashindb = $row_customer['customer_pass'];

        $customer_id = $row_customer['customer_id'];

        $get_ip = getRealIpUser();

        $user_id = getuserid();

        $check_customer = mysqli_num_rows($run_customer);

        $select_cart = "select * from cart where ip_add='$get_ip'";

        $run_cart = mysqli_query($con,$select_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if(!password_verify($customer_pass, $hashindb)){

            echo "<script>alert('your email or password id invalid')</script>";

            exit();

        }else{

            $update_c_id = "update cart set user_id='$customer_id' where ip_add='$get_ip' AND user_id='$user_id'";

            if($run_update_c_id = mysqli_query($con,$update_c_id)){

                $get_cart = "select DISTINCT p_id from cart where ip_add='$get_ip' AND user_id='$customer_id'";

                $run_cart = mysqli_query($con,$get_cart);

                while ($row_cart = mysqli_fetch_array($run_cart)){

                    $p_id = $row_cart['p_id'];

                    $count_cart = "select * from cart where p_id='$p_id' and ip_add='$get_ip' and user_id='$customer_id'";

                    $run_count_cart = mysqli_query($con,$count_cart);

                    $row_count_cart = mysqli_num_rows($run_count_cart);
                    
                    if($row_count_cart>1){

                        $delete_cart = "delete from cart where p_id='$p_id' and ip_add='$get_ip' and user_id='$customer_id' limit 1";

                        $run_delete_cart = mysqli_query($con,$delete_cart);

                    }

                }
            }
            

        if($check_cart==0){

            $_SESSION['customer_email']=$customer_email;

            echo "<script>alert('your are Logged in ')</script>";

            echo "<script>window.open('customer/my_account','_self')</script>";
            }else{

            $_SESSION['customer_email']=$customer_email;

            echo "<script>alert('your are Logged in ')</script>";

            echo "<script>window.open('cart','_self')</script>";


        }

    }

}

?>

