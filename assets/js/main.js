/**
 * UCIPS · Preregistro — Main JS
 * Universidad de las Ciencias Policiales y de la Seguridad del Estado de Puebla
 *
 * Modules:
 *  1. Sticky Navigation  — adds .scrolled to .top-nav at scroll > 50px
 *  2. Scroll Reveal      — IntersectionObserver on [data-reveal], adds .revealed
 *  3. Counter Animation  — animates .stat-number values on scroll into view
 */

(function () {
  'use strict';

  /* ─────────────────────────────────────────────────────────────
     1. STICKY NAVIGATION
     Adds class "scrolled" to .top-nav when window scrolls past 50px.
     The CSS handles the frosted-glass background change on that class.
  ───────────────────────────────────────────────────────────── */
  (function initStickyNav() {
    var nav = document.querySelector('.top-nav');
    if (!nav) return;

    var THRESHOLD = 50;
    var ticking = false;

    function updateNav() {
      if (window.scrollY > THRESHOLD) {
        nav.classList.add('scrolled');
      } else {
        nav.classList.remove('scrolled');
      }
      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(updateNav);
        ticking = true;
      }
    }, { passive: true });

    // Run once on load in case page is already scrolled (e.g., browser restore)
    updateNav();
  })();


  /* ─────────────────────────────────────────────────────────────
     2. SCROLL REVEAL
     Any element with the [data-reveal] attribute starts invisible
     (via CSS: opacity:0; transform:translateY(32px)).
     Once it enters the viewport, the .revealed class is added,
     triggering the CSS transition to full opacity + position.

     Optional [data-delay="200"] attribute (ms) adds a staggered delay
     by setting it as a CSS transition-delay via inline style.

     Usage in HTML:
       <div data-reveal>...</div>
       <div data-reveal data-delay="200">...</div>
  ───────────────────────────────────────────────────────────── */
  (function initScrollReveal() {
    if (!('IntersectionObserver' in window)) {
      // Fallback: make everything visible if browser lacks support
      document.querySelectorAll('[data-reveal]').forEach(function (el) {
        el.classList.add('revealed');
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var el = entry.target;
            var delay = el.getAttribute('data-delay');
            if (delay) {
              el.style.transitionDelay = parseInt(delay, 10) + 'ms';
            }
            el.classList.add('revealed');
            observer.unobserve(el); // animate once
          }
        });
      },
      {
        threshold: 0.12,
        rootMargin: '0px 0px -48px 0px'
      }
    );

    document.querySelectorAll('[data-reveal]').forEach(function (el) {
      observer.observe(el);
    });
  })();


  /* ─────────────────────────────────────────────────────────────
     3. COUNTER ANIMATION
     Elements with class .stat-number and a numeric text content
     will count up from 0 to their target value when scrolled into view.

     Supports:
       - Plain integers:          "8"
       - Numbers with suffix:     "2000+" → animates number, keeps "+"
       - Numbers with prefix $:   "$500"  → keeps "$", animates number
       - Decimals are rounded during animation

     The element's original text is preserved after animation.

     Usage in HTML:
       <span class="stat-number">8</span>
       <span class="stat-number">2000+</span>
  ───────────────────────────────────────────────────────────── */
  (function initCounters() {
    if (!('IntersectionObserver' in window)) return;

    var DURATION = 1800; // ms
    var EASING_POWER = 3; // cubic ease-out

    function easeOutCubic(t) {
      return 1 - Math.pow(1 - t, EASING_POWER);
    }

    function animateCounter(el, target, prefix, suffix) {
      var startTime = null;

      function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var elapsed = timestamp - startTime;
        var progress = Math.min(elapsed / DURATION, 1);
        var eased = easeOutCubic(progress);
        var current = Math.round(eased * target);

        el.textContent = prefix + current.toLocaleString('es-MX') + suffix;

        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          // Restore exact original value (handles "Mixta" or non-numeric edge cases)
          el.textContent = prefix + target.toLocaleString('es-MX') + suffix;
        }
      }

      window.requestAnimationFrame(step);
    }

    function parseStatNumber(text) {
      // Strip whitespace
      text = text.trim();

      var prefix = '';
      var suffix = '';
      var numStr = text;

      // Extract prefix (e.g. "$")
      var prefixMatch = text.match(/^([^0-9]+)/);
      if (prefixMatch) {
        prefix = prefixMatch[1];
        numStr = text.slice(prefix.length);
      }

      // Extract suffix (e.g. "+", "k", " Egresados")
      var numericMatch = numStr.match(/^([0-9,\.]+)(.*)/);
      if (numericMatch) {
        suffix = numericMatch[2];
        numStr = numericMatch[1].replace(/,/g, '');
      }

      var value = parseFloat(numStr);
      if (isNaN(value)) return null;

      return { prefix: prefix, suffix: suffix, value: value };
    }

    var counterObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var el = entry.target;
            var parsed = parseStatNumber(el.textContent);
            if (parsed) {
              animateCounter(el, parsed.value, parsed.prefix, parsed.suffix);
            }
            counterObserver.unobserve(el);
          }
        });
      },
      {
        threshold: 0.5
      }
    );

    document.querySelectorAll('.stat-number').forEach(function (el) {
      counterObserver.observe(el);
    });
  })();


  /* ─────────────────────────────────────────────────────────────
     4. CURP AUTO-UPPERCASE
     Converts CURP input values to uppercase as the user types.
     Handles any input with id="curp" or name="curp" or data-curp.
     (Supplementary to any inline oninput already on the element.)
  ───────────────────────────────────────────────────────────── */
  (function initCurpUppercase() {
    var selectors = [
      'input[name="curp"]',
      'input[id="curp"]',
      'input[data-curp]'
    ];

    selectors.forEach(function (selector) {
      document.querySelectorAll(selector).forEach(function (input) {
        // Avoid double-binding if inline handler exists
        if (input.dataset.curpBound) return;
        input.dataset.curpBound = '1';

        input.addEventListener('input', function () {
          var pos = this.selectionStart;
          this.value = this.value.toUpperCase();
          // Restore caret position after value change
          try { this.setSelectionRange(pos, pos); } catch (e) { /* readonly */ }
        });
      });
    });
  })();


  /* ─────────────────────────────────────────────────────────────
     5. SMOOTH ANCHOR SCROLL
     Handles nav links that point to #id anchors on the same page.
     Accounts for sticky nav height offset.
  ───────────────────────────────────────────────────────────── */
  (function initAnchorScroll() {
    var NAV_OFFSET = 80; // px — matches sticky nav height + breathing room

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        var hash = this.getAttribute('href');
        if (!hash || hash === '#') return;
        var target = document.querySelector(hash);
        if (!target) return;

        e.preventDefault();

        var top = target.getBoundingClientRect().top + window.scrollY - NAV_OFFSET;

        window.scrollTo({
          top: Math.max(0, top),
          behavior: 'smooth'
        });

        // Update URL without triggering scroll
        if (history.pushState) {
          history.pushState(null, '', hash);
        }
      });
    });
  })();

})();
