// Load More Behavior in Landing Page Galleries

(function($){
    $(document).ready(function(){
        let itemsToShow = 6;
        let $items = $('.past_tour_gallery li');
        if (!$items.length) return;
        let totalItems = $items.length;

        $('.load_more_images').on('click', function(e){
            e.preventDefault();
            let visibleCount = $items.filter(':visible').length;
            $items.slice(visibleCount, visibleCount + itemsToShow).fadeIn();

            if (visibleCount + itemsToShow >= totalItems) {
                $(this).hide();
            }
        });
    });
})(jQuery);