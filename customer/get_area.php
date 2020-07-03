<?php 

include("includes/db.php");

if(isset($_GET['cityVal'])){

    $city_name = $_GET['cityVal'];

    $get_c_id = "select * from city where city_name='$city_name'";

    $run_c_id = mysqli_query($con,$get_c_id);

    $row_c_id = mysqli_fetch_array($run_c_id);

    $city_id = $row_c_id['city_id'];

    $get_area = "select * from area where city_id='$city_id'";

    $run_area = mysqli_query($con,$get_area);

    echo "<option disabled selected hidden>Choose Area</option>";

    while($row_area=mysqli_fetch_array($run_area)){

        $area_name = $row_area['area_name'];

            echo "
            
            <option>$area_name</option>

            ";
        
    }

}

if(isset($_GET['areaVal'])){

    $area_name = $_GET['areaVal'];

    $get_a_id = "select * from area where area_name='$area_name'";

    $run_a_id = mysqli_query($con,$get_a_id);

    $row_a_id = mysqli_fetch_array($run_a_id);

    $area_id = $row_a_id['area_id'];

    $get_landmark = "select * from landmark where area_id='$area_id'";

    $run_landmark = mysqli_query($con,$get_landmark);

    echo "<option disabled selected hidden>Choose Landmark</option>";

    while($row_landmark=mysqli_fetch_array($run_landmark)){

        $landmark_name = $row_landmark['landmark_name'];

            echo "
            
            <option>$landmark_name</option>

            ";
        
    }

}

?>