<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Bonus Panel</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?raise_bonus" class="btn btn-success pull-right">Raise Bonus</a>
           </div>
       </div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Applied On</th>
            <th>FMR Code</th>
            <th>Name</th>
            <th>Bonus Amount</th>
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
            
            $get_fmr_bonus = "select sum(bonus_amt) as bonus_total from fmr_bonus where fmr_id='$fmr_id'";
            $run_fmr_bonus = mysqli_query($con,$get_fmr_bonus);
            $row_fmr_bonus = mysqli_fetch_array($run_fmr_bonus);

            $bonus_total = $row_fmr_bonus['bonus_total'];
            
            ?>
            <td><?php echo $bonus_total; ?></td>
            <?php 
            
            $get_remarks = "select * from fmr_bonus where fmr_id='$fmr_id'";
            $run_remarks = mysqli_query($con,$get_remarks);
            $row_remarks = mysqli_fetch_array($run_remarks);

            $remarks = $row_remarks['bonus_remarks'];
            
            ?>
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