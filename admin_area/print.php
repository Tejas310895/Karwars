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

    $get_discount = "select * from customer_discounts where invoice_no='$invoice_id'";
    $run_discount = mysqli_query($con,$get_discount);
    $row_discount = mysqli_fetch_array($run_discount);

    $discount_type = $row_discount['discount_type'];
    $discount_amount = $row_discount['discount_amount'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../styles/bootstrap.min.css" >
    <link rel="stylesheet" href="../styles/bootstrap.css" >
    <script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
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
</head>

<body>

<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <img src="admin_images/karlogob.png" alt="" class="border-0 d-block mx-auto pt-4" width="100%">
        <br>
        <h4>Order No. : <?php echo $invoice_id; ?></h4>
        <h4>Order On : <?php echo date('d/M/Y',strtotime($order_date)); ?></h4>
        <h4>Name : <?php echo $c_name; ?></h4>
        <h4>Mobile No. : <?php echo $c_contact; ?></h4>
        <h4>Address : <?php echo $customer_address.', '.$customer_phase.', '.$customer_landmark.', '.$customer_city.'.'; ?></h4>
        <!-- <h4>Payment Mode : <?php //if($txn_status=='TXN_SUCCESS'){echo"ONLINE";}else{echo"CASH";} ; ?></h4> -->
    </div>
    </div>
    <div class="col-12 px-0">
    <table class="table table-lg">
        <thead class="text-center">
            <tr>
                <!-- <th>HSN</th> -->
                <th style="width:50%; text-align:left;">ITEM</th>
                <th style="width:10%;">QTY</th>
                <th style="width:40%;">SUBTOTAL</th>
            </tr>
        </thead>
        <?php 

        $get_client_id = "SELECT distinct(client_id) from customer_orders where invoice_no='$invoice_id'";
        $run_client_id = mysqli_query($con,$get_client_id);
        while($row_client_id=mysqli_fetch_array($run_client_id)){

            $client_id = $row_client_id['client_id'];

            $get_product_type = "select * from clients where client_id='$client_id'";
            $run_product_type = mysqli_query($con,$get_product_type);
            $row_product_type = mysqli_fetch_array($run_product_type);

            $product_type = $row_product_type['client_pro_type'];
            
            echo"
            <tr>
            <th colspan='3' class='text-center'>$product_type</th>
            </tr>
            ";
            ?>
        <tbody class="text-center" style="font-weight:bold;">
        <?php
				$get_pro_id = "select * from customer_orders where invoice_no='$invoice_id' and client_id='$client_id'";

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
						<tr>
						<td class='text-left'>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center'>$sub_total.00</td>
						</tr>
						";	

					}else {

						echo "

						<tr>
						<td class='text-left'>$pro_title $pro_desc</td>
						<td class='text-center'>$qty</td>
						<td class='text-center' colspan='2'><strong>Undelivered</strong></td>
						</tr>
						";	

					}

					}

                }
				?>
                </tbody>
            <?php } ?>
                <tbody>
        <tr>
        <th colspan="2" class="text-right">Item Total :</th>
        <td> ₹ <?php echo $total; ?></td>
        </tr>
        <tr class="<?php if($del_charges<=0){echo 'd-none';}else{echo 'show';} ?>">
        <th colspan="3" class="text-right">Delivery Charges :</th>
        <td> ₹ <?php echo $del_charges; ?></td>
        </tr>
        <tr class="<?php if($discount_amount>1){echo"show";}else{echo"d-none";} ?>">
        <th colspan="2" class="text-right"><?php echo $discount_type; ?> :</th>
        <td> ₹ <strong><?php echo "-".$discount_amount; ?></strong></td>
        </tr>
        <tr>
        <th colspan="2" class="text-right">GRAND TOTAL :<br>inc of all taxes   </th>
        <td> ₹ <strong><?php echo ($total+$del_charges)-$discount_amount; ?></strong></td>
        </tr>
        </tbody>
    </table>
    </div>
    <!-- <div class="col-12">
    <table class="table">
        <thead>
            <tr>
                <th>HSN</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>CESS</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody style="font-weight:bold;"> -->

        <?php 
        
        // $get_tax = "SELECT DISTINCT hsn FROM customer_orders where invoice_no='$invoice_id'";

        // $run_tax = mysqli_query($con,$get_tax);

        // while($row_tax=mysqli_fetch_array($run_tax)){

        //     $hsn_code = $row_tax['hsn'];

        //     $get_sum = "select sum(due_amount) as hsn_total from customer_orders where hsn='$hsn_code' and invoice_no='$invoice_id'";

        //     $run_sum = mysqli_query($con,$get_sum);

        //     $row_sum = mysqli_fetch_array($run_sum);

        //     $hsn_total = $row_sum['hsn_total'];

        //     $get_taxcat = "select * from taxes where hsn_code='$hsn_code'";

        //     $run_taxcat = mysqli_query($con,$get_taxcat);

        //     $row_taxcat = mysqli_fetch_array($run_taxcat);

        //     $cgst = $row_taxcat['cgst'];

        //     $sgst = $row_taxcat['sgst'];

        //     $cess = $row_taxcat['cess'];

        //     $hsn_cgst = $hsn_total*($cgst/100);

        //     $hsn_sgst = $hsn_total*($sgst/100);

        //     $hsn_cess = $hsn_total*($cess/100);

        ?>
            <!-- <tr>
                <td scope="row"><?php echo $hsn_code; ?></td>
                <td><?php //echo $hsn_cgst.'('.$cgst.'%)'; ?></td>
                <td><?php //echo $hsn_sgst.'('.$sgst.'%)'; ?></td>
                <td><?php //echo $hsn_cess.'('.$cess.'%)'; ?></td>
                <td><?php //echo $hsn_cgst+$hsn_sgst+$hsn_cess; ?></td>
            </tr> -->
    <?php //} ?>
        <!-- </tbody>
    </table>
    </div> -->
    <div class="col-12">
        <!-- <h4 class="text-center">YOU SAVED ₹ <?php //echo $you_saved; ?><br> on this order</h2> -->
        <h5 class="text-center">Thank You</h5>
        <h6 class="text-center">Order Again : www.karwars.in</h6>
    </div>
<!-- </div> -->
</div>

</body>
</html>



