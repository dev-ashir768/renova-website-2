/* ═══════════════════════════════════════════
   Renova Marketing Solutions — Premium Script
═══════════════════════════════════════════ */

/* ── 1. GSAP SCROLLTRIGGER SETUP ─────────────────────────────────────── */
gsap.registerPlugin(ScrollTrigger);

// Smooth anchor scrolling (native, no library)
function smoothScrollTo(targetId, offset = 70) {
  const el = document.querySelector(targetId);
  if (!el) return;
  const top = el.getBoundingClientRect().top + window.scrollY - offset;
  window.scrollTo({ top, behavior: 'smooth' });
}


/* ── 2. CUSTOM CURSOR ────────────────────────────────────────────────── */
const cursorDot  = document.createElement('div');
const cursorRing = document.createElement('div');
cursorDot.id  = 'cursor-dot';
cursorRing.id = 'cursor-ring';
Object.assign(cursorDot.style, {
  position:'fixed', width:'6px', height:'6px', borderRadius:'50%',
  background:'#b8922a', pointerEvents:'none', zIndex:'9999',
  transform:'translate(-50%,-50%)', top:'0', left:'0',
});
Object.assign(cursorRing.style, {
  position:'fixed', width:'32px', height:'32px', borderRadius:'50%',
  border:'1.5px solid rgba(184,146,42,0.5)', pointerEvents:'none',
  zIndex:'9998', transform:'translate(-50%,-50%)', top:'0', left:'0',
  transition:'width 0.3s, height 0.3s, border-color 0.3s',
});
document.body.appendChild(cursorDot);
document.body.appendChild(cursorRing);

let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;

document.addEventListener('mousemove', (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
  gsap.set(cursorDot, { x: mouseX, y: mouseY });
});

(function animateRing() {
  ringX += (mouseX - ringX) * 0.1;
  ringY += (mouseY - ringY) * 0.1;
  gsap.set(cursorRing, { x: ringX, y: ringY });
  requestAnimationFrame(animateRing);
})();

document.querySelectorAll('a, button, .service-card, .package-card, .portfolio-item, .faq-trigger').forEach(el => {
  el.addEventListener('mouseenter', () => {
    cursorRing.style.width = '52px';
    cursorRing.style.height = '52px';
    cursorRing.style.borderColor = 'rgba(184,146,42,0.9)';
  });
  el.addEventListener('mouseleave', () => {
    cursorRing.style.width = '32px';
    cursorRing.style.height = '32px';
    cursorRing.style.borderColor = 'rgba(184,146,42,0.5)';
  });
});


/* ── 3. NAVBAR ────────────────────────────────────────────────────────── */
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  if (window.scrollY > 60) navbar.classList.add('nav-scrolled');
  else                      navbar.classList.remove('nav-scrolled');
}, { passive: true });

// Active nav link
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('ul a[href^="#"]');

window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(sec => {
    if (window.scrollY >= sec.offsetTop - 120) current = sec.id;
  });
  navLinks.forEach(a => {
    a.style.color = a.getAttribute('href') === `#${current}` ? '#b8922a' : '';
  });
}, { passive: true });

// Mobile menu
document.getElementById('hamburger').addEventListener('click', (e) => {
  e.stopPropagation();
  document.getElementById('mobile-menu').classList.toggle('open');
});
document.addEventListener('click', (e) => {
  if (!navbar.contains(e.target)) {
    document.getElementById('mobile-menu').classList.remove('open');
  }
});
document.querySelectorAll('.mobile-link').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('mobile-menu').classList.remove('open');
    const target = link.getAttribute('href');
    if (target) setTimeout(() => smoothScrollTo(target), 80);
  });
});

// Desktop anchor links
document.querySelectorAll('a[href^="#"]').forEach(a => {
  if (!a.classList.contains('mobile-link')) {
    a.addEventListener('click', (e) => {
      const target = a.getAttribute('href');
      if (target && target.length > 1) {
        e.preventDefault();
        smoothScrollTo(target);
      }
    });
  }
});


