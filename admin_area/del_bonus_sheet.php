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
            <a href="index.php?del_raise_bonus" class="btn btn-success pull-right">Raise Bonus</a>
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
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    $get_bonus = "select * from del_bonus order by bonus_id desc";
    $run_bonus = mysqli_query($con,$get_bonus);
    $counter = 0;
    while ($row_bonus=mysqli_fetch_array($run_bonus)) {
        $delivery_partner_id = $row_bonus['delivery_partner_id'];
        $bonus_amt = $row_bonus['bonus_amt'];
        $bonus_remarks = $row_bonus['bonus_remarks'];
        $updated_date = $row_bonus['updated_date'];

        $get_del_details = "select * from delivery_partner where delivery_partner_id='$delivery_partner_id'";
        $run_del_details = mysqli_query($con,$get_del_details);
        $row_del_details = mysqli_fetch_array($run_del_details);

        $delivery_partner_name = $row_del_details['delivery_partner_name'];
        $delivery_partner_code = $row_del_details['delivery_partner_code'];
    ?>
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td><?php echo date('d/M/y',strtotime($updated_date)); ?></td>
            <td><?php echo $delivery_partner_code; ?></td>
            <td><?php echo $delivery_partner_name; ?></td>
            <td><?php echo $bonus_amt; ?></td>
            <td><?php echo $bonus_remarks; ?></td>
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