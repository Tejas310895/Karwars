<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>

       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Staff List</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_staff" class="btn btn-success pull-right">Register Staff</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Staff Name</th> 
                    <th>Staff Type</th>
                    <th>Actions</th>
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
            ?>
            <tr class="text-center">
                <td><?php echo $counter; ?></td>
                <td><?php echo $employee_name; ?></td>
                <td><?php echo $employee_role; ?></td>
                <td>
                    <a  href="index.php?edit_staff=<?php echo $employee_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                        <i class="tim-icons icon-settings"></i>
                    </a>
                </td>
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

    