<?php 

include("includes/db.php");


if(isset($_GET['bill'])){

    $invoice_id = $_GET['bill'];

    $client = $_GET['client'];

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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<title>Bill</title>
	<style>

    @media print {
         *{width: 100mm;}

         .table{
            padding-left:0px;
             width: 100mm;
             }
            /* td.table{
                width:20%;
            } */

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
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <!-- <img src="admin_images/karlogob.png" alt="" class="border-0 d-block mx-auto pt-4" width="100%"> -->
        <h4 class="text-center">Id : <?php echo $invoice_id; ?></h4>
        <br>
        <h4>Date : <?php echo date('d/M/Y',strtotime($date)); ?></h4>
        <h4>Name : <?php echo $c_name; ?></h4>
        <!-- <h4>Payment Mode : <?php //if($txn_status=='TXN_SUCCESS'){echo"ONLINE";}else{echo"CASH";} ; ?></h4> -->
    </div>
    </div>
    <div class="col-12 px-0">
    <table class="table table-lg">
        <thead class="text-center">
            <tr>
                <th style="width:5%;">Sl.No</th>
				<th style="width:60%;">ITEM</th>
				<th style="width:5%;">QUANTITY</th>
				<th style="width:15%;">TOTAL</th>
            </tr>
        </thead>
        <tbody class="text-center" style="font-weight:bold;">
			<?php

				$get_pro_id = "select * from customer_orders where invoice_no='$invoice_id'";

				$run_pro_id = mysqli_query($con,$get_pro_id);

                $counter = 0;
                
                $get_sum = "select SUM(due_amount) as order_total from customer_orders where invoice_no='$invoice_id' and client_id='$client' and product_status='Deliver'";
                $run_sum = mysqli_query($con,$get_sum);
                $row_sum = mysqli_fetch_array($run_sum);
                $order_total = $row_sum['order_total'];

				while($row_pro_id = mysqli_fetch_array($run_pro_id)){
					
				$pro_id = $row_pro_id['pro_id'];

				$qty = $row_pro_id['qty'];

				$product_status = $row_pro_id['product_status'];

				$sub_total = $row_pro_id['due_amount'];

				$pro_price = $sub_total/$qty;  

				$get_pro = "select * from products where product_id='$pro_id' and client_id='$client'";

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

						<tr>
						    <td class='text-center'>$counter</td>
							<td style='width:70%;'' class='text-left'>$pro_title $pro_desc</td>
							<td >$qty</td>
							<td>₹ $sub_total</td>
						</tr>
						";	

					}else {

						echo "

						<tr>
						<td class='text-center'>$counter</td>
						<td style='width:70%;'' class='text-left'>$pro_title $pro_desc</td>
						<td >$qty</td>
						<td><strong>Undelivered</strong></td>
						</tr>
						";	

					}

					}

				}
				?>
                <tr>
                <th colspan="3" class="text-right">Total :</th>
                <th>₹ <?php echo $order_total;?></th>
                </tr>
			</tbody>
			<tbody>
			</tbody>
		</table>
		<!-- <div class="row">
			<div class="col-12">
                 <hr class="mb-0" style="border-top:1px solid #999;height:10px;">
				<h5 style="font-size:1rem;font-family:Raleway;text-align:center;">WERNEAR TECHNOLOGIES, Dombivali East, 421204. GSTN:27AADFW3376J1ZR</h5>
			</div>
		</div> -->
	</div>
</body>
</html>



