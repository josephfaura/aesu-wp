(function ($) {
  'use strict';

  // Hide dots when there's only one "page" of slides
  function toggleDots(slick) {
    if (!slick || !slick.$dots) return;

    var pages = (typeof slick.getDotCount === 'function')
      ? slick.getDotCount()
      : Math.ceil(slick.slideCount / (slick.options.slidesToShow || 1));

    var showDots = pages > 1; // only show if more than one page
    $(slick.$dots).toggle(showDots);
  }

  // Which sliders we care about
  var sliderTargets = '.trip_highlight_items, .hotels_slider, .trip_options_slider, .js-carousel .slick-slider';

  // Keep dots state correct on init / resize / slide changes
  $(document).on('init reInit setPosition afterChange breakpoint', sliderTargets, function (e, slick) {
    toggleDots(slick);
  });

  // Initialize Slick sliders
  $(function () {
    $('.trip_highlight_items, .hotels_slider, .trip_options_slider').each(function () {
      var $el = $(this);
      if (!$el.hasClass('slick-initialized')) {
        $el.slick($.extend(true, {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: true,
          dots: true,
          adaptiveHeight: true,
          lazyLoad: 'progressive',
          prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><i class="fa-solid fa-angle-left" aria-hidden="true"></i></button>',
          nextArrow: '<button type="button" class="slick-next" aria-label="Next"><i class="fa-solid fa-angle-right" aria-hidden="true"></i></button>',
          responsive: [
            { breakpoint: 1023, settings: { slidesToShow: 2 } },
            { breakpoint: 767,  settings: { slidesToShow: 1 } }
          ]
        }, $el.data('slick') || {}));
      }
    });
  });

})(jQuery);
