require(['jquery', 'jquery/ui', 'slick'], function($) {
    $(document).ready(function() {
        $(".regular").slick({
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
