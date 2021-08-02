
	<?php  
		include("../includes/db.php");
		 $secretkey = "209d3f7ab9e04a78cfdfa2ad2e97dd14541e18d3";
		 $orderId = $_POST["orderId"];
		 $orderAmount = $_POST["orderAmount"];
		 $referenceId = $_POST["referenceId"];
		 $txStatus = $_POST["txStatus"];
		 $paymentMode = $_POST["paymentMode"];
		 $txMsg = $_POST["txMsg"];
		 $txTime = $_POST["txTime"];
		 $signature = $_POST["signature"];
		 $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
		 $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
		 $computedSignature = base64_encode($hash_hmac);

		 function send_sms($text1,$contact){

			$text2 = "New%20Order%20received%20on%20the%20portal";
			//echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
			// $url1="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=$c_contact&message=$text1";
			// $url2="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=7892916394&message=$text2";
			$url1 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text1&number=+91$contact";
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
		}

		 if ($signature == $computedSignature) {

			if ($txStatus == "SUCCESS") {
	
				$insert_customer_order = "insert into paytm (CURRENCY,GATEWAYNAME,RESPMSG,BANKNAME,PAYMENTMODE,MID,RESPCODE,TXNID,TXNAMOUNT,ORDERID,STATUS,BANKTXNID,TXNDATE,CHECKSUMHASH) 
				values ('INR','$paymentMode','$txMsg','NIL','$paymentMode','NIL','NIL','$referenceId','$orderAmount','$orderId','$txStatus','NIL','$txTime','$signature')";
	
					$get_customer = "select * from customer_orders where invoice_no='$orderId'";
	
					$run_customer = mysqli_query($con,$get_customer);
	
					$row_customer = mysqli_fetch_array($run_customer);
	
					$customer_id = $row_customer['customer_id'];
	
					$get_contact = "select * from customers where customer_id='$customer_id'";
	
					$run_contact = mysqli_query($con,$get_contact);
	
					$row_contact = mysqli_fetch_array($run_contact);
	
					$c_contact = $row_contact['customer_contact'];
	
					if($run_insert = mysqli_query($con,$insert_customer_order)){
	
					$success1 = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%0APayment%20Successful%20of%20-%20$orderAmount";

					send_sms($success1,$c_contact);
	
					echo "<script>alert('Payment Successfull')</script>";
	
					echo "<script>window.open('../customer/pay_success','_self')</script>";
				}
		}
			//Process your transaction here as success transaction.
			//Verify amount & order id received from Payment gateway with your application's order id and amount.
	
		else {
	
			$orderId = $_POST["orderId"];
	
			$get_customer = "select * from customer_orders where invoice_no='$orderId'";
	
			$run_customer = mysqli_query($con,$get_customer);
	
			$row_customer = mysqli_fetch_array($run_customer);
	
			$customer_id = $row_customer['customer_id'];
	
			$get_contact = "select * from customers where customer_id='$customer_id'";
	
			$run_contact = mysqli_query($con,$get_contact);
	
			$row_contact = mysqli_fetch_array($run_contact);
	
			$c_contact = $row_contact['customer_contact'];
	
	
			$failed1 = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%0APayment%20Failed%20no%20worries%20pay%20on%20delivery";

			send_sms($failed1,$c_contact);
	
			echo "<script>alert('Payment Failed')</script>";
	
			echo "<script>window.open('../customer/pay_failed','_self')</script>";
		}
	
		// if (isset($_POST) && count($_POST)>0 )
		// { 
		// 	foreach($_POST as $paramName => $paramValue) {
		// 			echo "<br/>" . $paramName . " = " . $paramValue;
		// 	}
		// }
		
	
	}
	else {
	
		$orderId = $_POST["orderId"];
	
		$get_customer = "select * from customer_orders where invoice_no='$orderId'";
	
		$run_customer = mysqli_query($con,$get_customer);
	
		$row_customer = mysqli_fetch_array($run_customer);
	
		$customer_id = $row_customer['customer_id'];
	
		$get_contact = "select * from customers where customer_id='$customer_id'";
	
		$run_contact = mysqli_query($con,$get_contact);
	
		$row_contact = mysqli_fetch_array($run_contact);
	
		$c_contact = $row_contact['customer_contact'];
	
	
		$failed2 = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%0APayment%20Failed%20no%20worries%20pay%20on%20delivery";

		send_sms($failed2,$c_contact);
	
		echo "<script>alert('Payment failed')</script>";
	
		echo "<script>window.open('../customer/pay_failed','_self')</script>";
		//Process transaction as suspicious.
	}
	 ?>




