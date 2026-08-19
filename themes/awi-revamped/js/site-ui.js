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

          // ✅ FIX: don't use querySelector(hash) because IDs like "#2026_trips" break as CSS selectors
          const id = decodeURIComponent(hash.slice(1));
          let target = document.getElementById(id) || document.querySelector(`[name="${id}"]`);
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

        /* ===============================
           Mobile CTA / WPConsent Banner
        =============================== */

        function updateMobileCtaPosition() {

            const $mobileCta = $('.mobile_cta');

            if (!$mobileCta.length) {
                return;
            }

            // Mobile CTA only exists/should be affected at 976px and below
            if (window.innerWidth > 976) {
                $mobileCta.css('bottom', '');
                return;
            }

            const container = document.querySelector('#wpconsent-container');

            if (!container || !container.shadowRoot) {
                return;
            }

            // Holder controls visibility
            const holder = container.shadowRoot.querySelector(
                '#wpconsent-banner-holder'
            );

            // Actual visible banner
            const banner = container.shadowRoot.querySelector(
                '.wpconsent-banner'
            );

            if (!holder || !banner) {
                return;
            }

            const isVisible = holder.classList.contains(
                'wpconsent-banner-visible'
            );

            if (isVisible) {

                const bannerHeight = banner.getBoundingClientRect().height;

                $mobileCta.css('bottom', bannerHeight + 'px');

            } else {

                $mobileCta.css('bottom', '0px');
            }
        }


        /* ===============================
           Initial check
        =============================== */

        updateMobileCtaPosition();


        /* ===============================
           Viewport resize
        =============================== */

        $(window).on('resize', function () {
            updateMobileCtaPosition();
        });


        /* ===============================
           Wait for WPConsent to load
        =============================== */

        const wpConsentHostObserver = new MutationObserver(function () {

            const container = document.querySelector('#wpconsent-container');

            if (!container || !container.shadowRoot) {
                return;
            }

            wpConsentHostObserver.disconnect();

            const holder = container.shadowRoot.querySelector(
                '#wpconsent-banner-holder'
            );

            const banner = container.shadowRoot.querySelector(
                '.wpconsent-banner'
            );

            if (!holder || !banner) {
                return;
            }


            /* -------------------------------
               Watch visibility changes
            ------------------------------- */

            const bannerObserver = new MutationObserver(function () {
                updateMobileCtaPosition();
            });

            bannerObserver.observe(holder, {
                attributes: true,
                attributeFilter: ['class']
            });


            /* -------------------------------
               Watch banner height changes
            ------------------------------- */

            if (typeof ResizeObserver !== 'undefined') {

                const bannerResizeObserver = new ResizeObserver(function () {
                    updateMobileCtaPosition();
                });

                bannerResizeObserver.observe(banner);
            }


            // Run once after everything is ready
            updateMobileCtaPosition();
        });


        /* ===============================
           Start watching for WPConsent
        =============================== */

        wpConsentHostObserver.observe(document.documentElement, {
            childList: true,
            subtree: true
        });

    });
})(jQuery);