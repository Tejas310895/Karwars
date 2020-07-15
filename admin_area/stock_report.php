<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

      <div class="row">
           <div class="col-lg-12 col-md-12">
               <h2 class="card-title">ORDER STOCK DATA</h2>
           </div>
       </div>
       <div class="row">
            <div class="col mt-1">
                <input type="date" class="form-control start_date" placeholder="start-date">
            </div>
            <div class="col mt-1">
                <input type="date" class="form-control end_date" placeholder="end-date">
            </div>
            <div class="col">
                <button type="button" class="btn btn-warning view_stock">View</button>
                <!-- <button type="button" class="btn btn-default download_stock">Download</button> -->
            </div>
       </div>
       <div class="card card-tasks mb-0">
                <div class="card-body" id="refresh">
                    <div class="table-full-width table-responsive" id="time">
                            <table class="table" id="tblexportData">
                            <thead>
                                <tr class="text-center">
                                    <th>Sl.No</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Bulk Quantity</th>
                                    <th>Amount/Item</th>
                                    <th>Bulk Amount</th>
                                </tr>
                            
                            </thead>
                            <tbody id='stock_date'>
                            
                            </tbody>
                        </table>
                        <button class="btn btn-default pull-right download_stock d-none" onclick="exportToExcel('tblexportData')">Download</button>
                </div>
            </div>
       </div>
        

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