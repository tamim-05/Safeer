/**
 * SAFEER INTERIOR WORK RIYADH — ABOUT PAGE JAVASCRIPT (js/about.js)
 * Backlit metric counter animation with IntersectionObserver.
 */

(function () {
  'use strict';

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  document.addEventListener('DOMContentLoaded', () => {
    initMetricCounters();
  });

  function initMetricCounters() {
    const counterEls = document.querySelectorAll('[data-counter]');
    if (!counterEls.length) return;

    if (prefersReducedMotion) {
      counterEls.forEach((el) => {
        el.textContent = el.getAttribute('data-counter');
      });
      return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const targetVal = parseInt(el.getAttribute('data-counter'), 10) || 0;
          const suffix = el.getAttribute('data-suffix') || '';
          const duration = 1400; // ms
          const startTime = performance.now();

          function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Ease-out expo curve: 1 - Math.pow(2, -10 * progress)
            const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            const currentVal = Math.floor(easeProgress * targetVal);

            el.textContent = currentVal + suffix;

            if (progress < 1) {
              requestAnimationFrame(updateCounter);
            } else {
              el.textContent = targetVal + suffix;
            }
          }

          requestAnimationFrame(updateCounter);
          obs.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    counterEls.forEach((el) => observer.observe(el));
  }

})();
