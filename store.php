<?php 

    include("includes/header.php");

?>

<!-- fixed-top -->

    <div class="container-fuild fixed-top">
        <!-- nav -->
            <ul class="nav bg-white shoploc pb-0">
                <li class="nav-item">
                    <a class="nav-link pt-2 mt-1" href="./">
                    <svg id="Layer" enable-background="new 0 0 64 64" height="25pt" float="left" fill="#999" viewBox="0 0 64 64" width="25pt" xmlns="http://www.w3.org/2000/svg"><path d="m54 30h-39.892l15.272-14.552c.799-.762.83-2.028.068-2.828-.762-.798-2.027-.831-2.828-.068l-17.445 16.625c-.758.758-1.175 1.761-1.175 2.823s.417 2.063 1.21 2.858l17.41 16.59c.387.369.884.552 1.38.552.528 0 1.055-.208 1.448-.62.762-.8.731-2.065-.068-2.828l-15.341-14.552h39.961c1.104 0 2-.896 2-2s-.896-2-2-2z" fill="#012e52"/></svg>
                    </a>
                </li>
                <li class="nav-item" style="width: 44%; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">

                        <?php 
                        
                        if(!isset($_SESSION['customer_email'])){

                            echo "
                            <a href='checkout.php'>
                                Hi Guest <br> 
                                <i class='fas fa-map-marker-alt'></i> 
                                Add your location
                                <i class='fas fa-chevron-down'></i> 
                            
                            </a>
                            ";

                        }else{

                            $c_email = $_SESSION['customer_email'];

                            $get_name = "select * from customers where customer_email='$c_email'";

                            $run_name = mysqli_query($con,$get_name);

                            $row_name = mysqli_fetch_array($run_name);

                            $c_id = $row_name['customer_id'];

                            $c_name = $row_name['customer_name'];

                            $get_address = "select * from customer_address where customer_id='$c_id' ";

                            $run_add_count = mysqli_query($con,$get_address);

                            $add_count = mysqli_num_rows($run_add_count);

                            $run_address = mysqli_query($con,$get_address);

                            $row_address = mysqli_fetch_array($run_address);

                            $c_phase = $row_address['customer_phase'];

                            $c_landmark = $row_address['customer_landmark'];

                            if($add_count>0){

                            echo " 
                            <a href='customer/my_account.php'>
                                $c_name <br> 
                            <i class='fas fa-map-marker-alt'></i> 
                            $c_phase, $c_landmark
                            <i class='fas fa-chevron-down'></i> 
                            </a>
                        ";
                            }else{

                                echo "
                                <a href='customer/my_account.php'>
                                $c_name <br> 
                                <i class='fas fa-map-marker-alt'></i> 
                                Add your Location
                                <i class='fas fa-chevron-down'></i> 
                                </a>
                                ";
                            }

                        }
                        
                        ?>    
                </li>
                <li class="nav-item ml-3">
                    <a class="nav-link px-1 pt-3 " href="search_product">
                        <svg version="1.1" id="Capa_1" width="20pt" height="20pt" fill="#999" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M225.474,0C101.151,0,0,101.151,0,225.474c0,124.33,101.151,225.474,225.474,225.474
                                        c124.33,0,225.474-101.144,225.474-225.474C450.948,101.151,349.804,0,225.474,0z M225.474,409.323
                                        c-101.373,0-183.848-82.475-183.848-183.848S124.101,41.626,225.474,41.626s183.848,82.475,183.848,183.848
                                        S326.847,409.323,225.474,409.323z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M505.902,476.472L386.574,357.144c-8.131-8.131-21.299-8.131-29.43,0c-8.131,8.124-8.131,21.306,0,29.43l119.328,119.328
                                        c4.065,4.065,9.387,6.098,14.715,6.098c5.321,0,10.649-2.033,14.715-6.098C514.033,497.778,514.033,484.596,505.902,476.472z"/>
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li class="nav-item ml-2 ">
                    <a href="cart.php" class="nav-link ml-4 pt-3 px-1">
                        <svg viewBox="0 -36 512.001 512" width="25pt" height="25pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg"><path d="m256 219.988281c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0"/><path d="m472 139.988281h-59.136719l-90.96875-125.152343c-8.171875-14.003907-26.171875-18.988282-40.46875-11.070313-14.492187 8.050781-19.703125 26.304687-11.648437 40.800781.230468.410156.484375.804688.769531 1.179688l71.351563 94.242187h-171.796876l71.351563-94.242187c.28125-.375.539063-.769532.769531-1.179688 8.035156-14.460937 2.882813-32.730468-11.660156-40.808594-14.265625-7.902343-32.265625-2.921874-40.453125 11.070313l-90.972656 125.160156h-59.136719c-22.054688 0-40 17.945313-40 40 0 17.394531 11.289062 32.539063 27.191406 37.898438 1.695313 1.3125 3.8125 2.101562 6.117188 2.101562.460937 0 .894531.027344 1.347656.089844 4.304688.578125 7.714844 3.84375 8.496094 8.117187l34.019531 187.164063c2.597656 14.269531 15.011719 24.628906 29.519531 24.628906h298.617188c14.507812 0 26.921875-10.359375 29.519531-24.632812l34.019531-187.15625c.78125-4.277344 4.195313-7.542969 8.515625-8.121094.4375-.0625.871094-.089844 1.328125-.089844 2.320313 0 4.453125-.796875 6.148438-2.125 15.914062-5.394531 27.160156-20.511719 27.160156-37.875 0-22.054687-17.945312-40-40-40zm-185.011719-105.660156c-2.285156-4.730469-.511719-10.492187 4.136719-13.070313 4.839844-2.683593 10.941406-.953124 13.609375 3.855469.195313.359375.417969.703125.65625 1.03125l82.746094 113.84375h-21.15625zm-80.378906-8.179687c.238281-.328126.453125-.667969.652344-1.019532 2.675781-4.8125 8.78125-6.546875 13.601562-3.878906 4.65625 2.585938 6.4375 8.339844 4.148438 13.078125l-79.992188 105.660156h-21.15625zm265.390625 173.839843h-176c-5.523438 0-10 4.476563-10 10 0 5.523438 4.476562 9.898438 10 9.898438h154.398438c-.523438 1.492187-.9375 3.039062-1.226563 4.632812l-34.023437 187.257813c-.863282 4.757812-5.003907 8.210937-9.839844 8.210937h-298.617188c-4.839844 0-8.976562-3.453125-9.84375-8.207031l-34.019531-187.164062c-.289063-1.59375-.703125-3.140626-1.226563-4.628907h154.398438c5.523438 0 10-4.476562 10-10 0-5.523437-4.476562-10-10-10h-176c-11.121094 0-20-9.0625-20-20 0-11.027343 8.972656-20 20-20h432c11.027344 0 20 8.972657 20 20 0 11.105469-9.085938 20-20 20zm0 0"/><path d="m256 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10zm0 0"/><path d="m356 389.988281c16.542969 0 30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30zm-10-110c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10v80c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10zm0 0"/><path d="m156 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.476563 10 10zm0 0"/></svg>
                        <span class="badge badge-light shopbadge <?php echo diaplay_cart(); ?>"><?php echo items(); ?></span>
                    </a>
                </li>
            </ul>
        <!-- nav -->

        <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pt-1">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </nav>
        <!-- breadcrumb -->

        <!-- sidebar -->
            <?php 

                include("includes/sidebar.php")

            ?>
        <!-- sidebar -->
    </div>

