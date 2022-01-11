<?php 

include("includes/db.php");

if(isset($_GET['update_order'])){

  date_default_timezone_set('Asia/Kolkata');
  $today = date("Y-m-d H:i:s");

  $update_order = $_GET['update_order'];

  $status = $_GET['status'];

  if($status==='Delivered'){

  $update_status_del = "UPDATE customer_orders SET order_status='$status',del_date='$today' WHERE invoice_no='$update_order'";
  $run_status_del = mysqli_query($con,$update_status_del);

  $update_discount = "UPDATE customer_discounts set discount_date='$today' where invoice_no='$update_order'";
  $run_update_discount = mysqli_query($con,$update_discount);

  $update_charges = "UPDATE order_charges set updated_date='$today' where invoice_id='$update_order'";
  $run_update_charges = mysqli_query($con,$update_charges);

    $get_order_stock = "select * from customer_orders where invoice_no='$update_order'";
    $run_order_stock = mysqli_query($con,$get_order_stock);
    while ($row_order_stock=mysqli_fetch_array($run_order_stock)) {
      $order_stock_pro = $row_order_stock['pro_id'];
      $order_stock_qty = $row_order_stock['qty'];

      $update_warehouse_stock = "update products set warehouse_stock=warehouse_stock-'$order_stock_qty' where product_id='$order_stock_pro'";
      $run_update_warehouse_stock = mysqli_query($con,$update_warehouse_stock);
    }

    echo "<script>alert('Status Updated')</script>";

    echo "<script>window.open('index.php?view_orders','_self')</script>";

  }

  if($status==='Packed'){

    $order_id = $update_order;

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_order_details = "select * from customer_orders where invoice_no='$order_id'";
    $run_order_details = mysqli_query($con,$get_order_details);
    $row_order_details = mysqli_fetch_array($run_order_details);

    $customer_id = $row_order_details['customer_id'];
    
    $get_customer = "select * from customers where customer_id='$customer_id'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $c_name = $row_customer['customer_name'];

    $c_email = $row_customer['customer_email'];

    $c_contact = $row_customer['customer_contact'];

    $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$order_id' and product_status='Deliver'";

    $run_total = mysqli_query($con,$get_total);

    $row_total = mysqli_fetch_array($run_total);

    $total = $row_total['total'];

    $get_discount = "select * from customer_discounts where invoice_no='$order_id'";
    $run_discount = mysqli_query($con,$get_discount);
    $row_discount = mysqli_fetch_array($run_discount);

    $coupon_code = $row_discount['coupon_code'];
    $discount_type = $row_discount['discount_type'];
    $discount_amount = $row_discount['discount_amount'];

    $get_del_charges = "select * from order_charges where invoice_id='$order_id'";
    $run_del_charges = mysqli_query($con,$get_del_charges);
    $row_del_charges = mysqli_fetch_array($run_del_charges);

    $del_charges = $row_del_charges['del_charges'];

    if($discount_type==='amount'){

        $grand_total = ($total+$del_charges)-$discount_amount;

    }elseif ($discount_type==='product') {

        $get_off_pro = "select * from products where product_id='$discount_amount'";
        $run_off_pro = mysqli_query($con,$get_off_pro);
        $row_off_pro = mysqli_fetch_array($run_off_pro);

        $off_product_price = $row_off_pro['product_price'];

        $grand_total = ($total+$del_charges)+$off_product_price;
        
    }elseif (empty($discount_type)) {

        $grand_total = $total+$del_charges;
        
    }

    $update_status_del = "UPDATE customer_orders SET order_status='$status',del_date='$today' WHERE invoice_no='$order_id'";
    $run_status_del = mysqli_query($con,$update_status_del);


    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.cashfree.com/api/v1/order/create',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('appId' => '4650665d5636e6e9464179340564',
                                'secretKey' => '209d3f7ab9e04a78cfdfa2ad2e97dd14541e18d3',
                                'orderId' => $order_id,
                                'orderAmount' => $grand_total,
                                'orderCurrency' => 'INR',
                                'orderNote' => 'Order Payment',
                                'customerEmail' => $c_email,
                                'customerName' => $c_name,
                                'customerPhone' => $c_contact,
                                'returnUrl' => 'https://karwars.in/admin_area/handleResponse.php',
                                'notifyUrl' => 'https://karwars.in/admin_area/handleResponse.php'),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);
    $pay_link = $result['paymentLink'];
    $status = $result['status'];
    // $reason = $result['reason'];

    if($status==='OK'){

        $long_url = $pay_link;
        $apiv4 = 'https://api-ssl.bitly.com/v4/bitlinks';
        $genericAccessToken = '54be5c94eb234cb15f17c7358d9437d57cc06dc9';

        $data = array(
            'long_url' => $long_url
        );
        $payload = json_encode($data);

        $header = array(
            'Authorization: Bearer ' . $genericAccessToken,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );

        $ch = curl_init($apiv4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $resultl = curl_exec($ch);

        $resulten = json_decode($resultl, true);

        $link = $resulten['link'];

    $insert_payment = "insert into payment_links (invoice_id,
                                                  payment_link,
                                                  created_at) 
                                                  values 
                                                  ('$order_id',
                                                   '$link',
                                                   '$today')";
    $run_insert_payment = mysqli_query($con,$insert_payment);

    if($run_insert_payment){

      //   $textp = "Below%20is%20the%20KARWARS%20GROCERY%20pay%20on%20delivery%20link%20for%20contactless%20delivery%20".$link;

      //   //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
      // //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
      // $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$textp&number=+91$c_contact";
      //  // Initialize a CURL session. 
      //  $ch = curl_init();  
       
      //  // Return Page contents. 
      //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
       
      //  //grab URL and pass it to the variable. 
      //  curl_setopt($ch, CURLOPT_URL, $url); 
       
      //  $result = curl_exec($ch);  

        echo "<script>alert('Link Generated')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    

    }
    }
  }


}

