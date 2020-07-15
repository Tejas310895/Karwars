<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

        ?>
        <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Date</th>
		</tr>
	</thead>
	<tbody>
    <?php
                    $get_notify = "SELECT * FROM notify ORDER BY notify_id DESC";
                
                    $run_notify = mysqli_query($con,$get_notify);

                    while($row_notify = mysqli_fetch_array($run_notify)){

                    $pro_id = $row_notify['product_id'];

                    $customer_id = $row_notify['customer_id'];

                    $date = $row_notify['notify_date'];
                
                    $get_customer = "select * from customers where customer_id='$customer_id'";

                    $run_customer = mysqli_query($con,$get_customer);

                    $row_customer = mysqli_fetch_array($run_customer);

                    $c_name = $row_customer['customer_name'];

                    $get_product = "select * from products where product_id='$pro_id'";

                    $run_product = mysqli_query($con,$get_product);

                    $row_product = mysqli_fetch_array($run_product);

                    $pro_name = $row_product['product_title'];

                    $pro_desc = $row_product['product_desc'];

                  ?>
                          <tr class="text-center">
                          <td style="font-size:0.8rem;"><?php echo $c_name; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $pro_name; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $pro_desc; ?></td>
                          <td style="font-size:0.8rem;"><?php echo $date; ?></td>
                          </tr>
                          <?php } ?>
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