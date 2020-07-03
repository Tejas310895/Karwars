<?php 

    include("includes/header.php");

?>

<!-- fixed nav -->
    <div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" href="./">
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
                <li class="breadcrumb-item active" aria-current="page">Home</li>
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
            <input type="number"  minlength="10" maxlength="10" class="form-control" id="name" name="c_contact" aria-describedby="emailHelp" placeholder="Enter Number" required>
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" id="email" name="c_email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="pass" name="c_pass" placeholder="Password" required>
        </div>
        <button type="submit" name="register" class="btn btn-success btn-lg btn-block text-center">Register</button>
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

    $c_pass = password_hash($_POST['c_pass'], PASSWORD_DEFAULT);

    $c_ip = getRealIpUser();

    $user_id = getuserid();

    $get_count = "select * from customers where customer_email='$c_email'";

    $run_count = mysqli_query($con,$get_count);

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

    $insert_customer = "insert into customers (customer_name,customer_contact,customer_email,customer_pass,customer_ip) 
    values ('$c_name','$c_contact','$c_email','$c_pass','$c_ip')";

    $run_customer = mysqli_query($con,$insert_customer);

    $sel_cart = "select * from cart where ip_add='$c_ip'";

    $run_cart = mysqli_query($con,$sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    $get_c = "select * from customers where customer_email='$c_email'";

    $run_c = mysqli_query($con,$get_c);

    $row_c = mysqli_fetch_array($run_c);

    $cus_id = $row_c['customer_id'];

    $update_c_id = "update cart set user_id='$cus_id' where ip_add='$c_ip' AND user_id='$user_id'";

    $run_update_c_id = mysqli_query($con,$update_c_id);



    if($check_cart>0){

        //if customer register with items in cart//

        $_SESSION['customer_email']=$c_email;

        echo "<script>alert('You have Registered Sucessfully')</script>";

        echo "<script>window.open('cart','_self')</script>";

    }else{

        //if customer register without items in cart//

        $_SESSION['customer_email']=$c_email;

        echo "<script>alert('You have Registered Sucessfully')</script>";

        echo "<script>window.open('./','_self')</script>";

    }
    
    }else{

    echo "<script>alert('Email Already Registered, Please Login')</script>";

}

}


?>