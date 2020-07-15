
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
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    <tbody class="text-center" style="font-size:12px;">
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

<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='js/datatable.js'></script>

<?php } ?>