
<?php 

    include("includes/header.php");

?>


<!-- header -->
    <div class="container-fluid geolocation fixed-top pt-0 mt-0 px-0 mx-0">
        
        <div class="row">
            <div class="col geolocation px-4" id="geoheader">
            <?php 
                
                if(!isset($_SESSION['customer_email'])){

                    echo "
                    <a href='checkout'>
                        Hi Guest <br> 
                        <i class='fas fa-map-marker-alt'></i> 
                        Choose your location
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
                    <a href='customer/my_account'>
                        $c_name <br> 
                    <i class='fas fa-map-marker-alt'></i> 
                    $c_phase, $c_landmark
                    <i class='fas fa-chevron-down'></i> 
                    </a>
                ";
                    }else{

                        echo "
                        <a href='customer/my_account'>
                        $c_name <br> 
                        <i class='fas fa-map-marker-alt'></i> 
                        Add Your Location
                        <i class='fas fa-chevron-down'></i> 
                        </a>
                        ";
                    }

                }
                
                ?>    
            </div>
        </div>

    </div>
<!-- header -->

<!-- banner carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <?php 
                    
                    $get_slides = "select * from slider LIMIT 0,1";

                    $run_slides = mysqli_query($con,$get_slides);

                    while($row_slide=mysqli_fetch_array($run_slides)){

                        $slide_name = $row_slide['slide_name'];
                        $slide_image = $row_slide['slide_image'];
                        $slide_url = $row_slide['slide_url'];

                        echo "
                        
                        <div class='carousel-item p-3 active'>

                        <a href='$slide_url'>

                            <img src='admin_area/slides_images/$slide_image' class='d-block w-100'>

                        </a>

                        </div>
                        
                        ";
                    }

                    $get_slides = "select * from slider LIMIT 1,4";

                    $run_slides = mysqli_query($con,$get_slides);

                    while($row_slide=mysqli_fetch_array($run_slides)){

                        $slide_name = $row_slide['slide_name'];
                        $slide_image = $row_slide['slide_image'];

                        echo "
                        
                        <div class='carousel-item p-3'>

                        <a href='$slide_url'>

                            <img src='admin_area/slides_images/$slide_image' class='d-block w-100'>

                        </a>

                        </div>
                        
                        ";
                    }
                    
                    ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
<!-- banner carousel -->

<!-- product swipe -->

    <div class="container-fluid 
    gridheading">
        <div class="row pl-1 pb-2">
            <div class="col">
                <h5 class="heading_main">Most Reviewed</h5>
            </div>
        </div>
    </div>

    <div class="swiper-container">
            <div class="swiper-wrapper">

            <?php add_index_cart(); ?>
            <?php delete_index_cart(); ?>
            <?php
            
                $get_store = "select * from store LIMIT 0,7";
                
                $run_store = mysqli_query($con,$get_store);
                
                while($row_store=mysqli_fetch_array($run_store)){
                    
                    $store_id = $row_store['store_id'];
                    
                    $store_title = $row_store['store_title'];

                    $store_desc = $row_store['store_desc'];
                    
                    $min_price = $row_store['min_price'];
                    
                    $store_img1 = $row_store['store_img'];
                    
                ?>


                    <div class='swiper-slide'>
                                <div class='card pro_card my-2' style='width: 18rem;'>
                                            <img src='admin_area/other_images/store_images/<?php echo $store_img1; ?>' class='card-img-top pro_img p-1' alt='image responsive' height='100'>
                                            <div class='card-body p-1'>
                                            <p class='card-text text-left px-2 pro_title'><?php echo $store_title; ?></p>
                                            <p class='card-text text-left px-2 store_Desc'><?php echo $store_desc; ?></p>   
                                                <div class='row'>
                                                    <div class='col-6'>
                                                    <p class='card-text text-left pro_price pl-2 mt-1'>₹ <?php echo $min_price; ?></p>
                                                    </div>
                                                    <div class='col-6 px-0'>
                                                        <div class="row">
                                                        <div class='col-12'>
                                                            <a href="shop?store_id=<?php echo $store_id; ?>" class='btn ml-0 py-1  pull-left pro_store'>ADD <i class="fas fa-chevron-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                        </div>
                                </div>
                        </div>
                    
        <?php
                    
                }
            
            ?>
            </div>
                <!-- Add Pagination -->
                <!-- <div class="swiper-pagination"></div> -->
    </div>

<!-- product swipe -->

