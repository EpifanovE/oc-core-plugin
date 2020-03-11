$(document).ready(function () {

    let $carousel = $('.owl-carousel');
    if ($carousel.length) {

        $carousel.each(function (index, el) {
            let $owlAttr = {
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 7000,
                dots: false,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                autoplayHoverPause: true,
                lazyLoad: true,
                nav: true,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>']
            };
            $.extend($owlAttr, $(el).data("owl-carousel"));
            $(this).owlCarousel($owlAttr);
        });
    }
});