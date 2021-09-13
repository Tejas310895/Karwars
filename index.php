
<?php 

    include("includes/header.php");

?>

<!-- header -->
    <div class="container-fluid geolocation fixed-top pt-0 mt-0 px-0 mx-0 bg-white">
        <div class="row">
            <div class="col-3">
                    <?php 
                                    
                    if(!isset($_COOKIE['user'])){

                            echo "
                            
                            <a class='nav-link  pb-0 pt-2 my_account' href='check_user'>
                                <svg height='18pt' viewBox='0 0 512 512' width='18pt' fill='#29ABE2' xmlns='http://www.w3.org/2000/svg'><path d='m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0'/><path d='m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0'/></svg>
                            </a>
                            
                            ";
            
                        }else{
            
                            echo "
                            
                            <a class='nav-link  pb-0 pt-2 my_account' href='customer/my_account'>
                                <svg height='18pt' viewBox='0 0 512 512' width='18pt' fill='#29ABE2' xmlns='http://www.w3.org/2000/svg'><path d='m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0'/><path d='m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0'/></svg>
                            </a>
                            
                            ";
            
                        }
                    
                    ?>
            </div>
            <div class="col-6">
                <img src="admin_area/admin_images/karwarslogo.png" alt="" class="img-thumbnail d-bock mx-auto bg-transparent brand-logo border-0 rounded-0">
            </div>
            <div class="col-3">
            <!-- toggle -->
                <div  id="phone" class="button-call">
                    <button id="btn-call" class="bg-transparent border-0"><i class="far fa-question-circle"></i></button>
                </div>
                <div id="div-call" class="slide-call">
                    <h6>Need Help ✆ 7892916394</h6>
                </div>
            <!-- toggle -->
            </div>
        </div>
    </div>
<!-- header -->
<!-- schedule -->
    <?php 

    date_default_timezone_set('Asia/Kolkata');
    $today = date("H:i");

    if($today>='09:00' && $today<='18:00'){
        $startTimeamp = strtotime($today) + 60*60*3;
        $endTimeamp = strtotime($today) + 60*60*6;
        $startTime = date('H:i', $startTimeamp);
        $endTime = date('H:i', $endTimeamp);
        if($endTime>='17:00' && $endTime<='09:00'){
            $endTime = date('h:i A', $endTimeamp);
        }else{
            $delendTime = '07:00 PM';
        }

        if($startTime<='16:00'){
            $delstartTime = date('h:i A', $endTimeamp);
        }else{
            $delstartTime = '06:00 PM';
        }
        $delivery_by = "TODAY ".($delstartTime)." TO ".($delendTime)."";
    }elseif ($today>='18:00') {
        $delivery_by = "TOMORROW 10 AM TO 12 PM";
    }elseif ($today<='09:00') {
        $delivery_by = "TODAY  10 AM TO 12 PM";
    }

    ?>
    <div class="container mt-3 bg-success text-white pl-4">
        <div class="row">
            <div class="col-2">
                <img class="pull-left ml-2" src="admin_area/admin_images/delivery-truck.svg" alt="" width="41">
            </div>
            <div class="col-10 pl-2" style="padding-top:5px;">
                <div class="alert mb-0 px-1 pt-1 pb-0 border-0" role="alert">
                    <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;">DELIVERY EXPECTED BY*</h6>
                    <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;">Next Available delivery Slot</h6>
                    <!-- <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;"><?php //echo $delivery_by; ?></h6> -->
                </div>
            </div>
        </div>
    </div>