/* ── 4. HERO ANIMATION ────────────────────────────────────────────────── */
(function initHero() {
  const h1Words = document.querySelectorAll('#hero-headline .hero-word span');

  gsap.set('#hero-label',    { opacity: 0, y: 20, filter: 'blur(4px)' });
  gsap.set(h1Words,          { y: '105%' });
  gsap.set('#hero-sub',      { opacity: 0, y: 20, filter: 'blur(4px)' });
  gsap.set('#hero-cta > *',  { opacity: 0, y: 18, scale: 0.96 });
  gsap.set('#hero-stats > *',{ opacity: 0, y: 18 });

  const tl = gsap.timeline({ delay: 0.15, defaults: { ease: 'expo.out' } });
  tl
    .to('#hero-label',    { opacity: 1, y: 0, filter: 'blur(0px)', duration: 0.8 })
    .to(h1Words, {
      y: '0%', duration: 1.0,
      stagger: { each: 0.05, ease: 'power2.out' },
      ease: 'expo.out',
    }, '-=0.5')
    .to('#hero-sub',      { opacity: 1, y: 0, filter: 'blur(0px)', duration: 0.75 }, '-=0.35')
    .to('#hero-cta > *',  { opacity: 1, y: 0, scale: 1, duration: 0.65, stagger: 0.12, ease: 'back.out(1.5)' }, '-=0.5')
    .to('#hero-stats > *',{ opacity: 1, y: 0, duration: 0.55, stagger: 0.1 }, '-=0.4');

  // Hero parallax on mouse move
  const hero = document.getElementById('home');
  hero.addEventListener('mousemove', (e) => {
    const { width, height } = hero.getBoundingClientRect();
    const xPct = (e.clientX / width  - 0.5) * 16;
    const yPct = (e.clientY / height - 0.5) * 10;
    gsap.to('#hero-headline', { x: xPct * 0.5, y: yPct * 0.4, duration: 1.2, ease: 'power2.out' });
    gsap.to('#hero-sub',      { x: xPct * 0.3, y: yPct * 0.25, duration: 1.4, ease: 'power2.out' });
  });
  hero.addEventListener('mouseleave', () => {
    gsap.to(['#hero-headline','#hero-sub'], { x: 0, y: 0, duration: 1.2, ease: 'power2.out' });
  });
})();


/* ── 5. SECTION HEADING REVEALS ───────────────────────────────────────── */
document.querySelectorAll('h2').forEach(el => {
  const text = el.innerHTML;
  // Wrap each word in overflow:hidden spans
  const words = el.innerText.trim().split(/\s+/);
  // Only split plain text headings (skip ones already processed)
  if (el.dataset.split) return;
  el.dataset.split = 'true';

  // Preserve gold-text spans by working with innerHTML carefully
  // Simple approach: wrap whole h2 for fade+slide
  gsap.set(el, { opacity: 0, y: 40 });
  ScrollTrigger.create({
    trigger: el,
    start: 'top 88%',
    onEnter: () => {
      gsap.to(el, { opacity: 1, y: 0, duration: 0.9, ease: 'expo.out' });
    },
    once: true,
  });
});


/* ── 6. CARD SCROLL REVEALS ───────────────────────────────────────────── */
// Service cards — stagger per visible batch
gsap.utils.toArray('.service-card').forEach((card, i) => {
  gsap.set(card, { opacity: 0, y: 50, scale: 0.97 });
  ScrollTrigger.create({
    trigger: card,
    start: 'top 90%',
    onEnter: () => {
      gsap.to(card, {
        opacity: 1, y: 0, scale: 1,
        duration: 0.8,
        delay: (i % 3) * 0.1,
        ease: 'expo.out',
      });
    },
    once: true,
  });
});

// Package cards
gsap.utils.toArray('.package-card').forEach((card, i) => {
  gsap.set(card, { opacity: 0, y: 50, scale: 0.97 });
  ScrollTrigger.create({
    trigger: card,
    start: 'top 90%',
    onEnter: () => {
      gsap.to(card, {
        opacity: 1, y: 0, scale: 1,
        duration: 0.8,
        delay: (i % 3) * 0.12,
        ease: 'expo.out',
      });
    },
    once: true,
  });
});

// Portfolio items
gsap.utils.toArray('.portfolio-item').forEach((item, i) => {
  gsap.set(item, { opacity: 0, y: 40, scale: 0.96 });
  ScrollTrigger.create({
    trigger: item,
    start: 'top 92%',
    onEnter: () => {
      gsap.to(item, {
        opacity: 1, y: 0, scale: 1,
        duration: 0.75,
        delay: (i % 3) * 0.1,
        ease: 'expo.out',
      });
    },
    once: true,
  });
});

// Why cards, FAQ items
gsap.utils.toArray('.why-card, .faq-item').forEach((el, i) => {
  gsap.set(el, { opacity: 0, x: -20 });
  ScrollTrigger.create({
    trigger: el,
    start: 'top 90%',
    onEnter: () => {
      gsap.to(el, { opacity: 1, x: 0, duration: 0.7, delay: i * 0.07, ease: 'expo.out' });
    },
    once: true,
  });
});

// Generic reveals
gsap.utils.toArray('.reveal').forEach((el, i) => {
  if (el.matches('.service-card,.package-card,.portfolio-item,.why-card,.faq-item')) return;
  gsap.set(el, { opacity: 0, y: 36 });
  ScrollTrigger.create({
    trigger: el,
    start: 'top 90%',
    onEnter: () => {
      gsap.to(el, { opacity: 1, y: 0, duration: 0.8, delay: (i % 3) * 0.07, ease: 'expo.out' });
    },
    once: true,
  });
});

