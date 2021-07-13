<?php 

include("includes/db.php");

date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d H:i:s");

$current_month = date("m");

$current_year = date("Y");

?>
<?php

    // multiple recipients
// $to  = 'aidan@example.com' . ', '; 
// $to .= 'wez@example.com';
$to  = 'tshirsat700@gmail.com'; 

// subject
$subject = 'Daily Reports';

// message
$message = "
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <table style='border: 1px solid black;text-align:center;'>
    <thead>
        <tr>
            <th>Date</th>
            <th>Orders</th>
            <th>Amount</th>
            <th>Margin</th>
            <th>DLC Credit</th>
            <th>DLC Debit</th>
            <th>Discount</th>
            <th>Profits</th>
        </tr>
    </thead>
    <tbody>";

$get_montly_report = "SELECT * FROM customer_orders WHERE MONTH(order_date) = $current_month AND YEAR(order_date) = $current_year AND order_status='Delivered' group by DAY(order_date)";
$run_montly_report = mysqli_query($con,$get_montly_report);
$orders_gt = 0;
$amount_gt = 0;
$margin_st = 0;
$dlc_credits_gt = 0;
$dlc_debits_gt = 0;
$discounts_gt = 0;
while($row_montly_report=mysqli_fetch_array($run_montly_report)){
    $report_date = $row_montly_report['order_date'];
    $day_format = date('d-M',strtotime($report_date));

    $str_date = date('Y-m-d',strtotime($report_date));

    $get_orders_sum = "SELECT * from customer_orders where CAST(order_date as DATE)='$str_date' and order_status='Delivered' group by invoice_no";
    $run_orders_sum = mysqli_query($con,$get_orders_sum);
    $orders_sum = mysqli_num_rows($run_orders_sum);

    $dlc_credits_total = 0;
    $discount_total = 0;
    while($row_orders_sum=mysqli_fetch_array($run_orders_sum)){

        $invoice_no = $row_orders_sum['invoice_no'];

        $get_dlc_credit = "select sum(del_charges) as dlc_credits from order_charges where invoice_id='$invoice_no'";
        $run_dlc_credits = mysqli_query($con,$get_dlc_credit);
        $row_dlc_credits = mysqli_fetch_array($run_dlc_credits);
    
        $dlc_credits = $row_dlc_credits['dlc_credits'];  
        
        $dlc_credits_total += $dlc_credits;

        $get_discounts = "select sum(discount_amount) as discounts from customer_discounts where invoice_no='$invoice_no'";
        $run_discounts = mysqli_query($con,$get_discounts);
        $row_discounts = mysqli_fetch_array($run_discounts);

        $discounts = $row_discounts['discounts'];

        $discount_total += $discounts;

    }

    $get_amount_sum = "SELECT sum(due_amount) as amount_sum from customer_orders where CAST(order_date as DATE)='$str_date' and order_status='Delivered' and product_status='Deliver' group by invoice_no";
    $run_amount_sum = mysqli_query($con,$get_amount_sum);
    $row_amount_sum = mysqli_fetch_array($run_amount_sum);

    $amount_sum = $row_amount_sum['amount_sum'];
    $margin = $amount_sum*0.07;
    $dlc_debits = $orders_sum*40;
    $profits = ($margin-$dlc_debits-$discount_total)+$dlc_credits_total;

    $orders_gt += $orders_sum;
    $amount_gt += $amount_sum;
    $margin_st += ($amount_sum*0.07);
    $dlc_credits_gt += $dlc_credits_total;
    $dlc_debits_gt += ($orders_sum*40);
    $discounts_gt += $discount_total;
$message .="

<tr>
<td>$day_format</td>
<td>$orders_sum</td>
<td>$amount_sum</td>
<td>$margin</td>
<td>$dlc_credits_total</td>
<td>$dlc_debits</td>
<td>$discount_total</td>
<td>$profits</td>
</tr>

";

}
$profits_gt = ($margin_st-$dlc_debits_gt-$discounts_gt)+$dlc_credits_gt;
$message .= "
<tfoot>
<tr>
    <th>Total</th>
    <th>$orders_gt</th>
    <th>$amount_gt</th>
    <th>$margin_st</th>
    <th>$dlc_credits_gt</th>
    <th>$dlc_debits_gt</th>
    <th>$discounts_gt</th>
    <th>$profits_gt</th>
</tr>
</tfoot>
</tbody>
</table>
</body>
</html>
";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Tejas <tshirsat700@gmail.com>' . "\r\n";
$headers .= 'From: Tejas <tshirsat700@gmail.com>' . "\r\n";
// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
