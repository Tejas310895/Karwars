<?php 

    include("includes/db.php");

?>

<?php 

if(isset($_POST['view'])){

    $from = $_POST['start'];

    $to = $_POST['end'];

    if($_POST['status']=='All'){

        $status = "order_status in ('Order Placed' , 'Delivered' , 'Out For Delivery' , 'Cancelled' , 'Refunded')";
    }else{

    $status = "order_status='".$_POST['status']."'";
    }

    $counter = 0;

    $get_invoice = "SELECT DISTINCT(invoice_no) FROM customer_orders where $status and order_date between '$from' and '$to'";

    $run_invoice = mysqli_query($con,$get_invoice);

    while($row_invoice=mysqli_fetch_array($run_invoice)){

        $invoice_no = $row_invoice['invoice_no'];

        $get_pro_inc = "select * from customer_orders where invoice_no='$invoice_no'";

        $run_pro_inc = mysqli_query($con,$get_pro_inc);

            $row_pro_inc=mysqli_fetch_array($run_pro_inc);

            $status = $row_pro_inc['order_status'];
            $order_date = $row_pro_inc['order_date'];
            $customer_id = $row_pro_inc['customer_id'];
            $add_id = $row_pro_inc['add_id'];
            $pro_id = $row_pro_inc['pro_id'];
            $qty = $row_pro_inc['qty'];
            $due_amount = $row_pro_inc['due_amount'];

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

    $margin =$due_amount*0.05;
    $counter = $counter+1;

    echo "
    <tr>
        <td class='text-center'>$counter</td>
        <td class='text-center'>$status</td>
        <td class='text-center'>$invoice_no</td>
        <td class='text-center'>$order_date</td>
        <td class='text-center'>$Order_by</td>
        <td class='text-center'>$Contact</td>
        <td class='text-center'>$address, $phase, $landmark, $city</td>
        <td class='text-center'>$pro_name-$pro_desc</td>
        <td class='text-center'>$pro_price</td>
        <td class='text-center'>$qty</td>
        <td class='text-center'>$due_amount</td>
        <td class='text-center'>$margin</td>
    </tr>
    ";

}

}

?>
