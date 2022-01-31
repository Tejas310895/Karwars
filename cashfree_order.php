<?php


if (isset($_POST['c_id'])) {

    $customer_id = $_POST['c_id'];

    $add_id = $_POST['add_id'];

    // $schedule_date = $_POST['schedule_date'];

    //$date = $_POST['date'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $get_contact = "select * from customers where customer_id='$customer_id'";

    $run_contact = mysqli_query($con, $get_contact);

    $row_contact = mysqli_fetch_array($run_contact);

    $c_contact = $row_contact['customer_contact'];
    $c_name = $row_contact['customer_name'];

    $get_unique = "SELECT * from customer_orders order by order_id DESC LIMIT 1";

    $run_unique = mysqli_query($con, $get_unique);

    $row_unique = mysqli_fetch_array($run_unique);

    $unique_num = $row_unique['order_id'];

    $user_id = getuserid();

    $status = "Order Placed";

    $invoice_no = $unique_num . mt_rand();

    $select_cart = "select * from cart where user_id='$user_id'";

    $run_cart = mysqli_query($con, $select_cart);

    $txn_amount = 0;
    while ($row_cart = mysqli_fetch_array($run_cart)) {

        $pro_id = $row_cart['p_id'];

        $pro_qty = $row_cart['qty'];

        $get_products = "select * from products where product_id='$pro_id'";

        $run_products = mysqli_query($con, $get_products);

        $row_products = mysqli_fetch_array($run_products);

        $sub_total = $row_products['product_price'] * $pro_qty;
        // $vendor_sub_total = $row_products['vendor_price']*$pro_qty;

        $txn_amount += $sub_total;

        //         $client_id = $row_products['client_id'];

        //         $insert_customer_order = "insert into customer_orders (customer_id,add_id,pro_id,due_amount,vendor_due_amount,invoice_no,qty,order_date,del_date,order_schedule,order_status,product_status,client_id) 
        //         values ('$customer_id','$add_id',' $pro_id','$sub_total','$vendor_sub_total','$invoice_no','$pro_qty','$today','$today','$today','$status','Deliver','$client_id')";

        //         $run_customer_order = mysqli_query($con,$insert_customer_order);

        //         $delete_cart = "delete from cart where user_id='$user_id'";

        //         $run_delete = mysqli_query($con,$delete_cart);

        //         $update_stock = "UPDATE products SET product_stock=product_stock-'$pro_qty' WHERE product_id='$pro_id'";

        //         $run_update_stock = mysqli_query($con,$update_stock);


    }

    // if($run_customer_order){

    $get_del_charges = "select * from admins";
    $run_del_charges = mysqli_query($con, $get_del_charges);
    $row_del_charges = mysqli_fetch_array($run_del_charges);

    if ($txn_amount < 499) {
        $del_charges = $row_del_charges['del_charges'];
    } else {
        $del_charges = 0;
    }
    // }
    if (isset($_POST['coupon_id'])) {
        $coupon_id = $_POST['coupon_id'];

        $get_dis_total = "select sum(due_amount) as dis_total from customer_orders WHERE invoice_no='$invoice_no'";
        $run_dis_total = mysqli_query($con, $get_dis_total);
        $row_dis_total = mysqli_fetch_array($run_dis_total);

        $dis_total = $row_dis_total['dis_total'];

        $get_coupon_det = "select * from coupons where coupon_id='$coupon_id'";
        $run_coupon_det = mysqli_query($con, $get_coupon_det);
        $row_coupon_det = mysqli_fetch_array($run_coupon_det);

        $dis_coupon_code = $row_coupon_det['coupon_code'];
        $dis_coupon_type = $row_coupon_det['coupon_type'];

        $get_coupon_dis_req = "select * from coupon_controls where coupon_code='$dis_coupon_code'";
        $run_coupon_dis_req = mysqli_query($con, $get_coupon_dis_req);
        $row_coupon_dis_req = mysqli_fetch_array($run_coupon_dis_req);

        $dis_coupon_unit = $row_coupon_dis_req['coupon_unit'];
        $dis_coupon_use_id = $row_coupon_dis_req['coupon_use_id'];
        $dis_upto_limit = $row_coupon_dis_req['upto_limit'];

        if ($dis_coupon_type === 'percent') {
            $percent_off = round($dis_total * ($dis_coupon_unit / 100));
            if ($percent_off > $dis_upto_limit) {
                $dis_amt = $dis_upto_limit;
                $txn_total = ($txn_amount + $del_charges) - $dis_amt;
            } else {
                $dis_amt = $percent_off;
                $txn_total = ($txn_amount + $del_charges) - $dis_amt;
            }
        } elseif ($dis_coupon_type === 'amount') {
            $dis_amt = $dis_coupon_unit;
            $txn_total = ($txn_amount + $del_charges) - $dis_amt;
        } elseif ($dis_coupon_type === 'product') {
            $get_off_pro_det = "select * from products where product_id='$dis_coupon_use_id'";
            $run_off_pro_det = mysqli_query($con, $get_off_pro_det);
            $row_off_pro_det = mysqli_fetch_array($run_off_pro_det);

            $dis_amt = $row_off_pro_det['product_price'];
            $txn_total = ($txn_amount + $del_charges) + $dis_amt;
        }
    } else {
        $txn_total = ($txn_amount + $del_charges);
        $coupon_id = 0;
    }

    echo "<script>alert($percent_off)</script>";

    // }

    $get_pending_check = "select * from pending_orders where invoice_no='$invoice_no'";
    $run_pending_check = mysqli_query($con, $get_pending_check);
    $pending_check = mysqli_num_rows($run_pending_check);
    if ($pending_check >= 1) {
        $delete_pending = "delete from pending_orders where invoice_no='$invoice_no'";
        $run_delete_pending = mysqli_query($con, $delete_pending);

        if ($run_delete_pending) {

            $insert_pending = "insert into pending_orders (customer_id,
                                                                invoice_no,
                                                                coupon_id,
                                                                add_id,
                                                                created_at,
                                                                updated_at) 
                                                                values 
                                                                ('$customer_id',
                                                                '$invoice_no',
                                                                '$coupon_id',
                                                                '$add_id',
                                                                '$today',
                                                                '$today')";
            $run_insert_pending = mysqli_query($con, $insert_pending);
        }
    } else {

        $insert_pending = "insert into pending_orders (customer_id,
                                                            invoice_no,
                                                            coupon_id,
                                                            add_id,
                                                            created_at,
                                                            updated_at) 
                                                            values 
                                                            ('$customer_id',
                                                            '$invoice_no',
                                                            '$coupon_id',
                                                            '$add_id',
                                                            '$today',
                                                            '$today')";
        $run_insert_pending = mysqli_query($con, $insert_pending);
    }

    // if($run_customer_order){

    //     $invoice_no = $invoice_no;

    // $text = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20click%20here%20to%20View%20Details%20:-%20http://www.wernear.in/customer/order_view?invoice_no=$invoice_no";

    // //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
    // $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
    // // Initialize a CURL session. 
    // $ch = curl_init();  

    // // Return Page contents. 
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // //grab URL and pass it to the variable. 
    // curl_setopt($ch, CURLOPT_URL, $url); 

    // $result = curl_exec($ch);

    if ($run_insert_pending) {
        include('cashfree/request.php');
    } else {
        echo "<script>alert('Order Failed')</script>";
        echo "<script>window.open('cart','_self')</script>";
    }


    // }else{

    //     echo "<script>alert('Order Failed')</script>";

    //     echo "<script>window.open('cart','_self')</script>";
}
