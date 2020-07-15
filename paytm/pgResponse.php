<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include("../includes/db.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
			$CURRENCY = $_POST['CURRENCY'];
			$GATEWAYNAME = $_POST['GATEWAYNAME'];
			$RESPMSG = $_POST['RESPMSG'];
			$BANKNAME = $_POST['BANKNAME'];
			$PAYMENTMODE = $_POST['PAYMENTMODE'];
			$MID = $_POST['MID'];
			$RESPCODE = $_POST['RESPCODE'];
			$TXNID = $_POST['TXNID'];
			$TXNAMOUNT = $_POST['TXNAMOUNT'];
			$ORDERID = $_POST['ORDERID'];
			$STATUS = $_POST['STATUS'];
			$BANKTXNID = $_POST['BANKTXNID'];
			$TXNDATE = $_POST['TXNDATE'];
			$CHECKSUMHASH = $_POST['CHECKSUMHASH'];

			$insert_customer_order = "insert into paytm (CURRENCY,GATEWAYNAME,RESPMSG,BANKNAME,PAYMENTMODE,MID,RESPCODE,TXNID,TXNAMOUNT,ORDERID,STATUS,BANKTXNID,TXNDATE,CHECKSUMHASH) 
			values ('$CURRENCY','$GATEWAYNAME','$RESPMSG','$BANKNAME','$PAYMENTMODE','$MID','$RESPCODE','$TXNID','$TXNAMOUNT','$ORDERID','$STATUS','$BANKTXNID','$TXNDATE','$CHECKSUMHASH')";

				$get_customer = "select * from customer_orders where invoice_no='$ORDERID'";

				$run_customer = mysqli_query($con,$get_customer);

				$row_customer = mysqli_fetch_array($run_customer);

				$customer_id = $row_customer['customer_id'];

				$get_contact = "select * from customers where customer_id='$customer_id'";

				$run_contact = mysqli_query($con,$get_contact);

				$row_contact = mysqli_fetch_array($run_contact);

				$c_contact = $row_contact['customer_contact'];

				if($run_insert = mysqli_query($con,$insert_customer_order)){

				//$text = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20click%20here%20to%20View%20Details%20:-%20http://www.wernear.in/customer/order_view?invoice_no=$invoice_no";

				$textd = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20click%20here%20to%20View%20Details%20:-%20http://www.wernear.in/customer/order_view?invoice_no=$ORDERID%0APayment%20Successful%20of%20-%20$TXNAMOUNT";

				//echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
				$url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$textd";
				// Initialize a CURL session. 
				$ch = curl_init();  
				
				// Return Page contents. 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				
				//grab URL and pass it to the variable. 
				curl_setopt($ch, CURLOPT_URL, $url); 
				
				$result = curl_exec($ch); 

				echo "<script>alert('Payment Successfull')</script>";

				echo "<script>window.open('../customer/my_account','_self')</script>";
			}
	}
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.

	else {

		$ORDERID = $_POST['ORDERID'];

		$get_customer = "select * from customer_orders where invoice_no='$ORDERID'";

		$run_customer = mysqli_query($con,$get_customer);

		$row_customer = mysqli_fetch_array($run_customer);

		$customer_id = $row_customer['customer_id'];

		$get_contact = "select * from customers where customer_id='$customer_id'";

		$run_contact = mysqli_query($con,$get_contact);

		$row_contact = mysqli_fetch_array($run_contact);

		$c_contact = $row_contact['customer_contact'];


		$textf = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20click%20here%20to%20View%20Details%20:-%20http://www.wernear.in/customer/order_view?invoice_no=$ORDERID%0APayment%20Failed%20no%20worries%20pay%20on%20delivery";

		//echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
		$urlf = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$textf";
		// Initialize a CURL session. 
		$ch = curl_init();  
		
		// Return Page contents. 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		//grab URL and pass it to the variable. 
		curl_setopt($ch, CURLOPT_URL, $urlf); 
		
		$result = curl_exec($ch); 

		echo "<script>alert('Payment Failed')</script>";

		echo "<script>window.open('../','_self')</script>";
	}

	// if (isset($_POST) && count($_POST)>0 )
	// { 
	// 	foreach($_POST as $paramName => $paramValue) {
	// 			echo "<br/>" . $paramName . " = " . $paramValue;
	// 	}
	// }
	

}
else {

	$ORDERID = $_POST['ORDERID'];

	$get_customer = "select * from customer_orders where invoice_no='$ORDERID'";

	$run_customer = mysqli_query($con,$get_customer);

	$row_customer = mysqli_fetch_array($run_customer);

	$customer_id = $row_customer['customer_id'];

	$get_contact = "select * from customers where customer_id='$customer_id'";

	$run_contact = mysqli_query($con,$get_contact);

	$row_contact = mysqli_fetch_array($run_contact);

	$c_contact = $row_contact['customer_contact'];


	$textfn = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20click%20here%20to%20View%20Details%20:-%20http://www.wernear.in/customer/order_view?invoice_no=$ORDERID%0APayment%20Failed%20no%20worries%20pay%20on%20delivery";

	//echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
	$urlfn = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$textfn";
	// Initialize a CURL session. 
	$ch = curl_init();  
	
	// Return Page contents. 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	//grab URL and pass it to the variable. 
	curl_setopt($ch, CURLOPT_URL, $urlfn); 
	
	$result = curl_exec($ch); 

	echo "<script>alert('Payment failed')</script>";

		echo "<script>window.open('../')</script>";
	//Process transaction as suspicious.
}

?>