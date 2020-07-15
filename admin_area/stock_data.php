<?php 

    include("includes/db.php");

?>

<?php 

if(isset($_POST['view'])){

    $from = $_POST['start'];

    $to = $_POST['end'];

    $a = 'Order Placed';

    $b = ' Delivered';

    $order_status = $a.$b;

    $counter = 0;

    $get_bstock = "SELECT distinct pro_id from customer_orders where order_status in ('Order Placed' , 'Delivered') and order_date between '$from' and '$to'";

    $run_bstock = mysqli_query($con,$get_bstock);
                        
    while($row_bstock = mysqli_fetch_array($run_bstock)){

    $pro_id = $row_bstock['pro_id'];

    $get_qtysum = "SELECT SUM(qty) AS bulk_qty FROM customer_orders where pro_id='$pro_id' and order_status in ('Order Placed' , 'Delivered' , 'Out For Delivery') and order_date between '$from' and '$to'";

    $run_qtysum = mysqli_query($con,$get_qtysum);

    $row_qtysum = mysqli_fetch_array($run_qtysum);

    $bulk_qty = $row_qtysum['bulk_qty'];
    
    $get_prodet = "select * from products where product_id='$pro_id'";

    $run_prodet = mysqli_query($con,$get_prodet);

    $row_prodet = mysqli_fetch_array($run_prodet);

    $pro_title = $row_prodet['product_title'];

    $pro_desc = $row_prodet['product_desc'];

    $pro_price = $row_prodet['product_price'];

    $bulk_price = $bulk_qty*$pro_price;

    $counter = $counter+1;

    echo "
    <tr>
        <td class='text-center'> $counter </td>
        <td class='text-center'>$pro_title</td>
        <td class='text-center'>$pro_desc</td>
        <td class='text-center'>$bulk_qty</td>
        <td class='text-center'>$bulk_qty x $pro_price</td>
        <td class='text-center'>$bulk_price</td>
    </tr>
    ";

}

}

?>
