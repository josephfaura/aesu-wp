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

        /* ===============================
           Smooth Scroll for Anchor Links (no hash left in URL)
        =============================== */
        const HEADER_OFFSET = 120;

        $(document).on('click', 'a[href*="#"]', function (e) {
          const href = this.getAttribute('href');
          if (!href || href === '#' || href === '#0') return;

          // Same-page only
          const samePage =
            this.pathname.replace(/^\//, '') === location.pathname.replace(/^\//, '') &&
            this.hostname === location.hostname;

          if (!samePage) return;

          const hash = this.hash;
          if (!hash) return;

          let target;
          try {
            target = document.querySelector(hash);
          } catch (err) {
            return;
          }
          if (!target) return;

          e.preventDefault();

          // Smooth scroll
          const top = Math.max(
            0,
            target.getBoundingClientRect().top + window.pageYOffset - HEADER_OFFSET
          );

          window.scrollTo({ top, behavior: 'smooth' });

          // ✅ Remove the hash so the same anchor can be clicked again
          const cleanUrl = window.location.pathname + window.location.search;
          history.replaceState(null, '', cleanUrl);
        });

    });
})(jQuery);