<!-- header on scroll -->

<script src="js/jquery-3.5.1.slim.min.js" ></script>

<script>

$(function() {
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 20) {
            $(".geolocation").addClass("geoactive");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
           $(".geolocation").removeClass("geoactive");
        }
    });
});

</script>
<!-- header on scroll -->

<!-- product carousel script -->
<!-- Swiper JS -->
<script src="js/swiper.min.js"></script>
<!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 2.4,
        spaceBetween: 65,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        });
    </script>
<!-- product carousel script -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
window.addEventListener('resize', function() {
    if (window.innerWidth >= 700) {
		window.location = "desktop"; 
	}
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>