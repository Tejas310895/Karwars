<?php 

    include("includes/db.php");

?>
<?php 

if(isset($_POST['dshow'])){

    $from = $_POST['dstart'];

    $to = $_POST['dend'];

    if($_POST['dstatus']=='All'){

        $status = "order_status in ('Order Placed', 'Packed'  , 'Delivered' , 'Out For Delivery' , 'Cancelled' , 'Refunded')";
    }else{

    $status = "order_status='".$_POST['dstatus']."'";
    }


?>

<?php
                
$get_invoice = "SELECT DISTINCT invoice_no FROM customer_orders where  $status and date(del_date) between '$from' and '$to' ORDER BY order_id DESC";

$run_invoice = mysqli_query($con,$get_invoice);

while($row_invoice=mysqli_fetch_array($run_invoice)){

$invoice_id = $row_invoice['invoice_no'];

$get_orders = "select * from customer_orders where invoice_no='$invoice_id'";

$run_orders = mysqli_query($con,$get_orders);

$order_count = mysqli_num_rows($run_orders);

$row_orders = mysqli_fetch_array($run_orders);

$c_id = $row_orders['customer_id'];

$date = $row_orders['order_date'];

$add_id = $row_orders['add_id'];

$status = $row_orders['order_status'];

$order_date = $row_orders['order_date'];

$get_total = "SELECT sum(due_amount) AS total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver'";

$run_total = mysqli_query($con,$get_total);

$row_total = mysqli_fetch_array($run_total);

$total = $row_total['total'];

$get_pur_total = "SELECT sum(vendor_due_amount) AS pur_total FROM customer_orders WHERE invoice_no='$invoice_id' and product_status='Deliver'";

$run_pur_total = mysqli_query($con,$get_pur_total);

$row_pur_total = mysqli_fetch_array($run_pur_total);

$pur_total = $row_pur_total['pur_total'];

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

$get_txn = "select * from paytm where ORDERID='$invoice_id'";

$run_txn = mysqli_query($con,$get_txn);

$row_txn = mysqli_fetch_array($run_txn);

$txn_status = $row_txn['STATUS'];

$get_discount = "select * from customer_discounts where invoice_no='$invoice_id'";
$run_discount = mysqli_query($con,$get_discount);
$row_discount = mysqli_fetch_array($run_discount);

$coupon_code = $row_discount['coupon_code'];
$discount_type = $row_discount['discount_type'];
$discount_amount = $row_discount['discount_amount'];

    if($discount_type==='amount'){

    $d_c = "-".$discount_amount;

    }elseif ($discount_type==='product') {

    $get_off_pro = "select * from products where product_id='$discount_amount'";
    $run_off_pro = mysqli_query($con,$get_off_pro);
    $row_off_pro = mysqli_fetch_array($run_off_pro);

    $off_product_price = $row_off_pro['product_price'];

    $d_c = "+".$off_product_price;
    
    }elseif (empty($discount_type)) {

    $d_c = 0;
    
    }

$get_del_charges = "select * from order_charges where invoice_id='$invoice_id'";
$run_del_charges = mysqli_query($con,$get_del_charges);
$row_del_charges = mysqli_fetch_array($run_del_charges);

$del_charges = $row_del_charges['del_charges'];

$get_del_charges_paid = "select * from orders_delivery_assign where invoice_no='$invoice_id'";
$run_del_charges_paid = mysqli_query($con,$get_del_charges_paid);
$row_del_charges_paid = mysqli_fetch_array($run_del_charges_paid);

$del_charges_paid = $row_del_charges_paid['delivery_charges'];


$get_bill_diff = "select * from bill_controller where invoice_no='$invoice_id'";
$run_bill_diff = mysqli_query($con,$get_bill_diff);
$bill_diff_total = 0;
while($row_bill_diff = mysqli_fetch_array($run_bill_diff)){

$bill_diff_amount = $row_bill_diff['bill_amount'];
$bill_diff_total += $bill_diff_amount;

}

$get_tax_pro_id = "select * from customer_orders where invoice_no='$invoice_id' and product_status='Deliver'";

$run_tax_pro_id = mysqli_query($con,$get_tax_pro_id);


$taxr = 0;

$taxp = 0;

while($row_tax_pro_id = mysqli_fetch_array($run_tax_pro_id)){

$pro_id_tax = $row_tax_pro_id['pro_id'];

$sub_tax_total = $row_tax_pro_id['due_amount'];

$vendor_sub_tax_total = $row_tax_pro_id['vendor_due_amount'];

$get_tax_pro = "select * from products where product_id='$pro_id_tax'";

$run_tax_pro = mysqli_query($con,$get_tax_pro);

$row_tax_pro = mysqli_fetch_array($run_tax_pro);

$tax = $row_tax_pro['product_gst_rate'];

$unit_taxr = $sub_tax_total*($tax/100);

$unit_taxp = $vendor_sub_tax_total*($tax/100);

$taxr += $unit_taxr;

$taxp += $unit_taxp;

}

// if($discount_type==='amount'){

//     $grand_total = $total;

//   }elseif ($discount_type==='product') {

//     $get_off_pro = "select * from products where product_id='$discount_amount'";
//     $run_off_pro = mysqli_query($con,$get_off_pro);
//     $row_off_pro = mysqli_fetch_array($run_off_pro);

//     $off_product_price = $row_off_pro['product_price'];

//     $grand_total = ($total+$del_charges)+$off_product_price;
    
//   }elseif (empty($discount_type)) {

//     $grand_total = $total;
    
//   }

?>
        <tr class="text-center">
        <td style="font-size:0.8rem;"><?php echo $status; ?></td>
        <td style="font-size:0.8rem;"><?php echo $invoice_id; ?></td>
        <td style="font-size:0.8rem;"><?php echo $order_date; ?></td>
        <td style="font-size:0.8rem;"><?php echo $c_name; ?></td>
        <td style="font-size:0.8rem;">+91 <?php echo $c_contact; ?></td>
        <!-- <td style="font-size:0.8rem;"><?php //echo $customer_address; ?>, 
            <?php //echo $customer_phase; ?>, 
            <?php //echo $customer_landmark; ?>, 
            <?php //echo $customer_city; ?> .
        </td> -->
        <td style="font-size:0.7rem; text-align:center;"><?php echo $order_count; ?></td>
        <td style="font-size:0.7rem;">₹ <?php echo $total; ?></td>
        <td style="font-size:0.7rem;">₹ <?php echo round($pur_total,2); ?></td>
        <td style="font-size:0.7rem;">₹ <?php echo round($taxr,2); ?></td>
        <td style="font-size:0.7rem;">₹ <?php echo round($taxp,2); ?></td>
        <td style="font-size:0.7rem; text-align:center;"><?php if($del_charges>0){echo$del_charges;}else{echo 0;} ;?></td>
        <td style="font-size:0.7rem; text-align:center;"><?php if(isset($del_charges_paid)){echo $del_charges_paid;}else{echo 0;} ;?></td>
        <td style="font-size:0.7rem; text-align:center;"><?php echo $d_c;?></td>
        <td><?php if($txn_status=='SUCCESS'){echo"PRE";}else{echo"POST";} ; ?></td>
        <td class="td-actions" >
        <button id="show_details" class="btn btn-info btn-sm p-1" style="font-size:0.7rem;" data-toggle="modal" data-target="#KK<?php echo $invoice_id; ?>">
        <svg id="Capa_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#fff"/><stop offset="1" stop-color="#fff"/></linearGradient><g><g><path d="m509.188 247.27c-4.571-6.387-114.526-156.27-253.188-156.27s-248.617 149.883-253.187 156.27c-3.75 5.215-3.75 12.246 0 17.461 4.57 6.386 114.525 156.269 253.187 156.269s248.617-149.883 253.188-156.27c3.75-5.214 3.75-12.246 0-17.46zm-253.188 143.73c-105.176 0-197.143-103.813-222.074-135 24.931-31.187 116.898-135 222.074-135s197.143 103.813 222.074 135c-24.931 31.187-116.898 135-222.074 135zm0-240c-57.891 0-105 47.109-105 105s47.109 105 105 105 105-47.109 105-105-47.109-105-105-105zm0 180c-41.367 0-75-33.647-75-75s33.633-75 75-75 75 33.647 75 75-33.633 75-75 75zm0-120c-24.814 0-45 20.186-45 45s20.186 45 45 45 45-20.186 45-45-20.186-45-45-45zm0 60c-8.262 0-15-6.724-15-15s6.738-15 15-15 15 6.724 15 15-6.738 15-15 15zm0-211c8.291 0 15-6.709 15-15v-30c0-8.291-6.709-15-15-15s-15 6.709-15 15v30c0 8.291 6.709 15 15 15zm0 392c-8.291 0-15 6.709-15 15v30c0 8.291 6.709 15 15 15s15-6.709 15-15v-30c0-8.291-6.709-15-15-15zm-117.979-370.36c4.081 7.12 13.237 9.65 20.479 5.493 7.178-4.146 9.639-13.315 5.479-20.493l-15-25.986c-4.131-7.178-13.359-9.624-20.479-5.493-7.178 4.146-9.639 13.315-5.479 20.493zm235.958 348.72c-4.102-7.192-13.301-9.653-20.479-5.493-7.178 4.146-9.639 13.315-5.479 20.493l15 25.986c4.081 7.12 13.237 9.65 20.479 5.493 7.178-4.146 9.639-13.315 5.479-20.493zm-20.479-343.227c7.242 4.157 16.399 1.625 20.479-5.493l15-25.986c4.16-7.178 1.699-16.348-5.479-20.493-7.148-4.087-16.348-1.67-20.479 5.493l-15 25.986c-4.16 7.177-1.699 16.347 5.479 20.493zm-195 337.734c-7.148-4.116-16.348-1.685-20.479 5.493l-15 25.986c-4.16 7.178-1.699 16.348 5.479 20.493 7.242 4.157 16.399 1.625 20.479-5.493l15-25.986c4.16-7.177 1.699-16.347-5.479-20.493z" fill="url(#SVGID_1_)"/></g></g></svg>
    </button>
        <!-- Modal -->
        <div class="modal modal-black fade" id="KK<?php echo $invoice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Order Id - <?php echo $invoice_id; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
                </div>
                <div class="modal-body my-3">
                <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">VENDOR</th>
                        <th class="text-center">ITEMS</th>
                        <th class="text-center">PACK</th>
                        <th class="text-center">QTY</th>
                        <th class="text-right">PRICE</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                
                $get_pro_id = "select * from customer_orders where invoice_no='$invoice_id'";

                $run_pro_id = mysqli_query($con,$get_pro_id);

                $counter = 0;

                while($row_pro_id = mysqli_fetch_array($run_pro_id)){

                $pro_id = $row_pro_id['pro_id'];

                $qty = $row_pro_id['qty'];

                $sub_total = $row_pro_id['due_amount'];

                $client_id = $row_pro_id['client_id'];

                $pro_price = $sub_total/$qty;  
                
                $pro_status = $row_pro_id['product_status'];

                $get_pro = "select * from products where product_id='$pro_id'";

                $run_pro = mysqli_query($con,$get_pro);

                $row_pro = mysqli_fetch_array($run_pro);

                $pro_title = $row_pro['product_title'];

                $pro_img1 = $row_pro['product_img1'];

                // $pro_price = $row_pro['product_price'];

                $pro_desc = $row_pro['product_desc'];
                
                // $sub_total = $pro_price * $qty;

                $get_client = "select * from clients where client_id='$client_id'";

                $run_client = mysqli_query($con,$get_client);

                $row_client = mysqli_fetch_array($run_client);

                $client_name = $row_client['client_shop'];

                
                ?>
                    <tr>
                        <td class="text-center"><?php echo $client_name; ?></td>
                        <td class="text-center"><?php echo $pro_title; ?></td>
                        <td class="text-center"><?php echo $pro_desc; ?></td>
                        <td class="text-center"><?php echo $qty; ?> x ₹<?php echo $pro_price; ?></td>
                        <td class="text-right">₹<?php echo $sub_total; ?></td>
                        <td class="text-right"><?php echo $pro_status; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                <h3 class="card-title">Total - ₹<?php echo $total; ?>/-</h3>
                </div>
            </div>
            </div>
        </div>
        </div>
        <a href="print.php?print=<?php echo $invoice_id; ?>" target="_blank" id="show_details" class="btn btn-danger btn-sm p-1" >
        <svg id="Capa_1" enable-background="new 0 0 512 512" fill="#fff" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><g><path d="m422.5 99v-24c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v24z"/><path d="m118.5 319v122 26 15c0 16.568 13.431 30 30 30h214c16.569 0 30-13.432 30-30v-15-26-122zm177 128h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15zm0-64h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/><path d="m436.5 129h-361c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h13v-80h-9c-8.284 0-15-6.716-15-15s6.716-15 15-15h24 304 24c8.284 0 15 6.716 15 15s-6.716 15-15 15h-9v80h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-309 94h-48c-8.284 0-15-6.716-15-15s6.716-15 15-15h48c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/></g></svg>
    </a>
    <a href="../customer/invoice?pdf=<?php echo $invoice_id ?>" target="_blank" id="show_details" class="btn btn-danger btn-sm p-1 mt-1 <?php if($status=='Delivered'){echo "show";}else{echo "d-none";} ?>" download>INVOICE</a>
        </td>
        </tr>
        <?php } ?>
        <?php } ?>