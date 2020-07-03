<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="container">
    <div class="row">
    <!-- City Details -->
        <div class="col-4">
        <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="text-center py-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ADD CITY
                            </button>
                        </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <form action="process_order.php" method="post">
                            <div class="form-group">
                            <input type="text" class="form-control" name="city_name" id="exampleFormControlInput1" placeholder="Enter City">
                        </div>
                        <button type="submit" name="add_city" class="btn btn-primary btn-lg btn-block">ADD CITY</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
        <table class="table text-center">
    <thead>
            <tr>
                <th>CITY NAME</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                            
                            $get_city_name = "select * from city";
            
                            $run_city_name = mysqli_query($con,$get_city_name);
            
                            while($row_city_name = mysqli_fetch_array($run_city_name)){
                            
                            ?>
            <tr>
                <td><?php echo $row_city_name['city_name']; ?></td>
                <td>
                <a href="index.php?delete_city=<?php echo $row_city_name['city_id']; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="tim-icons icon-simple-remove"></i>
                </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
            </div>

<!-- City Details -->

<!-- Area Details -->

            <div class="col-4">
            <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="text-center py-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                ADD AREA
                            </button>
                        </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <form action="process_order.php" method="post">
                            <div class="form-group">
                            <input type="text" class="form-control" name="area_name" id="exampleFormControlInput1" placeholder="Enter Area">
                        </div>
                        <div class="form-group">
                            <label >Select City</label>
                            <select class="form-control" name="city_id">
                            <?php 
                            
                            $get_city = "select * from city";

                            $run_city = mysqli_query($con,$get_city);

                            while($row_city = mysqli_fetch_array($run_city)){

                                $city_id = $row_city['city_id'];

                                $city_name = $row_city['city_name'];
                            
                            ?>
                            <option value="<?php echo $city_id; ?>"><?php echo $city_name; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="add_area" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            <table class="table">
        <thead>
            <tr>
                <th>CITY NAME</th>
                <th>AREA NAME</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                            
            $get_area_name = "select * from area";

            $run_area_name = mysqli_query($con,$get_area_name);

            while($row_area_name = mysqli_fetch_array($run_area_name)){

                $ci_id = $row_area_name['city_id'];

                $get_area_c = "select * from city where city_id=$ci_id";

                $run_area_c = mysqli_query($con,$get_area_c);

                $row_area_c = mysqli_fetch_array($run_area_c);
            
            ?>
            <tr>
                <td><?php echo $row_area_c['city_name']; ?></td>
                <td><?php echo $row_area_name['area_name']; ?></td>
                <td>
                <a href="index.php?delete_area=<?php echo $row_area_name['area_id']; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="tim-icons icon-simple-remove"></i>
                </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
            </table>
                </div>

<!-- Area Details -->

<!-- Landmark Details -->

                <div class="col-4">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="text-center py-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                                ADD LANDMARK
                            </button>
                        </h5>
                        </div>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <form action="process_order.php" method="post">
                            <div class="form-group">
                            <input type="text" class="form-control" name="landmark_name" id="exampleFormControlInput1" placeholder="Enter Landmark">
                        </div>
                        <div class="form-group">
                            <label >Select Area</label>
                            <select class="form-control" name="area_id">
                            <?php 
                            
                            $get_area = "select * from area";

                            $run_area = mysqli_query($con,$get_area);

                            while($row_area = mysqli_fetch_array($run_area)){

                                $area_id = $row_area['area_id'];

                                $area_name = $row_area['area_name'];
                            
                            ?>
                            <option value="<?php echo $area_id; ?>"><?php echo $area_name; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="add_landmark" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <table class="table">
            <thead>
                <tr>
                    <th>AREA NAME</th>
                    <th>LANDMARK</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                            
                    $get_landmark_name = "select * from landmark";
        
                    $run_landmark_name = mysqli_query($con,$get_landmark_name);
        
                    while($row_landmark_name = mysqli_fetch_array($run_landmark_name)){
        
                        $ai_id = $row_landmark_name['area_id'];
        
                        $get_area_a = "select * from area where area_id=$ai_id";
        
                        $run_area_a = mysqli_query($con,$get_area_a);
        
                        $row_area_a = mysqli_fetch_array($run_area_a);
                    
                    ?>
                    <tr>
                    <td><?php echo $row_area_a['area_name']; ?></td>
                    <td><?php echo $row_landmark_name['landmark_name']; ?></td>
                    <td>
                <a href="index.php?delete_landmark=<?php echo $row_landmark_name['landmark_id']; ?>" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="tim-icons icon-simple-remove"></i>
                </a>
                </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        </div>
    </div>

    <!-- Landmark Details -->
</div>

    <?php } ?>