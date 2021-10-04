<?php 

include('../includes/db.php');
        $orderId = $_POST["orderId"];
        $orderAmount = $_POST["orderAmount"];
        $referenceId = $_POST["referenceId"];
        $txStatus = $_POST["txStatus"];
        $paymentMode = $_POST["paymentMode"];
        $txMsg = $_POST["txMsg"];
        $txTime = $_POST["txTime"];

        $get_cust_id = "select * from customer_orders where invoice_no='$orderId'";
        $run_cust_id = mysqli_query($con,$get_cust_id);
        $row_cust_id = mysqli_fetch_array($run_cust_id);

        $customer_id = $row_cust_id['customer_id'];

        $get_contact = "select * from customers where customer_id='$customer_id'";
        $run_contact = mysqli_query($con,$get_contact);
        $row_contact = mysqli_fetch_array($run_contact);
        $c_contact = $row_contact['customer_contact'];

        if($txStatus==='SUCCESS'){

        $insert_customer_order = "insert into paytm (CURRENCY,GATEWAYNAME,RESPMSG,BANKNAME,PAYMENTMODE,MID,RESPCODE,TXNID,TXNAMOUNT,ORDERID,STATUS,BANKTXNID,TXNDATE,CHECKSUMHASH) 
        values ('INR','$paymentMode','$txMsg','NIL','$paymentMode','NIL','NIL','$referenceId','$orderAmount','$orderId','$txStatus','NIL','$txTime','nil')";


            if($run_insert = mysqli_query($con,$insert_customer_order)){

                $text = "Payment%20Successful%20for%20order%20$orderId%20,Amount%20$orderAmount%20Received%20Thank%20you%20order%20again";
                $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
                // Initialize a CURL session. 
                $ch = curl_init();  
                
                // Return Page contents. 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
                //grab URL and pass it to the variable. 
                curl_setopt($ch, CURLOPT_URL, $url); 
                
                $result = curl_exec($ch);   

                $delete_previous = "delete from payment_links where invoice_id=$orderId";
                $run_delete_previous = mysqli_query($con,$delete_previous);

                echo "<script>alert('Payment Successful')</script>";
                echo "<script>window.open('../customer/pay_success','_self')</script>";
            }
        }else {
            echo "<script>alert('Payment Failed')</script>";
            echo "<script>window.open('../customer/pay_failed','_self')</script>";
        }



?>