/* ═══════════════════════════════════════════════════
   Renova — Shared Components
   Navbar + Footer injected on every page.
   Active link auto-detected from window.location.
═══════════════════════════════════════════════════ */

(function () {
  /* ── Active page detection ── */
  const path = window.location.pathname.split('/').pop() || 'index.html';
  const isService = path.startsWith('service-');
  const isPackages = path === 'packages.html';
  const isAbout = path === 'about.html';
  const isContact = path === 'contact.html';
  const isServices = path === 'services.html' || isService;

  function cls(active) {
    return active
      ? 'text-gold font-semibold'
      : 'text-text-sub hover:text-text-main transition-colors';
  }

  /* ── Navbar HTML ── */
  const navbarHTML = `
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-4 px-6 lg:px-12">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="index.html">
      <img src="assets/images/logo/logo.png" alt="Renova Marketing Solutions" class="h-10 w-auto object-contain" />
    </a>
    <ul class="hidden lg:flex items-center gap-8 text-sm font-medium">
      <li><a href="services.html" class="${cls(isServices)}">Services</a></li>
      <li><a href="packages.html" class="${cls(isPackages)}">Packages</a></li>
      <li><a href="index.html#portfolio" class="${cls(false)}">Portfolio</a></li>
      <li><a href="about.html" class="${cls(isAbout)}">About</a></li>
      <li><a href="contact.html" class="btn-gold px-5 py-2.5 rounded-sm text-sm text-white${isContact ? ' ring-2 ring-gold/40' : ''}">Get Started</a></li>
    </ul>
    <button id="hamburger" class="lg:hidden flex flex-col gap-1.5 p-2" aria-label="Menu">
      <span class="block w-6 h-0.5 bg-text-main"></span>
      <span class="block w-6 h-0.5 bg-text-main"></span>
      <span class="block w-4 h-0.5 bg-text-main"></span>
    </button>
  </div>
  <div id="mobile-menu" class="lg:hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-lg border-b border-gray-100 shadow-lg" style="display:none">
    <ul class="flex flex-col py-3 px-6">
      <li><a href="services.html" class="block py-3 text-sm ${isServices ? 'font-semibold text-gold' : 'font-medium text-text-sub'} border-b border-gray-50">Services</a></li>
      <li><a href="packages.html" class="block py-3 text-sm ${isPackages ? 'font-semibold text-gold' : 'font-medium text-text-sub'} border-b border-gray-50">Packages</a></li>
      <li><a href="index.html#portfolio" class="block py-3 text-sm font-medium text-text-sub border-b border-gray-50">Portfolio</a></li>
      <li><a href="about.html" class="block py-3 text-sm ${isAbout ? 'font-semibold text-gold' : 'font-medium text-text-sub'} border-b border-gray-50">About</a></li>
      <li class="pt-3"><a href="contact.html" class="btn-gold block text-center py-3 rounded-sm text-sm text-white">Get Started</a></li>
    </ul>
  </div>
</nav>`;

  /* ── Footer HTML ── */
  const footerHTML = `
<footer id="site-footer" class="py-12 px-6 lg:px-12 border-t border-mid-gray bg-off-white">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
      <div class="md:col-span-2">
        <a href="index.html" class="inline-block mb-4">
          <img src="assets/images/logo/logo.png" alt="Renova Marketing Solutions" class="h-9 w-auto object-contain" />
        </a>
        <p class="text-text-sub text-sm leading-relaxed max-w-xs">A full-service marketing and technology agency helping businesses build stronger brands across the USA and Canada.</p>
        <p class="text-text-muted text-xs mt-3 italic">Creative Solutions. Measurable Results. Lasting Growth.</p>
      </div>
      <div>
        <div class="text-xs uppercase tracking-widest text-text-muted font-bold mb-4">Services</div>
        <ul class="space-y-2">
          <li><a href="service-web-design.html"  class="text-xs text-text-sub hover:text-gold transition-colors">Website Development</a></li>
          <li><a href="service-web-app.html"     class="text-xs text-text-sub hover:text-gold transition-colors">Web Applications</a></li>
          <li><a href="service-android.html"     class="text-xs text-text-sub hover:text-gold transition-colors">Android Apps</a></li>
          <li><a href="service-ios.html"         class="text-xs text-text-sub hover:text-gold transition-colors">iOS Apps</a></li>
          <li><a href="service-seo.html"         class="text-xs text-text-sub hover:text-gold transition-colors">SEO Services</a></li>
          <li><a href="service-branding.html"    class="text-xs text-text-sub hover:text-gold transition-colors">Branding &amp; Design</a></li>
          <li><a href="service-social-media.html" class="text-xs text-text-sub hover:text-gold transition-colors">Social Media</a></li>
          <li><a href="service-influencer.html"  class="text-xs text-text-sub hover:text-gold transition-colors">Influencer Marketing</a></li>
          <li><a href="service-photography.html" class="text-xs text-text-sub hover:text-gold transition-colors">Photography &amp; Video</a></li>
        </ul>
      </div>
      <div>
        <div class="text-xs uppercase tracking-widest text-text-muted font-bold mb-4">Company</div>
        <ul class="space-y-2">
          <li><a href="about.html"           class="text-xs text-text-sub hover:text-gold transition-colors">About Us</a></li>
          <li><a href="packages.html"        class="text-xs text-text-sub hover:text-gold transition-colors">Packages</a></li>
          <li><a href="index.html#portfolio" class="text-xs text-text-sub hover:text-gold transition-colors">Portfolio</a></li>
          <li><a href="contact.html"         class="text-xs text-text-sub hover:text-gold transition-colors">Contact Us</a></li>
          <li><a href="services.html"        class="text-xs text-text-sub hover:text-gold transition-colors">All Services</a></li>
        </ul>
        <div class="mt-6 pt-6 border-t border-mid-gray">
          <div class="text-xs uppercase tracking-widest text-text-muted font-bold mb-3">Follow Us</div>
          <div class="flex gap-3">
            <a href="#" class="w-7 h-7 rounded-sm border border-mid-gray flex items-center justify-center hover:border-gold hover:text-gold transition-colors text-text-muted text-xs font-bold">f</a>
            <a href="#" class="w-7 h-7 rounded-sm border border-mid-gray flex items-center justify-center hover:border-gold hover:text-gold transition-colors text-text-muted text-xs font-bold">in</a>
            <a href="#" class="w-7 h-7 rounded-sm border border-mid-gray flex items-center justify-center hover:border-gold hover:text-gold transition-colors text-text-muted text-xs">◎</a>
          </div>
        </div>
      </div>
    </div>
    <div class="gold-divider mb-6"></div>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
      <p class="text-xs text-text-muted">&copy; ${new Date().getFullYear()} Renova Marketing Solutions. All rights reserved.</p>
      <p class="text-xs text-text-muted">USA &amp; Canada</p>
    </div>
  </div>
</footer>`;

  /* ── Inject on DOM ready ── */
  function inject() {
    const navSlot = document.getElementById('navbar-placeholder');
    if (navSlot) navSlot.outerHTML = navbarHTML;

    const footSlot = document.getElementById('footer-placeholder');
    if (footSlot) footSlot.outerHTML = footerHTML;

    initNavbar();
    initCursor();
    initFooterReveal();
  }

  /* ── Navbar behaviour ── */
  function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
      navbar.classList.toggle('nav-scrolled', window.scrollY > 60);
    }, { passive: true });

    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    if (hamburger && mobileMenu) {
      hamburger.addEventListener('click', (e) => {
        e.stopPropagation();
        mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
      });
      document.addEventListener('click', (e) => {
        if (!navbar.contains(e.target)) mobileMenu.style.display = 'none';
      });
    }
  }

  /* ── Gold cursor ── */
  function initCursor() {
    if (document.getElementById('cursor-dot')) return; // already exists
    const dot = document.createElement('div');
    const ring = document.createElement('div');
    dot.id = 'cursor-dot';
    ring.id = 'cursor-ring';
    Object.assign(dot.style, {
      position: 'fixed', width: '6px', height: '6px', borderRadius: '50%',
      background: '#b8922a', pointerEvents: 'none', zIndex: '9999',
      transform: 'translate(-50%,-50%)', top: '0', left: '0',
    });
    Object.assign(ring.style, {
      position: 'fixed', width: '32px', height: '32px', borderRadius: '50%',
      border: '1.5px solid rgba(184,146,42,0.5)', pointerEvents: 'none', zIndex: '9998',
      transform: 'translate(-50%,-50%)', top: '0', left: '0',
      transition: 'width .3s, height .3s, border-color .3s',
    });
    document.body.appendChild(dot);
    document.body.appendChild(ring);

    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', (e) => {
      mx = e.clientX; my = e.clientY;
      if (typeof gsap !== 'undefined') gsap.set(dot, { x: mx, y: my });
    });
    (function loop() {
      rx += (mx - rx) * 0.1;
      ry += (my - ry) * 0.1;
      if (typeof gsap !== 'undefined') gsap.set(ring, { x: rx, y: ry });
      requestAnimationFrame(loop);
    })();

    function expandCursor() { ring.style.width = '52px'; ring.style.height = '52px'; ring.style.borderColor = 'rgba(184,146,42,0.9)'; }
    function shrinkCursor() { ring.style.width = '32px'; ring.style.height = '32px'; ring.style.borderColor = 'rgba(184,146,42,0.5)'; }

    // Attach to existing elements
    document.querySelectorAll('a, button, .svc-card, .feat-card, .filter-btn, .pkg-card, .value-card').forEach((el) => {
      el.addEventListener('mouseenter', expandCursor);
      el.addEventListener('mouseleave', shrinkCursor);
    });

    // Watch for future elements (e.g. injected cards)
    new MutationObserver((mutations) => {
      mutations.forEach((m) => {
        m.addedNodes.forEach((node) => {
          if (node.nodeType !== 1) return;
          node.querySelectorAll('a, button, .svc-card, .feat-card, .filter-btn').forEach((el) => {
            el.addEventListener('mouseenter', expandCursor);
            el.addEventListener('mouseleave', shrinkCursor);
          });
        });
      });
    }).observe(document.body, { childList: true, subtree: true });
  }

  /* ── Footer reveal ── */
  function initFooterReveal() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    const footer = document.getElementById('site-footer');
    if (!footer) return;
    gsap.from(footer, {
      opacity: 0, y: 24, duration: 0.9, ease: 'expo.out',
      scrollTrigger: { trigger: footer, start: 'top 95%', once: true },
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inject);
  } else {
    inject();
  }
})();