if(isset($_GET['cancel_order'])){

    $cancel_order = $_GET['cancel_order'];

    $get_id = "select * from customer_orders where invoice_no='$cancel_order'";

    $run_id = mysqli_query($con,$get_id);

    $row_id = mysqli_fetch_array($run_id);

    $c_id = $row_id['customer_id'];

    $get_contact = "select * from customers where customer_id='$c_id'";

    $run_contact = mysqli_query($con,$get_contact);

    $row_contact = mysqli_fetch_array($run_contact);

    $c_contact = $row_contact['customer_contact'];
  
    $update_status_del = "UPDATE customer_orders SET order_status='Cancelled',product_status='Undeliver' WHERE invoice_no='$cancel_order'";
  
    $run_status_del = mysqli_query($con,$update_status_del);
  
  
      echo "<script>alert('Order Cancelled')</script>";
  
      echo "<script>window.open('index.php?view_orders','_self')</script>";

      $text = "Your%20Order%20with%20Order%20Id%20$update_order%20is%20been%20Cancelled%20Call%207292916394%20For%20Support";

      //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
    //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
    $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
     // Initialize a CURL session. 
     $ch = curl_init();  
     
     // Return Page contents. 
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
     //grab URL and pass it to the variable. 
     curl_setopt($ch, CURLOPT_URL, $url); 
     
     $result = curl_exec($ch);   
  
  }

  if(isset($_GET['update_stock'])){

    $pro_id = $_GET['update_stock'];

    $stock = $_POST['stock'];
  
    $update_stock = "UPDATE products SET product_stock='$stock' WHERE product_id='$pro_id'";
  
    $run_update_stock = mysqli_query($con,$update_stock);
  
  
      echo "<script>alert('Stock Updated')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

  if(isset($_POST['add_city'])){

    $city_name = $_POST['city_name'];
  
    $insert_city = "insert into city (city_name) values ('$city_name')";
  
    $run_insert_city = mysqli_query($con,$insert_city);
  
  
      echo "<script>alert('City Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_POST['add_area'])){

    $city_id = $_POST['city_id'];

    $area_name = $_POST['area_name'];
  
    $insert_area = "insert into area (area_name,city_id) values ('$area_name','$city_id')";
  
    $run_insert_area = mysqli_query($con,$insert_area);
  
  
      echo "<script>alert('Area Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_POST['add_landmark'])){

    $area_id = $_POST['area_id'];

    $landmark_name = $_POST['landmark_name'];
  
    $insert_landmark = "insert into landmark (landmark_name,area_id) values ('$landmark_name','$area_id')";
  
    $run_insert_landmark = mysqli_query($con,$insert_landmark);
  
  
      echo "<script>alert('Landmark Added')</script>";
  
      echo "<script>window.open('index.php?view_area','_self')</script>";
  
  
  }

  if(isset($_GET['update_pos'])){

    $pro_id = $_GET['update_pos'];

    $position = $_POST['position'];

    $check_count = "SELECT * FROM products where store_id=(SELECT store_id FROM products WHERE product_id='$pro_id')";

    $run_check_count = mysqli_query($con,$check_count);

    $count = mysqli_num_rows($run_check_count);

    // $row_check_count = mysqli_fetch_array($run_check_count);

    // $store_id = $row_check_count['store_id'];


    if($position<=$count){

      $update_position = "UPDATE products SET product_position='$position' WHERE product_id='$pro_id'";

      $run_update_position = mysqli_query($con,$update_position);
  
      echo "<script>alert('Position Updated')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";

    }else{

      echo "<script>alert('Products less then position number')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
    }

  
  
  }


  if(isset($_GET['Y'])){

    $pro_id = $_GET['Y'];

    $update_visibility = "UPDATE products SET product_visibility='Y' WHERE product_id='$pro_id'";
  
    $run_update_visibility = mysqli_query($con,$update_visibility);
  
  
      echo "<script>alert('Product Visible')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

  if(isset($_GET['N'])){

    $pro_id = $_GET['N'];

    $update_visibility = "UPDATE products SET product_visibility='N' WHERE product_id='$pro_id'";
  
    $run_update_visibility = mysqli_query($con,$update_visibility);
  
  
      echo "<script>alert('Product Visible')</script>";
  
      echo "<script>window.open('index.php?view_products','_self')</script>";
  
  
  }

  if(isset($_GET['undeliver_order'])){

    $invoice_id = $_GET['undeliver_order'];

    $pro_id = $_GET['undelpro_id'];

    $update_undel = "update customer_orders set product_status='Undeliver' where invoice_no='$invoice_id' and pro_id='$pro_id'";

    $run_update_undel = mysqli_query($con,$update_undel);

    if($run_update_undel){
  
      echo "<script>alert('Order Updated')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";

    }else{

      echo "<script>alert('Try Again')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";


    }
  
  
  }

  if(isset($_GET['minus_order'])){

    $invoice_id = $_GET['minus_order'];

    $pro_id = $_GET['minuspro_id'];

    $pro_price = $_GET['minusper_pro'];

    $update_minus = "update customer_orders set qty=qty-1, due_amount=due_amount-'$pro_price' where invoice_no='$invoice_id' and pro_id='$pro_id'";

    $run_update_minus = mysqli_query($con,$update_minus);

    if($run_update_minus){
  
      echo "<script>alert('Order Updated')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";

    }else{

      echo "<script>alert('Try Again')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";


    }
  
  
  }

  if(isset($_GET['plus_order'])){

    $invoice_id = $_GET['plus_order'];

    $pro_id = $_GET['pluspro_id'];

    $pro_price = $_GET['plusper_pro'];

    $update_plus = "update customer_orders set qty=qty+1,due_amount=due_amount+'$pro_price' where invoice_no='$invoice_id' and pro_id='$pro_id'";

    $run_update_plus = mysqli_query($con,$update_plus);

    if($run_update_plus){
  
      echo "<script>alert('Add Updated')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";

    }else{

      echo "<script>alert('Try Again')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";


    }
  
  
  }

  if(isset($_GET['deliver_order'])){

    $invoice_id = $_GET['deliver_order'];

    $pro_id = $_GET['delpro_id'];

    $update_del = "update customer_orders set product_status='Deliver' where invoice_no='$invoice_id' and pro_id='$pro_id'";

    $run_update_del = mysqli_query($con,$update_del);

    if($run_update_del){
  
      echo "<script>alert('Order Updated')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";

    }else{

      echo "<script>alert('Try Again')</script>";
  
      echo "<script>window.open('index.php?confirm_order=$invoice_id','_self')</script>";


    }   
  }

  if(isset($_POST['bill_diff'])){

    $invoice_id = $_POST['bill_diff'];

    $diff_value = $_POST['bill_diff_value'];

    $client_id = $_POST['client_id'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $insert_bill_diff = "insert into bill_controller (client_id,
                                                      invoice_no,
                                                      bill_amount,
                                                      bill_controller_type,
                                                      updated_date) 
                                                      values 
                                                      ('$client_id',
                                                       '$invoice_id',
                                                       '$diff_value',
                                                       'value_diff',
                                                       '$today')";
    $run_insert_bill_diff = mysqli_query($con,$insert_bill_diff);

    if($run_insert_bill_diff){

      echo "<script>alert('bill Updated Successfully')</script>";
      echo "<script>window.open('index.php?view_orders','_self')</script>";

    }else{

      echo "<script>alert('bill Update Failed')</script>";
      echo "<script>window.open('index.php?view_orders','_self')</script>";
      
    }

  }

  if(isset($_POST['del_bill_diff'])){

    $invoice_id = $_POST['del_bill_diff'];

    $del_client_id = $_POST['del_client_id'];

    $del_bill_diff = "delete from bill_controller where invoice_no='$invoice_id' and client_id='$del_client_id'";
    $run_del_bill_diff = mysqli_query($con,$del_bill_diff);

    if($run_del_bill_diff){

      echo "<script>alert('bill deleted Successfully')</script>";
      echo "<script>window.open('index.php?view_orders','_self')</script>";

    }else{

      echo "<script>alert('bill delete Failed')</script>";
      echo "<script>window.open('index.php?view_orders','_self')</script>";
      
    }

  }

  if(isset($_GET['update_purchase'])){

    $purchase_invoice_id = $_GET['update_purchase'];

    $get_purchase_data = "select * from purchase_invoice_entry where purchase_invoice_id='$purchase_invoice_id'";
    $run_purchase_data = mysqli_query($con,$get_purchase_data);
    $row_purchase_data = mysqli_fetch_array($run_purchase_data);

    $product_array = $row_purchase_data['product_array'];

    $unserialize_array = unserialize($product_array);

    $arr_length = count($unserialize_array);

    for ($i=0; $i < $arr_length; $i++) {

      $product_pur_id = $unserialize_array[$i][0];
      $product_pur_qty = $unserialize_array[$i][1];
      $vendor_pur_price = $unserialize_array[$i][2];

      $vendor_pur_u_price = $vendor_pur_price/$product_pur_qty;

      $update_purchase_price = "update products set vendor_price='$vendor_pur_u_price',warehouse_stock='$product_pur_qty',product_stock='$product_pur_qty' where product_id='$product_pur_id'";
      $run_update_purchase_price = mysqli_query($con,$update_purchase_price);
      
    }

    if($run_update_purchase_price){
      $update_status = "update purchase_invoice_entry set stock_update_status='active' where purchase_invoice_id='$purchase_invoice_id'";
      $run_update_status = mysqli_query($con,$update_status);
      
      echo "<script>alert('Updated Successfully')</script>";
      echo "<script>window.open('index.php?purchase_invoice_entries','_self')</script>";
    }else {
      echo "<script>alert('Update Failed')</script>";
      echo "<script>window.open('index.php?purchase_invoice_entries','_self')</script>";
    }

    // var_dump($unserialize_array);

  }

  if(isset($_GET['settle_id'])){

    $settlement_id = $_GET['settle_id'];
    $set_status = $_GET['settle_status'];

    $update_status = "update del_settlements set settlement_status='$set_status' where settlement_id='$settlement_id'";
    $run_update_status = mysqli_query($con,$update_status);

    if($run_update_status){
      echo "<script>alert('Settlement Updated')</script>";
      echo "<script>window.open('index.php?del_settlement_sheet','_self')</script>";
    }else {
      echo "<script>alert('Update Failed')</script>";
      echo "<script>window.open('index.php?del_settlement_sheet','_self')</script>";
    }
  }

  if(isset($_POST['payment_submit'])){
    
    $purchase_invoice_id = $_POST['purchase_invoice_id'];
    $purchase_txn_type = $_POST['purchase_txn_type'];
    $purchase_ref_no = $_POST['purchase_ref_no'];

    $update_pur_pay = "update purchase_invoice_entry set purchase_txn_type='$purchase_txn_type',purchase_ref_no='$purchase_ref_no',payment_status='paid' where purchase_invoice_id='$purchase_invoice_id'";
    $run_update_pur_pay = mysqli_query($con,$update_pur_pay);

    if($run_update_pur_pay){
      echo "<script>alert('Payment Updated')</script>";
      echo "<script>window.open('index.php?purchase_invoice_entries','_self')</script>";
    }else {
      echo "<script>alert('Update Failed')</script>";
      echo "<script>window.open('index.php?purchase_invoice_entries','_self')</script>";
    }

  }

?>