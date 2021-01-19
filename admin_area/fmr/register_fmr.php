<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

    $get_last_id = "SELECT * from fmr_users order by fmr_id desc limit 1";
    $run_last_id = mysqli_query($con,$get_last_id);
    $row_last_id = mysqli_fetch_array($run_last_id);

    $fmr_id = $row_last_id['fmr_id'];


?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">INSERT PRODUCT</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?fmr_member" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" >
       <input type="hidden" id="last_id" value="<?php echo $fmr_id+1; ?>">
        <div class="row">
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">FMR Name</label>
                <input type="text" class="form-control" id="fmr_name" name="fmr_name" placeholder="Enter Name" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">FMR Email</label>
                <input type="email" class="form-control" id="fmr_email" name="fmr_email" placeholder="Enter Email" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">FMR Contact</label>
                <input type="number" class="form-control" id="fmr_contact" name="fmr_contact" placeholder="Enter Contact" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">FMR Date of Birth(DOB)</label>
                <input type="date" class="form-control" id="fmr_dob" name="fmr_dob" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">FMR Qualification</label>
                    <select class="form-control" name="fmr_qualification" required>
                        <option value=''>Under Graduate</option>
                        <option value=''>Graduate</option>
                        <option value=''>Post Graduate</option>
                    </select>
                </div>
                </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Address</label>
                <input type="text" class="form-control" id="fmr_address" name="fmr_address" placeholder="Enter Address" required>
            </div>
            </div>
            <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label for="exampleFormControlInput1">City</label>
                <input type="text" class="form-control" id="fmr_city" name="fmr_city" placeholder="Enter City" required>
            </div>
            </div>
            <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label for="exampleFormControlInput1">State</label>
                <input type="text" class="form-control" id="fmr_state" name="fmr_state" placeholder="Enter State" required>
            </div>
            </div>
            <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label for="exampleFormControlInput1">Pincode</label>
                <input type="number" class="form-control" id="fmr_pincode" name="fmr_pincode" placeholder="Enter Pincode" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">PAN Number</label>
                <input type="text" class="form-control" id="fmr_pan_no" name="fmr_pan_no" placeholder="Enter PAN No." required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Addhar Number</label>
                <input type="number" class="form-control" id="fmr_addhar_no" name="fmr_addhar_no" placeholder="Enter Addhar Number" required>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="input-group mb-3">
                <input type="text" class="form-control text-white"  placeholder="GET FMR UNIQUE CODE HERE" id="get_fmr_id" name="fmr_unique_code" value="" aria-label="" aria-describedby="basic-addon2" readonly required>
                <div class="input-group-append p-0">
                    <button class="btn btn-outline-secondary m-0" id="generate_fmr_id" type="button">Genrate Id</button>
                </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <button class="btn-success btn-block btn-lg" type="submit" name="submit">Submit</button>
            </div>
        </div> 
       </form>


<?php 

if(isset($_POST['submit'])){

    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

    $pass = rand_string(6);
    $fmr_pass = password_hash($pass, PASSWORD_DEFAULT);
    date_default_timezone_set('Asia/Kolkata');
    $fmr_join_date = date("Y-m-d H:i:s");
    $fmr_name = $_POST['fmr_name'];
    $fmr_email = $_POST['fmr_email'];
    $fmr_contact = $_POST['fmr_contact'];
    $fmr_dob = $_POST['fmr_dob'];
    $fmr_qualification = $_POST['fmr_qualification'];
    $fmr_address = $_POST['fmr_address'];
    $fmr_city = $_POST['fmr_city'];
    $fmr_state = $_POST['fmr_state'];
    $fmr_pincode = $_POST['fmr_pincode'];
    $fmr_pan_no = $_POST['fmr_pan_no'];
    $fmr_addhar_no = $_POST['fmr_addhar_no'];
    $fmr_unique_code = $_POST['fmr_unique_code'];
    
    $insert_fmr = "insert into fmr_users (fmr_unique_code,
                                            fmr_name,
                                            fmr_email,
                                            fmr_pass,
                                            fmr_contact,
                                            fmr_dob,
                                            fmr_qualification,
                                            fmr_address,
                                            fmr_city,
                                            fmr_pincode,
                                            fmr_state,
                                            fmr_pan_no,
                                            fmr_addhar_no,
                                            fmr_join_date,
                                            fmr_status) 
                                    values ('$fmr_unique_code',
                                             '$fmr_name',
                                             '$fmr_email',
                                             '$fmr_pass',
                                             '$fmr_contact',
                                             '$fmr_dob',
                                             '$fmr_qualification',
                                             '$fmr_address',
                                             '$fmr_city',
                                             '$fmr_pincode',
                                             '$fmr_state',
                                             '$fmr_pan_no',
                                             '$fmr_addhar_no',
                                             '$fmr_join_date',
                                             'active')";
    
    $run_fmr = mysqli_query($con,$insert_fmr);
    
    if($run_fmr){

        $text1 = "Welcome%20to%20Karwars%20Online%20Supermarket%20Team%A0You%20are%20been%20registered%20as%20Field%20Marketing%20Execute%A0Below%20are%20Login%20Details%A0Username:$fmr_email%A0Password:$fmr_pass";
        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        // $url1="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=$c_contact&message=$text1";
        // $url2="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=7892916394&message=$text2";
        $url1 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text1&number=+91$c_contact";

        // create both cURL resources
        $ch1 = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the two handles
        curl_multi_add_handle($mh,$ch1);

        //execute the multi handle
        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        //close the handles
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_close($mh);
        
        echo "<script>alert('FMR Registration sucessful')</script>";
        echo "<script>window.open('index.php?fmr_member','_self')</script>";
        
    }else{

        echo "<script>alert('Registration Failed')</script>";
    }
    
}
?>

<?php 
} 
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="fmr/js/fmr.js"></script>