<?php 


include("includes/db.php");
if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{

?> 
        <div class="row">
           <div class="col-lg-6 col-md-6">
           <h2 class="card-title">Raise Credit</h2>
           </div>
           <div class="col-lg-6 col-md-6">
            <a href="index.php?fmr_settlement_sheet" class="btn btn-primary pull-right">Back</a>
           </div>
       </div>
       <form id="insert_product" method="post" action="">
    <div class="form-group fieldGroup">
        <div class="input-group mt-3">
            <select class="form-control mt-2" id="exampleFormControlSelect1" name="fmr_user[]" id="fmr_user" required>
            <?php
            
                echo "<option disabled selected value>Choose the FMR</option>";
                $get_fmr_users = "select * from fmr_users";
                $run_fmr_users = mysqli_query($con,$get_fmr_users);
                while($row_fmr_users=mysqli_fetch_array($run_fmr_users)){

                    $fmr_id = $row_fmr_users['fmr_id'];
                    $fmr_name = $row_fmr_users['fmr_name'];

                echo "<option value='$fmr_id'>$fmr_name</option>";

                }
            
            ?>
            </select>
            <input type="text" name="settlement_amt[]" id="settlement_amt" class="form-control mt-2" placeholder="Enter settlement Amount" required/>
            <input type="text" name="settlement_type[]" id="settlement_type" class="form-control mt-2" placeholder="Enter Type" required/>
            <input type="text" name="settlement_ref[]" id="settlement_ref" class="form-control mt-2" placeholder="Enter Ref No." required/>
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
            <select class="form-control mt-2" id="exampleFormControlSelect1" name="fmr_user[]" id="fmr_user" required>
            <?php
            
            echo "<option disabled selected value>Choose the FMR</option>";
            $get_fmr_users = "select * from fmr_users";
            $run_fmr_users = mysqli_query($con,$get_fmr_users);
            while($row_fmr_users=mysqli_fetch_array($run_fmr_users)){

                $fmr_id = $row_fmr_users['fmr_id'];
                $fmr_name = $row_fmr_users['fmr_name'];

            echo "<option value='$fmr_id'>$fmr_name</option>";

            }
        
        ?>
        </select>
        <input type="text" name="settlement_amt[]" id="settlement_amt" class="form-control mt-2" placeholder="Enter settlement Amount" required/>
        <input type="text" name="settlement_type[]" id="settlement_type" class="form-control mt-2" placeholder="Enter Type" required/>
        <input type="text" name="settlement_ref[]" id="settlement_ref" class="form-control mt-2" placeholder="Enter Ref No." required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="fmr/js/fmr.js"></script>
<?php 

if(isset($_POST['submit'])){
    $fmr_userArr = $_POST['fmr_user'];
    $settlement_amtArr = $_POST['settlement_amt'];
    $settlement_typeArr = $_POST['settlement_type'];
    $settlement_refArr = $_POST['settlement_ref'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

            if(!empty($fmr_userArr)){
                for($i = 0; $i < count($fmr_userArr); $i++){
                    if(!empty($fmr_userArr[$i])){
                        $fmr_user = $fmr_userArr[$i];
                        $settlement_amt = $settlement_amtArr[$i];
                        $settlement_type = $settlement_typeArr[$i];
                        $settlement_ref = $settlement_refArr[$i];

                        $insert_settlement = "insert into fmr_settlements (fmr_id,settlement_amt,settlement_type,settlement_ref_id,updated_date) 
                        values ('$fmr_user','$settlement_amt','$settlement_type','$settlement_ref','$today')";

                        $run_settlement = mysqli_query($con,$insert_settlement);
                        
                    }
                }
            }

            if($run_settlement){
                echo "<script>alert('Credit Raised')</script>";
                echo "<script>window.open('index.php?fmr_settlement_sheet','_self')</script>";
            }else{
                echo "<script>alert('Failed Try Again')</script>";
            }

} 

}

?>
