<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>
        <div class="coupon_alert" role="alert">
           
        </div>
       <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">PURCHASE INVOICES</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_purchase_invoice" class="btn btn-success pull-right">NEW PURCHASE INVOICE</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Seller</th> 
                    <th>Invoice No.</th>
                    <th>Invoice Date</th>
                    <th>Products</th>
                    <th>TXN Type</th>
                    <th>REF No.</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            $get_purchase_inc = "select * from purchase_invoice_entry";
            $run_purchase_inc = mysqli_query($con,$get_purchase_inc);
            $counter = 0;
            while ($row_purchase_inc=mysqli_fetch_array($run_purchase_inc)) {
                $purchase_invoice_id = $row_purchase_inc['purchase_invoice_id'];
                $seller_id = $row_purchase_inc['seller_id'];
                $purchase_invoice_no = $row_purchase_inc['purchase_invoice_no'];
                $purchase_invoice_date = $row_purchase_inc['purchase_invoice_date'];
                $product_array = $row_purchase_inc['product_array'];
                $purchase_txn_type = $row_purchase_inc['purchase_txn_type'];
                $purchase_ref_no = $row_purchase_inc['purchase_ref_no'];
                $updated_date = $row_purchase_inc['updated_date'];

                $sorted_array = unserialize($product_array);

                $get_seller = "select * from clients where client_id='$seller_id'";
                $run_seller = mysqli_query($con,$get_seller);
                $row_seller = mysqli_fetch_array($run_seller);

                $client_name = $row_seller['client_name'];
            ?>
                <tr class="text-center">
                    <td><?php echo ++$counter; ?></td>
                    <td><?php echo $client_name; ?></td>
                    <td><?php echo $purchase_invoice_no; ?></td>
                    <td><?php echo date("d-M-y",strtotime($purchase_invoice_date)); ?></td>
                    <td>
                        <a href="#" id="show_details" class="btn btn-primary text-white" data-toggle="modal" data-target="#KK<?php echo $purchase_invoice_id;?>" title="view">
                            <i class="tim-icons icon-alert-circle-exc text-white"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal modal-black fade" id="KK<?php echo $purchase_invoice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Invoice Id - <?php echo $purchase_invoice_no; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body my-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ITEMS</th>
                                                    <th class="text-center">QTY</th>
                                                    <th class="text-center">PRICE</th>
                                                    <th class="text-center">GST</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            
                                            $array_size = (count($sorted_array)-1);
                                            $grand_total = 0;
                                            for($i=0; $i<=$array_size; $i++){

                                            $pro_id = $sorted_array[$i][0];

                                            $qty = $sorted_array[$i][1];

                                            $price = $sorted_array[$i][2];

                                            $gst = $sorted_array[$i][3];

                                            $total_price = $price/$qty;   
                                            
                                            $grand_total += $total_price;

                                            $get_pro = "select * from products where product_id='$pro_id'";

                                            $run_pro = mysqli_query($con,$get_pro);

                                            $row_pro = mysqli_fetch_array($run_pro);

                                            $pro_title = $row_pro['product_title'];

                                            $pro_img1 = $row_pro['product_img1'];

                                            // $pro_price = $row_pro['product_price'];

                                            $pro_desc = $row_pro['product_desc'];
                                            
                                            // $sub_total = $pro_price * $qty;

                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $pro_title; ?><br><?php echo $pro_desc; ?></td>
                                                    <td class="text-center"><?php echo $qty; ?> X ₹<?php echo $price; ?></td>
                                                    <td class="text-center"><?php echo $total_price; ?></td>
                                                    <td class="text-center">₹ <?php echo $gst; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary text-left" data-dismiss="modal">Close</button>
                                        <h3 class="card-title">Total - ₹ <?php echo $grand_total; ?>/-</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Modal -->
                    </td>
                    <td>
                        <?php echo $purchase_txn_type; ?>
                    </td>
                    <td>
                        <?php echo $purchase_ref_no; ?>
                    </td>
                    <td>
                        <?php echo $grand_total; ?>
                    </td>
                    <td class="td-actions text-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#PE<?php echo $purchase_invoice_id; ?>">
                            <i class="tim-icons icon-settings"></i>
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="PE<?php echo $purchase_invoice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">INC - <?php echo $purchase_invoice_no; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="purchase_invoice_id" value="<?php echo $purchase_invoice_id; ?>">
                                            <div class="form-group">
                                              <label>Transaction Mode</label>
                                              <select class="form-control" name="purchase_txn_type" id="purchase_txn_type" required>
                                                <option value="" selected disabled>Select Payment Mode</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="NEFT">NEFT</option>
                                                <option value="IMPS">IMPS</option>
                                              </select>
                                            </div>
                                            <div class="form-group">
                                              <label>Reference No.</label>
                                              <input type="text" class="form-control text-dark" name="purchase_ref_no" id="purchase_ref_no" aria-describedby="helpId" placeholder="Enter Reference Number" required>
                                            </div>
                                            <button type="submit" name="payment_submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
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
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script  src='js/datatable.js'></script>

    <?php } ?>

    <?php 
    
    if(isset($_POST['payment_submit'])){
        $purchase_invoice_id = $_POST['purchase_invoice_id'];
        $purchase_txn_type = $_POST['purchase_txn_type'];
        $purchase_ref_no = $_POST['purchase_ref_no'];

        $insert_payment = "update purchase_invoice_entry set purchase_txn_type='',purchase_ref_no''";
    }

    ?>