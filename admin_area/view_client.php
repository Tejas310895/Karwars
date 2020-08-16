<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

    <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">VENDOR</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?insert_client" class="btn btn-primary pull-right">Add New</a>
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Client Name</th>
                    <th>Shop Name</th> 
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>GSTN</th>
                    <th>PRODUCT TYPE</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                
                    $get_client = "select * from clients";
        
                    $run_client = mysqli_query($con,$get_client);
                    
                    $counter=0;

                    while($row_client=mysqli_fetch_array($run_client)){
                        
                        $client_id = $row_client['client_id'];
                        $client_name = $row_client['client_name'];
                        $client_shop = $row_client['client_shop'];
                        $client_email = $row_client['client_email'];
                        $client_phone = $row_client['client_phone'];
                        $client_address = $row_client['client_address'];
                        $client_gstn = $row_client['client_gstn'];
                        $client_pro_type = $row_client['client_pro_type'];
                
                ?>
                <tr>
                <td ><?php echo ++$counter; ?></td>
                <td ><?php echo $client_name; ?></td>
                <td ><?php echo $client_shop; ?></td>
                <td ><?php echo $client_email; ?></td>
                <td ><?php echo $client_phone; ?></td>
                <td ><?php echo $client_address; ?></td>
                <td ><?php echo $client_gstn; ?></td>
                <td ><?php echo $client_pro_type; ?></td>
                <td class="td-actions text-center">
                        <a  href="index.php?edit_client=<?php echo $client_id; ?>" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                            <i class="tim-icons icon-settings"></i>
                        </a>
                        <a href="index.php?delete_client=<?php echo $client_id; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                            <i class="tim-icons icon-simple-remove"></i>
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