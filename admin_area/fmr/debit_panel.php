<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Debit Panel</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?raise_debit" class="btn btn-success pull-right">Raise Debit</a>
           </div>
       </div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Date</th>
            <th>FMR Code</th>
            <th>Name</th>
            <th>DR Amount</th>
            <th>DR Remarks</th>
        </tr>
    </thead>
    <tbody>
        <?php 
                
            $get_fmr_debit = "select * from fmr_debits";
            $run_fmr_debit = mysqli_query($con,$get_fmr_debit);
            $counter = 0;
            while($row_fmr_debit = mysqli_fetch_array($run_fmr_debit)){
            
            $counter = ++$counter;
            $fmr_debit_id = $row_fmr_debit['fmr_debit_id'];
            $fmr_debit_amt = $row_fmr_debit['fmr_debit_amt'];
            $fmr_debit_comment = $row_fmr_debit['fmr_debit_comment'];
            $updated_date = $row_fmr_debit['updated_date'];
            $fmr_id = $row_fmr_debit['fmr_id'];

            $get_fmr = "select * from fmr_users where fmr_id='$fmr_id'";
            $run_fmr = mysqli_query($con,$get_fmr);
            $row_fmr = mysqli_fetch_array($run_fmr);

            $fmr_name = $row_fmr['fmr_name'];
            $fmr_unique_code = $row_fmr['fmr_unique_code'];
            $fmr_status = $row_fmr['fmr_status'];
        
        ?>
        <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo date('d/M/Y@h:i a',strtotime($updated_date)); ?></td>
            <td><?php echo $fmr_unique_code; ?></td>
            <td><?php echo $fmr_name; ?><small class="text-success text-uppercase">(<?php echo $fmr_status; ?>)</small></td>
            <td><?php echo $fmr_debit_amt; ?></td>
            <td><?php echo $fmr_debit_comment; ?></td>
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