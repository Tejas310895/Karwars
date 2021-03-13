<?php 

    include("includes/db.php");

?>

<?php 

if(isset($_POST['view'])){

    $from = $_POST['start'];

    $to = $_POST['end'];

    $a = 'Order Placed';

    $b = ' Delivered';

    $c = 'Out For Delivery';

    $order_status = $a.$b.$c;

    $counter = 0;

    $get_bstock = "SELECT distinct pro_id from customer_orders where order_status='Delivered' and product_status='Deliver' and date(order_date) between '$from' and '$to'";

    $run_bstock = mysqli_query($con,$get_bstock);
                        
    while($row_bstock = mysqli_fetch_array($run_bstock)){

    $pro_id = $row_bstock['pro_id'];

    $get_qtysum = "SELECT SUM(qty) AS bulk_qty FROM customer_orders where pro_id='$pro_id' and order_status='Delivered' and product_status='Deliver' and date(order_date) between '$from' and '$to'";

    $run_qtysum = mysqli_query($con,$get_qtysum);

    $row_qtysum = mysqli_fetch_array($run_qtysum);

    $bulk_qty = $row_qtysum['bulk_qty'];

    $get_pricesum = "SELECT SUM(due_amount) AS total_price FROM customer_orders where pro_id='$pro_id' and order_status='Delivered' and product_status='Deliver' and date(order_date) between '$from' and '$to'";

    $run_pricesum = mysqli_query($con,$get_pricesum);

    $row_pricesum = mysqli_fetch_array($run_pricesum);

    $bulk_price = $row_pricesum['total_price'];
    
    $get_prodet = "select * from products where product_id='$pro_id'";

    $run_prodet = mysqli_query($con,$get_prodet);

    $row_prodet = mysqli_fetch_array($run_prodet);

    $pro_title = $row_prodet['product_title'];

    $pro_desc = $row_prodet['product_desc'];

    $pro_price = $row_prodet['product_price'];

    $pro_price = $row_prodet['product_price'];

    $client_id = $row_prodet['client_id'];

    $get_client = "select * from clients where client_id='$client_id'";

            $run_client = mysqli_query($con,$get_client);

            $row_client = mysqli_fetch_array($run_client);

            $client = $row_client['client_shop'];


    $counter = $counter+1;

    echo "
    <tr>
        <td class='text-center'> $counter </td>
        <td class='text-center'>$client</td>
        <td class='text-center'>$pro_title</td>
        <td class='text-center'>$pro_desc</td>
        <td class='text-center'>$bulk_qty</td>
        <td class='text-center'>$bulk_qty</td>
        <td class='text-center'>$bulk_price</td>
    </tr>
    ";

}

}


if(isset($_POST['show'])){

    $from = $_POST['start'];

    $to = $_POST['end'];

    if($_POST['status']=='All'){

        $status = "order_status in ('Order Placed', 'Packed'  , 'Delivered' , 'Out For Delivery' , 'Cancelled' , 'Refunded')";
    }else{

    $status = "order_status='".$_POST['status']."'";
    }

    $counter = 0;

    $get_invoice = "SELECT * FROM customer_orders where  $status and date(order_date) between '$from' and '$to'";

    $run_invoice = mysqli_query($con,$get_invoice);

    while($row_invoice=mysqli_fetch_array($run_invoice)){

        $invoice_no = $row_invoice['invoice_no'];

        // $get_pro_inc = "select * from customer_orders where invoice_no='$invoice_no'";

        // $run_pro_inc = mysqli_query($con,$get_pro_inc);

        //     $row_pro_inc=mysqli_fetch_array($run_pro_inc);

            $status = $row_invoice['product_status'];
            $order_date = $row_invoice['order_date'];
            $customer_id = $row_invoice['customer_id'];
            $add_id = $row_invoice['add_id'];
            $pro_id = $row_invoice['pro_id'];
            $qty = $row_invoice['qty'];
            $due_amount = $row_invoice['due_amount'];
            $client_id = $row_invoice['client_id'];

            $pro_price = $due_amount/$qty;

            $get_customer = "select * from customers where customer_id='$customer_id'";

            $run_customer = mysqli_query($con,$get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

            $Order_by = $row_customer['customer_name'];
            $Contact = $row_customer['customer_contact'];

            $get_add = "select * from customer_address where add_id='$add_id'";

            $run_add = mysqli_query($con,$get_add);

            $row_add = mysqli_fetch_array($run_add);

            $city = $row_add['customer_city'];
            $landmark = $row_add['customer_landmark'];
            $phase = $row_add['customer_phase'];
            $address = $row_add['customer_address'];
            
            $get_pro = "select * from products where product_id='$pro_id'";

            $run_pro = mysqli_query($con,$get_pro);

            $row_pro = mysqli_fetch_array($run_pro);

            $pro_name = $row_pro['product_title'];
            $pro_desc = $row_pro['product_desc'];
            $pro_price = $row_pro['product_price'];
            $ven_price = $row_pro['vendor_price'];

            $get_client = "select * from clients where client_id='$client_id'";

            $run_client = mysqli_query($con,$get_client);

            $row_client = mysqli_fetch_array($run_client);

            $client = $row_client['client_shop'];

    $margin =$due_amount*0.05;
    $counter = $counter+1;

    echo "
    <tr>
        <td class='text-center'>$counter</td>
        <td class='text-center'>$client</td>
        <td class='text-center'>$status</td>
        <td class='text-center'>$invoice_no</td>
        <td class='text-center'>$order_date</td>
        <td class='text-center'>$Order_by</td>
        <td class='text-center'>$Contact</td>
        <td class='text-center'>$address, $phase, $landmark, $city</td>
        <td class='text-center'>$pro_name-$pro_desc</td>
        <td class='text-center'>$pro_price</td>
        <td class='text-center'>$ven_price</td>
        <td class='text-center'>$qty</td>
        <td class='text-center'>$due_amount</td>
    </tr>
    ";

}

}

if(isset($_POST['add_promo'])){

    $promo_id = $_POST['promo_id'];
    $store_id = $_POST['store_id'];

    $update_promo = "update promo_products set store_id='$store_id' where promo_id='$promo_id'";
    $run_update_promo = mysqli_query($con,$update_promo);

    if($run_update_promo){
        echo "<script>alert('Promo Added')</script>";
  
        echo "<script>window.open('index.php?promo_store','_self')</script>";  
    }else{
        echo "<script>alert('Promo Failed')</script>";
  
        echo "<script>window.open('index.php?promo_store','_self')</script>";  
    }


}

?>
