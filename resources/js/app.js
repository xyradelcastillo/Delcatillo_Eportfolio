/* ------------------------------------------------------------------
 | Portfolio interactions (framework-free vanilla JS)
 | 1. Dark / light theme toggle
 | 2. Mobile hamburger navigation
 | 3. Navbar surface on scroll + active section highlighting
 | 4. Project filter buttons
 | 5. Scroll-reveal animations
 * ----------------------------------------------------------------- */

(function () {
    'use strict';

    var doc = document.documentElement;

    /* 1. Theme toggle — the initial class was already set inline in <head>
          to avoid a flash of the wrong theme; here we only flip & persist. */
    var themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var isDark = doc.classList.toggle('dark');
            try {
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            } catch (e) { /* storage unavailable */ }
        });
    }

    /* 2. Mobile navigation */
    var menuToggle = document.getElementById('menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    if (menuToggle && mobileMenu) {
        var setMenu = function (open) {
            mobileMenu.classList.toggle('hidden', !open);
            menuToggle.setAttribute('aria-expanded', String(open));
            menuToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
            menuToggle.querySelector('.menu-open').classList.toggle('hidden', open);
            menuToggle.querySelector('.menu-close').classList.toggle('hidden', !open);
        };
        menuToggle.addEventListener('click', function () {
            setMenu(mobileMenu.classList.contains('hidden'));
        });
        // Close the panel after tapping an anchor link.
        mobileMenu.querySelectorAll('[data-navlink-mobile]').forEach(function (link) {
            link.addEventListener('click', function () { setMenu(false); });
        });
    }

    /* 3. Navbar: add border/shadow once scrolled, highlight current section. */
    var navbar = document.getElementById('navbar');
    var onScroll = function () {
        if (navbar) {
            navbar.classList.toggle('is-scrolled', window.scrollY > 8);
        }
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    var navLinks = document.querySelectorAll('[data-navlink]');
    if ('IntersectionObserver' in window && navLinks.length) {
        var linkFor = function (id) {
            return document.querySelector('[data-navlink][href="#' + id + '"]');
        };
        var sectionObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    navLinks.forEach(function (link) {
                        link.removeAttribute('aria-current');
                    });
                    var link = linkFor(entry.target.id);
                    if (link) link.setAttribute('aria-current', 'true');
                });
            },
            { rootMargin: '-40% 0px -55% 0px' }
        );
        document.querySelectorAll('main section[id]').forEach(function (section) {
            sectionObserver.observe(section);
        });
    }

    /* 4. Project category filter. */
    var filterButtons = document.querySelectorAll('[data-filter]');
    var projectCards = document.querySelectorAll('.project-card');
    var emptyState = document.getElementById('projects-empty');
    if (filterButtons.length && projectCards.length) {
        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var filter = button.getAttribute('data-filter');
                filterButtons.forEach(function (b) {
                    b.setAttribute('aria-pressed', String(b === button));
                });
                var visible = 0;
                projectCards.forEach(function (card) {
                    var show = filter === 'all' || card.getAttribute('data-category') === filter;
                    card.classList.toggle('hidden', !show);
                    if (show) visible++;
                });
                if (emptyState) {
                    emptyState.classList.toggle('hidden', visible > 0);
                }
            });
        });
    }

    /* 5. Reveal-on-scroll animations (.reveal elements in app.css). */
    var revealables = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) {
        revealables.forEach(function (el) { el.classList.add('revealed'); });
    } else {
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12 }
        );
        revealables.forEach(function (el) { revealObserver.observe(el); });
    }
})();
