
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        var j = jQuery.noConflict();
        j(document).ready(function(){
            j('.carousel').owlCarousel({
                margin:20,
                loop: true,
                autoplayTimeOut: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0:{
                        items: 1,
                        nav: false,
                    },
                    600:{
                        items: 2,
                        nav: false
                    },
                    1000:{
                        items: 3,
                        nav: false
                    }
                }
            });
        });

    </script>
</body>
</html>