<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>

       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Staff Orders List</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?view_staff" class="btn btn-success pull-right">Back</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Staff Name</th> 
                    <th>Orders</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            $get_employee_details = "select * from employees";
            $run_employee_details = mysqli_query($con,$get_employee_details);
            $counter = 0;
            while($row_employee_details=mysqli_fetch_array($run_employee_details)){
            $employee_id = $row_employee_details['employee_id'];
            $employee_name = $row_employee_details['employee_name'];
            $employee_role = $row_employee_details['employee_role'];
            $counter = ++$counter;

            $get_order_count = "select * from employee_orders where employee_id='$employee_id' and employee_action='created'";
            $run_order_count = mysqli_query($con,$get_order_count);
            $order_count = mysqli_num_rows($run_order_count);
            $order_amount = 0;
            while($row_order_count = mysqli_fetch_array($run_order_count)){
                $invoice_id = $row_order_count['invoice_id'];
                
                $get_order_total = "select sum(due_amount) as order_total from customer_orders where invoice_no='$invoice_id'";
                $run_order_total = mysqli_query($con,$get_order_total);
                $row_order_total = mysqli_fetch_array($run_order_total);

                $order_total = $row_order_total['order_total'];
                $order_amount += $order_total;
            }
            ?>
            <tr class="text-center">
                <td><?php echo $counter; ?></td>
                <td><?php echo $employee_name; ?></td>
                <td><?php echo $order_count; ?></td>
                <td><?php echo $order_amount; ?></td>
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

    