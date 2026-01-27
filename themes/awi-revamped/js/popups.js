(function($){
    // Deals popup
    $('.deals_cta a').on('click', function(e){
        e.preventDefault();
        $('.tour_deals_popup_wrap').css('display', 'flex');
    });
    $('.tour_deals_close_popup').on('click', function(e){
        e.preventDefault();
        $('.tour_deals_popup_wrap').css('display', 'none');
    });
    $('.tour_deals_popup_wrap').on('click', function(){
        $(this).css('display', 'none');
    });
    $('.tour_deals_popup_content *').on('click', function(e){
        e.stopPropagation();
    });

    // Travel Tools popup
    $('.travel_tools a').on('click', function(e){
        e.preventDefault();
        $('.travel_tools_popup_wrap').css('display', 'flex');
    });
    $('.travel_tools_close_popup').on('click', function(e){
        e.preventDefault();
        $('.travel_tools_popup_wrap').css('display', 'none');
    });
    $('.travel_tools_popup_wrap').on('click', function(){
        $(this).css('display', 'none');
    });
    $('.travel_tools_popup_content *').on('click', function(e){
        e.stopPropagation();
    });
})(jQuery);