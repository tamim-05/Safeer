/**
 * SAFEER INTERIOR WORK RIYADH — HOME PAGE JAVASCRIPT (js/home.js)
 * Hero Anime.js timeline, Portfolio filtering & modal hooks,
 * Interactive Before/After comparison slider with touch/keyboard support,
 * and Scroll triggers.
 */

(function () {
  'use strict';

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  document.addEventListener('DOMContentLoaded', () => {
    initHeroSequence();
    initBeforeAfterSlider();
    initPortfolioFilters();
    initPortfolioModalClicks();
  });

  /**
   * 1. Hero Entrance Sequence with Anime.js
   * Based on Design Tokens v1.0 Section 3.2
   */
  function initHeroSequence() {
    if (prefersReducedMotion) return;

    if (typeof anime === 'function') {
      const heroTl = anime.timeline({
        easing: 'easeOutExpo',
      });

      heroTl
        .add({
          targets: '.hero-bg-img',
          scale: [1.14, 1.08],
          duration: 1400,
          easing: 'easeInOutQuad'
        }, 0)
        .add({
          targets: '.hero-eyebrow',
          opacity: [0, 1],
          translateY: [12, 0],
          duration: 700,
        }, 300)
        .add({
          targets: '.hero-headline',
          opacity: [0, 1],
          translateY: [24, 0],
          duration: 1000,
        }, 450)
        .add({
          targets: '.hero-subtext',
          opacity: [0, 1],
          translateY: [16, 0],
          duration: 800,
        }, 750)
        .add({
          targets: '.hero-cta-group .btn',
          opacity: [0, 1],
          translateY: [16, 0],
          delay: anime.stagger(80),
          duration: 700,
        }, 900)
        .add({
          targets: '.hero-rule',
          scaleX: [0, 1],
          duration: 900,
          easing: 'easeOutExpo'
        }, 1100)
        .add({
          targets: '.hero-microcopy',
          opacity: [0, 1],
          duration: 600,
        }, 1250);
    }
  }

  /**
   * 2. Interactive Before / After Comparison Slider
   * Drag handle, touch-move, and keyboard arrows ±5%
   */
  function initBeforeAfterSlider() {
    const container = document.getElementById('comparison-slider');
    const handle = document.getElementById('comparison-handle');
    if (!container || !handle) return;

    let isDragging = false;
    let currentPos = 50;

    function setPosition(percent) {
      currentPos = Math.max(0, Math.min(100, percent));
      container.style.setProperty('--slider-pos', `${currentPos}%`);
      handle.setAttribute('aria-valuenow', Math.round(currentPos));
    }

    function onPointerMove(e) {
      if (!isDragging) return;
      const rect = container.getBoundingClientRect();
      const clientX = e.touches ? e.touches[0].clientX : e.clientX;
      const x = clientX - rect.left;
      const percent = (x / rect.width) * 100;
      setPosition(percent);
    }

    function startDrag(e) {
      isDragging = true;
      document.body.style.cursor = 'ew-resize';
      document.body.style.userSelect = 'none';
      onPointerMove(e);
    }

    function stopDrag() {
      if (isDragging) {
        isDragging = false;
        document.body.style.cursor = '';
        document.body.style.userSelect = '';
      }
    }

    container.addEventListener('mousedown', startDrag);
    window.addEventListener('mousemove', onPointerMove);
    window.addEventListener('mouseup', stopDrag);

    container.addEventListener('touchstart', startDrag, { passive: true });
    window.addEventListener('touchmove', onPointerMove, { passive: true });
    window.addEventListener('touchend', stopDrag);

    // Keyboard support (Accessibility)
    handle.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        setPosition(currentPos - 5);
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        setPosition(currentPos + 5);
      } else if (e.key === 'Home') {
        e.preventDefault();
        setPosition(0);
      } else if (e.key === 'End') {
        e.preventDefault();
        setPosition(100);
      }
    });

    // Default 50%
    setPosition(50);
  }

  /**
   * 3. Portfolio Category Filtering
   */
  function initPortfolioFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    if (!filterBtns.length || !portfolioItems.length) return;

    filterBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        filterBtns.forEach((b) => b.classList.remove('is-active'));
        btn.classList.add('is-active');

        const category = btn.getAttribute('data-filter');

        portfolioItems.forEach((item) => {
          const itemCat = item.getAttribute('data-category');
          if (category === 'all' || itemCat === category) {
            item.style.display = '';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
          } else {
            item.style.opacity = '0';
            item.style.transform = 'translateY(12px)';
            setTimeout(() => {
              if (!btn.classList.contains('is-active')) return;
              item.style.display = 'none';
            }, 200);
          }
        });
      });
    });
  }

  /**
   * 4. Project Modal Lightbox Data Hooks
   */
  function initPortfolioModalClicks() {
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    if (!portfolioItems.length) return;

    portfolioItems.forEach((item) => {
      item.addEventListener('click', () => {
        const title = item.querySelector('h4')?.textContent.trim() || 'Interior Project';
        const category = item.querySelector('.portfolio-category')?.textContent.trim() || 'Residential';
        const img = item.querySelector('img')?.getAttribute('src') || '';
        const scope = item.getAttribute('data-scope') || 'Comprehensive Interior Architecture & Fit-Out';
        const location = item.getAttribute('data-location') || 'Riyadh, Saudi Arabia';
        const typology = item.getAttribute('data-typology') || 'Luxury Villa';
        const status = item.getAttribute('data-status') || 'Completed & Delivered';
        const description = item.getAttribute('data-desc') || 'A bespoke interior designed with architectural balance, tailored millwork, and warm ambient illumination.';

        if (typeof window.openProjectModal === 'function') {
          window.openProjectModal({
            title,
            category,
            image: img,
            scope,
            location,
            typology,
            status,
            description
          }, item);
        }
      });
    });
  }

})();
