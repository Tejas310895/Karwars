<?php 

include("includes/db.php");

if(isset($_GET['clientbill_mail'])){
    
    $invoice_id = $_GET['clientbill_mail'];
    
    $get_client = "SELECT DISTINCT(client_id) from customer_orders where invoice_no='$invoice_id'";
    $run_client = mysqli_query($con,$get_client);
    while($row_client=mysqli_fetch_array($run_client)){

        $client_id = $row_client['client_id'];
        
        $get_client_details = "select * from clients where client_id='$client_id'";
        $run_client_details = mysqli_query($con,$get_client_details);
        $row_client_details = mysqli_fetch_array($run_client_details);

        $client_email = $row_client_details['client_email'];

        //HTML mail function

        $to = $client_email;
        $subject = 'Karwars Order ('.$invoice_id.')';
        $from = 'karwarsgrocery@gmail.com';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $message = '<html><body>';
        $message .= '<h1 style="color:#999;font-size:1.5rem;text-align:center;">Your Bill Link</h1>';
        $message .= 'https://karwars.in/admin_area/clientbill.php?bill='.$invoice_id.'&client='.$client_id;
        $message .= '</body></html>';

        $sendmail = mail($to, $subject, $message, $headers);
       }

       if($sendmail==true){
        echo "<script>alert('Mail Sent')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";
       }else{
        echo "<script>alert('Mail Failed')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";
       }
    }

    if(isset($_GET['delbill_mail'])){
    
        $invoice_id = $_GET['delbill_mail'];
    
            //HTML mail function
    
            $to = 'karwarsgrocery@gmail.com';
            $subject = 'Karwars Order ('.$invoice_id.')';
            $from = 'tshirsat700@gmail.com';
    
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
            $message = '<html><body>';
            $message .= '<h1 style="color:#999;font-size:1.5rem;text-align:center;">Your Bill Link</h1>';
            $message .= 'https://karwars.in/admin_area/print.php?print='.$invoice_id;
            $message .= '</body></html>';
    
            $sendmail = mail($to, $subject, $message, $headers);
    
           if($sendmail==true){
            echo "<script>alert('Mail Sent')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
           }else{
            echo "<script>alert('Mail Failed')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
           }
        }
?>