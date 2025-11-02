/* js/carousel-fixes.js */
(function ($) {
  'use strict';

  // All trip carousels on the page
  var SLIDERS = '.trip_highlight_items, .hotels_slider, .trip_options_slider';

  // Hide dots when there's only one "page" of slides
  function toggleDots(slick) {
    if (!slick || !slick.$dots) return;

    // If Slick provides dot count, use it; fallback to slide math
    var pages = (typeof slick.getDotCount === 'function') ? slick.getDotCount() : null;
    var showDots;

    if (pages !== null) {
      // Slick returns 0 when there is only one page
      showDots = pages > 0;
    } else {
      var visible = slick.options.slidesToShow || 1;
      showDots = slick.slideCount > visible;
    }
    $(slick.$dots).toggle(!!showDots);
  }

  // Keep dots state correct on all lifecycle events
  $(document).on('init reInit setPosition afterChange breakpoint', SLIDERS, function (e, slick) {
    toggleDots(slick);
  });

   // === INITIATE Slick on trip highlights ===
  $(function () {
    $('.trip_highlight_items').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      dots: true,
      adaptiveHeight: true,      // smoother first render
      lazyLoad: 'progressive',   // images load smoothly
      prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next" aria-label="Next"><i class="fa-solid fa-angle-right"></i></button>',
      responsive: [
        { breakpoint: 1023, settings: { slidesToShow: 2 } },
        { breakpoint: 767,  settings: { slidesToShow: 1 } }
      ]
    });
  });

})(jQuery);
