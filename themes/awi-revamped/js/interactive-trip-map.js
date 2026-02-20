(function () {
  "use strict";

  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, (s) => ({
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#039;",
    }[s]));
  }

  function parseRoute(el) {
    const raw = el.getAttribute("data-route");
    if (!raw) return null;

    try {
      const data = JSON.parse(raw);
      return Array.isArray(data) ? data : null;
    } catch (e) {
      return null;
    }
  }

  function normalizePoint(pt) {
    const lat = Number(pt?.lat);
    const lng = Number(pt?.lng);
    if (!Number.isFinite(lat) || !Number.isFinite(lng)) return null;

    return {
      lat,
      lng,
      title: pt?.title ? String(pt.title) : "",
      // If popup is plain text, we’ll escape it.
      // If you intentionally pass trusted HTML, set `popupIsHtml = true` below.
      popup: pt?.popup ? String(pt.popup) : "",
    };
  }

  function init(el) {
    if (typeof L === "undefined") return;

    const routeRaw = parseRoute(el);
    if (!routeRaw || routeRaw.length === 0) return;

    const points = routeRaw.map(normalizePoint).filter(Boolean);
    if (points.length === 0) return;

    const pinUrl = el.getAttribute("data-pin") || "";

    const map = L.map(el, { scrollWheelZoom: false });

    // CARTO Voyager tiles (matches what you want)
    L.tileLayer("https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png", {
      subdomains: "abcd",
      maxZoom: 20,
      attribution: "&copy; OpenStreetMap contributors &copy; CARTO"
    }).addTo(map);

    // One shared SVG icon for all markers
    const pinIcon = pinUrl
      ? L.icon({
          iconUrl: pinUrl,
          iconSize: [32, 32],
          iconAnchor: [16, 32],
          popupAnchor: [0, -28],
        })
      : null;

    const latlngs = [];
    const bounds = [];

    // If your popup field contains trusted HTML (WYSIWYG),
    // set this to true. If it’s plain text, keep false.
    const popupIsHtml = true;

    points.forEach((pt) => {
      const ll = [pt.lat, pt.lng];
      latlngs.push(ll);
      bounds.push(ll);

      const marker = L.marker(ll, pinIcon ? { icon: pinIcon } : undefined).addTo(map);

      if (pt.title || pt.popup) {
        const titleHtml = pt.title ? `<strong>${escapeHtml(pt.title)}</strong>` : "";
        const popupBody = pt.popup
          ? `<div>${popupIsHtml ? pt.popup : escapeHtml(pt.popup)}</div>`
          : "";

        marker.bindPopup(`${titleHtml}${popupBody}`);
      }
    });

    // Dashed itinerary line in the SAME ORDER as repeater rows
    if (latlngs.length >= 2) {
      L.polyline(latlngs, {
        color: "#2C768E",
        weight: 2,
        opacity: 0.9,
        dashArray: "3 6",
      }).addTo(map);
    }

    // Fit view to all points
    map.fitBounds(bounds, { padding: [20, 20] });

    // Helps when map is inside sticky/accordion/etc.
    setTimeout(() => map.invalidateSize(), 50);
  }

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".wi-map-canvas").forEach(init);
  });
})();