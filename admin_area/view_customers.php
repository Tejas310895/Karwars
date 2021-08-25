<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">CUSTOMERS</h2>
           </div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date</th>
            <th>TNAMT</th>
            <th>TNC</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    $get_customer = "select * from customers";

    $run_customer = mysqli_query($con,$get_customer);

    $counter = 0;
    while($row_customer = mysqli_fetch_array($run_customer)){

        $customer_id = $row_customer['customer_id'];

        $customer_name = $row_customer['customer_name'];

        $customer_email = $row_customer['customer_email'];

        $customer_contact = $row_customer['customer_contact'];

        $updated_date = $row_customer['updated_date'];

        $get_order_amount = "select sum(due_amount) as order_amount from cutomer_orders where customer_id='$customer_id' and product_status='Deliver'";
        $run_order_amount = mysqli_query($con,$get_order_amount);
        $row_order_amount = mysqli_fetch_array($run_order_amount);

        $order_amount = $row_order_amount['order_amount'];


        $get_order_count = "select distinct(invoice_no) from cutomer_orders where customer_id='$customer_id' and order_status='Delivered'";
        $run_order_count = mysqli_query($con,$get_order_count);
        $order_count = mysqli_num_rows($run_order_count);    
    ?>
        <tr>
            <td ><?php echo ++$counter; ?></td>
            <td><?php echo $customer_name; ?></td>
            <td>+91 <?php echo $customer_contact; ?></td>
            <td><?php echo $customer_email; ?></td>
            <td>
            <select class="custom-select">
                <?php 
                
                $get_add = "select * from customer_address where customer_id='$customer_id'";

                $run_add = mysqli_query($con,$get_add);

                while($row_add=mysqli_fetch_array($run_add)){

                    $customer_address = $row_add['customer_address'];

                    $customer_phase = $row_add['customer_phase'];

                    $customer_landmark = $row_add['customer_landmark'];

                    $customer_city = $row_add['customer_city'];

                    echo "
                    
                    <option>$customer_address, $customer_phase, $customer_landmark, $customer_city</option>
                    
                    ";

                }
                
                ?>
            </select>
            </td>
            <td class="text-center"><?php echo date('d/M/Y(h:i a)',strtotime($updated_date)); ?></td>
            <td><?php echo $order_amount; ?></td>
            <td><?php echo $order_count; ?></td>
        </tr>
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
<script  src='js/datatable.js'></script>

<?php } ?>