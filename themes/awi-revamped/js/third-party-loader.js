/**
 * Deferred third-party loader
 * Loads analytics on first interaction or after timeout
 */

(() => {
  let thirdPartyLoaded = false;

  function loadScript(src, { async = true, defer = true } = {}) {
    const s = document.createElement('script');
    s.src = src;
    s.async = async;
    s.defer = defer;
    document.body.appendChild(s);
  }

  function initThirdParty() {
    if (thirdPartyLoaded) return;
    thirdPartyLoaded = true;

    /* =====================
       Google Analytics
    ===================== */
    if (window.AWI_CONFIG?.ga_id) {
      loadScript(`https://www.googletagmanager.com/gtag/js?id=${AWI_CONFIG.ga_id}`);

      window.dataLayer = window.dataLayer || [];
      function gtag(){ dataLayer.push(arguments); }
      window.gtag = gtag;

      gtag('js', new Date());
      gtag('config', AWI_CONFIG.ga_id);
    }

    /* =====================
       Facebook Pixel
    ===================== */
    if (window.AWI_CONFIG?.fb_pixel_id) {
      !function(f,b,e,v,n,t,s){
        if(f.fbq)return;
        n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;
        n.push=n;
        n.loaded=!0;
        n.version='2.0';
        n.queue=[];
        t=b.createElement(e);t.async=!0;
        t.src=v;
        s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s);
      }(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

      fbq('init', AWI_CONFIG.fb_pixel_id);
      fbq('track', 'PageView');
    }

    /* =====================
       ContentSquare
    ===================== */
    loadScript('https://t.contentsquare.net/smb/tag.js');
  }

  /* =====================
     Trigger conditions
  ===================== */

  ['mousemove', 'keydown', 'touchstart', 'scroll', 'focus'].forEach(evt => {
    window.addEventListener(evt, initThirdParty, { once: true, passive: true });
  });

  // Fallback if no interaction
  setTimeout(initThirdParty, 5000);

})();