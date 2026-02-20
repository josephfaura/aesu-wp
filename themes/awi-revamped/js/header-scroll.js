/* New Header scroll behavior for top nav and trip headers */
document.addEventListener("DOMContentLoaded", function () {
  let lastScrollTop = window.scrollY || 0;
  const triggerRatio = 0.25;
  const isTripPage = awiHeaderScroll.isTripPage;

  let activeTarget = null;

  const tripHeader = document.querySelector(".trip_header");

  function initStyle(el) {
    if (!el) return;
    el.style.transition = "transform 0.5s ease";
    el.style.willChange = "transform";
  }

  function resetHeader(el) {
    if (!el) return;
    el.style.transform = "translateY(0)";
  }

  /* ---------------------------------------------------
     HARD GUARD: Trip header may NEVER be translated on desktop
     --------------------------------------------------- */
  function forceTripHeaderVisibleOnDesktop() {
    if (!isTripPage || !tripHeader) return;

    if (window.innerWidth > 976) {
      // Clear any inline transforms
      if (tripHeader.style.transform !== "translateY(0)") {
        tripHeader.style.transform = "translateY(0)";
      }

      // Remove animation properties so nothing animates it off-screen
      tripHeader.style.transition = "";
      tripHeader.style.willChange = "";
    }
  }

  /* Run repeatedly to defeat race conditions / other scripts */
  function guardLoop() {
    forceTripHeaderVisibleOnDesktop();
    requestAnimationFrame(guardLoop);
  }

  function getScrollTarget() {
    if (isTripPage) {
      // Only mobile/tablet participates in hide-on-scroll
      if (window.innerWidth <= 976) return document.querySelector(".trip_header");
      return null;
    }

    if (window.innerWidth < 880) return document.querySelector(".mobile_header");
    return document.querySelector(".desktop_header");
  }

  function setActiveTarget(nextTarget) {
    if (activeTarget && activeTarget !== nextTarget) resetHeader(activeTarget);
    activeTarget = nextTarget;
    if (activeTarget) initStyle(activeTarget);
  }

  function onScroll() {
    forceTripHeaderVisibleOnDesktop();

    const currentScroll = window.scrollY;
    const triggerPoint = window.innerHeight * triggerRatio;

    if (!activeTarget) {
      lastScrollTop = currentScroll;
      return;
    }

    if (currentScroll < triggerPoint) {
      resetHeader(activeTarget);
      lastScrollTop = currentScroll;
      return;
    }

    if (currentScroll < lastScrollTop) {
      activeTarget.style.transform = "translateY(0)";
    } else {
      activeTarget.style.transform = `translateY(-${activeTarget.offsetHeight + 4}px)`;
    }

    lastScrollTop = currentScroll;
  }

  function onResize() {
    forceTripHeaderVisibleOnDesktop();
    setActiveTarget(getScrollTarget());
    onScroll();
  }

  // Init
  setActiveTarget(getScrollTarget());
  forceTripHeaderVisibleOnDesktop();
  onScroll();

  // Start continuous protection (prevents unreproducible bugs)
  guardLoop();

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onResize);

  // ---- mobile search positioning stays as-is ----
  const searchMobile = document.getElementById("header-search-mobile");

  function syncSearchMobilePosition() {
    if (!searchMobile) return;
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