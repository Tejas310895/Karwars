<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>

       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PURCHASE ORDERS</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_purchase_orders" class="btn btn-success pull-right">NEW PURCHASE ORDER</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.no.</th>
                    <th>P-O no.</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $counter = 0;         
                $get_purchase_orders = "select * from purchase_entry";
                $run_purchase_orders = mysqli_query($con,$get_purchase_orders);
                while($row_purchase_orders=mysqli_fetch_array($run_purchase_orders)){

                    $purchase_invoices_array = $row_purchase_orders['purchase_entry_invoices'];
                    $purchase_invoices_unser = unserialize($purchase_invoices_array);
            ?>
                <tr class="text-center">
                    <td ><?php echo ++$counter; ?></td>
                    <td ><?php echo $row_purchase_orders['purchase_entry_no']; ?></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kk<?php echo $row_purchase_orders['purchase_entry_no']; ?>">
                            View
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="kk<?php echo $row_purchase_orders['purchase_entry_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content text-dark">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php 
                                
                                    $invoice_group = implode(",",$purchase_invoices_unser); 
                                    $get_product_group = "SELECT * from customer_orders where invoice_no in ($invoice_group) group by client_id";
                                    $run_product_group = mysqli_query($con,$get_product_group);
                                    $client_array = array();
                                    while($row_product_group=mysqli_fetch_array($run_product_group)){
                                        array_push($client_array, $row_product_group['client_id']);
                                    }

                                    foreach ($client_array as $client_id) {
                                        
                                        $get_clients = "select * from clients where client_id='$client_id'";
                                        $run_clients = mysqli_query($con,$get_clients);
                                        $row_clients = mysqli_fetch_array($run_clients);
                                
                                ?>
                                <h5 class="text-dark text-uppercase"><?php echo $row_clients['client_shop']; ?></h5>
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $product_amt_total = 0;
                                        $counter = 0;
                                        $get_product_group = "SELECT * from customer_orders where client_id='$client_id' and invoice_no in ($invoice_group) group by pro_id";
                                        $run_product_group = mysqli_query($con,$get_product_group);
                                        while($row_product_group=mysqli_fetch_array($run_product_group)){
                                            $product_id = $row_product_group['pro_id'];

                                            $get_products = "select * from products where product_id='$product_id'";
                                            $run_products = mysqli_query($con,$get_products);
                                            $row_products = mysqli_fetch_array($run_products);

                                            $product_title = $row_products['product_title'];
                                            $product_desc = $row_products['product_desc'];

                                            $get_qty_sum = "SELECT sum(qty) as product_qty from customer_orders where invoice_no in ($invoice_group) and pro_id='$product_id'";
                                            $run_qty_sum = mysqli_query($con,$get_qty_sum);
                                            $row_qty_sum = mysqli_fetch_array($run_qty_sum);

                                            $product_qty = $row_qty_sum['product_qty'];

                                            $get_amt_sum = "SELECT sum(due_amount) as product_amt from customer_orders where invoice_no in ($invoice_group) and pro_id='$product_id'";
                                            $run_amt_sum = mysqli_query($con,$get_amt_sum);
                                            $row_amt_sum = mysqli_fetch_array($run_amt_sum);

                                            $product_amt = $row_amt_sum['product_amt'];

                                            $product_amt_total += $product_amt;

                                        ?>
                                        <tr>
                                            <td scope="row"><?php echo ++$counter; ?></td>
                                            <td><?php echo $product_title." ".$product_desc; ?></td>
                                            <td><?php echo $product_qty; ?></td>
                                            <td><?php echo $product_amt; ?></td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <th><?php echo $product_amt_total; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <a class="btn btn-info" target="_blank" href="clientbill.php?ponumber=<?php echo $row_purchase_orders['purchase_entry_id'];?>">Print </a>
                        <a class="btn btn-danger">Cancel </a>
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

    