<?php

include("includes/db.php");

if(isset($_GET['pdf'])){

    $invoice_id = $_GET['pdf'];

    $get_orders = "select * from customer_orders where invoice_no='$invoice_id'";

    $run_orders = mysqli_query($con,$get_orders);

    //$order_count = mysqli_num_rows($run_orders);

    $row_orders = mysqli_fetch_array($run_orders);

    $c_id = $row_orders['customer_id'];

    $date = $row_orders['order_date'];

    $add_id = $row_orders['add_id'];

    $order_date = $row_orders['order_date'];

    $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver'";

    $run_total = mysqli_query($con,$get_total);

    $row_total = mysqli_fetch_array($run_total);

    $total = $row_total['total'];

    $get_customer = "select * from customers where customer_id='$c_id'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $c_name = $row_customer['customer_name'];

    $c_contact = $row_customer['customer_contact'];

    $c_email = $row_customer['customer_email'];

    $get_add = "select * from customer_address where add_id='$add_id'";

    $run_add = mysqli_query($con,$get_add);

    $row_add = mysqli_fetch_array($run_add);

    $customer_address = $row_add['customer_address'];

    $customer_phase = $row_add['customer_phase'];

    $customer_landmark = $row_add['customer_landmark'];

    $customer_city = $row_add['customer_city'];

    $get_min = "select * from admins";

    $run_min = mysqli_query($con,$get_min);

    $row_min = mysqli_fetch_array($run_min);

    $min_price = $row_min['min_order'];

    $del_charges = $row_min['del_charges'];

    $get_txn = "select * from paytm where ORDERID='$invoice_id'";

    $run_txn = mysqli_query($con,$get_txn);

    $row_txn = mysqli_fetch_array($run_txn);

    $txn_status = $row_txn['STATUS'];

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>TAX INVOICE</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<!-- <meta http-equiv="content-type" content="text-html; charset=utf-8"> -->
	<style type="text/css">
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}

		html {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		caption, th, td {
			text-align: left;
			font-weight: normal;
			vertical-align: middle;
		}

		q, blockquote {
			quotes: none;
		}
		q:before, q:after, blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		a img {
			border: none;
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
			display: block;
		}

		body {
			font-family: 'Source Sans Pro', sans-serif;
			font-weight: 300;
			font-size: 12px;
			margin: 0;
			padding: 0;
		}
		body a {
			text-decoration: none;
			color: inherit;
		}
		body a:hover {
			color: inherit;
			opacity: 0.7;
		}
		body .container {
			min-width: 500px;
			margin: 0 auto;
			padding: 0 20px;
		}
		body .clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		body .left {
			float: left;
		}
		body .right {
			float: right;
		}
		body .helper {
			display: inline-block;
			height: 100%;
			vertical-align: middle;
		}
		body .no-break {
			page-break-inside: avoid;
		}

		header {
			margin-top: 20px;
			margin-bottom: 50px;
		}
		header figure {
			float: left;
			width: 60px;
			height: 60px;
			margin-right: 10px;
			background-color: #fff;
			border-radius: 50%;
			text-align: center;
		}
		header figure img {
			margin-top: 0px;
		}
		header .company-address {
			float: left;
			max-width: 150px;
			line-height: 1.7em;
		}
		header .company-address .title {
			color: #8BC34A;
			font-weight: 400;
			font-size: 1.5em;
			text-transform: uppercase;
		}
		header .company-contact {
			float: right;
			height: 60px;
			padding: 0 10px;
			background-color: #8BC34A;
			color: white;
		}
		header .company-contact span {
			display: inline-block;
			vertical-align: middle;
		}
		header .company-contact .circle {
			width: 20px;
			height: 20px;
			background-color: white;
			border-radius: 50%;
			text-align: center;
		}
		header .company-contact .circle img {
			vertical-align: middle;
		}
		header .company-contact .phone {
			height: 100%;
			margin-right: 20px;
		}
		header .company-contact .email {
            font-size:1.2rem;
			height: 100%;
			min-width: 100px;
			text-align: right;
		}

		section .details {
			margin-bottom: 55px;
		}
		section .details .client {
			width: 50%;
			line-height: 20px;
		}
		section .details .client .name {
			color: #1c2213;
            margin-top:5px;
            font-size:1.2rem;
            font-family:Quicksand;
		}
		section .details .data {
			width: 50%;
			text-align: right;
		}
		section .details .title {
			margin-bottom: 15px;
			color: #8BC34A;
			font-size: 3em;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: 0.9166em;
		}
		section table .qty, section table .unit, section table .total {
			width: 20%;
            text-align: center;
		}
		section table .desc {
			width: 55%;
		}
		section table thead {
			display: table-header-group;
			vertical-align: middle;
			border-color: inherit;
		}
		section table thead th {
			padding: 5px 10px;
			background: #8BC34A;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #FFFFFF;
			text-align: right;
			color: white;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table thead th:last-child {
			border-right: none;
		}
		section table thead .desc {
			text-align: left;
		}
		section table thead .qty {
			text-align: center;
		}
		section table tbody td {
			padding: 10px;
			background: #E8F3DB;
			color: #777777;
			text-align: right;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #E8F3DB;
		}
		section table tbody td:last-child {
			border-right: none;
		}
		section table tbody h3 {
			margin-bottom: 5px;
			color: #8BC34A;
			font-weight: 600;
		}
		section table tbody .desc {
			text-align: left;
		}
		section table tbody .qty {
			text-align: center;
		}
		section table.grand-total {
			margin-bottom: 45px;
		}
		section table.grand-total td {
			padding: 5px 10px;
			border: none;
			color: #777777;
			text-align: right;
		}
		section table.grand-total .desc {
			background-color: transparent;
		}
		section table.grand-total tr:last-child td {
			font-weight: 600;
			color: #8BC34A;
			font-size: 1.18181818181818em;
		}

		footer {
			margin-bottom: 20px;
		}
		footer .thanks {
			margin-bottom: 10px;
			color: #8BC34A;
			font-size: 1.16666666666667em;
			font-weight: 600;
		}
		footer .notice {
			margin-bottom: 25px;
    		}
		footer .end {
			padding-top: 5px;
			border-top: 2px solid #8BC34A;
			text-align: center;
		}
	</style>
</head>

<body>
	<div id="content">
    <div class="container" style="background-color:#8BC34A; padding:10px;">
        <h5 style="color:#fff;font-weight:bold;text-align:center;font-size:2rem;font-family:'Source Sans Pro', sans-serif;">TAX INVOICE</h5>
	</div>
	<header class="clearfix">
		<div class="container">
			<figure>
				<img class="logo" src="../admin_area/admin_images/dashlogo.png" alt="">
			</figure>
			<!-- <div class="company-address">
				<h2 class="title">Company title</h2>
				<p>
					455 Foggy Heights,<br>
					AZ 85004, US
				</p>
			</div> -->
			<div class="company-contact">
				<div class="email right">
					<a style="font-weight:bold;"><?php if($txn_status=='TXN_SUCCESS'){echo"Paid Online";}else{echo"Paid Offline";}?></a>
					<span class="helper"></span>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="container">
			<div class="details clearfix">
				<div class="client left">
					<p style="font-size:1.2rem;font-weight:bold;">INVOICE TO:</p>
                    <p class="name"><?php echo"$c_name";?></p>
                    <p class="name">+91 <?php echo"$c_contact";?></p>
                    <p class="name"><?php echo"$c_email";?></p>
					<p style="font-size:1.1rem;text-transform:capitalize;font-family:Quicksand;padding-top:5px;"><?php echo"$customer_address, $customer_phase, $customer_landmark, $customer_city";?></p>
				</div>
				<div class="data right">
					<div class="title">Invoice <br> #<?php echo"$invoice_id";?> </div>
					<div class="date">
						Date of Invoice: <?php echo date('d/M/Y',strtotime($date)); ?><br>
						<!-- Due Date: 30/06/2014 -->
					</div>
				</div>
			</div>

			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
                        <th class="unit">Sl.No</th>
                        <th class="desc">Items</th>
                        <th class="qty">HSN CODE</th>
                        <th class="unit">Unit price</th>
						<th class="qty">Quantity</th>
                        <th class="unit">Taxable Value</th>
                        <th class="unit">CGST% Amount</th>
                        <th class="unit">SGST% Amount</th>
                        <th class="unit">IGST% Amount</th>
						<th class="unit">CESS% Amount</th>
						<th class="total">Total</th>
					</tr>
				</thead>
				<tbody>
                <?php
                                          
                $get_pro_id = "select * from customer_orders where invoice_no='$invoice_id' and product_status='Deliver'";

                $run_pro_id = mysqli_query($con,$get_pro_id);

                $counter = 0;

                while($row_pro_id = mysqli_fetch_array($run_pro_id)){

                $pro_id = $row_pro_id['pro_id'];

				$qty = $row_pro_id['qty'];
				
				$sub_total = $row_pro_id['due_amount'];

				$pro_price = $sub_total/$qty;

                $get_pro = "select * from products where product_id='$pro_id'";

                $run_pro = mysqli_query($con,$get_pro);

                $row_pro = mysqli_fetch_array($run_pro);

                $pro_title = $row_pro['product_title'];

                // $pro_price = $row_pro['product_price'];

                $pro_desc = $row_pro['product_desc'];

                $mrp = $row_pro['price_display'];

                $pro_hsn = $row_pro['product_hsn'];

                $cgst = $row_pro['product_cgst'];

                $sgst = $row_pro['product_sgst'];

                $igst = $row_pro['product_igst'];

                $cess = $row_pro['product_cess'];
            
                // $sub_total = $pro_price * $qty;

                if(($igst<=0) && ($cess<=0)){
                $taxable = $sub_total/((($cgst+$sgst)/100)+1);
                }elseif(($igst<=0) && ($cess>0)){
                $taxable = $sub_total/((($cgst+$sgst+$cess)/100)+1);
                }elseif(($cgst<=0) && ($sgst<=0) && ($cess<=0)){
                $taxable = $sub_total/((($igst)/100)+1);
                }elseif(($cgst<=0) && ($sgst<=0) && ($cess>0)){
                $taxable = $sub_total/((($igst+$cess)/100)+1);
                }

                if($cgst>0){
                $tax_cgst = $taxable*($cgst/100);
                }else{
                $tax_cgst = 0;
                }
                if($sgst>0){
                $tax_sgst = $taxable*($sgst/100);
                }else{
                $tax_sgst = 0;
                }  if($igst>0){
                $tax_igst = $taxable*($igst/100);
                }else{
                $tax_igst = 0;
                }  if($cess>0){
                $tax_cess = $taxable*($cess/100);
                }else{
                $tax_cess = 0;
                }

                $get_min = "select * from admins";

                $run_min = mysqli_query($con,$get_min);

                $row_min = mysqli_fetch_array($run_min);

                $min_price = $row_min['min_order'];

				$del_charges = $row_min['del_charges'];

                ?>
					<tr>
                        <td class="unit"><?php echo ++$counter;?></td>
						<td class="desc"><h3><?php echo $pro_title;?></h3><?php echo"$pro_desc";?></td>
                        <td class="qty"><?php echo $pro_hsn;?></td>
                        <td class="unit"><?php echo$pro_price.'.00';?></td>
                        <td class="qty"><?php echo $qty;?></td>
                        <td class="unit"><?php echo number_format(round((ceil($taxable*100)/100),1),2);?></td>
                        <td class="unit"><?php if($cgst>0){echo $cgst.'% '.number_format(round((floor($tax_cgst*100)/100),1),2);}else{echo 0;};?></td>
                        <td class="unit"><?php if($sgst>0){echo $sgst.'% '.number_format(round((floor($tax_cgst*100)/100),1),2);}else{echo 0;};?></td>
                        <td class="unit"><?php if($igst>0){echo $igst.'% '.number_format(round((floor($tax_cgst*100)/100),1),2);}else{echo 0;};?></td>
                        <td class="unit"><?php if($cess>0){echo $cess.'% '.number_format(round((floor($tax_cgst*100)/100),1),2);}else{echo 0;};?></td>
						<td class="total"><?php echo $sub_total.'.00';?></td>
                    </tr>
                <?php } ?>
				</tbody>
			</table>
			<div class="no-break">
				<table class="grand-total">
					<tbody>
						<tr>
							<td class="desc"></td>
							<td class="unit" colspan="2">GRAND TOTAL:</td>
							<td class="total">Rs. <?php echo $total+$del_charges.'.00'; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="thanks">Thank you!</div>
			<div class="notice">
				<div>WERNEAR TECHNOLOGIES,</div>
                <div>Karwar - 581306</div>
                <div>Karnataka</div>
                <div>Phone :+91 7892916394</div>
                <div>Mail :info@wernear.in</div>
                <div>GSTIN : 27AADFW3376J1ZR</div>
			</div>
			<div class="end">System generated invoice valid without the signature and seal.</div>
		</div>
	</footer>
	</div>
</body>
</html>


