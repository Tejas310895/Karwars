<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Notifications</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?send_del_notification" class="btn btn-success pull-right">Send Notification</a>
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
            <th>Subject</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php 
                
            $get_del_notification = "select * from del_notifications";
            $run_del_notification = mysqli_query($con,$get_del_notification);
            $counter = 0;
            while($row_del_notification = mysqli_fetch_array($run_del_notification)){
            $delivery_partner_id = $row_del_notification['delivery_partner_id'];
            $notification_subject = $row_del_notification['notification_subject'];
            $notification_content = $row_del_notification['notification_content'];
            $updated_date = $row_del_notification['updated_date'];

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
            <td><?php echo $notification_subject; ?></td>
            <td><?php echo $notification_content; ?></td>
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