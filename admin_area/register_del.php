<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

$get_last_count = "select * from delivery_partner order by delivery_partner_id desc limit 1";
$run_last_count = mysqli_query($con,$get_last_count);
$row_last_count = mysqli_fetch_array($run_last_count);

$last_count = $row_last_count['delivery_partner_id'];


?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Register Delivery Executive</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?del_executive" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Delivery Executive Name</label>
                    <input type="text" class="form-control" id="del_name" name="del_name" placeholder="Enter Name" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Delivery Executive Email</label>
                    <input type="email" class="form-control" id="del_email" name="del_email" placeholder="Enter Email" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Delivery Executive Contact</label>
                    <input type="number" class="form-control" id="del_contact" name="del_contact" placeholder="Enter Contact" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="form-group mb-3">
                <input type="text" class="form-control text-white"  value="DEL-<?php echo $last_count+1; ?>" id="del_code" name="del_code" value="" aria-label="" aria-describedby="basic-addon2" readonly required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <button class="btn-success btn-block btn-lg" type="submit" name="submit">Submit</button>
            </div>
        </div> 
       </form>


<?php 

if(isset($_POST['submit'])){

    // function rand_string( $length ) {

    //     $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    //     return substr(str_shuffle($chars),0,$length);
        
    //     }

    $pass = 'DEL123';
    $del_pass = password_hash($pass, PASSWORD_DEFAULT);
    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");
    $del_name = $_POST['del_name'];
    $del_email = $_POST['del_email'];
    $del_contact = $_POST['del_contact'];
    $del_code = $_POST['del_code'];

    $get_email_check = "select * from delivery_partner where delivery_partner_email='$del_email'";
    $run_email_check = mysqli_query($con,$get_email_check);
    $email_check = mysqli_num_rows($run_email_check);

    if($email_check<=0){
    
    $insert_del = "insert into delivery_partner (delivery_partner_code,
                                                delivery_partner_name,
                                                delivery_partner_email,
                                                delivery_partner_contact,
                                                delivery_partner_pass,
                                                delivery_partner_date) 
                                                values ('$del_code',
                                                        '$del_name',
                                                        '$del_email',
                                                        '$del_contact',
                                                        '$del_pass',
                                                        '$today')";
    
    $run_del = mysqli_query($con,$insert_del);
    
    if($run_del){

        $text = "Welcome%20to%20Karwars%20Online%20Supermarket%20Team%A0You%20are%20been%20registered%20as%20Field%20Marketing%20Execute%A0Below%20are%20Login%20Details%A0Username:$del_email%A0Password:$pass";

        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
        $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$del_contact";
        // Initialize a CURL session. 
        $ch = curl_init();  
        
        // Return Page contents. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
        //grab URL and pass it to the variable. 
        curl_setopt($ch, CURLOPT_URL, $url); 
        
        $result = curl_exec($ch);
        
        echo "<script>alert('Delivery Executive Registration sucessful')</script>";
        echo "<script>window.open('index.php?del_executive','_self')</script>";
    }else{
        echo "<script>alert('Registration Failed')</script>";
    }

    }else {
        echo "<script>alert('Dublicate Email Entry Try Different Email')</script>";
    }
    
}
?>

<?php 
} 
?>
