/**
 * Safeer Interior - global.js
 * Loaded on every page via functions.php.
 */
(function () {
  'use strict';

  var MOBILE_BREAKPOINT = 1023; // matches the CSS: desktop nav + hidden menu button from 1024px
  var prefersReducedMotion =
    window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Header scroll state ---------- */
  // Header starts transparent and gets .is-scrolled (dark blurred bg) after scrolling.
  function initHeaderScroll() {
    var header = document.querySelector('.site-header');
    if (!header) return;

    function update() {
      header.classList.toggle('is-scrolled', window.scrollY > 10);
    }

    update();
    window.addEventListener('scroll', update, { passive: true });
  }

  /* ---------- Mobile menu ---------- */
  function initMobileMenu() {
    var trigger = document.getElementById('menu-trigger');
    var drawer = document.getElementById('mobile-drawer');
    if (!trigger || !drawer) return;

    function isOpen() {
      return trigger.getAttribute('aria-expanded') === 'true';
    }

    function setOpen(open) {
      trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
      trigger.setAttribute('aria-label', open ? 'Close mobile menu' : 'Open mobile menu');
      drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
      drawer.classList.toggle('is-open', open);
      document.body.classList.toggle('menu-open', open);
    }

    trigger.addEventListener('click', function () {
      setOpen(!isOpen());
    });

    drawer.addEventListener('click', function (e) {
      if (e.target.closest('a')) setOpen(false);
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && isOpen()) {
        setOpen(false);
        trigger.focus();
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > MOBILE_BREAKPOINT && isOpen()) setOpen(false);
    });
  }

  /* ---------- Back to top ---------- */
  function initBackToTop() {
    var btn = document.querySelector('.back-to-top-btn');
    if (!btn) return;

    btn.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: prefersReducedMotion ? 'auto' : 'smooth'
      });
    });
  }

  /* ---------- Hash anchor scroll (Services page) ---------- */
  // Arriving on /services/#villa smooth-scrolls to that section.
  function initHashScroll() {
    if (!window.location.hash || prefersReducedMotion) return;

    var target = document.getElementById(decodeURIComponent(window.location.hash.slice(1)));
    if (!target) return;

    setTimeout(function () {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
  }

  /* ---------- Image tilt (.tilt-card > .tilt-inner) ---------- */
  // Used on the homepage, 404, About and Services pages. Skipped on touch
  // devices and when the visitor prefers reduced motion.
  function initTilt() {
    if (prefersReducedMotion) return;
    if (window.matchMedia && !window.matchMedia('(hover: hover)').matches) return;

    var MAX_DEG = 6;

    document.querySelectorAll('.tilt-card').forEach(function (card) {
      var inner = card.querySelector('.tilt-inner');
      if (!inner) return;

      card.addEventListener('mousemove', function (e) {
        var r = card.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width - 0.5;
        var y = (e.clientY - r.top) / r.height - 0.5;
        inner.style.transform =
          'perspective(1000px) rotateY(' + (x * MAX_DEG * 2).toFixed(2) + 'deg) ' +
          'rotateX(' + (-y * MAX_DEG * 2).toFixed(2) + 'deg)';
      });

      card.addEventListener('mouseleave', function () {
        inner.style.transform = '';
      });
    });
  }

  /* ---------- Metric counters ([data-counter]) ---------- */
  // Counts up when a metric scrolls into view (About page).
  function initMetricCounters() {
    var counterEls = document.querySelectorAll('[data-counter]');
    if (!counterEls.length) return;

    function format(el, value) {
      var suffix = el.getAttribute('data-suffix') || '';
      el.textContent = value + suffix;
    }

    // No animation: show the final value, suffix included.
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
      counterEls.forEach(function (el) {
        format(el, parseInt(el.getAttribute('data-counter'), 10) || 0);
      });
      return;
    }

    // Start at zero so the final number doesn't flash before the count-up.
    counterEls.forEach(function (el) { format(el, 0); });

    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;

        var el = entry.target;
        var target = parseInt(el.getAttribute('data-counter'), 10) || 0;
        var duration = 1400; // ms
        var start = performance.now();

        function tick(now) {
          var progress = Math.min((now - start) / duration, 1);
          // Ease-out expo
          var eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
          format(el, progress === 1 ? target : Math.floor(eased * target));
          if (progress < 1) requestAnimationFrame(tick);
        }

        requestAnimationFrame(tick);
        obs.unobserve(el);
      });
    }, { threshold: 0.3 });

    counterEls.forEach(function (el) { observer.observe(el); });
  }

  /* ---------- Spotlight glow (.spotlight-card) ---------- */
  // Feeds the mouse position to the CSS (--mx / --my). Skipped on touch
  // devices and when the visitor prefers reduced motion.
  function initSpotlight() {
    if (prefersReducedMotion) return;
    if (window.matchMedia && !window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

    document.querySelectorAll('.spotlight-card').forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        var r = card.getBoundingClientRect();
        card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
        card.style.setProperty('--my', (e.clientY - r.top) + 'px');
      });
    });
  }

  /* ---------- Home: hero entrance (Anime.js) ---------- */
  // anime.js is only loaded on the front page (see functions.php).
  function initHeroSequence() {
    if (prefersReducedMotion || typeof anime !== 'function') return;
    if (!document.querySelector('.hero-home')) return;

    anime.timeline({ easing: 'easeOutExpo' })
      .add({ targets: '.hero-bg-img', scale: [1.14, 1.08], duration: 1400, easing: 'easeInOutQuad' }, 0)
      .add({ targets: '.hero-eyebrow', opacity: [0, 1], translateY: [12, 0], duration: 700 }, 300)
      .add({ targets: '.hero-headline', opacity: [0, 1], translateY: [24, 0], duration: 1000 }, 450)
      .add({ targets: '.hero-subtext', opacity: [0, 1], translateY: [16, 0], duration: 800 }, 750)
      .add({
        targets: '.hero-cta-group .btn',
        opacity: [0, 1],
        translateY: [16, 0],
        delay: anime.stagger(80),
        duration: 700
      }, 900)
      .add({ targets: '.hero-rule', scaleX: [0, 1], duration: 900 }, 1100)
      .add({ targets: '.hero-microcopy', opacity: [0, 1], duration: 600 }, 1250);
  }

  /* ---------- Home: before / after slider ---------- */
  // Drag, touch and keyboard (arrows ±5%, Home/End). Sets --slider-pos on the container.
  function initBeforeAfterSlider() {
    var container = document.getElementById('comparison-slider');
    var handle = document.getElementById('comparison-handle');
    if (!container || !handle) return;

    var isDragging = false;
    var currentPos = 50;

    function setPosition(percent) {
      currentPos = Math.max(0, Math.min(100, percent));
      container.style.setProperty('--slider-pos', currentPos + '%');
      handle.setAttribute('aria-valuenow', Math.round(currentPos));
    }

    function onPointerMove(e) {
      if (!isDragging) return;
      var rect = container.getBoundingClientRect();
      var clientX = e.touches ? e.touches[0].clientX : e.clientX;
      setPosition(((clientX - rect.left) / rect.width) * 100);
    }

    function startDrag(e) {
      isDragging = true;
      document.body.style.cursor = 'ew-resize';
      document.body.style.userSelect = 'none';
      onPointerMove(e);
    }

    function stopDrag() {
      if (!isDragging) return;
      isDragging = false;
      document.body.style.cursor = '';
      document.body.style.userSelect = '';
    }

    container.addEventListener('mousedown', startDrag);
    window.addEventListener('mousemove', onPointerMove);
    window.addEventListener('mouseup', stopDrag);

    container.addEventListener('touchstart', startDrag, { passive: true });
    window.addEventListener('touchmove', onPointerMove, { passive: true });
    window.addEventListener('touchend', stopDrag);

    handle.addEventListener('keydown', function (e) {
      var keys = { ArrowLeft: currentPos - 5, ArrowRight: currentPos + 5, Home: 0, End: 100 };
      if (!(e.key in keys)) return;
      e.preventDefault();
      setPosition(keys[e.key]);
    });

    setPosition(50);
  }

  /* ---------- Home: portfolio filter + project click ---------- */
  function initPortfolio() {
    var grid = document.querySelector('.portfolio-grid');
    if (!grid) return;

    var items = grid.querySelectorAll('.portfolio-item');
    var buttons = document.querySelectorAll('.portfolio-filter-bar .filter-btn');

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        buttons.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        var category = btn.getAttribute('data-filter');

        items.forEach(function (item) {
          if (category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = '';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
          } else {
            item.style.opacity = '0';
            item.style.transform = 'translateY(12px)';
            setTimeout(function () {
              if (btn.classList.contains('is-active')) item.style.display = 'none';
            }, 200);
          }
        });
      });
    });

    // Passes the item's data to window.openProjectModal, if a modal is defined.
    items.forEach(function (item) {
      item.addEventListener('click', function () {
        if (typeof window.openProjectModal !== 'function') return;

        var title = item.querySelector('h4');
        var category = item.querySelector('.portfolio-category');
        var img = item.querySelector('img');

        window.openProjectModal({
          title: title ? title.textContent.trim() : '',
          category: category ? category.textContent.trim() : '',
          image: img ? img.getAttribute('src') : '',
          scope: item.getAttribute('data-scope') || '',
          location: item.getAttribute('data-location') || '',
          typology: item.getAttribute('data-typology') || '',
          status: item.getAttribute('data-status') || '',
          description: item.getAttribute('data-desc') || ''
        }, item);
      });
    });
  }

  /* ---------- Init ---------- */
  document.addEventListener('DOMContentLoaded', function () {
    initHeaderScroll();
    initMobileMenu();
    initBackToTop();
    initHashScroll();
    initTilt();
    initMetricCounters();
    initSpotlight();
    initHeroSequence();
    initBeforeAfterSlider();
    initPortfolio();
  });
})();