<!-- fixed-top -->
<div class="container-fluid pro_list p-3">
<?php

            if(!isset($_GET['cat'])){

            $get_store = "select * from store";

            $run_store = mysqli_query($con,$get_store);

            while($row_store=mysqli_fetch_array($run_store)){

                $store_id = $row_store['store_id'];

                $store_title = $row_store['store_title'];

                $store_img = $row_store['store_img'];

                $store_desc = $row_store['store_desc'];

                $min_price = $row_store['min_price'];


                ?>

        <div class="row bg-white mt-1 py-2">
                    <div class="col-4">
                        <img src="<?php echo $store_img; ?>" alt="..." class="img-thumbnail border-0">
                    </div>
                    <div class="col-8">
                            <h5 class="pro_list_title"><?php echo $store_title; ?></h5>
                            <h5 class="pro_list_desc"><?php echo $store_desc; ?></h5>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="pro_list_price">₹ <?php echo $min_price; ?></h5>
                                </div>
                                    <div class='col-6'>
                                        <a href="shop?store_id=<?php echo $store_id; ?>" class='btn ml-0 py-1  pull-left pro_store'>ADD <i class="fas fa-chevron-right"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>

    <?php           
                }
            }

    ?>

        <?php 
        
            if(isset($_GET['cat'])){
            
                $cat_id = $_GET['cat'];
                
                $get_cat_store = "select * from store where cat_id='$cat_id'";
                
                $run_cat_store = mysqli_query($con,$get_cat_store);

            while($row_cat_store=mysqli_fetch_array($run_cat_store)){

                $cat_store_id = $row_cat_store['store_id'];

                $cat_store_title = $row_cat_store['store_title'];

                $cat_store_img = $row_cat_store['store_img'];

                $cat_store_desc = $row_cat_store['store_desc'];

                $cat_min_price = $row_cat_store['min_price'];


                ?>

        <div class="row bg-white mt-1 py-2">
                    <div class="col-4">
                        <img src="<?php echo $cat_store_img; ?>" alt="..." class="img-thumbnail border-0">
                    </div>
                    <div class="col-8">
                            <h5 class="pro_list_title"><?php echo $cat_store_title; ?></h5>
                            <h5 class="pro_list_desc"><?php echo $cat_store_desc; ?></h5>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="pro_list_price">₹ <?php echo $cat_min_price; ?></h5>
                                </div>
                                <div class='col-6'>
                                        <a href="shop?store_id=<?php echo $cat_store_id; ?>" class='btn ml-0 py-1  pull-left pro_store'>ADD <i class="fas fa-chevron-right"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>

    <?php           
                }
            }

    ?>

    </div>

<?php

include("includes/footer.php");

?>