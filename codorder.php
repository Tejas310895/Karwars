<?php

if(isset($_POST['c_id'])){

    $customer_id = $_POST['c_id'];

    $add_id = $_POST['add_id'];

    // $schedule_date = $_POST['schedule_date'];

    //$date = $_POST['date'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");
}

$get_contact = "select * from customers where customer_id='$customer_id'";

$run_contact = mysqli_query($con,$get_contact);

$row_contact = mysqli_fetch_array($run_contact);

$c_contact = $row_contact['customer_contact'];
$c_name = $row_contact['customer_name'];

$get_unique = "SELECT * from customer_orders order by order_id DESC LIMIT 1";

$run_unique = mysqli_query($con,$get_unique);

$row_unique = mysqli_fetch_array($run_unique);

$unique_num = $row_unique['order_id'];

$user_id = getuserid();

$status = "Order Placed";

$invoice_no = $unique_num.mt_rand();

$select_cart = "select * from cart where user_id='$user_id'";

$run_cart = mysqli_query($con,$select_cart);

while($row_cart = mysqli_fetch_array($run_cart)){

    $pro_id = $row_cart['p_id'];

    $pro_qty = $row_cart['qty'];

    $get_products = "select * from products where product_id='$pro_id'";

    $run_products = mysqli_query($con,$get_products);

    while($row_products = mysqli_fetch_array($run_products)){

        $sub_total = $row_products['product_price']*$pro_qty;
        $vendor_sub_total = $row_products['vendor_price']*$pro_qty;

        $client_id = $row_products['client_id'];

        $insert_customer_order = "insert into customer_orders (customer_id,add_id,pro_id,due_amount,vendor_due_amount,invoice_no,qty,order_date,del_date,order_schedule,order_status,product_status,client_id) 
        values ('$customer_id','$add_id',' $pro_id','$sub_total','$vendor_sub_total','$invoice_no','$pro_qty','$today','$today','$today','$status','Deliver','$client_id')";

        $run_customer_order = mysqli_query($con,$insert_customer_order);

        $delete_cart = "delete from cart where user_id='$user_id'";

        $run_delete = mysqli_query($con,$delete_cart);

        $update_stock = "UPDATE products SET product_stock=product_stock-'$pro_qty' WHERE product_id='$pro_id'";

        $run_update_stock = mysqli_query($con,$update_stock);

    }
}
    if($run_customer_order){

        if(isset($_POST['coupon_id'])){
        $coupon_id = $_POST['coupon_id'];

        $get_dis_total = "select sum(due_amount) as dis_total from customer_orders WHERE invoice_no='$invoice_no'";
        $run_dis_total = mysqli_query($con,$get_dis_total);
        $row_dis_total = mysqli_fetch_array($run_dis_total);

        $dis_total = $row_dis_total['dis_total'];

        $get_coupon_det = "select * from coupons where coupon_id='$coupon_id'";
        $run_coupon_det = mysqli_query($con,$get_coupon_det);
        $row_coupon_det = mysqli_fetch_array($run_coupon_det);

        $dis_coupon_code = $row_coupon_det['coupon_code'];
        $dis_coupon_type = $row_coupon_det['coupon_type'];

        $get_coupon_dis_req = "select * from coupon_controls where coupon_code='$dis_coupon_code'";
        $run_coupon_dis_req = mysqli_query($con,$get_coupon_dis_req);
        $row_coupon_dis_req = mysqli_fetch_array($run_coupon_dis_req);

        $dis_coupon_unit = $row_coupon_dis_req['coupon_unit'];
        $dis_coupon_use_id = $row_coupon_dis_req['coupon_use_id'];
        $dis_upto_limit = $row_coupon_dis_req['upto_limit'];

        if($dis_coupon_type==='percent'){
            $percent_off = round($dis_total * ($dis_coupon_unit/100));
            if($percent_off>$dis_upto_limit){
                $dis_amt = $dis_upto_limit;
            }else{
                $dis_amt = $percent_off;
            }
            $discount_type = 'amount';
        }elseif ($dis_coupon_type==='amount') {
            $dis_amt = $dis_coupon_unit;
            $discount_type = 'amount';
        }elseif ($dis_coupon_type==='product') {
            $dis_amt = $dis_coupon_use_id;
            $discount_type = 'product';
        }

         $insert_discount = "insert into customer_discounts (invoice_no,
                                                            customer_id,
                                                            coupon_code,
                                                            discount_type,
                                                            discount_amount,
                                                            discount_date) 
                                                            values 
                                                            ('$invoice_no',
                                                            '$customer_id',
                                                            '$dis_coupon_code',
                                                            '$discount_type',
                                                            '$dis_amt',
                                                            '$today')";
         $run_insert_discount = mysqli_query($con,$insert_discount);

         if($run_insert_discount){
            setcookie("promo", "", time() - 1);
         }
        }
        
    }

    if($run_customer_order){
        
        $get_del_total = "select sum(due_amount) as del_total from customer_orders WHERE invoice_no='$invoice_no'";
        $run_del_total = mysqli_query($con,$get_del_total);
        $row_del_total = mysqli_fetch_array($run_del_total);

        $del_total = $row_del_total['del_total'];

        $get_del_charges = "select * from admins";
        $run_del_charges = mysqli_query($con,$get_del_charges);
        $row_del_charges = mysqli_fetch_array($run_del_charges);

        $del_charges = $row_del_charges['del_charges'];

        if($del_total<499){
            $insert_del_charges = "insert into order_charges (invoice_id,del_charges,updated_date) values ('$invoice_no','$del_charges','$today')";
            $run_insert_del_charges = mysqli_query($con,$insert_del_charges);
        }
    }

    if($run_customer_order){

        $insert_call = "insert into cron_call (invoice_no,cron_call_status,updated_date) values ('$invoice_no','false','$today')";
        $run_insert_call = mysqli_query($con,$insert_call);     
    }

    if($run_customer_order){
        
        $key = "EALz6t0ZsHkQ9WPx";
        $senderid="VRNEAR";	$route= 1;
        
        $text1 = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20Call%207892916394%20For%20Support";
        $text2 = "New%20Order%20received%20on%20the%20portal";
        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        // $url1="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=$c_contact&message=$text1";
        // $url2="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=7892916394&message=$text2";
        $url1 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text1&number=+91$c_contact";
        $url2 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text2&number=+917892916394";
        // $url1 = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text1";
        // $url2 = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=7892916394&message=$text2";

        // create both cURL resources
        $ch1 = curl_init();
        $ch2 = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_URL, $url2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the two handles
        curl_multi_add_handle($mh,$ch1);
        curl_multi_add_handle($mh,$ch2);

        //execute the multi handle
        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        //close the handles
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_close($mh);

        echo "<script>alert('Order Placed, thanks')</script>";

        echo "<script>window.open('customer/order_success','_self')</script>";
        
    }else{
        echo "<script>alert('Order Failed, Try Again')</script>";
    
        echo "<script>window.history.go(-2)</script>";
    }
?>
