(function ($) {

  // Ensure a single FA6 icon exists in the trigger's indicator, then set +/- based on state
  function setIcon($trigger) {
    var $ind = $trigger.find('.collapsed_indicator');
    if (!$ind.find('i').length) {
      $ind.empty().append('<i class="fa-solid" aria-hidden="true"></i>');
    }
    var $i = $ind.find('i');
    var isOpen = $trigger.next('.accordion_content').is(':visible');

    // Toggle icon
    $i.toggleClass('fa-plus', !isOpen)
      .toggleClass('fa-minus', isOpen);

    // A11y
    $trigger.attr('aria-expanded', String(isOpen));

    // Optional: add/remove .open on the item for CSS hooks
    $trigger.closest('.accordion_item').toggleClass('open', isOpen);
  }

  // Update the "Expand/Collapse All" label (and its icon) for a given wrapper
  function setToggleAllLabel($wrap) {
    var anyOpen = $wrap.find('.accordion_content:visible').length > 0;
    var $btn = $wrap.find('.toggle_all_trigger').first(); // one per group
    if (!$btn.length) return;

    $btn.html(anyOpen
      ? 'Collapse All <i class="fa-solid fa-minus" aria-hidden="true"></i>'
      : 'Expand All <i class="fa-solid fa-plus" aria-hidden="true"></i>'
    );
  }

  // Wire up one accordion group (wrapper should contain triggers, contents, and one toggle-all link)
  function setupAccordionGroup($wrap) {
    if (!$wrap.length) return;

    // Init icons + label on load
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

    // Expand/Collapse All (scoped to this wrapper only)
    $wrap.on('click', '.toggle_all_trigger', function (e) {
      e.preventDefault();
      var expandAll = $(this).text().trim().startsWith('Expand');

      var $contents = $wrap.find('.accordion_content');
      if (expandAll) {
        $contents.not(':visible').slideDown(200);
      } else {
        $contents.filter(':visible').slideUp(200);
      }

      // Normalize icons & label after animations
      setTimeout(function () {
        $wrap.find('.accordion_trigger').each(function () { setIcon($(this)); });
        setToggleAllLabel($wrap);
      }, 220);
    });
  }

  // Initialize: each itinerary is one group; each "What's Included" section is its own group
  $(function () {
    $('.itinerary').each(function () { setupAccordionGroup($(this)); });
    $('.whats_included .whats_included_accordion_section').each(function () {
      setupAccordionGroup($(this));
    });
  });

})(jQuery);
