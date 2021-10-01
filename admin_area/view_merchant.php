<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">MERCHANTS</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_merchant" class="btn btn-primary pull-right">Add New</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>GSTN</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                
                    $get_merchant = "select * from merchants";
        
                    $run_merchant = mysqli_query($con,$get_merchant);
                    
                    $counter=0;

                    while($row_merchant=mysqli_fetch_array($run_merchant)){
                        
                        $merchant_id = $row_merchant['merchant_id'];
                        $merchant_name = $row_merchant['merchant_name'];
                        $merchant_mobile = $row_merchant['merchant_mobile'];
                        $merchant_email = $row_merchant['merchant_email'];
                        $merchant_gst = $row_merchant['merchant_gst'];
                
                ?>
                <tr>
                <td ><?php echo ++$counter; ?></td>
                <td ><?php echo $merchant_name; ?></td>
                <td ><?php echo $merchant_email; ?></td>
                <td ><?php echo $merchant_mobile; ?></td>
                <td ><?php echo $merchant_gst; ?></td>
                <td class="td-actions text-center">
                    <a  href="index.php?edit_merchant=<?php echo $merchant_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                        <i class="tim-icons icon-settings"></i>
                    </a>
                    <a  href="index.php?merchant_products=<?php echo $merchant_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                        <i class="tim-icons icon-basket-simple"></i>
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