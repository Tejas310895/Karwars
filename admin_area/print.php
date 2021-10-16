<?php 

include("includes/db.php");

if(isset($_GET['print'])){
  $invoice_no = $_GET['print'];
  date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d H:i:s");

$get_total = "SELECT sum(due_amount) AS total FROM customer_orders where invoice_no='$invoice_no' and product_status='Deliver'";
$run_total = mysqli_query($con,$get_total);
$row_total = mysqli_fetch_array($run_total);

$total = $row_total['total'];

$get_details = "select * from customer_orders where invoice_no='$invoice_no'";
$run_details = mysqli_query($con,$get_details);
$row_details = mysqli_fetch_array($run_details);

$customer_id = $row_details['customer_id'];
$add_id = $row_details['add_id'];
$order_date = $row_details['order_date'];
$client_id = $row_details['client_id'];

$get_customer = "select * from customers where customer_id='$customer_id'";
$run_customer = mysqli_query($con,$get_customer);
$row_customer = mysqli_fetch_array($run_customer);

$customer_name = $row_customer['customer_name'];
$customer_contact = $row_customer['customer_contact'];

$get_add = "select * from customer_address where add_id='$add_id'";
$run_add = mysqli_query($con,$get_add);
$row_add = mysqli_fetch_array($run_add);

$customer_city = $row_add['customer_city'];
$customer_landmark = $row_add['customer_landmark'];
$customer_phase = $row_add['customer_phase'];
$customer_address = $row_add['customer_address'];

$get_min = "select * from admins";
$run_min = mysqli_query($con,$get_min);
$row_min = mysqli_fetch_array($run_min);
$min_price = $row_min['min_order'];
// $del_charges = $row_min['del_charges'];
        
$get_del_charges = "select * from order_charges where invoice_id='$invoice_no'";
$run_del_charges = mysqli_query($con,$get_del_charges);
$row_del_charges = mysqli_fetch_array($run_del_charges);

$del_charges = $row_del_charges['del_charges'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet'>
    <style>
            body{
                font-family:Josefin Sans;
            }
            #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
            }
            #invoice-POS h2 {
            font-size: 0.8rem;
            margin-top: 5px;
            margin-bottom: 5px;
            }
            #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
            }
            #invoice-POS p {
            font-size: 0.6em;
            color: #000;
            line-height: 1em;
            }
            #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            }
            #invoice-POS #top {
            min-height: 100px;
            }
            #invoice-POS #mid {
            min-height: 80px;
            }
            #invoice-POS #bot {
            min-height: 50px;
            }
            /* #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(../admin_area/admin_images/karlogob.png) no-repeat;
            background-size: 60px 60px;
            } */
            #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(../admin_area/admin_images/karlogob.png) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
            }
            #invoice-POS .info {
            display: block;
            margin-left: 0;
            text-align:center;
            font-weight:bold;
            font-size: 1rem;
            }
            #invoice-POS .title {
            float: right;
            }
            #invoice-POS .title p {
            text-align: right;
            }
            #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
            }
            #invoice-POS .tabletitle {
            font-size: 1rem;
            /* background: #EEE; */
            }
            #invoice-POS .service {
            border-bottom: 1px solid #EEE;
            font-size: 1rem;
            color:#000;
            }
            #invoice-POS .item {
            width: 24mm;
            }
            #invoice-POS .itemtext {
            /* font-size: 0.5 rem; */
            margin-top: 7px;
            margin-bottom: 7px;
            }
            #invoice-POS #legalcopy {
            margin-top: 5mm;
            }
            #legal{
                font-size:1rem !important;
            }

            #item_type{
              text-align:left !important;
            }
            @media print 
                        {
                        /* @page
                        {
                            size: 100mm 100mm;
                            /* size: portrait; */
                            /* margin: 2mm 0mm 0mm 0mm; */
                        /* } */
                        .pagebreak { page-break-before: always; }
                        }
    </style>
    <script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
