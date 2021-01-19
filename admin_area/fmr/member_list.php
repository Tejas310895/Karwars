<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">FMR Members</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?fmr_details" class="btn btn-primary pull-right">FMR Details</a>
            <a href="index.php?register_fmr" class="btn btn-success pull-right">Register FMR</a>
           </div>
       </div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Registered On</th>
            <th>FMR Code</th>
            <th>Name</th>
            <th>Clients</th>
            <th>AMT Settled</th>
            <th>Debits</th>
            <th>Performance</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $counter = 0;
    $get_fmr_users = "select * from fmr_users";
    $run_fmr_users = mysqli_query($con,$get_fmr_users);
    while($row_fmr_users = mysqli_fetch_array($run_fmr_users)){

        $counter = ++$counter;
        $fmr_id = $row_fmr_users['fmr_id'];
        $fmr_unique_code = $row_fmr_users['fmr_unique_code'];
        $fmr_name = $row_fmr_users['fmr_name'];
        $fmr_email = $row_fmr_users['fmr_email'];
        $fmr_contact = $row_fmr_users['fmr_contact'];
        $fmr_dob = $row_fmr_users['fmr_dob'];
        $fmr_qualification = $row_fmr_users['fmr_qualification'];
        $fmr_address = $row_fmr_users['fmr_address'];
        $fmr_city = $row_fmr_users['fmr_city'];
        $fmr_pincode = $row_fmr_users['fmr_pincode'];
        $fmr_state = $row_fmr_users['fmr_state'];
        $fmr_pan_no = $row_fmr_users['fmr_pan_no'];
        $fmr_addhar_no = $row_fmr_users['fmr_addhar_no'];
        $fmr_join_date = $row_fmr_users['fmr_join_date'];
        $fmr_status = $row_fmr_users['fmr_status'];
    
    ?>
        <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo date('d/M/Y@h:i a',strtotime($fmr_join_date)); ?></td>
            <td><?php echo $fmr_unique_code; ?></td>
            <td><?php echo $fmr_name; ?><small class="text-success text-uppercase">(<?php echo $fmr_status; ?>)</small></td>
            <?php 
            
            $get_fmr_client = "select * from fmr_clients where fmr_id='$fmr_id'";
            $run_fmr_client = mysqli_query($con,$get_fmr_client);
            $count_client = mysqli_num_rows($run_fmr_client);
            
            ?>
            <td><?php echo $count_client; ?></td>
            <?php 
            
            $get_settle_amt = "select sum(settlement_amt) as settle_total from fmr_settlements where fmr_id='$fmr_id'";
            $run_settle_amt = mysqli_query($con,$get_settle_amt);
            $row_settle_amt = mysqli_fetch_array($run_settle_amt);

            $settle_total = $row_settle_amt['settle_total'];
            
            ?>
            <td><?php echo $settle_total; ?></td>

            <?php 
            
            $get_debit_amt = "select sum(fmr_debit_amt) as debit_total from fmr_debits where fmr_id='$fmr_id'";
            $run_debit_amt = mysqli_query($con,$get_debit_amt);
            $row_debit_amt = mysqli_fetch_array($run_debit_amt);

            $debit_total = $row_debit_amt['debit_total'];
            
            ?>
            <td><?php echo $debit_total; ?></td>
            <?php 
            
            $get_clients = "select * from fmr_clients where fmr_id='$fmr_id'";
            $run_clients = mysqli_query($con,$get_clients);
            $client_count = mysqli_num_rows($run_clients);
            $earnings = 0;
            while($row_clients=mysqli_fetch_array($run_clients)){

            $customer_id = $row_clients['customer_id'];

            $get_customer = "select * from customers where customer_id='$customer_id'";
            $run_customer = mysqli_query($con,$get_customer);
            $row_customer = mysqli_fetch_array($run_customer);

            $customer_name = $row_customer['customer_name'];

            $get_orders = "SELECT * from customer_orders where customer_id='$customer_id' group by invoice_no";
            $run_orders = mysqli_query($con,$get_orders);
            $total_purchase = 0;
            $client_orders = 0;
            while($row_orders=mysqli_fetch_array($run_orders)){
                $invoice_no = $row_orders['invoice_no'];

                $get_total = "select sum(due_amount) as order_total from customer_orders where invoice_no='$invoice_no' and order_status='Delivered'";
                $run_total = mysqli_query($con,$get_total);
                $row_total = mysqli_fetch_array($run_total);
                $order_total = $row_total['order_total'];

                $total_purchase += $order_total;
            }
            $earnings += $total_purchase;
            }

            $progress = ($earnings/100000)*100;

            ?>
            <td>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo$progress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo$progress; ?>%</div>
            </div>
            </td>
        </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
</div>
</div>
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='./js/datatable.js'></script>