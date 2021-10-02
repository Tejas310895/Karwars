<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>
<?php 

?>
        <div class="row">
           <div class="col-lg-12 col-md-12">
               <h2 class="card-title">REPORTS DASHBOARD</h2>
           </div>
       </div>
       <div class="row">
            <div class="col mt-1">
                <input type="date" class="form-control dstart_date" placeholder="start-date">
            </div>
            <div class="col mt-1">
                <input type="date" class="form-control dend_date" placeholder="end-date">
            </div>
            <div class="col mt-1">
            <div class="form-group">
                    <select class="form-control dstatus" id="dstatus" required>
                        <option>All</option>
                        <option>Order Placed</option>
                        <option>Packed</option>
                        <option>Out For Delivery</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                        <option>Refunded</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-warning dview_report">Show</button>
                <!-- <button type="button" class="btn btn-default download_stock">Download</button> -->
            </div>
       </div>
         <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
            <th>STATUS</th>
            <th>ORD ID</th>
            <th>ORDER DATE</th>
            <th>ORDER BY</th>
            <th>CONTACT</th>
            <th>ADDRESS</th>
            <th>ITEMS</th>
            <th>COST</th>
            <th>DLC</th>
            <th>DC</th>
            <th>BD</th>
            <th>PAYMENT TYPE</th>
            <th>ACTION</th>
		</tr>
	</thead>
	<tbody id="dreports">
    
	</tbody>
</table>

                </div>
          </div>
          <!-- partial -->
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='js/datatable.js'></script>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="js/script.js"></script>
