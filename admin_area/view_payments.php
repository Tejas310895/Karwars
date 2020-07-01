
<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PAYMENT DETAILS</h2>
           </div>
       </div>

<div class="row">
<table class="table">
    <thead class="text-center">
        <tr>
            <th>TXNDATE</th>
            <th>ORDERID</th>
            <th>TXNAMOUNT</th>
            <th>STATUS</th>
            <th>GATEWAYNAME</th>
            <th>RESPMSG</th>
            <th>BANKNAME</th>
            <th>PAYMENTMODE</th>
            <th>TXNID</th>
            <th>BANKTXNID</th>
        </tr>
    </thead>
    <tbody class="text-center">
            <?php
            
            $get_payment = "select * from paytm order by payment_id DESC";

            $run_payment = mysqli_query($con,$get_payment);

            while($row_payment=mysqli_fetch_array($run_payment)){

                $GATEWAYNAME = $row_payment['GATEWAYNAME'];
                $RESPMSG = $row_payment['RESPMSG'];
                $BANKNAME = $row_payment['BANKNAME'];
                $PAYMENTMODE = $row_payment['PAYMENTMODE'];
                $RESPCODE = $row_payment['RESPCODE'];
                $TXNID = $row_payment['TXNID'];
                $TXNAMOUNT = $row_payment['TXNAMOUNT'];
                $ORDERID = $row_payment['ORDERID'];
                $STATUS = $row_payment['STATUS'];
                $BANKTXNID = $row_payment['BANKTXNID'];
                $TXNDATE = $row_payment['TXNDATE'];
                $CHECKSUMHASH = $row_payment['CHECKSUMHASH'];

            
            ?>
        <tr>
            <td><?php echo $TXNDATE; ?></td>
            <td><?php echo $ORDERID; ?></td>
            <td><?php echo $TXNAMOUNT; ?></td>
            <td><?php echo $STATUS; ?></td>
            <td><?php echo $GATEWAYNAME; ?></td>
            <td><?php echo $RESPMSG; ?></td>
            <td><?php echo $BANKNAME; ?></td>
            <td><?php echo $PAYMENTMODE; ?></td>
            <td><?php echo $TXNID; ?></td>
            <td><?php echo $BANKTXNID; ?></td>
        </tr>
            <?php } ?>
    </tbody>
</table>
</div>


<?php } ?>