<!-- floatnav -->
    <div class="container-fuild floatnav ">

        <ul class="nav fixed-bottom justify-content-center bg-white">
        <li class="nav-item px-2  text-center">
        <a class="nav-link active pb-0 pt-2 px-1" href="./">
        <svg height="20pt" viewBox="0 1 511 511.999" width="20pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg"><path d="m498.699219 222.695312c-.015625-.011718-.027344-.027343-.039063-.039062l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.808594-33.328126-13.808594-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.144532.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.441406 13.234375 31.273437 13.746093.484375.046876.96875.070313 1.457031.070313h8.320313v153.695313c0 30.417968 24.75 55.164062 55.167969 55.164062h81.710937c8.285157 0 15-6.71875 15-15v-120.5c0-13.878906 11.292969-25.167969 25.171875-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.28125 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.164062v-153.695313h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.8125 18.359375-18.367187 18.367187-48.253906.027344-66.632813zm-21.242188 45.421876c-3.238281 3.238281-7.542969 5.023437-12.117187 5.023437h-22.71875c-8.285156 0-15 6.714844-15 15v168.695313c0 13.875-11.289063 25.164062-25.167969 25.164062h-66.710937v-105.5c0-30.417969-24.746094-55.167969-55.167969-55.167969h-48.195313c-30.421875 0-55.171875 24.75-55.171875 55.167969v105.5h-66.710937c-13.875 0-25.167969-11.289062-25.167969-25.164062v-168.695313c0-8.285156-6.714844-15-15-15h-22.328125c-.234375-.015625-.464844-.027344-.703125-.03125-4.46875-.078125-8.660156-1.851563-11.800781-4.996094-6.679688-6.679687-6.679688-17.550781 0-24.234375.003906 0 .003906-.003906.007812-.007812l.011719-.011719 208.847656-208.839844c3.234375-3.238281 7.535157-5.019531 12.113281-5.019531 4.574219 0 8.875 1.78125 12.113282 5.019531l208.800781 208.796875c.03125.03125.066406.0625.097656.09375 6.644531 6.691406 6.632813 17.539063-.03125 24.207032zm0 0"/></svg>
            <span class="icon-name">Home</span>
        </a>
        </li>
        <li class="nav-item px-2  text-center">
        <?php 
                        
                        if(!isset($_SESSION['customer_email'])){

                                echo "
                                
                                <a class='nav-link  pb-0 pt-2' href='checkout'>
                                    <svg height='20pt' viewBox='0 0 512 512' width='20pt' fill='#ff7b00' xmlns='http://www.w3.org/2000/svg'><path d='m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0'/><path d='m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0'/></svg>
                                <span class='icon-name'>Account</span>
                                </a>
                                
                                ";
                
                            }else{
                
                                echo "
                                
                                <a class='nav-link  pb-0 pt-2' href='customer/my_account'>
                                    <svg height='20pt' viewBox='0 0 512 512' width='20pt' fill='#ff7b00' xmlns='http://www.w3.org/2000/svg'><path d='m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0'/><path d='m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0'/></svg>
                                <span class='icon-name'>Account</span>
                                </a>
                                
                                ";
                
                            }
                        
                        ?>
        </li>
        <li class="nav-item px-2  text-center">
            <a class="nav-link pb-0 pt-2" href="store">
        <svg version="1.1" id="Capa_1" width="18pt" height="18pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
                <g>
                    <path d="M432,0h-76c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80V80
                        C512,35.888,476.112,0,432,0z M472,156c0,22.056-17.944,40-40,40h-76c-22.056,0-40-17.944-40-40V80c0-22.056,17.944-40,40-40h76
                        c22.056,0,40,17.944,40,40V156z"/>
                </g>
            </g>
            <g>
                <g>
                    <path d="M156,0H80C35.888,0,0,35.888,0,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80V80
                        C236,35.888,200.112,0,156,0z M196,156c0,22.056-17.944,40-40,40H80c-22.056,0-40-17.944-40-40V80c0-22.056,17.944-40,40-40h76
                        c22.056,0,40,17.944,40,40V156z"/>
                </g>
            </g>
            <g>
                <g>
                    <path d="M156,276H80c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80v-76
                        C236,311.888,200.112,276,156,276z M196,432c0,22.056-17.944,40-40,40H80c-22.056,0-40-17.944-40-40v-76c0-22.056,17.944-40,40-40
                        h76c22.056,0,40,17.944,40,40V432z"/>
                </g>
            </g>
            <g>
                <g>
                    <path d="M492,412c-11.046,0-20,8.954-20,20c0,22.056-17.944,40-40,40h-76c-22.056,0-40-17.944-40-40v-76c0-22.056,17.944-40,40-40
                        h76c15.905,0,30.301,9.419,36.675,23.996c4.425,10.121,16.218,14.736,26.338,10.312c10.121-4.426,14.737-16.218,10.312-26.338
                        C492.582,294.829,463.8,276,432,276h-76c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80
                        C512,420.954,503.046,412,492,412z"/>
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
                <span class="icon-name">Products</span>
            </a>
        </li>
        <li class="nav-item px-2  text-center">
            <a class="nav-link pb-0 pt-2 pr-2" href="cart">
                <svg viewBox="0 -36 512.001 512" width="22pt" height="22pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg"><path d="m256 219.988281c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0"/><path d="m472 139.988281h-59.136719l-90.96875-125.152343c-8.171875-14.003907-26.171875-18.988282-40.46875-11.070313-14.492187 8.050781-19.703125 26.304687-11.648437 40.800781.230468.410156.484375.804688.769531 1.179688l71.351563 94.242187h-171.796876l71.351563-94.242187c.28125-.375.539063-.769532.769531-1.179688 8.035156-14.460937 2.882813-32.730468-11.660156-40.808594-14.265625-7.902343-32.265625-2.921874-40.453125 11.070313l-90.972656 125.160156h-59.136719c-22.054688 0-40 17.945313-40 40 0 17.394531 11.289062 32.539063 27.191406 37.898438 1.695313 1.3125 3.8125 2.101562 6.117188 2.101562.460937 0 .894531.027344 1.347656.089844 4.304688.578125 7.714844 3.84375 8.496094 8.117187l34.019531 187.164063c2.597656 14.269531 15.011719 24.628906 29.519531 24.628906h298.617188c14.507812 0 26.921875-10.359375 29.519531-24.632812l34.019531-187.15625c.78125-4.277344 4.195313-7.542969 8.515625-8.121094.4375-.0625.871094-.089844 1.328125-.089844 2.320313 0 4.453125-.796875 6.148438-2.125 15.914062-5.394531 27.160156-20.511719 27.160156-37.875 0-22.054687-17.945312-40-40-40zm-185.011719-105.660156c-2.285156-4.730469-.511719-10.492187 4.136719-13.070313 4.839844-2.683593 10.941406-.953124 13.609375 3.855469.195313.359375.417969.703125.65625 1.03125l82.746094 113.84375h-21.15625zm-80.378906-8.179687c.238281-.328126.453125-.667969.652344-1.019532 2.675781-4.8125 8.78125-6.546875 13.601562-3.878906 4.65625 2.585938 6.4375 8.339844 4.148438 13.078125l-79.992188 105.660156h-21.15625zm265.390625 173.839843h-176c-5.523438 0-10 4.476563-10 10 0 5.523438 4.476562 9.898438 10 9.898438h154.398438c-.523438 1.492187-.9375 3.039062-1.226563 4.632812l-34.023437 187.257813c-.863282 4.757812-5.003907 8.210937-9.839844 8.210937h-298.617188c-4.839844 0-8.976562-3.453125-9.84375-8.207031l-34.019531-187.164062c-.289063-1.59375-.703125-3.140626-1.226563-4.628907h154.398438c5.523438 0 10-4.476562 10-10 0-5.523437-4.476562-10-10-10h-176c-11.121094 0-20-9.0625-20-20 0-11.027343 8.972656-20 20-20h432c11.027344 0 20 8.972657 20 20 0 11.105469-9.085938 20-20 20zm0 0"/><path d="m256 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10zm0 0"/><path d="m356 389.988281c16.542969 0 30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30zm-10-110c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10v80c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10zm0 0"/><path d="m156 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.476563 10 10zm0 0"/></svg>
                <span class="badge badge-light <?php echo diaplay_cart(); ?>"><?php echo items(); ?></span>
                <span class="icon-name">Basket</span>
            </a>
        </li>
        </ul>

    </div>
