/**
 * SAFEER INTERIOR WORK RIYADH — SERVICES JAVASCRIPT (js/services.js)
 * Smooth hash anchor navigation and interactive card reveal hooks.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    handleHashNavigation();
  });

  function handleHashNavigation() {
    if (!window.location.hash) return;
    const target = document.querySelector(window.location.hash);
    if (target) {
      setTimeout(() => {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100);
    }
  }

})();
