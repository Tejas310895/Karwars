<?php 

include("includes/db.php");


if(isset($_GET['print'])){

    $invoice_id = $_GET['print'];

    $get_orders = "select * from customer_orders where invoice_no='$invoice_id'";


    $run_orders = mysqli_query($con,$get_orders);

    //$order_count = mysqli_num_rows($run_orders);

    $row_orders = mysqli_fetch_array($run_orders);

    $c_id = $row_orders['customer_id'];

    $date = $row_orders['order_date'];

    $add_id = $row_orders['add_id'];

    $del_date = $row_orders['del_date'];

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
		@media print{
			.table,thead{
				border:2px solid #000;
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
		<table class="table table-bordered mt-2 head">
		<thead>
		<tr>
        <th  style="border:3px solid #000;">Customer Name</th><th style="border:3px solid #000;"><?php echo $c_name; ?></th>
		<th  style="border:3px solid #000;">Order ID</th><th style="border:3px solid #000;"><?php echo $invoice_id; ?></th>
		</tr>
		</thead>
		</table>
		<table class="table table-bordered mt-2">
			<thead class="text-center">
				<th style="width:5%;">Sl.No</th>
				<th style="width:60%;">ITEM</th>
				<th style="width:5%;">QUANTITY</th>
				<th style="width:15%;">TOTAL</th>
			</thead>
			<tbody>
			<?php



                $get_vendor = "select * from customer_order group by client_id";
                $run_vendor = mysqli_query($con,$get_vendor);
                while ($row_vendor=mysqli_fetch_array($run_vendor)) {

                $vendor_id = $row_vendor['client_id'];

                $get_client = "select * from clients where client_id=$vendor_id";
                $run_client = mysqli_query($con,$get_client);
                $row_client = mysqli_fetch_array($run_client);
                $vendor_name = $row_client['client_shop'];

                $get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver' and client_id='$vendor_id'";

                $run_total = mysqli_query($con,$get_total);
            
                $row_total = mysqli_fetch_array($run_total);
            
                $total = $row_total['total'];

				$get_pro_id = "select * from customer_orders where invoice_no='$invoice_id' and client_id='$vendor_id'";

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

                    echo "
                    <tr>
                    <td colspan='4'>
                    <h5 class='text-center'>$vendor_name</h5>
                    </td>
                    </tr>
                    ";

					if($product_status==='Deliver'){

						echo "

						<tr>
						<td class='text-center'>$counter</td>
						<td>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center'>$sub_total.00</td>
						</tr>
						";	

					}else {

						echo "

						<tr>
						<td class='text-center'>$counter</td>
						<td>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center'><strong>Undelivered</strong></td>
						</tr>
						";	

					}

					}

				}
                }   
				?>		
			</tbody>
		</table>
	</div>
</body>
</html>