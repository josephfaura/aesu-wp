//GA Tracking (tel clicks & CF7 submissions)

(function($){
    $(document).ready(function(){
        // Click-to-call
        $("a[href^='tel']").on("click",function(){
            gtag('event', 'click_to_call', { 'lead_source': awiTracking.utm_source });
        });

        // Contact Form 7 submission
        document.addEventListener('wpcf7mailsent', function(e) {
            e.preventDefault();
            gtag('event', 'contact_form_submitted', { 'lead_source': awiTracking.utm_source });
        }, false);
    });
})(jQuery);