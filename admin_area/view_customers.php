<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">CUSTOMERS</h2>
           </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Ip Address</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    $get_customer = "select * from customers";

    $run_customer = mysqli_query($con,$get_customer);

    $counter = 0;
    while($row_customer = mysqli_fetch_array($run_customer)){

        $customer_id = $row_customer['customer_id'];

        $customer_name = $row_customer['customer_name'];

        $customer_email = $row_customer['customer_email'];

        $customer_contact = $row_customer['customer_contact'];

        $customer_ip = $row_customer['customer_ip'];
    
    ?>
        <tr>
            <td><?php echo $customer_name; ?></td>
            <td>+91 <?php echo $customer_contact; ?></td>
            <td><?php echo $customer_email; ?></td>
            <td>
            <select class="custom-select">
                <?php 
                
                $get_add = "select * from customer_address where customer_id='$customer_id'";

                $run_add = mysqli_query($con,$get_add);

                while($row_add=mysqli_fetch_array($run_add)){

                    $customer_address = $row_add['customer_address'];

                    $customer_phase = $row_add['customer_phase'];

                    $customer_landmark = $row_add['customer_landmark'];

                    $customer_city = $row_add['customer_city'];

                    echo "
                    
                    <option>$customer_address, $customer_phase, $customer_landmark, $customer_city</option>
                    
                    ";

                }
                
                ?>
            </select>
            </td>
            <td class="text-center"><?php echo $customer_ip; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php } ?>