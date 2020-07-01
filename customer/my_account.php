<?php


session_start();

    if(!isset($_SESSION['customer_email'])){

        echo "<script>window.open('../checkout.php','_self')</script>";

    }else{

    include("includes/db.php");
    include("functions/function.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Wernear Grocery</title>
    <!-- google font -->
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Jost' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Laila' rel='stylesheet'>
    <!-- google font -->
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
    <!-- bootstrap link -->
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <!-- swiper -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <!-- font-awesome -->
    <!-- styles -->
    <link rel="stylesheet" href="styles/style.css?version=2">
    <!-- styles -->
</head>
<body>

<!-- fixed nav -->
    <div class="container-fuild fixed-top">
                <!-- nav -->
                    <ul class="nav bg-white accounttop ">
                        <li class="nav-item">
                            <a class="nav-link" href="../">
                                <i style="font-size: 1.5rem;" class="fas fa-arrow-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <h5 class="account mt-2">My Account</h5>
                        </li>
                    </ul>
                <!-- nav -->

        <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pt-1">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Account</li>
                </ol>
            </nav>
        <!-- breadcrumb -->

    </div>
<!-- fixed nav -->

<!-- user details -->
    <div class="container-fluid account bg-white py-3">
        <div class="row">
            <div class="col-10 px-4">
                <?php 
                
                $c_email = $_SESSION['customer_email'];

                $get_user = "select * from customers where customer_email='$c_email'";

                $run_user = mysqli_query($con,$get_user);

                while($row_user=mysqli_fetch_array($run_user)){

                $c_name = $row_user['customer_name'];

                $c_contact = $row_user['customer_contact'];
                
                ?>
                <h5 class="user_name mt-1"><?php echo $c_name; ?></h5>
                <h5 class="user_number mb-0">+91 <?php echo $c_contact; ?></h5>

                
            </div>
            <div class="col-2">
            <button type="button" class="btn btn-insert_user " data-toggle="modal" data-target="#insertuser" data-whatever="$add_id"><i style="font-size:1.5rem; color:#999;" class="fas fa-user-edit"></i></button>
            </div>
        </div>
    </div>

    <!-- insertuser -->
        <div class="modal fade" id="insertuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">EDIT DETAILS</h5>
                    </div>
                    <div class="modal-body">
                        <form action="my_account.php" method="post" class="register_form">
                        <div class="form-group ">
                            <label>Full Name</label>
                            <input type="text" class="form-control" id="name" name="c_name" value="<?php echo $c_name; ?>" aria-describedby="emailHelp" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" id="name" name="c_contact" value="<?php echo $c_contact; ?>" aria-describedby="emailHelp" placeholder="Enter Number" required>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" id="email" name="c_email" value="<?php echo $c_email; ?>" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" id="pass" name="c_oldpass" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="pass" name="c_newpass" placeholder="Password" required>
                        </div>
                        <button type="submit" name="insertuser" class="btn btn-primary" >Update</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
                <?php } ?>

                <?php 

                if(isset($_POST['insertuser'])){

                    $c_mail = $_SESSION['customer_email'];

                    $c_name = $_POST['c_name'];

                    $c_contact = $_POST['c_contact'];

                    $c_email = $_POST['c_email'];

                    $c_oldpass = $_POST['c_oldpass'];

                    $c_newpass = password_hash($_POST['c_newpass'], PASSWORD_DEFAULT);
                    
                    $get_user_id = "select * from customers where customer_email='$c_mail'";

                    $run_user_id = mysqli_query($con,$get_user_id);

                    $row_user_id = mysqli_fetch_array($run_user_id);

                    $hashindb = $row_user_id['customer_pass'];


                    if(!password_verify($c_oldpass, $hashindb)){

                        
                        echo "<script>alert('Sorry, Your old password did not match')</script>";
      
                        echo "<script>window.open('my_account','_self')</script>";

                    }else{

                        $update_c_pass = "update customers set customer_name='$c_name',customer_contact='$c_contact',customer_email='$c_email',customer_pass='$c_newpass' where customer_email='$c_mail'";

                        $run_c_pass = mysqli_query($con,$update_c_pass);
                    
                        if($run_c_pass){
                    
                          echo "<script>alert('Your Password has been updated')</script>";
                    
                          echo "<script>window.open('../logout.php','_self')</script>";
                    
                        }

                    }
                    

                }

                ?>
    <!-- insertuser -->
<!-- user details -->

<!-- customer id -->

    <?php 

        $session_email = $_SESSION['customer_email'];

        $get_c_id = "select * from customers where customer_email='$session_email'";

        $run_c_id = mysqli_query($con,$get_c_id);

        $row_c_id = mysqli_fetch_array($run_c_id);

        $c_id = $row_c_id['customer_id'];

    ?>

<!-- customer id -->

<!-- user account my_orders -->
    <div class="accordion bg-white" id="accordionExample">
        <div class="card main_card">
            <button class="btn btn_order" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <div class="card-header order_header" id="headingOne">
                    <h5 class="mb-0 text-left order_head">My Orders</h5>
                </div>
            </button>
            <?php

            $get_min = "select * from admins";

            $run_min = mysqli_query($con,$get_min);

            $row_min = mysqli_fetch_array($run_min);

            $del_charges = $row_min['del_charges'];
            
            $get_invoice = "select distinct invoice_no from customer_orders where customer_id='$c_id' order by order_id DESC";

            $run_invoice = mysqli_query($con,$get_invoice);

            while($row_invoice = mysqli_fetch_array($run_invoice)){

            $invoice_id = $row_invoice['invoice_no'];

            $get_order_pro =  "select * from customer_orders where invoice_no='$invoice_id'";

            $run_order_pro = mysqli_query($con,$get_order_pro);

            $row_order_count = mysqli_num_rows($run_order_pro);

            $row_order_pro = mysqli_fetch_array($run_order_pro);

            $order_pro_id = $row_order_pro['pro_id'];

            $order_pro_qty = $row_order_pro['qty'];

            $order_del_date = $row_order_pro['del_date'];

            $order_date = $row_order_pro['order_date'];

            $order_status = $row_order_pro['order_status'];

            $get_order_sum = "SELECT sum(due_amount) AS order_sum FROM customer_orders WHERE invoice_no='$invoice_id'";

            $run_order_sum = mysqli_query($con,$get_order_sum);

            $row_order_sum = mysqli_fetch_array($run_order_sum);

            $order_sum = $row_order_sum['order_sum'];

            $get_txn = "select * from paytm where ORDERID='$invoice_id'";

            $run_txn = mysqli_query($con,$get_txn);

            $row_txn = mysqli_fetch_array($run_txn);

            $txn_status = $row_txn['STATUS'];

            ?>
            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body bg-white py-1">
                    <div class="card mb-2" style="max-width: 100%;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6"><h5 class="order_id">ID - <?php echo $invoice_id; ?></h5></div>
                                    <div class="col-6"><h5 class="order_status text-right"><?php echo $order_status; ?></h5></div>
                                </div>
                            </div>
                            <div class="card-body py-1">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="card-title mb-0"><?php echo $row_order_count; ?> Items</h5>
                                        <h4 class="card-title mb-0">₹ <?php echo  $order_sum+$del_charges; ?></h4>
                                        <p class="card-text mb-0  <?php if($txn_status==='TXN_SUCCESS'){echo 'text-success';}else{echo 'text-danger'; } ?>" style="font-size:0.7rem;font-weight:bold;">
                                        <?php 
                                        
                                            if($txn_status==='TXN_SUCCESS'){echo 'PAID ONLINE';}
                                            elseif($order_status==='Delivered'){echo 'PAID OFFLINE'; }
                                            elseif ($order_status==='Cancelled'){echo 'Cancelled';}
                                            elseif ($order_status==='Order Placed'){echo 'PAY CASH OR OFFLINE MODE';}
                                            elseif ($order_status==='Refunded'){echo 'REFUNDED';}
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2">
                                        <a href="order_view?invoice_no=<?php echo  $invoice_id; ?>" class="btn btn-success order_view py-0 mr-5" >View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div>
    <!-- order details modal -->
                <?php  }  ?>

    <!-- order details modal -->

<!-- user account my_orders -->

<!-- user account address -->
    <div class="accordion bg-white" id="accordionExample">
            <div class="card main_card">
                <button class="btn btn_add" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="card-header add_header" id="headingOne">
                        <h5 class="mb-0 text-left add_head">Address</h5>
                    </div>
                </button>
                 
                <?php 

                $c_mail = $_SESSION['customer_email'];
                
                $get_customer_id = "select * from customers where customer_email='$c_mail'";

                $run_customer_id = mysqli_query($con,$get_customer_id);

                $row_customer_id = mysqli_fetch_array($run_customer_id);

                $c_id = $row_customer_id['customer_id'];

                $get_address = "select * from customer_address where customer_id='$c_id'";

                $run_address = mysqli_query($con,$get_address);

                while($row_address=mysqli_fetch_array($run_address)){

                    $add_id = $row_address['add_id'];
                    
                    $customer_city = $row_address['customer_city'];

                    $customer_landmark = $row_address['customer_landmark'];

                    $customer_phase = $row_address['customer_phase'];

                    $customer_address = $row_address['customer_address'];

                    $add_type = $row_address['add_type'];
                
                ?>

            <div id="collapseTwo" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body bg-white py-1">
                    <div class="card mb-2" style="max-width: 100%;">
                            <div class="card-body py-1">
                                <div class="row py-0 my-0">
                                    <div class="col-9"><h5 class="add_title mt-2"><?php echo $add_type; ?></h5></div>
                                        <div class="col-3 mt-2 text-right">
                                            <a href="my_account?delete_address=<?php echo $add_id; ?>"><i style=" font-size:1.5rem; color:#999;" class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                  <p class="add_desc"><?php echo $customer_address."</br>".$customer_phase." ,".$customer_landmark." ,".$customer_city; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>

            <div id="collapseTwo" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body bg-white py-1">
                    <div class="card border-0 mb-2" style="max-width: 100%;">
                            <div class="card-body py-1">
                            <button type="button" class="btn btn-insert_add btn-block" data-toggle="modal" data-target="#inseradd" data-whatever="$add_id">ADD NEW ADDRESS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- insertadd -->

            <div class="modal fade" id="inseradd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">ADD NEW ADDRESS</h5>
                </div>
                <div class="modal-body">
                    <form action="my_account" method="post" class="register_form">
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

                    echo "<script>window.open('my_account','_self')</script>";

                }else{

                    echo "<script>alert('Sorry Address not updated try again')</script>";

                    echo "<script>window.open('my_account.php','_self')</script>";

                }
                

            }

            ?>
    <!-- insertadd -->

<!-- user account address -->

<!-- user account support -->
    <div class="accordion bg-white" id="accordionExample">
            <div class="card main_card">
                <button class="btn btn_add" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <div class="card-header add_header" id="headingOne">
                        <h5 class="mb-0 text-left add_head">Support</h5>
                    </div>
                </button>
            <div id="collapseThree" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body py-1">
                    <div class="card sup_body mb-2" style="max-width: 100%;">
                            <div class="card-body py-1">
                                <a href="tel:9867765397"><h5 class="sup_title mt-2">+91 9867765397</h5></a>
                                <a href="mailto:tshirsat700@gmail.com"><p class="sup_desc mb-0">tshirsat700@gmail.com</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- user account support -->

<!-- user account trems -->
    <div class="accordion bg-white" id="accordionExample">
            <div class="card main_card">
                <button class="btn btn_add" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                    <div class="card-header add_header" id="headingOne">
                        <h5 class="mb-0 text-left add_head">Terms & Policies</h5>
                    </div>
                </button>
            <div id="collapsefour" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body py-1">
                    <div class="card mb-2 trm_body" style="max-width:100%;">
                            <div class="card-body py-1">
                                <?php 
                                
                                $get_terms = "select * from terms";

                                $run_terms = mysqli_query($con,$get_terms);

                                while($row_terms = mysqli_fetch_array($run_terms)){

                                    $term_title = $row_terms['term_title'];

                                    $term_desc = $row_terms['term_desc'];
                                
                                ?>
                                <h5 class="trm_title mt-2"><?php echo $term_title; ?></h5>
                                <p class="trm_desc mb-0"><?php echo $term_desc; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- user account trems -->

<!-- user account logout -->
    <div class="accordion bg-white" id="accordionExample">
            <div class="card main_card">
                <button class="btn btn_add" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                    <div class="card-header lgout_header" id="headingOne">
                        <h5 class="mb-0 text-left add_head">Logout</h5>
                    </div>
                </button>
                    <div id="collapsefive" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body py-1">
                        <div class="row pb-2">
                            <div class="col-12"><h5 class="lg_title text-center">Are You Sure? </h5></div>
                            <div class="col-6"><a href="my_account.php" class="btn btn-success text-white pull-right">No</a></div>
                            <div class="col-6"><a href="logout.php" class="btn btn-danger text-white pull-left">Yes</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- user account logout -->

<?php

include("includes/footer.php");

?>

<?php 

}

?>

