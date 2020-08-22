<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

      <div class="row">
           <div class="col-lg-12 col-md-12">
               <h2 class="card-title">ORDER REPORT DATA</h2>
           </div>
       </div>
       <div class="row">
            <div class="col mt-1">
                <input type="date" class="form-control start_date" placeholder="start-date">
            </div>
            <div class="col mt-1">
                <input type="date" class="form-control end_date" placeholder="end-date">
            </div>
            <div class="col mt-1">
            <div class="form-group">
                    <select class="form-control status" id="status" required>
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
                <button type="button" class="btn btn-warning view_report">Show</button>
                <!-- <button type="button" class="btn btn-default download_stock">Download</button> -->
            </div>
       </div>
       <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="tblexportData" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
            <th>Sl.No</th>
            <th>CLIENT</th>
            <th>STATUS</th>
            <th>ORD ID</th>
            <th>ORDER DATE</th>
            <th>ORDER BY</th>
            <th>CONTACT</th>
            <th>ADDRESS</th>
            <th>ITEMS</th>
            <th>UNIT COST</th>
            <th>QTY</th>
            <th>TOTAL</th>
		</tr>
	</thead>
        <tbody id="report_date">

        </tbody>
    </table>
    <button class="btn btn-default pull-right download_report d-none" onclick="exportToExcel('tblexportData')">Download</button>
                </div>
          </div>
          <!-- partial -->
          <script type="text/javascript">
function exportToExcel(tableID, filename = ''){
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
}

</script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>


<?php } ?>