<!-- floatnav -->

<!-- Product Categories -->
    <div class="container-fluid gridheading mt-3">
        <div class="row pl-1 pb-2">
            <div class="col">
                <h5 class="heading_main">Shop by Categories</h5>
            </div>
        </div>
        
    </div>
    <div class="container">
            <div class="row mx-1">

            <?php 
            
            $get_cat = "select * from categories ";

            $run_cat = mysqli_query($db,$get_cat);
            
            while($row_cat=mysqli_fetch_array($run_cat)){

                $cat_id = $row_cat['cat_id'];

                $cat_img = $row_cat['cat_image'];

            
            ?>
                            <div class="col-6 px-2 py-2">
                                <a href="store.php?cat=<?php echo $cat_id;?>">
                                    <img src="admin_area/other_images/<?php echo $cat_img; ?>" class="img-thumbnail" alt="..." >
                                </a>
                            </div>
            <?php } ?>
                    </div>

                    
            </div>
    </div>    

<!-- Product Categories -->

<!-- offers -->
            <div class="container-fluid gridheading mt-3">
            <div class="row pl-1 pb-2 mx-0">
                <div class="col">
                    <h5 class="heading_main"></h5>
                </div>
            </div>
            </div>

    <div class="container offer_box">
        <div class="row">
        <?php 
                
                $get_offer = "select * from offers ";
    
                $run_offer = mysqli_query($db,$get_offer);
                
                while($row_offer=mysqli_fetch_array($run_offer)){

                    $offer_id = $row_offer['offer_id'];

                    $offer_img = $row_offer['offer_image'];

                
                ?>
            <div class="col-12 mx-1 my-2">
                <a href="newshop.php">
                <img src="admin_area/other_images/<?php echo $offer_img; ?>" class="img-fluid" alt="Responsive image">
                </a>
            </div>
                <?php } ?>
        </div>
    </div>
<!-- offers -->

<?php 

include("includes/footer.php");

?>