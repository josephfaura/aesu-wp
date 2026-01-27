(function ($) {
    $(function () {

        /* ===============================
           Load More Gallery
        =============================== */

        let itemsToShow = 6;
        let $items = $('.past_tour_gallery li');

        if ($items.length) {
            let totalItems = $items.length;

            $('.load_more_images').on('click', function (e) {
                e.preventDefault();

                let visibleCount = $items.filter(':visible').length;
                $items.slice(visibleCount, visibleCount + itemsToShow).fadeIn();

                if (visibleCount + itemsToShow >= totalItems) {
                    $(this).hide();
                }
            });
        }

        /* ===============================
           Back to Top Button
        =============================== */

        const $backToTop = $('#back_to_top');

        if ($backToTop.length) {
            $backToTop.on('click', function (e) {
                e.preventDefault();

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

    });
})(jQuery);