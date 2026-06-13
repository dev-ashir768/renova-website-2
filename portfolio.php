<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM portfolio_items WHERE status = 1 ORDER BY sort_order ASC, id ASC");
$items = $stmt->fetchAll();

$category_labels = [
    'website'   => 'Website Design',
    'branding'  => 'Branding',
    'mobile'    => 'Mobile App',
    'webapp'    => 'Web Application',
    'ecommerce' => 'E-Commerce',
    'marketing' => 'SEO & Marketing',
];
?>
<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio — Renova Marketing Solutions</title>
  <meta name="description" content="Explore Renova's portfolio of websites, mobile apps, branding, and digital marketing work across the USA and Canada." />
  <link rel="icon" type="image/png" href="assets/images/logo/favicon.png" />

  <script src="assets/js/components.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            gold:'#b8922a','gold-light':'#d4a93a','gold-dark':'#8a6b1e',
            cream:'#fafaf8','off-white':'#f5f4f0','light-gray':'#efefec',
            'mid-gray':'#e0dfd9','text-main':'#111110','text-sub':'#5a5a55','text-muted':'#9a9a94',
          },
          fontFamily:{ sans:['Inter','system-ui','sans-serif'] },
        },
      },
    };
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    .port-card {
      background:#fff; border:1px solid #e0dfd9; border-radius:4px; overflow:hidden;
      transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease; cursor:pointer;
    }
    .port-card:hover { transform:translateY(-6px); box-shadow:0 20px 48px rgba(184,146,42,.12); border-color:rgba(184,146,42,.35); }
    .port-thumb { position:relative; overflow:hidden; background:#f5f4f0; aspect-ratio:4/3; }
    .port-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
    .port-overlay {
      position:absolute; inset:0; background:rgba(184,146,42,.08);
      display:flex; align-items:center; justify-content:center;
      opacity:0; transition:opacity .3s ease;
    }
    .port-card:hover .port-overlay { opacity:1; }
    .filter-pill {
      padding:8px 20px; border-radius:2px; border:1px solid #e0dfd9;
      font-size:.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.08em;
      color:#5a5a55; background:#fff; cursor:pointer; transition:all .2s ease;
    }
    .filter-pill:hover { border-color:#b8922a; color:#b8922a; }
    .filter-pill.active { background:#b8922a; border-color:#b8922a; color:#fff; }
    .stat-num { font-size:clamp(2rem,5vw,3.5rem); font-weight:900; color:#b8922a; line-height:1; }

    /* Default category illustrations */
    .cat-thumb { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; }
  </style>
</head>
<body>
  <div id="navbar-placeholder"></div>

  <!-- HERO -->
  <section class="relative pt-36 pb-20 px-6 lg:px-12 overflow-hidden" style="background:#fafaf8">
    <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(184,146,42,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(184,146,42,.05) 1px,transparent 1px);background-size:80px 80px;"></div>
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 70% 50% at 50% 0%,rgba(212,169,58,.07) 0%,transparent 70%);"></div>
    <div class="max-w-7xl mx-auto relative z-10">
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full border border-gold/20 bg-gold/5">
          <span class="w-1.5 h-1.5 rounded-full bg-gold animate-pulse inline-block"></span>
          <span class="text-xs tracking-widest uppercase text-gold font-semibold">Our Work</span>
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-[4rem] font-black leading-tight tracking-tight text-text-main mb-6">
          Work That <span class="gold-text">Speaks</span><br />For Itself
        </h1>
        <p class="text-text-sub text-lg leading-relaxed max-w-xl">
          From startups to established brands — websites, apps, identities, and campaigns built for businesses across the USA and Canada.
        </p>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="py-10 px-6 lg:px-12 border-y border-mid-gray bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        <div class="reveal"><div class="stat-num">50+</div><div class="text-xs uppercase tracking-widest text-text-muted mt-2 font-semibold">Projects Delivered</div></div>
        <div class="reveal"><div class="stat-num">40+</div><div class="text-xs uppercase tracking-widest text-text-muted mt-2 font-semibold">Happy Clients</div></div>
        <div class="reveal"><div class="stat-num">7+</div><div class="text-xs uppercase tracking-widest text-text-muted mt-2 font-semibold">Service Categories</div></div>
        <div class="reveal"><div class="stat-num">2</div><div class="text-xs uppercase tracking-widest text-text-muted mt-2 font-semibold">Countries Served</div></div>
      </div>
    </div>
  </section>

  <!-- PORTFOLIO GRID -->
  <section class="py-24 px-6 lg:px-12 bg-off-white">
    <div class="max-w-7xl mx-auto">

      <!-- Filter Pills -->
      <div class="flex flex-wrap gap-2 mb-14 reveal" id="filter-bar">
        <button class="filter-pill active" data-filter="all">All Work</button>
        <button class="filter-pill" data-filter="website">Website</button>
        <button class="filter-pill" data-filter="branding">Branding</button>
        <button class="filter-pill" data-filter="mobile">Mobile App</button>
        <button class="filter-pill" data-filter="webapp">Web App</button>
        <button class="filter-pill" data-filter="ecommerce">E-Commerce</button>
        <button class="filter-pill" data-filter="marketing">Marketing</button>
      </div>

      <!-- Grid -->
      <?php if (empty($items)): ?>
        <p class="text-center text-text-muted py-20">No portfolio items yet. <a href="admin/" class="text-gold underline">Add from admin panel.</a></p>
      <?php else: ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="portfolio-grid">
        <?php foreach ($items as $item): ?>
        <div class="port-item reveal" data-cat="<?= htmlspecialchars($item['category']) ?>">
          <div class="port-card">
            <div class="port-thumb">
              <?php if ($item['image']): ?>
                <img src="admin/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" />
              <?php else: ?>
                <?php echo getDefaultThumb($item['category']); ?>
              <?php endif; ?>
              <div class="port-overlay">
                <span class="text-xs uppercase tracking-widest text-gold font-bold">View Project</span>
              </div>
            </div>
            <div class="p-5">
              <div class="text-xs text-gold uppercase tracking-widest mb-1 font-semibold">
                <?= htmlspecialchars($category_labels[$item['category']] ?? $item['category']) ?>
              </div>
              <div class="text-sm font-bold text-text-main mb-1"><?= htmlspecialchars($item['title']) ?></div>
              <?php if ($item['description']): ?>
                <p class="text-xs text-text-muted leading-relaxed"><?= htmlspecialchars($item['description']) ?></p>
              <?php endif; ?>
              <?php if ($item['client'] || $item['year']): ?>
                <div class="flex items-center gap-3 mt-3 pt-3 border-t border-mid-gray">
                  <?php if ($item['client']): ?><span class="text-xs text-text-muted"><?= htmlspecialchars($item['client']) ?></span><?php endif; ?>
                  <?php if ($item['year']): ?><span class="text-xs text-text-muted ml-auto"><?= htmlspecialchars($item['year']) ?></span><?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div id="no-results" class="hidden text-center py-20">
        <p class="text-text-muted text-sm">No projects in this category.</p>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-24 px-6 lg:px-12" style="background:#111110">
    <div class="max-w-4xl mx-auto text-center reveal">
      <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full border border-gold/20 bg-gold/10">
        <span class="w-1.5 h-1.5 rounded-full bg-gold animate-pulse inline-block"></span>
        <span class="text-xs tracking-widest uppercase text-gold font-semibold">Start Your Project</span>
      </div>
      <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-tight mb-6" style="color:#fafaf8">
        Ready to Build<br /><span class="gold-text">Something Great?</span>
      </h2>
      <p class="text-sm leading-relaxed mb-10 max-w-lg mx-auto" style="color:#9a9a94">
        Let's talk about your project. We'll put together a tailored proposal within 24 hours.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="contact.html" class="btn-gold px-8 py-4 rounded-sm text-sm uppercase tracking-widest font-bold text-white">Start a Project</a>
        <a href="packages.html" class="btn-outline px-8 py-4 rounded-sm text-sm uppercase tracking-widest font-bold" style="border-color:rgba(255,255,255,.2);color:#fafaf8;">View Packages</a>
      </div>
    </div>
  </section>

  <div id="footer-placeholder"></div>

  <script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray('.reveal').forEach((el,i) => {
      gsap.set(el,{opacity:0,y:36});
      ScrollTrigger.create({ trigger:el, start:'top 90%', once:true,
        onEnter:()=>gsap.to(el,{opacity:1,y:0,duration:.8,delay:(i%3)*.08,ease:'expo.out'}) });
    });
    gsap.utils.toArray('.gold-divider').forEach(el => {
      gsap.set(el,{scaleX:0,transformOrigin:'left center'});
      ScrollTrigger.create({ trigger:el, start:'top 93%', once:true,
        onEnter:()=>gsap.to(el,{scaleX:1,duration:1,ease:'expo.out'}) });
    });

    // Filter
    document.querySelectorAll('.filter-pill').forEach(pill => {
      pill.addEventListener('click', () => {
        document.querySelectorAll('.filter-pill').forEach(p=>p.classList.remove('active'));
        pill.classList.add('active');
        const f = pill.dataset.filter;
        let count = 0;
        document.querySelectorAll('.port-item').forEach(item => {
          const show = f==='all' || item.dataset.cat===f;
          item.style.display = show ? '' : 'none';
          if (show) { gsap.fromTo(item,{opacity:0,y:16},{opacity:1,y:0,duration:.4,ease:'expo.out'}); count++; }
        });
        document.getElementById('no-results').classList.toggle('hidden', count>0);
      });
    });

    // Magnetic btns
    document.querySelectorAll('.btn-gold,.btn-outline').forEach(btn => {
      btn.addEventListener('mousemove',e=>{const r=btn.getBoundingClientRect();gsap.to(btn,{x:(e.clientX-r.left-r.width/2)*.22,y:(e.clientY-r.top-r.height/2)*.18,duration:.4,ease:'power2.out'});});
      btn.addEventListener('mouseleave',()=>gsap.to(btn,{x:0,y:0,duration:.6,ease:'elastic.out(1,.5)'}));
    });
  </script>
</body>
</html>
<?php

function getDefaultThumb(string $cat): string {
    $thumbs = [
        'website' => '
          <div class="cat-thumb">
            <div style="position:absolute;top:20%;left:10%;width:60%;height:4px;background:linear-gradient(90deg,rgba(184,146,42,.4),transparent);border-radius:2px;"></div>
            <div style="position:absolute;top:35%;left:10%;width:40%;height:3px;background:rgba(0,0,0,.06);border-radius:2px;"></div>
            <div style="position:absolute;top:50%;left:10%;right:10%;height:80px;background:rgba(184,146,42,.05);border:1px solid rgba(184,146,42,.15);border-radius:4px;"></div>
            <div style="position:absolute;bottom:30%;left:10%;width:30%;height:3px;background:rgba(0,0,0,.06);border-radius:2px;"></div>
          </div>',
        'branding' => '
          <div class="cat-thumb" style="flex-direction:column;gap:12px;">
            <div style="width:90px;height:55px;border:1.5px solid rgba(184,146,42,.3);border-radius:4px;display:flex;align-items:center;justify-content:center;background:rgba(184,146,42,.05);">
              <span style="font-size:18px;font-weight:900;background:linear-gradient(135deg,#b8922a,#d4a93a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">R</span>
            </div>
            <div style="width:60px;height:2px;background:rgba(184,146,42,.35);border-radius:1px;"></div>
          </div>',
        'mobile' => '
          <div class="cat-thumb" style="gap:16px;">
            <div style="width:75px;height:130px;border:1.5px solid rgba(184,146,42,.3);border-radius:12px;background:rgba(184,146,42,.04);">
              <div style="margin:8px auto 0;width:20px;height:3px;background:rgba(184,146,42,.4);border-radius:2px;"></div>
            </div>
            <div style="width:50px;height:90px;border:1px solid rgba(0,0,0,.08);border-radius:8px;background:rgba(0,0,0,.02);"></div>
          </div>',
        'webapp' => '
          <div class="cat-thumb">
            <div style="position:absolute;inset:20px;border:1px solid rgba(0,0,0,.07);border-radius:8px;overflow:hidden;">
              <div style="position:absolute;top:0;left:0;right:0;height:8px;background:rgba(184,146,42,.2);"></div>
              <div style="position:absolute;bottom:20px;left:10px;right:10px;height:40px;display:flex;gap:4px;">
                <div style="flex:1;background:rgba(184,146,42,.12);border-radius:3px;"></div>
                <div style="flex:1;background:rgba(184,146,42,.2);border-radius:3px;"></div>
                <div style="flex:1;background:rgba(184,146,42,.08);border-radius:3px;"></div>
                <div style="flex:1;background:rgba(184,146,42,.16);border-radius:3px;"></div>
              </div>
            </div>
          </div>',
        'ecommerce' => '
          <div class="cat-thumb">
            <div style="position:absolute;top:15%;left:5%;right:5%;bottom:15%;display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:1fr 1fr;gap:6px;">
              <div style="background:rgba(184,146,42,.12);border-radius:4px;border:1px solid rgba(184,146,42,.15);"></div>
              <div style="background:rgba(0,0,0,.04);border-radius:4px;"></div>
              <div style="background:rgba(184,146,42,.08);border-radius:4px;"></div>
              <div style="grid-column:span 2;background:rgba(0,0,0,.03);border-radius:4px;"></div>
              <div style="background:rgba(184,146,42,.18);border-radius:4px;"></div>
            </div>
          </div>',
        'marketing' => '
          <div class="cat-thumb" style="flex-direction:column;gap:8px;">
            <div style="position:absolute;bottom:25%;left:10%;right:10%;height:70px;display:flex;align-items:flex-end;gap:5px;">
              <div style="flex:1;height:30%;background:rgba(184,146,42,.1);border-radius:3px 3px 0 0;"></div>
              <div style="flex:1;height:50%;background:rgba(184,146,42,.18);border-radius:3px 3px 0 0;"></div>
              <div style="flex:1;height:40%;background:rgba(184,146,42,.12);border-radius:3px 3px 0 0;"></div>
              <div style="flex:1;height:70%;background:rgba(184,146,42,.25);border-radius:3px 3px 0 0;"></div>
              <div style="flex:1;height:90%;background:rgba(184,146,42,.35);border-radius:3px 3px 0 0;"></div>
              <div style="flex:1;height:100%;background:rgba(184,146,42,.45);border-radius:3px 3px 0 0;"></div>
            </div>
            <div style="position:absolute;top:20%;left:50%;transform:translateX(-50%);font-size:11px;font-weight:700;color:rgba(184,146,42,.6);letter-spacing:.1em;">↑ Growth</div>
          </div>',
    ];
    return $thumbs[$cat] ?? $thumbs['website'];
}
?>