</head>
<body>
<div class="pagebreak mt-1 ml-1">
  <div id="invoice-POS">
  <center>
  <img src="admin_images/karwarslogo.png" alt="" width="120px">
  </center>
    <!-- <center id="top">
      <div class="logo">
      </div>
    </center> -->
    <div id="mid">
      <div class="info">
        <h2>ORDER STATEMENT</h2>
        <h2>Order id : <?php echo $invoice_no; ?> </br>
            Date : <?php echo date('d/M/Y h:i a',strtotime($order_date)); ?> </br>
            Name : <?php echo $customer_name; ?></br>
            Phone   : <?php echo $customer_contact; ?></br>
            Address : <?php echo $customer_address.",".$customer_phase.",".$customer_landmark.",".$customer_city; ?></br>
        </h2>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot" style="text-align:center;">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2 class="my-0">Item</h2></td>
								<td class="Hours"><h2 class="my-0">Qty</h2></td>
								<td class="Rate"><h2 class="my-0">Sub Total</h2></td>
							</tr>
      <?php 

        $get_client_id = "SELECT distinct(client_id) from customer_orders where invoice_no='$invoice_no'";
        $run_client_id = mysqli_query($con,$get_client_id);
        while($row_client_id=mysqli_fetch_array($run_client_id)){

            $client_id = $row_client_id['client_id'];

            $get_product_type = "select * from clients where client_id='$client_id'";
            $run_product_type = mysqli_query($con,$get_product_type);
            $row_product_type = mysqli_fetch_array($run_product_type);

            $product_type = $row_product_type['client_pro_type'];
            
            // echo"
            // <tr>
            // <th colspan='3' class='item_type' style='font-size:0.6rem;text-align:left;padding:10px 10px 0px 10px;text-transform: uppercase;background-color:#F0F0F0;'>$product_type</th>
            // </tr>
            // ";
       ?>
        <tbody class="text-center" style="font-weight:bold;">
      <?php
				$get_pro_id = "select * from customer_orders where invoice_no='$invoice_no' and client_id='$client_id'";

                $run_pro_id = mysqli_query($con,$get_pro_id);
                

				$counter = 0;
                $you_saved = 0;

				while($row_pro_id = mysqli_fetch_array($run_pro_id)){
					
				$pro_id = $row_pro_id['pro_id'];

				$qty = $row_pro_id['qty'];

				$product_status = $row_pro_id['product_status'];

				$sub_total = $row_pro_id['due_amount'];

				$pro_price = $sub_total/$qty;

				$get_pro = "select * from products where product_id='$pro_id'";

				$run_pro = mysqli_query($con,$get_pro);

				while($row_pro = mysqli_fetch_array($run_pro)){

					// $total =0;

					$pro_title = $row_pro['product_title'];

					$pro_desc = $row_pro['product_desc'];

					// $pro_price = $row_pro['product_price'];

					$mrp = $row_pro['price_display'];

					if($mrp<$pro_price){

						$discount=0;

					}else{

						$discount=($mrp-$pro_price)*$qty;
					} 

					//$sub_total = $row_pro['product_price']*$qty;
					
					//$total += $sub_total;

                    $counter = ++$counter;
                    $you_saved += $discount;

					if($product_status==='Deliver'){

            echo "
            
              <tr class='service'>
								<td class='tableitem'><p class='itemtext'>$pro_title $pro_desc</p></td>
								<td class='tableitem'><p class='itemtext'>$qty</p></td>
								<td class='tableitem'><p class='itemtext'>$sub_total.00</p></td>
							</tr>
            
            ";

					}else {

						echo "
              <tr class='service'>
								<td class='tableitem'><p class='itemtext'>$pro_title $pro_desc</p></td>
								<td class='tableitem'><p class='itemtext'>$qty</p></td>
								<td class='tableitem'><p class='itemtext'>Cancelled</p></td>
							</tr>
						";	

					}

					}

                }
			?>
      <?php } ?>
            <?php 
                
                $get_discount = "select * from customer_discounts where invoice_no='$invoice_no'";
                $run_discount = mysqli_query($con,$get_discount);
                $row_discount = mysqli_fetch_array($run_discount);

                $coupon_code = $row_discount['coupon_code'];
                $discount_type = $row_discount['discount_type'];
                $discount_amount = $row_discount['discount_amount'];

                if($discount_type==='amount'){
                    $grand_total = ($total+$del_charges)-$discount_amount;
                }elseif (empty($discount_type)) {
                    $grand_total = $total+$del_charges;
                }elseif ($discount_type==='product') {
                    $get_promo_pro = "select * from products where product_id='$discount_amount'";
                    $run_promo_pro = mysqli_query($con,$get_promo_pro);
                    $row_promo_pro = mysqli_fetch_array($run_promo_pro);
    
                    $promo_pro_title = $row_promo_pro['product_title'];
                    $promo_pro_desc = $row_promo_pro['product_desc'];
                    $promo_pro_price = $row_promo_pro['product_price']; 
                    $grand_total = ($total+$del_charges)+$promo_pro_price;
            ?>

                            <tr>
                                <th colspan='3' class='item_type' style='font-size:0.6rem;text-align:left;padding:10px 10px 0px 10px;text-transform: uppercase;background-color:#F0F0F0;'>Promo Products</th>
                            </tr>
                            <tr>
                                <td class='tableitem' colspan="2"><p class='itemtext'><?php echo $promo_pro_title." ".$promo_pro_desc;?></p></td>
								<td class='tableitem'><p class='itemtext'><?php echo $promo_pro_price;?></p></td>
                            </tr>
            <?php } ?>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Item Total</h2></td>
								<td class="payment"><h2><?php echo $total; ?>.00</h2></td>
							</tr>
              <?php if($del_charges>0){?>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Delivery Charges</h2></td>
								<td class="payment"><h2><?php echo $del_charges; ?>.00</h2></td>
							</tr>
              <?php } ?>
              <?php if(!empty($coupon_code)){?>
              <tr class="tabletitle">
              <td></td>
              <?php if($discount_type==='amount'){ ?>
              <td class="text-right"><h2>Promo (<?php echo strtoupper($coupon_code); ?>)<h2></td>
              <td><h2>-<?php echo $discount_amount; ?><h2></td>
              <?php }else{ ?>
              <td class="text-left" colspan="2" style="text-align:left;">
                <h2>
                    Promo (<?php echo strtoupper($coupon_code); ?>) <br>
                    Offer Product Added to Order.
                <h2>
              </td>
              </tr>
              <?php } ?>
              <?php } ?>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Grand Total</h2></td>
								<td class="payment"><h2><?php echo $grand_total; ?>.00</h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank You!</strong> <br> Order Again : www.karwars.in.
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
  </div>
</body>
</html>
<?php } ?>