<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

if(isset($_GET['confirm_order'])){

    $invoice_id=$_GET['confirm_order'];

    $get_c_id = "select * from customer_orders where invoice_no='$invoice_id'";

    $run_c_id = mysqli_query($con,$get_c_id);

    $row_c_id = mysqli_fetch_array($run_c_id);

    $c_id = $row_c_id['customer_id'];

    $get_customer = "select * from customers where customer_id='$c_id'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $c_name = $row_customer['customer_name'];

    $c_contact = $row_customer['customer_contact'];

?>

<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="text-center">Order Id : <?php echo $invoice_id; ?></h4>
        </div>
        <div class="col">
          <h4 class="text-center">Name : <?php echo $c_name; ?></h4>
        </div>
        <div class="col">
          <h4 class="text-center">Contact : <?php echo $c_contact; ?></h4>
        </div>
    </div>
    <hr style="border-bottom:4px solid #fff;">
</div>

<table class="table">
<?php 

    
    $get_pro_id = "select * from customer_orders where invoice_no='$invoice_id'";

    $run_pro_id = mysqli_query($con,$get_pro_id);

    $counter = 0;

    while($row_pro_id = mysqli_fetch_array($run_pro_id)){

    $pro_status = $row_pro_id['product_status'];

    $pro_id = $row_pro_id['pro_id'];

    $qty = $row_pro_id['qty'];

    $get_pro = "select * from products where product_id='$pro_id'";

    $run_pro = mysqli_query($con,$get_pro);

    while($row_pro = mysqli_fetch_array($run_pro)){

    $pro_title = $row_pro['product_title'];

    $pro_img1 = $row_pro['product_img1'];

    $pro_price = $row_pro['product_price'];

    $pro_desc = $row_pro['product_desc'];
    
    $sub_total = $pro_price * $qty;

}

?>
<tr>
<th>
    <h5 class="text-center"><?php echo $pro_title.'-'.$pro_desc; ?></h5>
</th>
<th>
<?php 

    if($pro_status==='Deliver'){
        echo"
        <a href='process_order.php?undeliver_order=$invoice_id&undelpro_id=$pro_id' class='btn btn-danger d-block'>Update Undeliver</a>
        ";
    }else{
        echo "
        <a href='process_order.php?deliver_order=$invoice_id&delpro_id=$pro_id' class='btn btn-success d-block'>Update Deliver</a>
        ";
    }

?>
</th>
</tr>
<?php } }?>
</table>
<a href="process_order.php?update_order=<?php echo $invoice_id;?>&status=Packed" class="btn btn-warning pull-right">Update Packed</a>
<?php } ?>

