<?php 

session_start();
ob_start();
include("includes/db.php");
include("functions/function.php");

?>

<?php 

if(isset($_POST['send_otp'])){
    $c_contact = $_POST['send_otp'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    function rand_string( $length ) {

        $chars = "0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

        $get_check_unique = "select * from customers where customer_contact='$c_contact'";
        $run_check_unique = mysqli_query($con,$get_check_unique);
        $check_unique = mysqli_num_rows($run_check_unique);

        if($check_unique===0){

            $c_otp = rand_string(4);

            $insert_otp = "insert into otp_verefication (contact_no,verification_otp,updated_date) values ('$c_contact','$c_otp','$today')";
            $run_insert_otp = mysqli_query($con,$insert_otp);

            if($insert_otp){

                $key = "EALz6t0ZsHkQ9WPx";
                $senderid="VRNEAR";	$route= 1;
                $text = "$c_otp%20is%20your%20one%20time%20password%20and%20it%20is%20valid%20for%20the%20next%2015%20mins.%20Please%20do%20not%20share%20this%20OTP%20with%20anyone.%20Thank%20you,%20Karwars%20Onine%20Supermarket.";

                //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
                //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
                $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
                // $url = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text";

                // Initialize a CURL session.
                $ch = curl_init();  
                
                // Return Page contents. 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
                //grab URL and pass it to the variable. 
                curl_setopt($ch, CURLOPT_URL, $url); 
                
                $result = curl_exec($ch);

                echo 1;
            }
        }else{
            echo 2;
        }
}

if(isset($_POST['otp_verify'])){
    $otp_verify = $_POST['otp_verify'];

    $check_otp = "select * from otp_verefication where verification_otp='$otp_verify' order by verification_id desc limit 1";
    $run_check_otp = mysqli_query($con,$check_otp);
    $check_otp_count = mysqli_num_rows($run_check_otp);

    if($check_otp_count==1){

        $delete_otp = "delete from otp_verefication where verification_otp='$otp_verify'";
        $run_delete_otp = mysqli_query($con,$delete_otp);

        echo 1;
    }
}

if(isset($_POST['cust_email'])){

    $customer_email = $_POST['cust_email'];

    $get_cust_count = "select * from customers where customer_email='$customer_email'";
    $run_cust_count = mysqli_query($con,$get_cust_count); 
    $check_email = mysqli_num_rows($run_cust_count);

    if(!$check_email==0){
        echo 1;
    }
}

/* customer login */

if(isset($_POST['send_log_otp'])){
    $c_contact = $_POST['send_log_otp'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    function rand_string( $length ) {

        $chars = "0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

        $get_check_unique = "select * from customers where customer_contact='$c_contact'";
        $run_check_unique = mysqli_query($con,$get_check_unique);
        $check_unique = mysqli_num_rows($run_check_unique);

        if($check_unique===1){

            $c_otp = rand_string(4);

            $insert_otp = "insert into otp_verefication (contact_no,verification_otp,updated_date) values ('$c_contact','$c_otp','$today')";
            $run_insert_otp = mysqli_query($con,$insert_otp);

            if($insert_otp){

                $key = "EALz6t0ZsHkQ9WPx";
                $senderid="VRNEAR";	$route= 1;
                $text = "$c_otp%20is%20your%20one%20time%20password%20and%20it%20is%20valid%20for%20the%20next%2015%20mins.%20Please%20do%20not%20share%20this%20OTP%20with%20anyone.%20Thank%20you,%20Karwars%20Onine%20Supermarket.";

                //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
                //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
                $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
                // $url = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text";

                // Initialize a CURL session.
                $ch = curl_init();  
                
                // Return Page contents. 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
                //grab URL and pass it to the variable. 
                curl_setopt($ch, CURLOPT_URL, $url); 
                
                $result = curl_exec($ch);

                echo 1;
            }
        }else{
            echo 2;
        }
}

if(isset($_POST['otp_log_verify']) && isset($_POST['c_log_verify'])){
    $otp_verify = $_POST['otp_log_verify'];
    $contact_verify = $_POST['c_log_verify'];

    $check_otp = "select * from otp_verefication where verification_otp='$otp_verify' order by verification_id desc limit 1";
    $run_check_otp = mysqli_query($con,$check_otp);
    $check_otp_count = mysqli_num_rows($run_check_otp);

    if($check_otp_count==1){

        $delete_otp = "delete from otp_verefication where verification_otp='$otp_verify'";
        $run_delete_otp = mysqli_query($con,$delete_otp);

        $user_id = getuserid();

        $select_cart = "select * from cart where user_id='$user_id'";

        $run_cart = mysqli_query($con,$select_cart);

        $check_cart = mysqli_num_rows($run_cart);

        $select_customer = "select * from customers where customer_contact='$contact_verify' ";

        $run_customer = mysqli_query($con,$select_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        $customer_id = $row_customer['customer_id'];
        

        $update_c_id = "update cart set user_id='$customer_id' where user_id='$user_id'";

            if($run_update_c_id = mysqli_query($con,$update_c_id)){

                $get_cart = "select DISTINCT p_id from cart where user_id='$customer_id'";

                $run_cart = mysqli_query($con,$get_cart);

                while ($row_cart = mysqli_fetch_array($run_cart)){

                    $p_id = $row_cart['p_id'];

                    $count_cart = "select * from cart where p_id='$p_id' and user_id='$customer_id'";

                    $run_count_cart = mysqli_query($con,$count_cart);

                    $row_count_cart = mysqli_num_rows($run_count_cart);
                    
                    if($row_count_cart>1){

                        $delete_cart = "delete from cart where p_id='$p_id' and user_id='$customer_id' limit 1";

                        $run_delete_cart = mysqli_query($con,$delete_cart);

                    }

                }
            }

            if($check_cart==0){

                // $_SESSION['customer_email']=$customer_email;
                
                setcookie("user", $customer_id, time()+31556926);  /* expire in 1 hour */

                echo 1;
                
                }else{
    
                // $_SESSION['customer_email']=$customer_email;
    
                setcookie("user", $customer_id, time()+31556926);  /* expire in 1 hour */

                echo 1;
    
            }
    }
}

?>
<?php ob_end_flush(); ?>