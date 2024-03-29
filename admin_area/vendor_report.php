<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
    <div class="col-lg-6 col-md-6">
    <h2 class="card-title">PAYMENT DETAILS</h2>
    </div>
</div>

<div class="row">
<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th  rowspan="2" class="border">DATE</th>
            <th colspan="2" class="border bg-info text-dark">GROCERY</th>
            <th colspan="2" class="border bg-success text-dark">VEGETABLES</th>
            <th colspan="2" class="border bg-warning text-dark">FRUITS</th>
            <th colspan="2" class="border bg-danger text-dark">SWEETS</th>
            <th colspan="2" class="border bg-primary text-dark">YASIN</th>
            <th  rowspan="2" class="border">DISCOUNTS</th>
            <th  rowspan="2" class="border">CHARGES</th>
        </tr>
        <tr>
            <!-- <th class="border-bottom"></th> -->
            <th class="border bg-info text-dark">MRT Total</th>
            <th class="border bg-info text-dark">ORD Total</th>
            <th class="border bg-success text-dark">MRT Total</th>
            <th class="border bg-success text-dark">ORD Total</th>
            <th class="border bg-warning text-dark">MRT Total</th>
            <th class="border bg-warning text-dark">ORD Total</th>
            <th class="border bg-danger text-dark">MRT Total</th>
            <th class="border bg-danger text-dark">ORD Total</th>
            <th class="border bg-primary text-dark">MRT Total</th>
            <th class="border bg-primary text-dark">ORD Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
            $get_reports = "SELECT * FROM customer_orders GROUP BY CAST(del_date as DATE) order by del_date  desc";
            $run_reports = mysqli_query($con,$get_reports);
            while($row_reports = mysqli_fetch_array($run_reports)){
            $del_date = $row_reports['del_date'];
            $delivery_date = date('Y-m-d',strtotime($del_date));
            $display_delivery_date = date('d-M-Y',strtotime($del_date));
        ?>
        <tr  class="text-center">
            <td><?php echo $display_delivery_date; ?></td>
            <td class="bg-info" style="color:#000 !important;">
                <?php 
                
                $get_total_purchase = "select sum(vendor_due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='1' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo round($total_purchase, 2);
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-info" style="color:#000 !important;">
                <?php 
                
                $get_total_purchase = "select sum(due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='1' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo $total_purchase;
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-success" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(vendor_due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='5' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo round($total_purchase, 2);
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-success" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='5' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo $total_purchase;
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-warning" style="color:#000 !important;">
                <?php 
                
                $get_total_purchase = "select sum(vendor_due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='3' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo round($total_purchase, 2);
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-warning" style="color:#000 !important;">
                <?php 
                
                $get_total_purchase = "select sum(due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='3' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo $total_purchase;
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-danger" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(vendor_due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='4' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo round($total_purchase, 2);
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-danger" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='4' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo round($total_purchase, 2);
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-primary" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(vendor_due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='9' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo $total_purchase;
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td class="bg-primary" style="color:#000 !important;">
            <?php 
                
                $get_total_purchase = "select sum(due_amount) as total_purchase from customer_orders where CAST(del_date as DATE)='$delivery_date' and client_id='9' and order_status='Delivered' and product_status='Deliver'";
                $run_total_purchase = mysqli_query($con,$get_total_purchase);
                $row_total_purchase = mysqli_fetch_array($run_total_purchase);

                $total_purchase = $row_total_purchase['total_purchase'];

                if($total_purchase>0){
                    echo $total_purchase;
                }else{
                    echo 0;
                }
                
                ?>
            </td>
            <td>
            <?php 
            
            $get_discounts = "select * from customer_discounts where CAST(discount_date as DATE)='$delivery_date'";
            $run_discounts = mysqli_query($con,$get_discounts);
            $discount_total = 0;
            while($row_discounts=mysqli_fetch_array($run_discounts)){
                $dis_invoice_id = $row_discounts['invoice_no'];
                $discount_amount = $row_discounts['discount_amount'];

                $get_discount_status = "select * from customer_orders where invoice_no='$dis_invoice_id'";
                $run_discount_status = mysqli_query($con,$get_discount_status);
                $row_discount_status = mysqli_fetch_array($run_discount_status);

                $discount_status = $row_discount_status['order_status'];

                if($discount_status==='Delivered'){
                    $discount_total += $discount_amount;
                }else{
                    $discount_total = 0;
                }
            }
                echo $discount_total;
            ?>
            </td>
            <td>
            <?php 
            
            $get_charges = "select * from order_charges where CAST(updated_date as DATE)='$delivery_date'";
            $run_charges = mysqli_query($con,$get_charges);
            $charge_total = 0;
            while($row_charges=mysqli_fetch_array($run_charges)){
                $chg_invoice_id = $row_charges['invoice_id'];
                $del_charges = $row_charges['del_charges'];

                $get_charge_status = "select * from customer_orders where invoice_no='$chg_invoice_id'";
                $run_charge_status = mysqli_query($con,$get_charge_status);
                $row_charge_status = mysqli_fetch_array($run_charge_status);

                $charge_status = $row_charge_status['order_status'];

                if($charge_status==='Delivered'){
                    $charge_total += $del_charges;
                }else{
                    $charge_total = 0;
                }
            }
                echo $charge_total;
            ?>
            </td>

        </tr>
        <?php } ?>
    </tbody>
</table>
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