<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Settlements</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?raise_del_credit" class="btn btn-success pull-right">Raise Credit</a>
           </div>
       </div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Date</th>
            <th>Del Code</th>
            <th>Name</th>
            <th>STL Amount</th>
            <th>STL Type</th>
            <th>STL Ref.no</th>
        </tr>
    </thead>
    <tbody>
        <?php 
                
        $get_settelments = "select * from del_settlements order by settlement_id desc";
        $run_settelments = mysqli_query($con,$get_settelments);
        $counter = 0;
        while ($row_settelments=mysqli_fetch_array($run_settelments)) {
            $delivery_partner_id = $row_settelments['delivery_partner_id'];
            $settlement_amt = $row_settelments['settlement_amt'];
            $settlement_type = $row_settelments['settlement_type'];
            $settlement_ref_id = $row_settelments['settlement_ref_id'];
            $updated_date = $row_settelments['updated_date'];

            $get_del_details = "select * from delivery_partner where delivery_partner_id='$delivery_partner_id'";
            $run_del_details = mysqli_query($con,$get_del_details);
            $row_del_details = mysqli_fetch_array($run_del_details);
    
            $delivery_partner_name = $row_del_details['delivery_partner_name'];
            $delivery_partner_code = $row_del_details['delivery_partner_code'];
        ?>
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td><?php echo date('d/M/Y@h:i a',strtotime($updated_date)); ?></td>
            <td><?php echo $delivery_partner_code; ?></td>
            <td><?php echo $delivery_partner_name; ?></td>
            <td><?php echo $settlement_amt; ?></td>
            <td><?php echo $settlement_type; ?></td>
            <td><?php echo $settlement_ref_id; ?></td>
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