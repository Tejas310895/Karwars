<?php 

if(isset($_POST['fmr_code'])){
    include("../includes/db.php");

    $fmr_code = $_POST['fmr_code'];

    $get_fmr = "SELECT * from fmr_users where fmr_unique_code='$fmr_code'";
    $run_fmr = mysqli_query($con,$get_fmr);
    $row_fmr = mysqli_fetch_array($run_fmr);

    $fmr_id = $row_fmr['fmr_id'];
    $fmr_unique_code = $row_fmr['fmr_unique_code'];
    $fmr_name = $row_fmr['fmr_name'];
    $fmr_email = $row_fmr['fmr_email'];
    $fmr_pass = $row_fmr['fmr_pass'];
    $fmr_contact = $row_fmr['fmr_contact'];
    $fmr_dob = $row_fmr['fmr_dob'];
    $fmr_qualification = $row_fmr['fmr_qualification'];
    $fmr_address = $row_fmr['fmr_address'];
    $fmr_city = $row_fmr['fmr_city'];
    $fmr_pincode = $row_fmr['fmr_pincode'];
    $fmr_state = $row_fmr['fmr_state'];
    $fmr_pan_no = $row_fmr['fmr_pan_no'];
    $fmr_addhar_no = $row_fmr['fmr_addhar_no'];
    $fmr_join_date = $row_fmr['fmr_join_date'];
    $fmr_status = $row_fmr['fmr_status'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d");

?>

<div class="container">
        <div class="row rounded p-2" style="box-shadow:1px 1px 10px 2px #fff;">
            <div class="col-6">
                <h5><?php echo $fmr_unique_code;?> <small class="text-success text-uppercase"><?php echo $fmr_status;?></small></h5>
                <h5>Joining Date : <?php echo date('d/M/Y@h:i a',strtotime($fmr_join_date)); ?></h5>
                <h5>Name : <?php echo $fmr_name;?></h5>
                <h5>Email : <?php echo $fmr_email;?></h5>
                <h5>Contact : <?php echo $fmr_contact;?></h5>
                <h5>Age : <?php echo date_diff(date_create($fmr_dob), date_create($today))->y; ?></h5>
            </div>
            <div class="col-6">
                <h5>Qualification : <?php echo $fmr_qualification;?></h5>
                <h5>Address : <?php echo $fmr_address;?></h5>
                <h5>City : <?php echo $fmr_city;?></h5>
                <h5>State : <?php echo $fmr_state;?></h5>
                <h5>Pincode : <?php echo $fmr_pincode;?></h5>
                <h5>Addhar Number : <?php echo $fmr_addhar_no;?></h5>
                <h5>PAN Number : <?php echo $fmr_pan_no;?></h5>
            </div>
        </div>
        <ul class="nav nav-pills nav-justified mb-3 mt-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-earnings" role="tab" aria-controls="pills-home" aria-selected="true">EARNINGS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-bonus" role="tab" aria-controls="pills-profile" aria-selected="false">BONUS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-debits" role="tab" aria-controls="pills-contact" aria-selected="false">DEBITS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-credits" role="tab" aria-controls="pills-contact" aria-selected="false">CREDITS</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-earnings" role="tabpanel" aria-labelledby="pills-home-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Name</th>
                            <th>Orders</th>
                            <th>Total Purchase</th>
                            <th>Total Commision Earned</th>
                        </tr>
                    </thead>
                    <?php 
                    
                    $get_clients = "select * from fmr_clients where fmr_id='$fmr_id'";
                    $run_clients = mysqli_query($con,$get_clients);
                    $client_count = mysqli_num_rows($run_clients);
                    $counter = 0;
                    $earnings = 0;
                    while($row_clients=mysqli_fetch_array($run_clients)){
                    $counter = ++$counter;
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

                        $get_order_count = "select distinct(invoice_no) from customer_orders where invoice_no='$invoice_no' and order_status='Delivered'";
                        $run_order_count = mysqli_query($con,$get_order_count);
                        $order_count = mysqli_num_rows($run_order_count);

                        $client_orders += $order_count;

                        $get_total = "select sum(due_amount) as order_total from customer_orders where invoice_no='$invoice_no' and order_status='Delivered'";
                        $run_total = mysqli_query($con,$get_total);
                        $row_total = mysqli_fetch_array($run_total);
                        $order_total = $row_total['order_total'];

                        $total_purchase += $order_total;
                    }
                    $earnings += $total_purchase;
                    
                    ?>
                    <tbody>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $client_orders; ?></td>
                        <td><?php echo $earnings; ?></td>
                        <td><?php echo $earnings*0.01; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-bonus" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Bonus Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_bonus = "select * from fmr_bonus where fmr_id='$fmr_id'";
                    $run_bonus = mysqli_query($con,$get_bonus);
                    $counter = 0;
                    while($row_bonus = mysqli_fetch_array($run_bonus)){
                    $bonus_amt = $row_bonus['bonus_amt'];
                    $bonus_remark = $row_bonus['bonus_remarks'];
                    $bonus_date = $row_bonus['updated_date'];
                    $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($bonus_date)); ?></td>
                        <td><?php echo $bonus_amt; ?></td>
                        <td><?php echo $bonus_remark; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-debits" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Debit Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_debits = "select * from fmr_debits where fmr_id='$fmr_id'";
                    $run_debits = mysqli_query($con,$get_debits);
                    $counter = 0;
                    while($row_debits = mysqli_fetch_array($run_debits)){
                        $fmr_debit_amt = $row_debits['fmr_debit_amt'];
                        $fmr_debit_comment = $row_debits['fmr_debit_comment'];
                        $debit_date = $row_debits['updated_date'];
                        $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($debit_date)); ?></td>
                        <td><?php echo $fmr_debit_amt; ?></td>
                        <td><?php echo $fmr_debit_comment; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-credits" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Date</th>
                            <th>Settlement Amount</th>
                            <th>Settlement Type</th>
                            <th>Settlement Ref.Id</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $get_credits = "select * from fmr_settlements where fmr_id='$fmr_id'";
                    $run_credits = mysqli_query($con,$get_credits);
                    while($row_credits = mysqli_fetch_array($run_credits)){
                        $settlement_amt = $row_credits['settlement_amt'];
                        $settlement_type = $row_credits['settlement_type'];
                        $settlement_ref_id = $row_credits['settlement_ref_id'];
                        $settlement_date = $row_credits['updated_date'];
                        $counter = ++$counter;
                    ?>
                        <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo date('d/M/Y@h:i a',strtotime($settlement_date)); ?></td>
                        <td><?php echo $settlement_amt; ?></td>
                        <td><?php echo $settlement_type; ?></td>
                        <td><?php echo $settlement_ref_id; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php 
    
    }else{

        echo "
        <div class='container'>
        <h5 class='text-center'> Wrong FMR CODE TRY AGAIN </h5>
        </div>
        ";

    } ?>