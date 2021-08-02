<?php

		$get_txn = "select * from customer_orders where invoice_no=$invoice_no";

		$run_txn = mysqli_query($con,$get_txn);

		$count = mysqli_num_rows($run_txn);

		$row_txn = mysqli_fetch_array($run_txn);

		$c_id = $row_txn['customer_id'];

    $applicationId = '4650665d5636e6e9464179340564';

		if($count>0){

      $get_customer = "select * from customers where customer_id='$c_id'";

      $run_customer = mysqli_query($con,$get_customer);

      $row_customer = mysqli_fetch_array($run_customer);

      $c_name = $row_customer['customer_name'];

      $c_contact = $row_customer['customer_contact'];

      $c_email = $row_customer['customer_email'];

      $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_no' and product_status='Deliver'";

      $run_total = mysqli_query($con,$get_total);

      $row_total = mysqli_fetch_array($run_total);

      $total = $row_total['total'];

      $get_discount = "select * from customer_discounts where invoice_no='$invoice_no'";
      $run_discount = mysqli_query($con,$get_discount);
      $row_discount = mysqli_fetch_array($run_discount);

      $coupon_code = $row_discount['coupon_code'];
      $discount_type = $row_discount['discount_type'];
      $discount_amount = $row_discount['discount_amount'];

      $get_del_charges = "select * from order_charges where invoice_id='$invoice_no'";
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


	}else{


		echo "<script>alert('Payment Failed')</script>";

        echo "<script>window.open('customer/my_account','_self')</script>";
	}

?>
<?php 

$appId = "4650665d5636e6e9464179340564";
$orderId = $invoice_no;
$orderAmount = $grand_total;
$orderCurrency = "INR";
$orderNote = "Order Payment";
$customerName = $c_name;
$customerPhone = $c_contact;
$customerEmail = $c_email;
$returnUrl = "https://karwars.in/cashfree/response.php";
$notifyUrl = "https://karwars.in/cashfree/response.php";


?>
<!DOCTYPE html>
<html>
<head>
  <title>Cashfree - Signature Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body onload="document.frm1.submit()">


<?php 
$mode = "PROD"; //<------------ Change to TEST for test server, PROD for production

// extract($_POST);
  $secretKey = "209d3f7ab9e04a78cfdfa2ad2e97dd14541e18d3";
  $postData = array( 
  "appId" => $appId, 
  "orderId" => $orderId, 
  "orderAmount" => $orderAmount, 
  "orderCurrency" => $orderCurrency, 
  "orderNote" => $orderNote, 
  "customerName" => $customerName, 
  "customerPhone" => $customerPhone, 
  "customerEmail" => $customerEmail,
  "returnUrl" => $returnUrl, 
  "notifyUrl" => $notifyUrl,
);
ksort($postData);
$signatureData = "";
foreach ($postData as $key => $value){
    $signatureData .= $key.$value;
}
$signature = hash_hmac('sha256', $signatureData, $secretKey,true);
$signature = base64_encode($signature);

if ($mode == "PROD") {
  $url = "https://www.cashfree.com/checkout/post/submit";
} else {
  $url = "https://test.cashfree.com/billpay/checkout/post/submit";
}

?>
  <form action="<?php echo $url; ?>" name="frm1" method="post">
      <p>Please wait.......</p>
      <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
      <input type="hidden" name="orderNote" value='<?php echo $orderNote; ?>'/>
      <input type="hidden" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
      <input type="hidden" name="customerName" value='<?php echo $customerName; ?>'/>
      <input type="hidden" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
      <input type="hidden" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
      <input type="hidden" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
      <input type ="hidden" name="notifyUrl" value='<?php echo $notifyUrl; ?>'/>
      <input type ="hidden" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
      <input type="hidden" name="appId" value='<?php echo $appId; ?>'/>
      <input type="hidden" name="orderId" value='<?php echo $orderId; ?>'/>
  </form>
</body>
</html>
