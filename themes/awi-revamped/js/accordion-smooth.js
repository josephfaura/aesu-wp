// Legacy Accordion + Smooth Scroll

(function($){
    // Whats Included expand/collapse all
    $('.whats_included .toggle_all_trigger').on('click', function(e){
        e.preventDefault();
        var section = $(this).parents('.whats_included_accordion_section');
        if($(this).text() === "Expand All"){
            $(this).text('Collapse All');
            section.find('.accordion_content').slideDown();
            section.find('.collapsed_indicator').text('-');
        } else {
            $(this).text('Expand All');
            section.find('.accordion_content').slideUp();
            section.find('.collapsed_indicator').text('+');
        }
    });

    // Check initial state of accordions
    function checkAccordionState() {
        var allHidden = true;
        $('.whats_included .accordion_item .accordion_content').each(function() {
            if ($(this).css('display') !== 'none') {
                allHidden = false;
                return false;
            }
        });
        $('.whats_included .toggle_all_trigger').text(allHidden ? 'Expand All' : 'Collapse All');
    }
    checkAccordionState();

    // Smooth anchor scroll for internal links
    $(document).on('click', 'a[href^="#"]', function(event) {
        var target = $($.attr(this, 'href'));
        if (!target.length) return;
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top - 100
        }, 500);
    });

})(jQuery);