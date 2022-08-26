require(['jquery', 'jquery/ui', 'slick'], function($) {
    $(document).ready(function() {
        $(".slick-slider").slick({
            dots: true,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true
        });
        $('.regular').slick({
            autoplay: true,
            dots: true,
            responsive: [{
                breakpoint: 500,
                settings: {
                    dots: false,
                    arrows: false,
                    infinite: false,
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }]
        });
    });
});
