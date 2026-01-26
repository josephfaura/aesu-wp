(function ($) {

    // --- Scroll to .packages section ---
    function scrollToPackages() {
        const $packages = $(".packages").first();
        if (!$packages.length) return;

        $([document.documentElement, document.body]).animate({
            scrollTop: $packages.offset().top - 260
        }, 500);
    }

    // --- Filter packages as user types ---
    $(document).on('input', '#search_packages', function () {
        const textEntered = $(this).val().toLowerCase();
        let resultsCount = 0;

        $('.packages li').each(function () {
            const $li = $(this);
            const elementText = $li.text().toLowerCase();
            
            if (elementText.includes(textEntered)) {
                $li.css('display', 'flex');
                resultsCount++;
            } else {
                $li.css('display', 'none');
            }
        });

        // Show "no results" message if nothing matches
        $('.awt_toc_form').css('display', resultsCount === 0 ? 'block' : 'none');
    });

    // --- Handle search button click ---
    $(document).on('click', '#search_submit', function (e) {
        e.preventDefault();
        scrollToPackages();
    });

    // --- Handle Enter key in search input ---
    $(document).on('keydown', '#search_packages', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // prevent any form submission / page jump
            scrollToPackages();
        }
    });

    // --- Optional: show all image URLs if show_values = true ---
    if (awiToc.show_values) {
        $(document).ready(function () {
            $('.packages li').each(function () {
                $('footer').append($(this).find('.package_thumbnail img').attr('src') + '<br>');
            });
        });
    }

})(jQuery);