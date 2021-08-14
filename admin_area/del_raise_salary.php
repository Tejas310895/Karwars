<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Release Salary</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?del_salary_sheet" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form id="insert_product" method="post" action="">
    <div class="form-group fieldGroup">
        <div class="input-group mt-3">
            <select class="form-control mt-2" id="exampleFormControlSelect1" name="del_partner[]" id="del_partner" required>
            <?php
            
                echo "<option disabled selected value>Choose the Delivery Partner</option>";
                $get_delivery_partner = "select * from delivery_partner";
                $run_delivery_partner = mysqli_query($con,$get_delivery_partner);
                while($row_delivery_partner=mysqli_fetch_array($run_delivery_partner)){

                    $delivery_partner_id = $row_delivery_partner['delivery_partner_id'];
                    $delivery_partner_name = $row_delivery_partner['delivery_partner_name'];

                echo "<option value='$delivery_partner_id'>$delivery_partner_name</option>";

                }
            
            ?>
            </select>
            <input type="text" name="salary_amt[]" id="salary_amt" class="form-control mt-2" placeholder="Enter Salary Amount" required/>
            <input type="text" name="salary_type[]" id="salary_type" class="form-control mt-2" placeholder="Enter Type" required/>
            <input type="text" name="salary_ref[]" id="salary_ref" class="form-control mt-2" placeholder="Enter Ref No." required/>
            <div class="input-group-addon mx-3 mt-1"> 
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="submit" id="add_product"  class="btn btn-lg btn-primary mx-5 mt-5 float-left">Submit</button>
    
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
            <select class="form-control mt-2" id="exampleFormControlSelect1" name="del_partner[]" id="del_partner" required>
            <?php
            
            echo "<option disabled selected value>Choose the Delivery Partner</option>";
            $get_delivery_partner = "select * from delivery_partner";
            $run_delivery_partner = mysqli_query($con,$get_delivery_partner);
            while($row_delivery_partner=mysqli_fetch_array($run_delivery_partner)){

                $delivery_partner_id = $row_delivery_partner['delivery_partner_id'];
                $delivery_partner_name = $row_delivery_partner['delivery_partner_name'];

            echo "<option value='$delivery_partner_id'>$delivery_partner_name</option>";

            }
        
        ?>
        </select>
        <input type="text" name="salary_amt[]" id="salary_amt" class="form-control mt-2" placeholder="Enter Salary Amount" required/>
        <input type="text" name="salary_type[]" id="salary_type" class="form-control mt-2" placeholder="Enter Type" required/>
        <input type="text" name="salary_ref[]" id="salary_ref" class="form-control mt-2" placeholder="Enter Ref No." required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="fmr/js/fmr.js"></script>
<?php 

if(isset($_POST['submit'])){
    $del_partnerArr = $_POST['del_partner'];
    $salary_amtArr = $_POST['salary_amt'];
    $salary_typeArr = $_POST['salary_type'];
    $salary_refArr = $_POST['salary_ref'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

            if(!empty($del_partnerArr)){
                for($i = 0; $i < count($del_partnerArr); $i++){
                    if(!empty($del_partnerArr[$i])){
                        $del_partner = $del_partnerArr[$i];
                        $salary_amt = $salary_amtArr[$i];
                        $salary_type = $salary_typeArr[$i];
                        $salary_ref = $salary_refArr[$i];

                        $insert_salary = "insert into del_payroll (delivery_partner_id,salary_amt,salary_type,salary_ref_id,updated_date) 
                        values ('$del_partner','$salary_amt','$salary_type','$salary_ref','$today')";

                        $run_salary = mysqli_query($con,$insert_salary);
                        
                    }
                }
            }

            if($run_salary){
                echo "<script>alert('Salary Released')</script>";
                echo "<script>window.open('index.php?del_salary_sheet','_self')</script>";
            }else{
                echo "<script>alert('Failed Try Again')</script>";
            }

} 

}

?>
