(function() {
    function bindSmsConsent(form) {
        const phone = form.querySelector('input[name="sms-phone"]');
        const consentWrap = form.querySelector('.wpcf7-acceptance');

        if (!phone || !consentWrap) return;

        // Hide initially
        consentWrap.style.display = phone.value.trim() ? 'block' : 'none';
        const checkbox = consentWrap.querySelector('input[type="checkbox"]');
        if (checkbox) checkbox.checked = false;

        // Toggle on input
        phone.addEventListener('input', function() {
            if (phone.value.trim() !== '') {
                consentWrap.style.display = 'block';
            } else {
                consentWrap.style.display = 'none';
                if (checkbox) checkbox.checked = false;
            }
        });
    }

    // --- Inline forms ---
    document.querySelectorAll('.subscribe_form').forEach(bindSmsConsent);

    // --- Popup forms (Popup Maker) ---
    document.addEventListener('pumAfterOpen', function(e) {
        const popupForm = e.target.querySelector('.subscribe_form');
        if (popupForm) bindSmsConsent(popupForm);
    });

})();