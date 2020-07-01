<?php 

    include("includes/header.php");

?>
<script>
window.addEventListener('resize', function() {
	if (window.innerWidth <= 700) {
		window.location.href = "./"; 
	}
    if (window.innerWidth >= 700) {
		window.location.href = "desktop"; 
	}
});
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <img src="admin_area/admin_images/desktop.jpg" class="img-fluid mx-3" alt="">
        </div>
    </div>
</div>


<?php 

include("includes/footer.php");

?>