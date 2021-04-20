
<?php 

include("includes/header.php");

?>

<!-- header -->
<div class="container-fluid geolocation fixed-top pt-0 mt-0 px-0 mx-0 bg-white">
    <div class="row">
        <div class="col-3">
                <?php 
                                
                if(!isset($_COOKIE['wrnuser'])){

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

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb pt-3 pb-1">
                    <li class="breadcrumb-item active" aria-current="page"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms & Policies</li>
                </ol>
            </nav>
        <!-- breadcrumb -->


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php 
                                
                $get_terms = "select * from terms";

                $run_terms = mysqli_query($con,$get_terms);

                while($row_terms = mysqli_fetch_array($run_terms)){

                    $term_title = $row_terms['term_title'];

                    $term_desc = $row_terms['term_desc'];
            
            ?>
            <h3 class="text-left" style="font-family: Josefin Sans;">
                <?php echo $term_title; ?>
            </h3>
            <p>
                <?php echo $term_desc; ?>
            </p>
            <?php } ?>
        </div>
    </div>
</div>

<?php 

include("includes/footer.php");

?>