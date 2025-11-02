/**
 * itinerary-toggle.js
 * Accordion behaviors for trip itinerary + "What's Included" sections.
 * - Uses Font Awesome 6 icons (fa-solid fa-plus / fa-solid fa-minus)
 * - Keeps aria-expanded accurate
 * - Provides robust "Expand/Collapse All" that does not rely on button text
 */
(function ($) {
  'use strict';

  /**
   * Ensure one FA6 icon exists in the trigger's indicator,
   * then set +/- based on the content's visibility.
   * @param {jQuery} $trigger
   */
  function setIcon($trigger) {
    var $ind = $trigger.find('.collapsed_indicator');
    if (!$ind.length) return;

    // Create a single FA6 <i> if missing
    var $i = $ind.find('i.fa-solid');
    if (!$i.length) {
      $ind.empty().append('<i class="fa-solid" aria-hidden="true"></i>');
      $i = $ind.find('i.fa-solid');
    }

    var isOpen = $trigger.next('.accordion_content').is(':visible');

    // Toggle icon classes
    $i.toggleClass('fa-plus', !isOpen)
      .toggleClass('fa-minus', isOpen);

    // A11y state
    $trigger.attr('aria-expanded', String(isOpen));

    // Optional hook for styling
    $trigger.closest('.accordion_item').toggleClass('open', isOpen);
  }

  /**
   * Compute and set the "Expand/Collapse All" button label + icon.
   * Relies on a data attribute instead of string matching.
   * @param {jQuery} $wrap
   */
  function setToggleAllLabel($wrap) {
    var anyOpen = $wrap.find('.accordion_content:visible').length > 0;
    var $btn = $wrap.find('.toggle_all_trigger').first(); // one per group
    if (!$btn.length) return;

    // Store desired action as data, not text
    $btn.attr('data-expand', anyOpen ? 'false' : 'true');

    var label = anyOpen ? 'Collapse All' : 'Expand All';
    var iconClass = anyOpen ? 'fa-minus' : 'fa-plus';

    // Render cleanly without innerHTML string concatenation
    $btn.empty()
      .append(document.createTextNode(label + ' '))
      .append($('<i>', {
        'class': 'fa-solid ' + iconClass,
        'aria-hidden': 'true'
      }));
  }

  /**
   * Wire up one accordion group wrapper.
   * Expects:
   *  - .accordion_trigger elements preceding .accordion_content
   *  - (optional) a single .toggle_all_trigger button/link inside the wrapper
   * @param {jQuery} $wrap
   */
  function setupAccordionGroup($wrap) {
    if (!$wrap || !$wrap.length) return;

    // Initial state
    $wrap.find('.accordion_trigger').each(function () { setIcon($(this)); });
    setToggleAllLabel($wrap);

    // Row toggle
    $wrap.on('click', '.accordion_trigger', function () {
      var $trig = $(this);
      $trig.next('.accordion_content').slideToggle(200, function () {
        setIcon($trig);
        setToggleAllLabel($wrap);
      });
    });

    // Expand/Collapse All (scoped)
    $wrap.on('click', '.toggle_all_trigger', function (e) {
      e.preventDefault();
      var $btn = $(this);
      var expandAll = $btn.attr('data-expand') === 'true';

      var $contents = $wrap.find('.accordion_content');
      if (expandAll) {
        $contents.not(':visible').slideDown(200);
      } else {
        $contents.filter(':visible').slideUp(200);
      }

      // Normalize icons/labels after animations complete
      setTimeout(function () {
        $wrap.find('.accordion_trigger').each(function () { setIcon($(this)); });
        setToggleAllLabel($wrap);
      }, 220);
    });
  }

  /**
   * Init: each itinerary is one group; each "What's Included" section is its own group.
   */
  $(function () {
    // Itinerary sections
    $('.itinerary').each(function () {
      setupAccordionGroup($(this));
    });

    // What's Included sections (each subsection is its own accordion group)
    $('.whats_included .whats_included_accordion_section').each(function () {
      setupAccordionGroup($(this));
    });
  });

})(jQuery);
