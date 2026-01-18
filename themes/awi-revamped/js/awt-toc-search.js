(function($){

    // Only run on AWT page
    if (!$('body').hasClass('page-id-898')) return;

    const $input   = $('#search_packages');
    const $items   = $('.packages li');
    const $fallback = $('.awt_toc_form');

    function runFilter() {
        const query = $input.val().toLowerCase().trim();
        let matches = 0;

        $items.each(function(){
            const $li = $(this);
            const text = $li.text().toLowerCase();

            if (!query || text.includes(query)) {
                $li.css('display', 'flex');
                matches++;
            } else {
                $li.css('display', 'none');
            }
        });

        // Show fallback form if no matches
        $fallback.toggle(matches === 0);
    }

    // Filter as you type
    $input.on('input', runFilter);

    // Scroll on search button click
    $('#search_submit').on('click', function(e){
        e.preventDefault();
        runFilter();

        $([document.documentElement, document.body]).animate({
            scrollTop: $('.packages').first().offset().top - 260
        }, 500);
    });

})(jQuery);