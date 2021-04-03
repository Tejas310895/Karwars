<?php 

    ob_start();
    include("includes/header.php");

?>

<!-- fixed nav -->
    <div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" onClick="window.history.back()">
                            <i style="font-size: 1.8rem;" class="fas fa-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-1">
                        <h5 class="cart_head">Register</h5>
                    </li>
                </ul>
            <!-- nav -->

    <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-1">
                <li class="breadcrumb-item active" aria-current="page"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </nav>
    <!-- breadcrumb -->

    </div>
<!-- fixed nav -->
<!-- onKeyPress="if(this.value.length==10) return false;" -->
<!-- register form -->
    <div class="container">
        <form action="customer_register.php" method="post" enctype="multipart/form-data" class="register_form">
        <div class="form-group ">
            <label>Full Name</label>
            <input type="text" class="form-control" id="name" name="c_name" aria-describedby="emailHelp" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label>Mobile No.</label>
            <div class='input-group'>
                <input type="number"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control" id="c_contact" name="c_contact" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required >
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button" id="send_otp">Send OTP</button>
                    <button class="btn btn-sm btn-primary d-none" type="button" id="change_no">Change</button>
                </div>
            </div>
            <div class="input-group mt-1 d-none" id="otp_input">
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" class="form-control py-1" name="c_otp" id="c_otp" placeholder="Enter OTP" aria-label="Recipient's username" required>
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="button" id="otp_verify">Verify</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" id="c_email" name="c_email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <div class='alert alert-danger d-none email_alert mb-0 py-0' role='alert'>
                Email Aready Exist!Try Another
            </div>
        </div>
        <div class="form-check mb-3 ml-2">
            <input type="checkbox" class="form-check-input referal" id="fmr_check">
            <label class="form-check-label ml-2" for="exampleCheck1"><h5>I have a referal code</h5></label>
        </div>
        <div class="input-group mb-3 d-none" id="fmr_code">
            <input type="text" class="form-control text-uppercase" id="fmr_code_input" name="fmr_code" placeholder="Enter Referal Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text text-danger bg-white" id="check_fmr_code"><i class="fas fa-times"></i></span>
            </div>
        </div>
        <button type="submit" name="register" id="customer_register" class="btn btn-success btn-lg btn-block text-center">Register</button>
        </form>
    </div>
<!-- register form -->

<?php 

include("includes/footer.php");

?>

<?php 

if(isset($_POST['register'])){

    $c_name = $_POST['c_name'];

    $c_contact = $_POST['c_contact'];

    $c_email = $_POST['c_email'];

    //$c_ip = getRealIpUser();

    $user_id = getuserid();

    $get_count = "select * from customers where customer_email='$c_email'";

    $run_count = mysqli_query($con,$get_count);

    $row_count = mysqli_fetch_array($run_count);

    $customer_con = $row_count['customer_contact'];

    $count = mysqli_num_rows($run_count);

    if($count<1){


     //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
    $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=Thank%20You%20for%20Registration";
    // Initialize a CURL session. 
    $ch = curl_init();  
    
    // Return Page contents. 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    
    //grab URL and pass it to the variable. 
    curl_setopt($ch, CURLOPT_URL, $url); 
    
    $result = curl_exec($ch);

    $insert_customer = "insert into customers (customer_name,customer_contact,customer_email,updated_date) 
    values ('$c_name','$c_contact','$c_email',NOW())";

    $run_customer = mysqli_query($con,$insert_customer);

    $sel_cart = "select * from cart where user_id='$user_id'";

    $run_cart = mysqli_query($con,$sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    $get_c = "select * from customers where customer_email='$c_email'";

    $run_c = mysqli_query($con,$get_c);

    $row_c = mysqli_fetch_array($run_c);

    $cus_id = $row_c['customer_id'];

    $update_c_id = "update cart set user_id='$cus_id' where user_id='$user_id'";

    $run_update_c_id = mysqli_query($con,$update_c_id);

    if(isset($_POST['fmr_code'])){

        $fmr_code = $_POST['fmr_code'];

        $get_fmr_id = "select * from fmr_users where fmr_unique_code='$fmr_code'";
        $run_fmr_id = mysqli_query($con,$get_fmr_id);
        $row_fmr_id = mysqli_fetch_array($run_fmr_id);

        $fmr_id =  $row_fmr_id['fmr_id'];

        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d H:i:s");

        $insert_referal = "insert into fmr_clients (fmr_id,customer_id,updated_date) values ('$fmr_id','$cus_id','$today')";
        $run_referal = mysqli_query($con,$insert_referal);
    }


    if($check_cart>0){

        //if customer register with items in cart//

        // $_SESSION['customer_email']=$c_email;

        $get_cust = "select * from customers where customer_contact='$c_contact'";

        $run_cust = mysqli_query($con,$get_cust);

        $row_cust = mysqli_fetch_array($run_cust);

        $cust_id = $row_c['customer_id'];


        setcookie("user", $cust_id, time()+31556926);  /* expire in 1 hour */

        echo "<script>alert('You have Registered Sucessfully')</script>";

        echo "<script>window.history.go(-3)</script>";

    }else{

        //if customer register without items in cart//

        // $_SESSION['customer_email']=$c_email;

        $get_cust = "select * from customers where customer_contact='$c_contact'";

        $run_cust = mysqli_query($con,$get_cust);

        $row_cust = mysqli_fetch_array($run_cust);

        $cust_id = $row_c['customer_id'];

        setcookie("user", $cust_id, time()+31556926);  /* expire in 1 hour */

        echo "<script>alert('You have Registered Sucessfully')</script>";

        echo "<script>window.history.go(-3)</script>";

    }
    
    }else{

    echo "<script>alert('Email or Number Already Registered, Please Login')</script>";

}

}


?>
<?php ob_end_flush(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="admin_area/fmr/js/fmr.js?v=4"></script>