<?php 

    include("includes/db.php");

?>

<?php 

date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d H:i:s");

if(isset($_POST['del_id'])){

    $delivery_partner_id = $_POST['del_id'];
    $del_invoice_no = $_POST['del_inc_id'];
    $del_charge = $_POST['del_charge'];

    $get_del_dubli = "select * from orders_delivery_assign where invoice_no='$del_invoice_no'";
    $run_del_dubli = mysqli_query($con,$get_del_dubli);
    $check_dubli = mysqli_num_rows($run_del_dubli);

    if($check_dubli<1){

    $insert_delivery = "insert into orders_delivery_assign (invoice_no,
                                                            delivery_partner_id,
                                                            delivery_charges,
                                                            delivery_assign_created_at,
                                                            delivery_assign_updated_at)
                                                            values
                                                            ('$del_invoice_no',
                                                            '$delivery_partner_id',
                                                            '$del_charge',
                                                            '$today',
                                                            '$today')";
    $run_insert_delivery = mysqli_query($con,$insert_delivery);

    if($run_insert_delivery){
        echo "<script>alert('Status Updated')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    
    }else {
        echo "<script>alert('Status Updation Failed')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    
    }
    }else{
        echo "<script>alert('Already Assigned')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    
    }
}

if(isset($_GET['assign_id'])){

    $assign_inc_id = $_GET['assign_id'];

    $delete_assign = "delete from orders_delivery_assign where invoice_no='$assign_inc_id'";
    $run_delete_assign = mysqli_query($con,$delete_assign);

    if($run_delete_assign){
        echo "<script>alert('Cancelled Successfully')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    
    }else {
        echo "<script>alert('Cancelled Failed')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";    
    }

}

?>