<!-- schedule -->
<!-- banner carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <?php 
                    
                    $get_slides = "select * from slider where image_type='head_slide' LIMIT 0,1";

                    $run_slides = mysqli_query($con,$get_slides);

                    while($row_slide=mysqli_fetch_array($run_slides)){

                        $slide_name = $row_slide['slide_name'];
                        $slide_image = $row_slide['slide_image'];
                        $slide_url = $row_slide['slide_url'];

                        echo "
                        
                        <div class='carousel-item p-3 active'>

                        <a href='$slide_url'>

                            <img src='$slide_image' class='d-block w-100'>

                        </a>

                        </div>
                        
                        ";
                    }

                    $get_slides = "select * from slider where image_type='head_slide' LIMIT 1,4";

                    $run_slides = mysqli_query($con,$get_slides);

                    while($row_slide=mysqli_fetch_array($run_slides)){

                        $slide_name = $row_slide['slide_name'];
                        $slide_image = $row_slide['slide_image'];

                        echo "
                        
                        <div class='carousel-item p-3'>

                        <a href='$slide_url'>

                            <img src='$slide_image' class='d-block w-100'>

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
<!-- <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show border text-justify border-0" role="alert">
                    Due to the GANESH CHATURTI festival home deliveries will not be done on 9th and 10th of august, Regret for the inconvenience caused.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div> -->
<!-- product swipe -->
    <div class="container-fluid px-0">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/min_ord_amtArtboard_1_2x-100_YjDvAtd9z.jpg" alt="" class="img-fluid mx-0">
    </div>

    <!-- Offer Zone -->
        <!-- <div class="container-fluid my-2 py-2 offer_container">
            <div class="swiper-container">
                <div class="swiper-wrapper"> -->
                    <?php 
                    
                    // $get_per_off = "select * from slider where image_type='promo_images' LIMIT 7";
                    // $run_per_off = mysqli_query($con,$get_per_off);
                    // while($row_per_off = mysqli_fetch_array($run_per_off)){

                    //     $slide_name = $row_per_off['slide_name'];
                    //     $slide_image = $row_per_off['slide_image'];
                    //     $slide_url = $row_per_off['slide_url'];

                    ?>
                    <!-- <div class='swiper-slide'>
                        <a href="<?php //echo $slide_url; ?>">
                            <img class="card-img-top per_off_img" src="<?php //echo $slide_image; ?>" alt="<?php //echo $slide_name; ?>">
                        </a>
                    </div> -->
                    <?php //} ?>
                <!-- </div> -->
                <!-- <div class="swiper-pagination"></div> -->
            <!-- </div> -->
            <!-- <div class="row pl-1 text-center">
                <a href="shop_offer?offer_zone=10" class="btn offer_box">
                    <h6 class="text-light pt-2">Below-10%</h6>
                </a>
                <a href="shop_offer?offer_zone=20" class="btn offer_box">
                    <h6 class="text-light pt-2">10% - 30%</h6>
                </a>
                <a href="shop_offer?offer_zone=30" class="btn offer_box">
                    <h6 class="text-light pt-2">30%-Above</h6>
                </a>
            </div> -->
        <!-- </div> -->
    <!-- Offer Zone -->
    <!-- banner display -->
    <!-- <img src="https://ik.imagekit.io/wrnear2017/karwars_images/cool_drink_offArtboard_51_4x-50_DhJsYBGff.jpg" alt="" class="img-fluid mb-2"> -->
    <a href="https://karwars.in/shop?store_id=40">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_74_2x-100_W9TLM2pmaA.jpg?updatedAt=1627924915176" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
    <a href="https://karwars.in/shop?store_id=36">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_78_2x-100_t9CKeE1jRr.jpg?updatedAt=1627924918767" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
    <a href="https://karwars.in/shop?store_id=64">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_75_2x-100_ESnwxPKVvW.jpg?updatedAt=1627924916162" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
    <!-- <a href="#">
    <div class="container-fluid p-2">
        <img src="https://ik.imagekit.io/wrnear2017/august_upload/first_pageArtboard_80_2x-100_jpydbiHSrLj.jpg?updatedAt=1628951509139" alt="" class="img-fluid mx-0 rounded">
    </div>
    </a> -->
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-6 px-0">
                    <img src="https://ik.imagekit.io/wrnear2017/karwars_images/bisc_offerArtboard_53_2x-50_QdGpQJwFy.jpg" alt="" class="img-fluid p-2" style="border-radius:1rem;">
            </div>
            <div class="col-6 px-0">
                    <img src="https://ik.imagekit.io/wrnear2017/karwars_images/bisc_offerArtboard_54_2x-50_pDIRq4GgTi.jpg" alt="" class="img-fluid p-2" style="border-radius:1rem;">
            </div>
        </div>
    </div> -->
    <!-- banner display -->

    <!-- season banner -->
    <!-- <div class="container-fluid px-0">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/pre_monsoon_site1Artboard_60_2x-100_1__nKU3uasfg.jpg" alt="" class="img-fluid mx-0">
    </div>
    <div class="container-fluid px-0 mb-2">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/buy_get_1Artboard_58_2x-100_bENp0CJNI.jpg" alt="" class="img-fluid mx-0">
    </div> -->
    <!-- season banner -->

    <!-- <div class="swiper-container">
            <div class="swiper-wrapper"> -->

            <?php //add_index_cart(); ?>
            <?php //delete_index_cart(); ?>
            <?php

                // $get_promo = "select * from promo_products";
                // $run_promo = mysqli_query($con,$get_promo);
                // while($row_promo = mysqli_fetch_array($run_promo)){
                // $promo_store_id = $row_promo['store_id'];
            
                // $get_store = "SELECT * FROM store where store_id='$promo_store_id'";
                
                // $run_store = mysqli_query($con,$get_store);
                
                // $row_store=mysqli_fetch_array($run_store);
                    
                // $store_id = $row_store['store_id'];
                
                // $store_title = $row_store['store_title'];

                // $store_desc = $row_store['store_desc'];
                
                // $min_price = $row_store['min_price'];
                
                // $store_img1 = $row_store['store_img'];

                // $get_offer_badge = "SELECT * from products where store_id='$store_id' order by 100-((product_price/price_display)*100) DESC limit 1";
                // $run_offer_badge = mysqli_query($con,$get_offer_badge);
                // $row_offer_badge = mysqli_fetch_array($run_offer_badge);

                // $product_price_badge = $row_offer_badge['product_price'];
                // $price_display_badge = $row_offer_badge['price_display'];
                
                // if( $price_display_badge>0){
                //     $offer_badge = round(100-(($product_price_badge/$price_display_badge)*100));
                // }else{
                //     $offer_badge = 0; 
                // }
                
                ?>


                    <!-- <div class='swiper-slide'>
                                <div class='card pro_card my-2' style='width: 18rem;'>
                                            <span class="badge offer-badge <?php //if($offer_badge==0){echo "d-none";}else{echo "show";}?>">
                                                <h6 class="offer-badge-text mb-0"><?php //echo $offer_badge; ?>%</h6>
                                                <small>OFF</small>
                                            </span>
                                            <img src='<?php //echo $store_img1; ?>' class='card-img-top pro_img p-1' alt='image responsive' height='100'>
                                            <div class='card-body p-1'>
                                            <p class='card-text text-left px-2 pro_title'><?php //echo $store_title; ?></p>
                                            <p class='card-text text-left px-2 store_Desc'><?php //echo $store_desc; ?></p>   
                                                <div class='row'>
                                                    <div class='col-6'>
                                                    <p class='card-text text-left pro_price pl-2 mt-1'>₹ <?php //echo $min_price; ?></p> 
                                                    </div>
                                                    <div class='col-6 px-0'>
                                                        <div class="row">
                                                            <div class='col-12 pl-1'>
                                                                <a href="shop?store_id=<?php //echo $store_id; ?>" class='btn ml-0 py-1  pull-left pro_store'>VIEW <i class="fas fa-chevron-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                        </div>
                                </div>
                        </div> -->
                    
        <?php
                    
                //}
            
            ?>
            <!-- </div> -->
                <!-- Add Pagination -->
                <!-- <div class="swiper-pagination"></div> -->
    <!-- </div> -->

<!-- product swipe -->

<!-- sale @ -->
<!-- <div class="container-fluid mb-3 px-3">
    <fieldset class="p-2" style="border: 3px solid #4da3ff;">
        <legend class="text-center text-white" style="font-family:jost;width:60%;background-color: #4da3ff;border-radius:10px;">Dhamaka Deals @</legend>
        <ul class="nav nav-pills nav-fill justify-content-center">
            <li class="nav-item">
                <a class="nav-link active mx-1" href="shop_offer?offer_zone=9" style="background-color: #4da3ff;font-family:Josefin Sans;">₹ 9</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active mx-1" href="shop_offer?offer_zone=49" style="background-color: #4da3ff;font-family:Josefin Sans;">₹ 49</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active mx-1" href="shop_offer?offer_zone=99" style="background-color: #4da3ff;font-family:Josefin Sans;">₹ 99</a>
            </li>
        </ul>
    </fieldset>
</div> -->
<!-- sale @ -->

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
            <a class='nav-link  pb-0 pt-2 px-4' href="search_product">
            <svg version="1.1" id="Capa_1"  width="20pt" height="20pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M225.474,0C101.151,0,0,101.151,0,225.474c0,124.33,101.151,225.474,225.474,225.474
                            c124.33,0,225.474-101.144,225.474-225.474C450.948,101.151,349.804,0,225.474,0z M225.474,409.323
                            c-101.373,0-183.848-82.475-183.848-183.848S124.101,41.626,225.474,41.626s183.848,82.475,183.848,183.848
                            S326.847,409.323,225.474,409.323z"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M505.902,476.472L386.574,357.144c-8.131-8.131-21.299-8.131-29.43,0c-8.131,8.124-8.131,21.306,0,29.43l119.328,119.328
                            c4.065,4.065,9.387,6.098,14.715,6.098c5.321,0,10.649-2.033,14.715-6.098C514.033,497.778,514.033,484.596,505.902,476.472z"></path>
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
            <span class='icon-name'>Search</span>
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
    <div class="container" style="background:#ffeb7a;">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/site_images2_N1eIqJeUi_.png" alt="" class="img-fluid">
        <div class="row mx-1">

        <?php 
        
        $get_cat = "SELECT * from categories order by cat_id asc";

        $run_cat = mysqli_query($db,$get_cat);
        
        while($row_cat=mysqli_fetch_array($run_cat)){

            $cat_id = $row_cat['cat_id'];

            $cat_img = $row_cat['cat_image'];

            $get_store_of = "select * from store where cat_id=$cat_id";
            $run_store_of = mysqli_query($con,$get_store_of);
            $cat_dis_res = 0;
            $avg_count = 0;
            while($row_store_of=mysqli_fetch_array($run_store_of)){

                $store_id_of = $row_store_of['store_id'];

                $get_pro_dis = "select (1-(product_price/price_display)) as cat_dis from products where store_id=$store_id_of order by cat_dis desc limit 1";
                $run_pro_dis = mysqli_query($con,$get_pro_dis);
                $row_pro_dis = mysqli_fetch_array($run_pro_dis);

                $cat_dis = $row_pro_dis['cat_dis'];

                if(is_null($cat_dis) || $cat_dis<=0){
                    $cat_dis_res = 0;
                    $avg_count = 0;
                }else{
                    $cat_dis_res += $cat_dis;
                    $avg_count = ++$avg_count;
                }

            }

        
        ?>
                        <div class="col-4 px-0">
                            <a href="store.php?cat=<?php echo $cat_id;?>">
                            <?php 
                                        
                                        if($cat_dis_res<=0){

                                        }else{
                                            $display_badge = round(($cat_dis_res/$avg_count)*100);
                                        echo "
                                <span class='badge badge-danger off_badge'>
                                    <h6 class='mb-0 pt-1'>
                                        $display_badge%
                                    </h6>
                                    <h6 style='font-size:.6rem;' class='mb-4'>OFF</h6>
                                </span> 
                                
                                ";} ?>
                                <img src="<?php echo $cat_img; ?>" class="img-thumbnail bg-transparent border-0" alt="..." >
                            </a>
                        </div>
        <?php } ?>
                </div>

                
        </div>
    </div>    

<!-- Product Categories -->
<!-- believe in us -->
    <a href="https://karwars.in/shop?store_id=1">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_79_2x-100_YSVV1PQvt_.jpg?updatedAt=1627924914055" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
    <a href="https://karwars.in/store.php?cat=15">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_76_2x-100_bbnNyh3DQ73.jpg?updatedAt=1627924917005" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
    <div class="container-fluid p-2">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/thirddayArtboard_14_2x-100_1__ffmdLL8ng.jpg" alt="" class="img-fluid mx-0 rounded">
    </div>
    <div class="container-fluid p-2">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_pageArtboard_70_2x-100_zIDxdJ4Xc.jpg" alt="" class="img-fluid mx-0 rounded">
    </div>
    <a href="https://karwars.in/store.php?cat=17">
        <div class="container-fluid p-2">
            <img src="https://ik.imagekit.io/wrnear2017/karwars_images/first_page_newArtboard_77_2x-100_Mlr9DYxXi8.jpg?updatedAt=1627924917953" alt="" class="img-fluid mx-0 rounded">
        </div>
    </a>
        <!-- stay safe -->
        <div class="container-fluid px-0">
        <img src="https://ik.imagekit.io/wrnear2017/karwars_images/stay_home_stay_safeArtboard_61_2x-100_Qz-cV33r9.jpg" alt="" class="img-fluid mx-0">
    </div>
    <!-- stay safe -->
<!-- believe in us -->
    <!-- <div class="container-fluid mt-3">
        <div class="row">
            <div class="<?php 
                
                // if(!isset($_COOKIE['user'])){
                //     echo "col-6 px-0";
                // }else{
                //     echo "col-6 px-0";
                // }
                ?> ml-2" style="background-color:#29ABE2;border-radius:10px 10px 0px 0px;">
                <h5 class="text-center pt-2 text-white" style="font-family:Josefin Sans;">
                <?php 
                
                // if(!isset($_COOKIE['user'])){
                //     echo "You May Like";
                // }else{
                //     echo "Recently Ordered";
                // }
                ?>
                </h5>
            </div>
        </div>
    </div> -->
   <!-- Offer Zone -->
        <!-- <div class="container-fluid mb-2 py-2 mx-2 offer_container" style="background-color:#29ABE2;">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php 
                    
                    // if(!isset($_COOKIE['user'])){

                    // ?>
                    // <?php 
                    
                    // $get_promo_pro = "select * from promo_products";
                    // $run_promo_pro = mysqli_query($con,$get_promo_pro);
                    // while($row_promo_pro=mysqli_fetch_array($run_promo_pro)){
                    //     $store_id = $row_promo_pro['store_id'];

                    //     $get_store_pro = "select * from store where store_id='$store_id'";
                    //     $run_store_pro = mysqli_query($con,$get_store_pro);
                    //     $row_store_pro = mysqli_fetch_array($run_store_pro);

                    //     $store_img = $row_store_pro['store_img'];
                    //     $store_title = $row_store_pro['store_title'];
                    ?>
                    <div class='swiper-slide'>
                        <a href="shop?store_id=<?php //echo $store_id; ?>">
                            <div class="card" style="width: 6rem;">
                                <img class="img-thumbnail d-block mx-auto bg-transparent border-0 p-2" src="<?php //echo $store_img; ?>" alt="<?php //echo $store_title; ?>" style="height:80px;">
                                <h6 class="card-title mb-1" style="width: 100%; text-overflow: ellipsis; white-space: nowrap; font-family:Josefin Sans; overflow: hidden;"><?php //echo $store_title; ?></h6>
                            </div>
                        </a>
                    </div>
                    <?php //} ?>
                    <?php //}else{ ?>
                        <?php 

                        // $c_email = $_COOKIE['user'];

                        // $get_name = "select * from customers where customer_email='$c_email'";

                        // $run_name = mysqli_query($con,$get_name);

                        // $row_name = mysqli_fetch_array($run_name);

                        // $cpromo_id = $_COOKIE['user'];
                            
                        // $get_cpromo_pro = "select * from customer_orders where customer_id='$cpromo_id' group by pro_id order by order_id limit 7";
                        // $run_cpromo_pro = mysqli_query($con,$get_cpromo_pro);
                        // while($row_cpromo_pro = mysqli_fetch_array($run_cpromo_pro)){

                        //     $cpromo_pro_id = $row_cpromo_pro['pro_id'];

                        //     $get_cpromo_store_id = "select * from products where product_id='$cpromo_pro_id'";
                        //     $run_cpromo_store_id = mysqli_query($con,$get_cpromo_store_id);
                        //     $row_cpromo_store_id = mysqli_fetch_array($run_cpromo_store_id);

                        //     $cpromo_store_id = $row_cpromo_store_id['store_id'];
                        //     $cpromo_product_id = $row_cpromo_store_id['product_id'];
                        //     $cpromo_product_title = $row_cpromo_store_id['product_title'];
                        //     $cpromo_product_img1 = $row_cpromo_store_id['product_img1'];
                        //     $cpromo_product_desc = $row_cpromo_store_id['product_desc'];

                        
                        ?>
                    <div class='swiper-slide'>
                        <a href="shop?store_id=<?php //echo $cpromo_store_id; ?>#<?php //echo $cpromo_product_id; ?>">
                            <div class="card" style="width: 6rem;">
                            <img class="img-thumbnail d-block mx-auto bg-transparent border-0 p-2" src="<?php //echo $cpromo_product_img1; ?>" alt="<?php //echo $cpromo_product_title; ?>" style="height:80px;">
                            <div class="card-body p-1">
                            <h6 class="card-title mb-1 mx-0 text-center" style="width: 100%; text-overflow: ellipsis; white-space: nowrap; font-family:Josefin Sans; overflow: hidden;"><?php echo $cpromo_product_title; ?> <br><small><?php echo $cpromo_product_desc; ?></small></h6>
                            </div>
                            </div>
                        </a>
                    </div>
                    <?php //} ?>
                    <?php //} ?>
                </div>
                <div class="swiper-pagination"></div> 
            </div>
        </div> -->
    <!-- Offer Zone -->
    
    <!-- offer -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php 
            
            $get_foot_img = "select * from slider where image_type='foot_slide' limit 0,1";
            $run_foot_img = mysqli_query($con,$get_foot_img);
            while($row_foot_img=mysqli_fetch_array($run_foot_img)){
                
                $slide_name = $row_foot_img['slide_name'];
                $slide_image = $row_foot_img['slide_image'];
                $slide_url = $row_foot_img['slide_url'];
            ?>
            <div class="carousel-item active">
            <a href="<?php echo $slide_url; ?>">
            <img class="d-block w-100 rounded-0 mx-0" src="<?php echo $slide_image; ?>" alt="<?php echo $slide_name; ?>">
            </a>
            </div>
            <?php } ?>
            <?php 
            
            $get_foot_img = "select * from slider where image_type='foot_slide' limit 1,4";
            $run_foot_img = mysqli_query($con,$get_foot_img);
            while($row_foot_img=mysqli_fetch_array($run_foot_img)){
                
                $slide_name = $row_foot_img['slide_name'];
                $slide_image = $row_foot_img['slide_image'];
                $slide_url = $row_foot_img['slide_url'];
            ?>
            <div class="carousel-item">
            <a href="<?php echo $slide_url; ?>">
            <img class="d-block w-100 rounded-0 mx-0" src="<?php echo $slide_image; ?>" alt="<?php echo $slide_name; ?>">
            </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid pt-2" style="background-color:#e6e6e6;">
        <div class="row mt-2 pb-2">
            <div class="col-12">
                <h6 class="pl-2" style="font-size:1rem;">SERVICES</h6>
                <ul class="pl-1">
                    <li class="d-block"><a href="about_us" style="color:#000 !important;">About Us</a></li>
                    <li class="d-block"><a href="terms&policies" style="color:#000 !important;">Terms & Policies</a></li>
                </ul>
            </div>
            <div class="col-12" style="font-family: Josefin Sans;">
                <h6 class="pl-2" style="font-size:1rem;">CONTACT US</h6>
                <li class="d-block" style="font-size:0.9rem;">KARWARS ONLINE SUPERMARKET</li>
                <li class="d-block" style="font-size:0.8rem;">Habbuwada karwar - 581301</li>
                <li class="d-block" style="font-size:0.8rem;">Call Us :- +91 7892916394</li>
                <li class="d-block" style="font-size:0.8rem;">Email Us :- karwarsgrocery@gmail.com</li>
            </div>
        </div>
    </div>
    <!-- offer -->

<!-- offers -->
            <!-- <div class="container-fluid gridheading mt-3">
            <div class="row pl-1 pb-2 mx-0">
                <div class="col">
                    <h5 class="heading_main"></h5>
                </div>
            </div>
            </div> -->

    <!-- <div class="container offer_box">
        <div class="row"> -->
        <?php 
                
                // $get_offer = "select * from offers ";
    
                // $run_offer = mysqli_query($db,$get_offer);
                
                // while($row_offer=mysqli_fetch_array($run_offer)){

                //     $offer_id = $row_offer['offer_id'];

                //     $offer_img = $row_offer['offer_image'];

                
                ?>
            <!-- <div class="col-12 mx-1 my-2"> -->
                <!-- <a href="newshop.php"> -->
                <!-- <img src="admin_area/other_images/<?php //echo $offer_img; ?>" class="img-fluid" alt="Responsive image"> -->
                <!-- </a> -->
            <!-- </div>
                <?php //} ?>
        </div>
    </div> -->
<!-- offers -->
<!-- 
<div class="icon-bar">
  <a href="tel:7892916394" class="support"><img src="admin_area/admin_images/support.svg" alt="" width="30px"></a>
</div> -->
<script>
// Set the date we're counting down to
// var countDownDate = new Date("Nov 15, 2020 00:00:00").getTime();

// Update the count down every 1 second
// var x = setInterval(function() {

  // Get today's date and time
//   var now = new Date().getTime();
    
  // Find the distance between now and the count down date
//   var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
//   document.getElementById("demo").innerHTML = "Ends in "+ days + "d " + hours + "h "
//   + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
//   if (distance < 0) {
//     clearInterval(x);
//     document.getElementById("demo").innerHTML = "EXPIRED";
//   }
// }, 1000);
</script>
<?php 

include("includes/footer.php");

?>