<?php

		$get_txn = "select * from customer_orders where invoice_no=$invoice_no";

		$run_txn = mysqli_query($con,$get_txn);

		$count = mysqli_num_rows($run_txn);

		$row_txn = mysqli_fetch_array($run_txn);

		$c_id = $row_txn['customer_id'];

		if($count>0){

			$get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_no'";

			$run_total = mysqli_query($con,$get_total);

			$row_total = mysqli_fetch_array($run_total);

			$total = $row_total['total'];

			$get_min = "select * from admins";

			$run_min = mysqli_query($con,$get_min);

			$row_min = mysqli_fetch_array($run_min);

			$del_charges = $row_min['del_charges'];

			$TXN_AMOUNT = $total+$del_charges;
		


	}else{


		echo "<script>alert('Payment Failed')</script>";

        echo "<script>window.open('customer/my_account','_self')</script>";
	}
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="GENERATOR" content="Evrsoft First Page">
<link rel="stylesheet" href="./styles/bootstrap.min.css" >
    <link rel="stylesheet" href="./styles/bootstrap.css" >
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
	<h4 class="text-center">Do not refresh or go back</h4>
	<p class="text-center">(if you cancel the payment no worries your order is placed and you can check order details in my account)</p>
	<pre>
	</pre>
		<form method="post" action="paytm/pgRedirect.php">		
						<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $invoice_no; ?>">
						<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $c_id; ?>">
						<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
						<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
									<div class="form-group text-center">
										<label for="exampleFormControlInput1"><h4>Total Payable</h4></label>
										<input title="TXN_AMOUNT" class="form-control text-center" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $TXN_AMOUNT; ?>" readonly>
									</div>
									<input value="Pay Now" type="submit" class="btn btn-success btn-lg btn-block"	onclick="">
		</form>
		</div>
	</div>
</div>
</body>
</html>