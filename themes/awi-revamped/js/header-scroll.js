/* New Header scroll behavior for top nav and trip headers */
document.addEventListener("DOMContentLoaded", function () {
  let lastScrollTop = window.scrollY || 0;
  const triggerRatio = 0.25; // 25vh trigger
  const isTripPage = awiHeaderScroll.isTripPage; // passed from PHP

  let activeTarget = null;

  function getScrollTarget() {
    if (!isTripPage) {
      if (window.innerWidth < 880) {
        return document.querySelector(".mobile_header");
      } else {
        return document.querySelector(".desktop_header");
      }
    } else {
      // Trip header only participates on mobile/tablet widths
      if (window.innerWidth <= 976) {
        return document.querySelector(".trip_header");
      } else {
        return null;
      }
    }
  }

  function initStyle(el) {
    if (!el) return;
    el.style.transition = "transform 0.5s ease";
    el.style.willChange = "transform";
    // NOTE: don't force translateY(0) here; we handle reset separately
  }

  function resetHeader(el) {
    if (!el) return;
    el.style.transform = "translateY(0)";
  }

  function setActiveTarget(nextTarget) {
    if (activeTarget && activeTarget !== nextTarget) {
      // IMPORTANT: undo any "hidden" transform when leaving that mode
      resetHeader(activeTarget);
    }

    activeTarget = nextTarget;

    if (activeTarget) {
      initStyle(activeTarget);
    }
  }

  function onScroll() {
    const currentScroll = window.scrollY;
    const triggerPoint = window.innerHeight * triggerRatio;

    if (!activeTarget) {
      lastScrollTop = currentScroll;
      return;
    }

    // If above trigger point, ensure header is visible
    if (currentScroll < triggerPoint) {
      resetHeader(activeTarget);
      lastScrollTop = currentScroll;
      return;
    }

    if (currentScroll < lastScrollTop) {
      // scrolling up
      activeTarget.style.transform = "translateY(0)";
    } else {
      // scrolling down
      activeTarget.style.transform = `translateY(-${activeTarget.offsetHeight + 4}px)`;
    }

    lastScrollTop = currentScroll;
  }

  function onResize() {
    // Re-evaluate which header should be controlled at this breakpoint
    const nextTarget = getScrollTarget();
    setActiveTarget(nextTarget);

    // Make sure the correct header state applies immediately after resize
    onScroll();
  }

  // Init
  setActiveTarget(getScrollTarget());

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onResize);

  // ---------------------------
  // Header Search positioning (MOBILE ONLY)
  // ---------------------------
  const searchMobile = document.getElementById("header-search-mobile");

  function syncSearchMobilePosition() {
    if (!searchMobile) return;

    // Only apply on mobile
    if (window.innerWidth >= 880) {
      searchMobile.style.top = "";
      return;
    }

    const header = document.querySelector(".mobile_header");
    if (!header) return;

    const rect = header.getBoundingClientRect();
    searchMobile.style.top = rect.bottom + "px";
  }

  window.addEventListener("scroll", syncSearchMobilePosition, { passive: true });
  window.addEventListener("resize", syncSearchMobilePosition);
  syncSearchMobilePosition();
});