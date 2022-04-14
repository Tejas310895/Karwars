<?php

include("includes/header.php");

?>

<!-- header -->
<div class="container-fluid geolocation fixed-top pt-0 mt-0 px-0 mx-0 bg-white">
    <div class="row">
        <div class="col-3">
            <?php

            if (!isset($_COOKIE['user'])) {

                echo "
                            
                            <a class='nav-link  pb-0 pt-2 my_account' href='check_user'>
                                <svg height='18pt' viewBox='0 0 512 512' width='18pt' fill='#29ABE2' xmlns='http://www.w3.org/2000/svg'><path d='m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0'/><path d='m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0'/></svg>
                            </a>
                            
                            ";
            } else {

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
            <div id="phone" class="button-call">
                <button id="btn-call" class="bg-transparent border-0"><i class="far fa-question-circle"></i></button>
            </div>
            <div id="div-call" class="slide-call">
                <h6>Need Help ✆ 7892916394</h6>
            </div>
            <!-- toggle -->
        </div>
        <div class="col-12 px-5 py-2">
            <a href="search_product">
                <div class="row rounded" style="background-color: #c5ffd1;">
                    <div class="col-1 p-1 mt-0">
                        <svg version="1.1" id="Capa_1" width="11pt" height="13pt" fill="#747474" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                    </div>
                    <div class="col-11 pt-2 pl-1">
                        <h6 class="text-left mb-0" style="color:#747474;text-decoration:none;">Search 2000+ products</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- header -->
<!-- schedule -->
<div class="container mt-3 bg-success text-white pl-4">
    <div class="row">
        <div class="col-2">
            <img class="pull-left ml-2" src="admin_area/admin_images/delivery-truck.svg" alt="" width="41">
        </div>
        <div class="col-10 pl-2" style="padding-top:5px;">
            <div class="alert mb-0 px-1 pt-1 pb-0 border-0" role="alert">
                <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;">DELIVERY EXPECTED BY*</h6>
                <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;">Next Available delivery Slot</h6>
                <!-- <h6 class="mb-0" style="font-family:Josefin Sans; font-size:0.8rem;"><?php //echo $delivery_by; 
                                                                                            ?></h6> -->
            </div>
        </div>
    </div>
</div>
<!-- schedule -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php

        $get_slides = "select * from slider where image_type='head_slide' LIMIT 0,1";

        $run_slides = mysqli_query($con, $get_slides);

        while ($row_slide = mysqli_fetch_array($run_slides)) {

            $slide_name = $row_slide['slide_name'];
            $slide_image = $row_slide['slide_image'];
            $slide_url = $row_slide['slide_url'];

            echo "
                        
                        <div class='carousel-item px-0 pb-0 active'>

                        <a href='$slide_url'>

                            <img src='$slide_image' class='w-100'>

                        </a>

                        </div>
                        
                        ";
        }

        $get_slides = "select * from slider where image_type='head_slide' LIMIT 1,4";

        $run_slides = mysqli_query($con, $get_slides);

        while ($row_slide = mysqli_fetch_array($run_slides)) {

            $slide_name = $row_slide['slide_name'];
            $slide_image = $row_slide['slide_image'];

            echo "
                        
                        <div class='carousel-item px-0 pb-0'>

                        <a href='$slide_url'>

                            <img src='$slide_image' class='w-100'>

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

<div class="container pt-2" style="background-color: #89CFF0;">
    <div class="row">
        <?php

        $veg_img_array = array(
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_13_2x-100_3__mT_rbEl4P.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646574465563", "shop?store_id=93"),
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_14_copy_4_2x-100_9pyDI_JTg.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646573528270", "shop?store_id=115"),
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_14_copy_2x-100_Bvarja0kiYwu.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646573528820", "shop?store_id=93"),
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_14_copy_3_2x-100_0Lhwcytlx.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646573528137", "shop?store_id=106"),
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_14_copy_2_2x-100_sXLJyUPGh.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646573528085", "shop?store_id=95"),
            array("https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_14_2x-100_vOG2tCB6P.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1646573528098", "shop?store_id=93")
        );

        foreach ($veg_img_array as $value) {
        ?>
            <div class="col-4 p-2">
                <a href="<?php echo $value[1];
                            ?>">
                    <img src="<?php echo $value[0];
                                ?>" alt="" class="img-thumbnail" style="border-radius: 10px;">
                </a>
            </div>
        <?php }
        ?>
    </div>
</div>
<div class="container-fluid p-3 mb-2" style="background-color: #F0FFFF;">
    <div class="row">
        <div class="col-12">
            <h5 class="font-weight-bold text-secondary mb-1" style="font-family: Josefin Sans;">
                SHOP BY CATEGORY
            </h5>
        </div>
        <?php

        $get_sbc = "select * from categories limit 5";
        $run_sbc = mysqli_query($con, $get_sbc);
        while ($row_sbc = mysqli_fetch_array($run_sbc)) {

            $sbc_cat_id = $row_sbc['cat_id'];
            $sbc_cat_image = $row_sbc['cat_image'];

            echo
            "
            <div class='col-4 mb-1'>
                <a href='store.php?cat=$sbc_cat_id' class=''>
                    <img src='$sbc_cat_image' alt='' class='img-thumbnail rounded border-0'>
                </a>
            </div>
            ";
        }



        ?>
        <div class="col-4">
            <a href="category">
                <img src="https://ik.imagekit.io/wrnear2017/august_upload/ui_ch_saleArtboard_12_2x_xXrHqufnV.png?ik-sdk-version=javascript-1.4.3&updatedAt=1646567585389" alt="" class="img-thumbnail rounded border-0">
            </a>
        </div>
    </div>
</div>

<!-- banner carousel -->

<!-- Product Ref 1 -->

<!-- Product Ref 1 -->
<!-- product carousel 2 -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <a href="store.php?cat=7">
            <div class="carousel-item active">
                <img class="d-block w-100 rounded-0 mx-0 my-2" src="https://ik.imagekit.io/wrnear2017/august_upload/LP_saleArtboard_6_4x-100_e9vtZggww.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1644933805066" alt="First slide">
            </div>
        </a>
    </div>
</div>
<div class="container-fluid" style="padding: 25px;">
    <div class="row">
        <div class="col-12 px-1 bg-white pt-3 pl-2" style="border-top-right-radius: 9.25rem !important;">
            <h5 class="font-weight-bold text-secondary" style="font-family: Josefin Sans;">
                DISCOUNTS ON BODY SOAP
            </h5>
        </div>
        <?php

        $get_biscuits = "select * from products where store_id='75' and product_visibility='Y' and product_stock>0 and (price_display/product_price)>1 order by (100-((price_display/product_price)*100)) asc limit 4";
        $run_biscuits = mysqli_query($con, $get_biscuits);
        while ($row_biscuits = mysqli_fetch_array($run_biscuits)) {
            $bis_product_title = $row_biscuits['product_title'];
            $bis_product_img1 = $row_biscuits['product_img1'];
            $bis_product_price = $row_biscuits['product_price'];
            $bis_price_display = $row_biscuits['price_display'];

            if ($bis_price_display > 0) {
                $discount_percent = 100 - round(($bis_product_price / $bis_price_display) * 100);
            } else {
                $discount_percent = 0;
            }
            echo
            "
            <div class='col-6 p-0 bg-white border'>
                <a href='shop?store_id=75'style='text-decoration:none !important;'>
                    <img src='$bis_product_img1' style='height:130px;' alt='' class='img-thumbnail mx-auto d-block border-0 rounded p-2'>
                    <p class='mb-0 pl-1 text-dark' style='display: block;width: 120px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;'>$bis_product_title</p>
                    <h6 class='font-weight-bold text-dark' style='font-size:1rem;'><span class='badge badge-warning rounded-0 d-inline mr-2'style='padding: 0em 0.4em;'>   </span>   $discount_percent% OFF</h6>
                </a>
            </div>
            ";
        }
        ?>
    </div>
</div>
<!-- product carousel 2 -->
<a href="store.php?cat=11">
    <div class="container-fluid p-2 rounded">
        <img src="https://ik.imagekit.io/wrnear2017/august_upload/LP_saleArtboard_7_4x-100_Zc1R98Hnn.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1644941636112" alt="" class="img-fluid mx-0">
    </div>
</a>
<div class="container-fluid" style="padding: 25px;">
    <div class="row">
        <div class="col-12 px-1 bg-white pt-3 pl-2" style="border-top-right-radius: 9.25rem !important;">
            <h5 class="font-weight-bold text-secondary" style="font-family: Josefin Sans;">
                DENTAL CARE PRODUCTS
            </h5>
        </div>
        <?php

        $get_biscuits = "select * from products where store_id='73' and product_visibility='Y' and product_stock>0 and (price_display/product_price)>1 order by (100-((price_display/product_price)*100)) asc limit 4";
        $run_biscuits = mysqli_query($con, $get_biscuits);
        while ($row_biscuits = mysqli_fetch_array($run_biscuits)) {
            $bis_product_title = $row_biscuits['product_title'];
            $bis_product_img1 = $row_biscuits['product_img1'];
            $bis_product_price = $row_biscuits['product_price'];
            $bis_price_display = $row_biscuits['price_display'];

            if ($bis_price_display > 0) {
                $discount_percent = 100 - round(($bis_product_price / $bis_price_display) * 100);
            } else {
                $discount_percent = 0;
            }
            echo
            "
            <div class='col-6 p-0 bg-white border'>
                <a href='shop?store_id=73'style='text-decoration:none !important;'>
                    <img src='$bis_product_img1' style='height:130px;' alt='' class='img-thumbnail mx-auto d-block border-0 rounded p-2'>
                    <p class='mb-0 pl-1 text-dark' style='display: block;width: 120px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;'>$bis_product_title</p>
                    <h6 class='font-weight-bold text-dark' style='font-size:1rem;'><span class='badge badge-danger rounded-0 d-inline mr-2'style='padding: 0em 0.4em;'>   </span>   $discount_percent% OFF</h6>
                </a>
            </div>
            ";
        }
        ?>
    </div>
</div>
<a href="shop?store_id=66">
    <div class="container-fluid p-2 rounded">
        <img src="https://ik.imagekit.io/wrnear2017/august_upload/ui_b_saleArtboard_10_2x-100_18Fi_dknsrJi.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1645772213396" alt="" class="img-fluid mx-0">
    </div>
</a>
<!-- floatnav -->
<div class="container-fuild floatnav ">

    <ul class="nav fixed-bottom justify-content-center bg-white">
        <li class="nav-item px-2  text-center">
            <a class="nav-link active pb-0 pt-2 px-1" href="./">
                <svg height="20pt" viewBox="0 1 511 511.999" width="20pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg">
                    <path d="m498.699219 222.695312c-.015625-.011718-.027344-.027343-.039063-.039062l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.808594-33.328126-13.808594-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.144532.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.441406 13.234375 31.273437 13.746093.484375.046876.96875.070313 1.457031.070313h8.320313v153.695313c0 30.417968 24.75 55.164062 55.167969 55.164062h81.710937c8.285157 0 15-6.71875 15-15v-120.5c0-13.878906 11.292969-25.167969 25.171875-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.28125 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.164062v-153.695313h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.8125 18.359375-18.367187 18.367187-48.253906.027344-66.632813zm-21.242188 45.421876c-3.238281 3.238281-7.542969 5.023437-12.117187 5.023437h-22.71875c-8.285156 0-15 6.714844-15 15v168.695313c0 13.875-11.289063 25.164062-25.167969 25.164062h-66.710937v-105.5c0-30.417969-24.746094-55.167969-55.167969-55.167969h-48.195313c-30.421875 0-55.171875 24.75-55.171875 55.167969v105.5h-66.710937c-13.875 0-25.167969-11.289062-25.167969-25.164062v-168.695313c0-8.285156-6.714844-15-15-15h-22.328125c-.234375-.015625-.464844-.027344-.703125-.03125-4.46875-.078125-8.660156-1.851563-11.800781-4.996094-6.679688-6.679687-6.679688-17.550781 0-24.234375.003906 0 .003906-.003906.007812-.007812l.011719-.011719 208.847656-208.839844c3.234375-3.238281 7.535157-5.019531 12.113281-5.019531 4.574219 0 8.875 1.78125 12.113282 5.019531l208.800781 208.796875c.03125.03125.066406.0625.097656.09375 6.644531 6.691406 6.632813 17.539063-.03125 24.207032zm0 0" />
                </svg>
                <span class="icon-name">Home</span>
            </a>
        </li>
        <li class="nav-item px-2  text-center">
            <a class='nav-link  pb-0 pt-2 px-4' href="search_product">
                <svg version="1.1" id="Capa_1" width="20pt" height="20pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
            <a class="nav-link pb-0 pt-2" href="category">
                <svg version="1.1" id="Capa_1" width="18pt" height="18pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M432,0h-76c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80V80
                        C512,35.888,476.112,0,432,0z M472,156c0,22.056-17.944,40-40,40h-76c-22.056,0-40-17.944-40-40V80c0-22.056,17.944-40,40-40h76
                        c22.056,0,40,17.944,40,40V156z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M156,0H80C35.888,0,0,35.888,0,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80V80
                        C236,35.888,200.112,0,156,0z M196,156c0,22.056-17.944,40-40,40H80c-22.056,0-40-17.944-40-40V80c0-22.056,17.944-40,40-40h76
                        c22.056,0,40,17.944,40,40V156z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M156,276H80c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80v-76
                        C236,311.888,200.112,276,156,276z M196,432c0,22.056-17.944,40-40,40H80c-22.056,0-40-17.944-40-40v-76c0-22.056,17.944-40,40-40
                        h76c22.056,0,40,17.944,40,40V432z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M492,412c-11.046,0-20,8.954-20,20c0,22.056-17.944,40-40,40h-76c-22.056,0-40-17.944-40-40v-76c0-22.056,17.944-40,40-40
                        h76c15.905,0,30.301,9.419,36.675,23.996c4.425,10.121,16.218,14.736,26.338,10.312c10.121-4.426,14.737-16.218,10.312-26.338
                        C492.582,294.829,463.8,276,432,276h-76c-44.112,0-80,35.888-80,80v76c0,44.112,35.888,80,80,80h76c44.112,0,80-35.888,80-80
                        C512,420.954,503.046,412,492,412z" />
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
                <span class="icon-name">Category</span>
            </a>
        </li>
        <li class="nav-item px-2  text-center">
            <a class="nav-link pb-0 pt-2 pr-2" href="cart">
                <svg viewBox="0 -36 512.001 512" width="22pt" height="22pt" fill="#ff7b00" xmlns="http://www.w3.org/2000/svg">
                    <path d="m256 219.988281c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0" />
                    <path d="m472 139.988281h-59.136719l-90.96875-125.152343c-8.171875-14.003907-26.171875-18.988282-40.46875-11.070313-14.492187 8.050781-19.703125 26.304687-11.648437 40.800781.230468.410156.484375.804688.769531 1.179688l71.351563 94.242187h-171.796876l71.351563-94.242187c.28125-.375.539063-.769532.769531-1.179688 8.035156-14.460937 2.882813-32.730468-11.660156-40.808594-14.265625-7.902343-32.265625-2.921874-40.453125 11.070313l-90.972656 125.160156h-59.136719c-22.054688 0-40 17.945313-40 40 0 17.394531 11.289062 32.539063 27.191406 37.898438 1.695313 1.3125 3.8125 2.101562 6.117188 2.101562.460937 0 .894531.027344 1.347656.089844 4.304688.578125 7.714844 3.84375 8.496094 8.117187l34.019531 187.164063c2.597656 14.269531 15.011719 24.628906 29.519531 24.628906h298.617188c14.507812 0 26.921875-10.359375 29.519531-24.632812l34.019531-187.15625c.78125-4.277344 4.195313-7.542969 8.515625-8.121094.4375-.0625.871094-.089844 1.328125-.089844 2.320313 0 4.453125-.796875 6.148438-2.125 15.914062-5.394531 27.160156-20.511719 27.160156-37.875 0-22.054687-17.945312-40-40-40zm-185.011719-105.660156c-2.285156-4.730469-.511719-10.492187 4.136719-13.070313 4.839844-2.683593 10.941406-.953124 13.609375 3.855469.195313.359375.417969.703125.65625 1.03125l82.746094 113.84375h-21.15625zm-80.378906-8.179687c.238281-.328126.453125-.667969.652344-1.019532 2.675781-4.8125 8.78125-6.546875 13.601562-3.878906 4.65625 2.585938 6.4375 8.339844 4.148438 13.078125l-79.992188 105.660156h-21.15625zm265.390625 173.839843h-176c-5.523438 0-10 4.476563-10 10 0 5.523438 4.476562 9.898438 10 9.898438h154.398438c-.523438 1.492187-.9375 3.039062-1.226563 4.632812l-34.023437 187.257813c-.863282 4.757812-5.003907 8.210937-9.839844 8.210937h-298.617188c-4.839844 0-8.976562-3.453125-9.84375-8.207031l-34.019531-187.164062c-.289063-1.59375-.703125-3.140626-1.226563-4.628907h154.398438c5.523438 0 10-4.476562 10-10 0-5.523437-4.476562-10-10-10h-176c-11.121094 0-20-9.0625-20-20 0-11.027343 8.972656-20 20-20h432c11.027344 0 20 8.972657 20 20 0 11.105469-9.085938 20-20 20zm0 0" />
                    <path d="m256 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10zm0 0" />
                    <path d="m356 389.988281c16.542969 0 30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30zm-10-110c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.480469 10 10v80c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10zm0 0" />
                    <path d="m156 249.988281c-16.542969 0-30 13.457031-30 30v80c0 16.542969 13.457031 30 30 30s30-13.457031 30-30v-80c0-16.574219-13.425781-30-30-30zm10 110c0 5.515625-4.484375 10-10 10s-10-4.484375-10-10v-80c0-5.515625 4.484375-10 10-10 5.519531 0 10 4.476563 10 10zm0 0" />
                </svg>
                <span class="badge basket_badge badge-light <?php echo diaplay_cart(); ?>"><?php echo items(); ?></span>
                <span class="icon-name">Basket</span>
            </a>
        </li>
    </ul>

</div>
<!-- floatnav -->

<!-- believe in us -->
<!-- Offer Zone -->

<!-- offer -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php

        $get_foot_img = "select * from slider where image_type='foot_slide' limit 0,1";
        $run_foot_img = mysqli_query($con, $get_foot_img);
        while ($row_foot_img = mysqli_fetch_array($run_foot_img)) {

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
        $run_foot_img = mysqli_query($con, $get_foot_img);
        while ($row_foot_img = mysqli_fetch_array($run_foot_img)) {

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
<?php

include("includes/footer.php");

?>