// Gold divider line draw
gsap.utils.toArray('.gold-divider').forEach(el => {
  gsap.set(el, { scaleX: 0, transformOrigin: 'left center' });
  ScrollTrigger.create({
    trigger: el,
    start: 'top 93%',
    onEnter: () => {
      gsap.to(el, { scaleX: 1, duration: 1.0, ease: 'expo.out' });
    },
    once: true,
  });
});


/* ── 7. MAGNETIC BUTTONS ─────────────────────────────────────────────── */
document.querySelectorAll('.btn-gold, .btn-outline').forEach(btn => {
  btn.addEventListener('mousemove', (e) => {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left - rect.width  / 2;
    const y = e.clientY - rect.top  - rect.height / 2;
    gsap.to(btn, { x: x * 0.22, y: y * 0.18, duration: 0.4, ease: 'power2.out' });
  });
  btn.addEventListener('mouseleave', () => {
    gsap.to(btn, { x: 0, y: 0, duration: 0.6, ease: 'elastic.out(1, 0.5)' });
  });
});


/* ── 8. SERVICE CARD 3D TILT ──────────────────────────────────────────── */
document.querySelectorAll('.service-card').forEach(card => {
  card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width  - 0.5;
    const y = (e.clientY - rect.top)  / rect.height - 0.5;
    gsap.to(card, {
      rotateY: x * 7, rotateX: -y * 7, y: -6,
      duration: 0.4, ease: 'power2.out',
      transformPerspective: 900,
    });
  });
  card.addEventListener('mouseleave', () => {
    gsap.to(card, {
      rotateY: 0, rotateX: 0, y: 0,
      duration: 0.7, ease: 'elastic.out(1, 0.6)',
    });
  });
});

document.querySelectorAll('.package-card').forEach(card => {
  card.addEventListener('mouseenter', () => gsap.to(card, { y: -6, duration: 0.35, ease: 'power2.out' }));
  card.addEventListener('mouseleave', () => gsap.to(card, { y:  0, duration: 0.5,  ease: 'elastic.out(1, 0.6)' }));
});


/* ── 9. PORTFOLIO HOVER ───────────────────────────────────────────────── */
document.querySelectorAll('.portfolio-item').forEach(item => {
  item.addEventListener('mouseenter', () => {
    gsap.to(item, { scale: 1.025, duration: 0.4, ease: 'power2.out' });
  });
  item.addEventListener('mouseleave', () => {
    gsap.to(item, { scale: 1, duration: 0.5, ease: 'elastic.out(1, 0.6)' });
  });
});


/* ── 10. FAQ ACCORDION ───────────────────────────────────────────────── */
document.querySelectorAll('.faq-trigger').forEach(trigger => {
  trigger.addEventListener('click', function () {
    const item   = this.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const icon   = item.querySelector('.faq-icon');
    const isOpen = !answer.classList.contains('hidden');

    document.querySelectorAll('.faq-answer').forEach(a => a.classList.add('hidden'));
    document.querySelectorAll('.faq-icon').forEach(ic => gsap.to(ic, { rotation: 0, duration: 0.3 }));

    if (!isOpen) {
      answer.classList.remove('hidden');
      gsap.fromTo(answer, { opacity: 0, y: -6 }, { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' });
      gsap.to(icon, { rotation: 45, duration: 0.3, ease: 'back.out(2)' });
    }
  });
});


/* ── 11. CONTACT FORM ────────────────────────────────────────────────── */
(function () {
  const form = document.getElementById('contact-form');
  if (!form) return;

  Validate.attachLiveValidation(['#c-name','#c-email','#c-phone','#c-project','#c-message']);

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const valid = Validate.all({
      '#c-name':    { required: true },
      '#c-email':   { required: true, email: true },
      '#c-phone':   { phone: true },
      '#c-project': { select: true },
      '#c-message': { required: true, minLen: 20 },
    });

    if (!valid) {
      Validate.shakeBtn(form.querySelector('button[type="submit"]'));
      return;
    }

    const btn = form.querySelector('button[type="submit"]');
    const orig = btn.textContent;
    btn.textContent = 'Sending…';
    btn.disabled = true;

    setTimeout(() => {
      btn.textContent = 'Message Sent ✓';
      btn.style.background = 'linear-gradient(135deg,#2d8a4e,#3aad64)';
      gsap.fromTo(btn, { scale: 0.97 }, { scale: 1, duration: 0.3, ease: 'back.out(2)' });
      form.reset();
      setTimeout(() => {
        btn.textContent = orig;
        btn.style.background = '';
        btn.disabled = false;
      }, 4500);
    }, 700);
  });
})();


/* ── 12. FOOTER REVEAL ───────────────────────────────────────────────── */
gsap.from('footer', {
  opacity: 0, y: 24,
  duration: 0.9,
  ease: 'expo.out',
  scrollTrigger: { trigger: 'footer', start: 'top 95%', once: true },
});
