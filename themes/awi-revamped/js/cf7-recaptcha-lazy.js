/* reCAPTCHA lazyload override script */

document.addEventListener('DOMContentLoaded', function () {
    let recaptchaLoaded = false;

    function loadRecaptchaV3() {
        if (recaptchaLoaded) return;
        recaptchaLoaded = true;

        const s = document.createElement('script');
        s.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
        s.async = true;
        s.defer = true;
        document.body.appendChild(s);
    }

    // Load on first focus inside a CF7 form
    document.addEventListener('focusin', function(e) {
        if (e.target.closest('.wpcf7')) {
            loadRecaptchaV3();
        }
    }, { once: true });

    // Load on first submit of a CF7 form
    document.addEventListener('submit', function(e) {
        if (e.target.closest('.wpcf7')) {
            loadRecaptchaV3();
        }
    }, { once: true });
});