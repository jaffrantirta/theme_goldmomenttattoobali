/**
 * Gold Moment Tattoo Bali — Main JavaScript
 * Features: Navbar scroll, Counter animation, Swiper carousel,
 *           Gallery lightbox, Scroll reveal, Booking form AJAX,
 *           Back to top, Parallax hero
 */

(function () {
  'use strict';

  /* ── Shared state ───────────────────────────────────────── */
  var swiperInstance = null;

  /* ── DOM Ready ──────────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {
    initNavbar();
    initHeroParallax();
    initSwiperCarousel();
    initGalleryFilter();      // must run after initSwiperCarousel
    initGalleryLightbox();
    initScrollReveal();
    initCounterAnimation();
    initBookingForm();
    initBackToTop();
    initNavActiveLinks();
  });

  /* ================================================================
     1. STICKY NAVBAR
  ================================================================ */
  function initNavbar() {
    var navbar = document.getElementById('main-navbar');
    if (!navbar) return;

    // Inner pages (no #hero) always use the solid scrolled style
    var isInnerPage = !document.getElementById('hero');

    function updateNavbar() {
      if (isInnerPage || window.scrollY > 60) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', updateNavbar, { passive: true });
    updateNavbar();

    // Smooth scroll for nav links & close mobile menu
    var navLinks = document.querySelectorAll('.nav-link[href^="#"], .btn-gold[href^="#"], .btn-gold-outline[href^="#"]');
    var navbarCollapse = document.getElementById('navbarMenu');

    navLinks.forEach(function (link) {
      link.addEventListener('click', function (e) {
        var href = link.getAttribute('href');
        if (href && href.startsWith('#') && href.length > 1) {
          e.preventDefault();
          var target = document.querySelector(href);
          if (target) {
            var offset = navbar.offsetHeight + 10;
            var top = target.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });

            // Close mobile navbar if open
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
              var bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
              if (bsCollapse) bsCollapse.hide();
            }
          }
        }
      });
    });
  }

  /* ================================================================
     2. HERO PARALLAX
  ================================================================ */
  function initHeroParallax() {
    var heroBg = document.getElementById('heroBg');
    if (!heroBg) return;

    window.addEventListener('scroll', function () {
      var scrolled = window.scrollY;
      if (scrolled < window.innerHeight) {
        heroBg.style.transform = 'scale(1.05) translateY(' + (scrolled * 0.25) + 'px)';
      }
    }, { passive: true });
  }

  /* ================================================================
     3. SWIPER CAROUSEL
  ================================================================ */
  function initSwiperCarousel() {
    if (typeof Swiper === 'undefined') return;

    swiperInstance = new Swiper('#tattooSwiper', {
      slidesPerView: 1.2,
      spaceBetween: 16,
      centeredSlides: false,
      loop: false,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        prevEl: '#tattooPrev',
        nextEl: '#tattooNext',
      },
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      breakpoints: {
        480: { slidesPerView: 1.8, spaceBetween: 16 },
        640: { slidesPerView: 2.4, spaceBetween: 18 },
        768: { slidesPerView: 3,   spaceBetween: 20 },
        992: { slidesPerView: 4,   spaceBetween: 22 },
        1200: { slidesPerView: 5,  spaceBetween: 24 },
      },
    });

    // Pause autoplay on hover
    var container = document.getElementById('tattooSwiper');
    if (container) {
      container.addEventListener('mouseenter', function () { swiperInstance.autoplay.stop(); });
      container.addEventListener('mouseleave', function () { swiperInstance.autoplay.start(); });
    }
  }

  /* ================================================================
     4. GALLERY LIGHTBOX
  ================================================================ */
  function initGalleryLightbox() {
    var lightbox    = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightboxImg');
    var closeBtn    = document.getElementById('lightboxClose');
    if (!lightbox || !lightboxImg) return;

    function openLightbox(src, alt) {
      lightboxImg.src = src;
      lightboxImg.alt = alt || 'Tattoo';
      lightbox.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
      lightboxImg.src = '';
    }

    // Click on gallery items
    var galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(function (item) {
      item.addEventListener('click', function () {
        var src = item.getAttribute('data-img') || item.querySelector('img').src;
        var alt = item.querySelector('img') ? item.querySelector('img').alt : '';
        openLightbox(src, alt);
      });
    });

    // Close events
    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeLightbox();
    });
  }

  /* ================================================================
     5. SCROLL REVEAL
  ================================================================ */
  function initScrollReveal() {
    var revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if (!revealEls.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ================================================================
     6. COUNTER ANIMATION (Hero Stats)
  ================================================================ */
  function initCounterAnimation() {
    var counters = document.querySelectorAll('[data-count]');
    if (!counters.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(function (counter) {
      observer.observe(counter);
    });

    function animateCounter(el) {
      var target   = parseInt(el.getAttribute('data-count'), 10);
      var duration = 1800;
      var start    = null;

      function step(timestamp) {
        if (!start) start = timestamp;
        var progress = Math.min((timestamp - start) / duration, 1);
        var ease = 1 - Math.pow(1 - progress, 3); // ease out cubic
        el.textContent = Math.floor(ease * target);
        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          el.textContent = target;
          // Add '+' suffix for stats ≥ 100
          if (target >= 100) el.textContent = target + '+';
        }
      }

      window.requestAnimationFrame(step);
    }
  }

  /* ================================================================
     7. BOOKING FORM — AJAX Submit
  ================================================================ */
  function initBookingForm() {
    var form       = document.getElementById('bookingForm');
    var submitBtn  = document.getElementById('submitBtn');
    var msgDiv     = document.getElementById('form-message');
    if (!form) return;

    // Set min date to today
    var dateInput = document.getElementById('booking-date');
    if (dateInput) {
      var today = new Date();
      var dd    = String(today.getDate()).padStart(2, '0');
      var mm    = String(today.getMonth() + 1).padStart(2, '0');
      var yyyy  = today.getFullYear();
      dateInput.setAttribute('min', yyyy + '-' + mm + '-' + dd);
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      // Basic front-end validation
      var name  = form.querySelector('[name="name"]').value.trim();
      var email = form.querySelector('[name="email"]').value.trim();
      var agree = form.querySelector('#agree-terms');

      if (!name || !email) {
        showMessage('error', 'Please fill in your name and email address.');
        return;
      }

      if (!isValidEmail(email)) {
        showMessage('error', 'Please enter a valid email address.');
        return;
      }

      if (agree && !agree.checked) {
        showMessage('error', 'Please agree to the Terms & Conditions to continue.');
        return;
      }

      // Check if WordPress AJAX is available
      if (typeof goldmomentData === 'undefined') {
        // Demo mode: show success without AJAX
        setLoadingState(true);
        setTimeout(function () {
          setLoadingState(false);
          showMessage('success', 'Thank you! Your booking request has been sent. We\'ll contact you within 24 hours.');
          form.reset();
        }, 1500);
        return;
      }

      // Real AJAX Submit
      setLoadingState(true);

      var formData = new FormData(form);
      formData.append('action', 'goldmoment_booking');
      formData.append('nonce', goldmomentData.nonce);

      fetch(goldmomentData.ajaxUrl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          setLoadingState(false);
          if (data.success) {
            showMessage('success', data.data.message);
            form.reset();
          } else {
            showMessage('error', data.data.message || 'Something went wrong. Please try again.');
          }
        })
        .catch(function () {
          setLoadingState(false);
          showMessage('error', 'Network error. Please check your connection and try again.');
        });
    });

    function setLoadingState(loading) {
      if (!submitBtn) return;
      submitBtn.disabled = loading;
      submitBtn.innerHTML = loading
        ? '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...'
        : '<i class="fa-solid fa-paper-plane"></i> Send Booking Request';
    }

    function showMessage(type, text) {
      if (!msgDiv) return;
      msgDiv.className = type;
      msgDiv.textContent = text;
      msgDiv.style.display = 'block';
      msgDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

      if (type === 'success') {
        setTimeout(function () {
          msgDiv.style.display = 'none';
        }, 8000);
      }
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
  }

  /* ================================================================
     8. BACK TO TOP
  ================================================================ */
  function initBackToTop() {
    var btn = document.getElementById('backToTop');
    if (!btn) return;

    window.addEventListener('scroll', function () {
      if (window.scrollY > 400) {
        btn.style.display = 'flex';
        btn.style.opacity = '1';
      } else {
        btn.style.opacity = '0';
        setTimeout(function () {
          if (window.scrollY <= 400) btn.style.display = 'none';
        }, 300);
      }
    }, { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    btn.addEventListener('mouseenter', function () {
      btn.style.transform = 'translateY(-4px) scale(1.05)';
    });

    btn.addEventListener('mouseleave', function () {
      btn.style.transform = 'translateY(0) scale(1)';
    });
  }

  /* ================================================================
     9. ACTIVE NAV LINK on Scroll (Spy)
  ================================================================ */
  function initNavActiveLinks() {
    var sections = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    if (!sections.length || !navLinks.length) return;

    window.addEventListener('scroll', function () {
      var scrollY  = window.scrollY;
      var offset   = 120;
      var current  = '';

      sections.forEach(function (section) {
        var top    = section.offsetTop - offset;
        var height = section.offsetHeight;
        if (scrollY >= top && scrollY < top + height) {
          current = section.getAttribute('id');
        }
      });

      navLinks.forEach(function (link) {
        link.classList.remove('active');
        var href = link.getAttribute('href');
        if (href === '#' + current) {
          link.classList.add('active');
        }
      });
    }, { passive: true });
  }

  /* ================================================================
     10. GALLERY FILTER (Portfolio Style Tabs)
     Tabs are customizable via WP Customizer → "carousel_filter_tabs"
     Each slide carries a data-style attribute matching the tattoo tag.
  ================================================================ */
  function initGalleryFilter() {
    var filterBtns = document.querySelectorAll('.gallery-filter-btn');
    if (!filterBtns.length) return;

    var swiperEl = document.getElementById('tattooSwiper');
    if (!swiperEl) return;

    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        // Update active button
        filterBtns.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var filter = btn.getAttribute('data-filter'); // e.g. 'all', 'japanese', 'blackwork'

        // Show / hide slides based on data-style
        var slides = swiperEl.querySelectorAll('.swiper-slide');
        slides.forEach(function (slide) {
          var style = slide.getAttribute('data-style') || '';
          slide.style.display = (filter === 'all' || style === filter) ? '' : 'none';
        });

        // Reset to first visible slide and refresh layout
        if (swiperInstance) {
          swiperInstance.slideTo(0, 0);
          swiperInstance.update();
        }
      });
    });
  }

})();
