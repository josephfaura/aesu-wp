/* New Header scroll behavior for top nav and trip headers */
document.addEventListener("DOMContentLoaded", function() {

    let lastScrollTop = 0;
    const triggerRatio = 0.25; // 25vh trigger
    const isTripPage = awiHeaderScroll.isTripPage; // passed from PHP

    // Determine scroll target dynamically
    function getScrollTarget() {
        if (!isTripPage) {
            if (window.innerWidth < 880) {
                return document.querySelector('.mobile_header');
            } else {
                return document.querySelector('.desktop_header');
            }
        } else {
            if (window.innerWidth <= 976) {
                return document.querySelector('.trip_header');
            } else {
                return null;
            }
        }
    }

    // Initialize element style for smooth transform
    function initStyle(el) {
        if (!el) return;
        el.style.transition = "transform 0.5s ease";
        el.style.willChange = "transform";
        el.style.transform = "translateY(0)";
    }

    // Scroll handler
    function onScroll() {
        const currentScroll = window.scrollY;
        const triggerPoint = window.innerHeight * triggerRatio;
        const target = getScrollTarget();

        if (!target || currentScroll < triggerPoint) {
            return;
        }

        if (currentScroll < lastScrollTop) {
            target.style.transform = "translateY(0)";
        } else {
            target.style.transform = `translateY(-${target.offsetHeight + 4}px)`;
        }

        lastScrollTop = currentScroll;
    }

    // Run init
    const initialTarget = getScrollTarget();
    initStyle(initialTarget);

    // Listen to scroll and resize
    window.addEventListener('scroll', onScroll);

    window.addEventListener('resize', function() {
        const target = getScrollTarget();
        initStyle(target);
    });

});