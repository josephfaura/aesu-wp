
// Replace Flexsider Pre Nex Arrows with FontAwesome
(function($){
    $(window).on('load', function() {
        if (!$('.flexslider').length) return;
        $('.flexslider').flexslider({
            animation: "slide",
            prevText: '<i class="fa-solid fa-angle-left"></i>',
            nextText: '<i class="fa-solid fa-angle-right"></i>'
        });
    });
})(jQuery);