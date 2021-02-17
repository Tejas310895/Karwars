<?php 

    include("includes/header.php");


?>
<?php

        $get_call = "select * from cron_call";
        $run_call = mysqli_query($con,$get_call);
        while($row_call=mysqli_fetch_array($run_call)){

        $invoice_no = $row_call['invoice_no'];
        $status = $row_call['cron_call_status'];

        if($status==='false'){

        $get_waclient = "SELECT DISTINCT(client_id) FROM customer_orders WHERE invoice_no='$invoice_no'";
        $run_waclient = mysqli_query($con,$get_waclient);
        $rows = array();
        while($row_waclient=mysqli_fetch_array($run_waclient)){
        $waclient_id = $row_waclient['client_id'];
        
        $get_wacontact = "SELECT * from clients where client_id='$waclient_id'";
        $run_wacontact = mysqli_query($con,$get_wacontact);
        $row_wacontact = mysqli_fetch_array($run_wacontact);
        
        array_push($rows, $row_wacontact['client_phone']);
        
        // $waclient_phone = $row_wacontact['client_phone'];

        
        // $username = urlencode("r701");
        // $token = urlencode("oV426q");
        // $plan_id = urlencode("10221");
        // $announcement_id = urlencode("242413");
        // $caller_id = urlencode("12345");
        // $contact_numbers = urlencode("$waclient_phone");

        // $api = "http://103.255.100.37/api/voice/voice_broadcast.php?username=".$username."&token=".$token."&plan_id=".$plan_id."&announcement_id=".$announcement_id."&caller_id=".$caller_id."&contact_numbers=".$contact_numbers."";

        // $response = file_get_contents($api);

        }

        $string = implode(',' , $rows);

        $post_url = "http://103.255.100.37/api/voice/voice_broadcast.php";

        $ARR_POST_DATA = array();

        $ARR_POST_DATA['username'] = 'r701';
        $ARR_POST_DATA['token'] = "oV426q";
        $ARR_POST_DATA['announcement_id'] = "242413";
        $ARR_POST_DATA['plan_id'] = 10221;
        $ARR_POST_DATA['caller_id'] = "1234"; // optional
        $ARR_POST_DATA['contact_numbers'] = "$string"; // comma(,) seperated 

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $post_url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($ARR_POST_DATA));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl);
        // $arr_response = json_docode($response, true);
        // var_dump($arr_response);
        // curl_close($curl); 

        if($response){

        $update_call = "update cron_call set cron_call_status='true' where invoice_no='$invoice_no'";
        $run_update_call = mysqli_query($con,$update_call);

        }

        }

        }
?>

<?php 

    include("includes/footer.php");


?>