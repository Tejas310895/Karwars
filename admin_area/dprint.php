<?php 

include("includes/db.php");


if(isset($_GET['print'])){

    $invoice_id = $_GET['print'];

	// $bags = $_GET['bags_no'];

    $get_orders = "select * from customer_orders where invoice_no='$invoice_id'";

    $run_orders = mysqli_query($con,$get_orders);

    //$order_count = mysqli_num_rows($run_orders);

    $row_orders = mysqli_fetch_array($run_orders);

    $c_id = $row_orders['customer_id'];

    $date = $row_orders['order_date'];

    $add_id = $row_orders['add_id'];

    $del_date = $row_orders['del_date'];

    $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver'";

    $run_total = mysqli_query($con,$get_total);

    $row_total = mysqli_fetch_array($run_total);

    $total = $row_total['total'];

    $get_customer = "select * from customers where customer_id='$c_id'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $c_name = $row_customer['customer_name'];

    $c_contact = $row_customer['customer_contact'];

    $get_add = "select * from customer_address where add_id='$add_id'";

    $run_add = mysqli_query($con,$get_add);

    $row_add = mysqli_fetch_array($run_add);

    $customer_address = $row_add['customer_address'];

    $customer_phase = $row_add['customer_phase'];

    $customer_landmark = $row_add['customer_landmark'];

    $customer_city = $row_add['customer_city'];

	$get_del_charges = "select * from order_charges where invoice_id='$invoice_id'";
	$run_del_charges = mysqli_query($con,$get_del_charges);
	$row_del_charges = mysqli_fetch_array($run_del_charges);

	$del_charges = $row_del_charges['del_charges'];

    $get_txn = "select * from paytm where ORDERID='$invoice_id'";

    $run_txn = mysqli_query($con,$get_txn);

    $row_txn = mysqli_fetch_array($run_txn);

    $txn_status = $row_txn['STATUS'];


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="stylefile.css" type="text/css" media="print" >
	<link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
	<title>Bill</title>
	<style>

		body{
			font-weight:bold;
		}

		@media print{
			table,thead{
				border:2px solid #000 !important;
			}
			.table-bordered td, .table-bordered th{
				border:2px solid #000 !important;
			}
			.pagebreak { page-break-before: always; }
                        }

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
	<div class="container-fluid px-4">
		<div class="row py-1">
			<div class="col-2 px-0">
				<img src="admin_images/karwarslogo.png" alt="" class="img-fluid border-3 mx-auto d-block" width="150px">
			</div>
			<div class="col-10 mt-3">
				<h5 class="mb-0"><strong>Delivery Statement (Ordered On : <?php echo date("d/M/Y", strtotime($date)); ?> )</strong></h5>
				<h5 class="mb-0"><strong>Name :</strong> <?php echo strtoupper($c_name); ?> / <strong>Mobile :</strong> +91 <?php echo $c_contact; ?> / <strong>Address :</strong><?php echo $customer_address; ?>, <?php echo $customer_landmark; ?>, <?php echo $customer_phase; ?>, <?php echo $customer_city; ?>. </h5>
			</div>
		</div>
		<div class="row p-0">
		<table class="table table-bordered mt-2 head">
		<thead>
		<tr>
		<th  style="border:3px solid #000;">Order ID</th><th style="border:3px solid #000;"><?php echo $invoice_id; ?></th>
		<th style="border:3px solid #000;">Payment Mode</th><th style="border:3px solid #000;"><?php if($txn_status==='SUCCESS'){echo "PREPAID";}else{echo "POSTPAID";} ?></th>
		<th style="border:3px solid #000;">Delivery Slot</th><th style="border:3px solid #000;"><?php echo date("d/M/Y", strtotime($del_date)); ?></th>
		</tr>
		</thead>
		</table>
		</div>
		<div class="row p-0">
		<table class="table m-0 table-bordered">
		    <thead class="text-center">
				<tr>
					<th colspan="5" style="border:0px 0px 0px 0px solid #000;"><h5 class="font-weight-bold text-uppercase">Delivery Items</h5></th>
				</tr>
			</thead>
			<thead class="text-center">
				<tr>
					<th style="width:5%;">Sl.no</th>
					<th style="width:60%;">ITEM</th>
					<th style="width:5%;">QUANTITY</th>
					<th style="width:15%;">SAVING</th>
					<th style="width:15%;">TOTAL</th>
				</tr>
			</thead>
			<tbody>
            <?php 

                // $get_client_id = "SELECT distinct(client_id) from customer_orders where invoice_no='$invoice_id'";
                // $run_client_id = mysqli_query($con,$get_client_id);
                // while($row_client_id=mysqli_fetch_array($run_client_id)){

                //     $client_id = $row_client_id['client_id'];

                //     $get_product_type = "select * from clients where client_id='$client_id'";
                //     $run_product_type = mysqli_query($con,$get_product_type);
                //     $row_product_type = mysqli_fetch_array($run_product_type);

                //     $product_type = $row_product_type['client_pro_type'];
                    
                //     echo"
                //     <tr>
                //     <td colspan='4' class='pb-2 pro_box' style='font-size:1rem;text-align:left;padding:10px 10px 0px 10px;text-transform: uppercase;background-color:#F0F0F0;'><strong>$product_type</strong></td>
                //     </tr>
                //     ";
            ?>
			<?php

				$get_pro_id = "select * from customer_orders where invoice_no='$invoice_id'";

				$run_pro_id = mysqli_query($con,$get_pro_id);

				$counter = 0;

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

					if($mrp<=0){

						$discount=0;

					}else{

						$discount=($mrp-$pro_price)*$qty;
					} 

					// $sub_total = $row_pro['product_price']*$qty;
					
					// $total += $sub_total;

					$counter = ++$counter;

					if($product_status==='Deliver'){

						echo "

						<tr style='font-size:1.2rem;'>
						<td>$counter</td>
						<td>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center'>$discount.00</td>
						<td class='text-center'>$sub_total.00</td>
						</tr>
						";	

					}else {

						echo "

						<tr style='font-size:1.2rem;'>
						<td>$counter</td>
						<td>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center' colspan='2'><strong>Undelivered</strong></td>
						</tr>
						";	

					}

					}

				}
				?>
                <?php //} ?>
                <?php 

                $get_discount = "select * from customer_discounts where invoice_no='$invoice_id'";
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
                    $promo_pro_dis_price = $row_promo_pro['price_display']; 
                    $grand_total = ($total+$del_charges)+$promo_pro_price;
            ?>

                            <tr>
                                <th colspan='5' class='item_type pb-2' style='font-size:1rem;text-align:left;padding:10px 10px 0px 10px;text-transform: uppercase;background-color:#F0F0F0;'>Promo Products</th>
                            </tr>
                            <tr style='font-size:1.2rem;'>
								<td><?php echo $counter+1; ?></td>
                                <td colspan="2"><?php echo $promo_pro_title." ".$promo_pro_desc;?></td>
                                <td class="text-center"><?php echo $promo_pro_dis_price-$promo_pro_price;?>.00</td>
								<td class="text-center"><?php echo $promo_pro_price;?>.00</td>
                            </tr>
            <?php } ?>
			</tbody>
			<tfoot>
                <tr style="border-top:3px solid #000;">
                    <td colspan="4" class="text-right">Item Total</td>
                    <td class="text-center"><?php echo $total; ?>.00</td>
                </tr>
                <tr style="border-top:0px solid #000;">
                    <?php if(!empty($coupon_code)){?>
                        <?php if($discount_type==='amount'){ ?>
                        <th class="text-right" colspan="4">Promo Applied (<?php echo strtoupper($coupon_code); ?>)</th>
                        <th class="text-center">-<?php echo $discount_amount; ?>.00</th>
                        <?php }else{ ?>
                        <th class="text-right" colspan="5">
                                Promo (<?php echo strtoupper($coupon_code); ?>) <br>
                                Promo Product Added to Order.
                        </th>
                    <?php } ?>
                    <?php } ?>
                </tr>
                
                <?php if($del_charges>0){?>
                    <tr style="border-top:0px solid #000;">
                        <td colspan="4" class="text-right">Delivery Charges</td>
                        <td class="text-center"><?php echo $del_charges; ?>.00</td>
                    </tr>
                <?php } ?>
				<tr style="border-top:3px solid #000;">
				    <th colspan="4" class="text-right">GRAND TOTAL :</th>
					<th class="text-center">Rs. <?php echo $grand_total; ?>.00</th>	
				</tr>
			</tfoot>
		</table>
		</div>
		<div class="row mt-3">
			<div class="col-12">
				<h5 style="font-size:1rem;font-family:Courgette;">Note :</h5>
				<!-- <h5 style="font-size:1rem;font-family:Courgette;">For tax invoice: https://www.karwars.in/customer/order_view?invoice_no=</h5> -->
				<h5 style="font-size:1rem;font-family:Courgette;">For online payments refunds shall be processed online, no cash refunds will be allowed.</h5>
			</div>
			<div class="col-12">
				<hr class="mb-0" style="border-top:1px solid #999;height:10px;font-weight:bold;">
				<h5 style="font-size:1rem;font-family:Raleway;text-align:center;font-weight:bold;">WERNEAR TECHNOLOGIES, Habbuwada Karwar, 581301. GSTIN:27AADFW3376J1ZR</h5>
				<h5 style="font-size:1rem;font-family:Raleway;text-align:center;font-weight:bold;">Follow us on: https://www.facebook.com/karwars.in</h5>
				<h5 style="font-size:1rem;font-family:Raleway;text-align:center;font-weight:bold;">Thank You 😊 Order Again</h5>
			</div>
		</div>
	</div>
	<!-- <div class="pagebreak mx-1">
		<div class="row ml-1">
			<?php 
			
			// for ($i=0; $i < $bags; $i++) { 

			?>
			<div class="col-2 border ml-1">
				<h2 class="text-left"><?php //echo $i+1; ?></h2>
				<h4 class="text-left"><?php //echo $c_name; ?></h4>
			</div>
			<?php //} ?>
		</div>
	</div> -->
</body>
</html>