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

        /* ===============================
           Header Search JS Toggle
        =============================== */

        const $toggles = $('.js-search-toggle');

        function closeSearch() {
          $('#header-search-mobile').removeClass('active');
          $('#header-search-desktop').removeClass('active');
          $toggles.attr('aria-expanded', 'false');
        }

        function openSearchForViewport() {
          if (window.innerWidth < 880) {
            $('#header-search-mobile').addClass('active');
            $('#header-search-desktop').removeClass('active');
          } else {
            $('#header-search-desktop').addClass('active');
            $('#header-search-mobile').removeClass('active');
          }
        }

        if ($toggles.length) {
          $toggles.on('click', function (e) {
            e.preventDefault();

            const isMobile = window.innerWidth < 880;
            const $target = isMobile ? $('#header-search-mobile') : $('#header-search-desktop');

            const willOpen = !$target.hasClass('active');

            closeSearch();
            if (willOpen) {
              $target.addClass('active');
              $toggles.attr('aria-expanded', 'true');

              // focus the search input
              setTimeout(() => {
                $target.find('input[type="search"], input[name="s"]').first().trigger('focus');
              }, 50);
            }
          });

          // Close on ESC
          $(document).on('keydown', function (e) {
            if (e.key === 'Escape') closeSearch();
          });

            // Close on click outside
            $(document).on('click', function (e) {
              const $mobile = $('#header-search-mobile');
              const $desktop = $('#header-search-desktop');

              const clickedInsideSearch =
                $(e.target).closest('#header-search-mobile, #header-search-desktop').length > 0;

              const clickedToggle =
                $(e.target).closest('.js-search-toggle').length > 0;

              if (clickedInsideSearch || clickedToggle) return;

              // If either is open, close both
              if ($mobile.hasClass('active') || $desktop.hasClass('active')) {
                $mobile.removeClass('active');
                $desktop.removeClass('active');
                $('.js-search-toggle').attr('aria-expanded', 'false');
              }
            });

          // If the viewport changes, close both so you don't carry "stale" positioning/state
          $(window).on('resize', function () {
            closeSearch();
          });
        }

    });
})(jQuery);