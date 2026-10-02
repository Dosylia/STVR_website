/* =============================================================================
   Skyrim Together VR — behaviour
   -----------------------------------------------------------------------------
   Plain ES2020, one file, deferred. Nothing here is load-bearing: the site is
   six pages of server-rendered HTML and every one of them works with this file
   blocked. What follows is atmosphere (snow, parallax, reveals) and three small
   widgets (menu, language, install tabs) that degrade to visible content.
   ========================================================================== */

(() => {
  'use strict';

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const $  = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  /* ------------------------------------------------------------- masthead */

  const masthead = $('#masthead');

  if (masthead) {
    const sync = () => masthead.classList.toggle('is-stuck', window.scrollY > 24);
    sync();
    addEventListener('scroll', sync, { passive: true });
  }

  /* --------------------------------------------------------- mobile menu */

  const burger = $('#burger');
  const nav = $('#nav');

  if (burger && nav) {
    burger.addEventListener('click', () => {
      const open = burger.getAttribute('aria-expanded') === 'true';
      burger.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
    });

    // A tap on a link closes it; otherwise the panel stays over the page you
    // just navigated to, which on a phone looks like the link did nothing.
    nav.addEventListener('click', (e) => {
      if (e.target.closest('a')) {
        burger.setAttribute('aria-expanded', 'false');
        nav.classList.remove('is-open');
      }
    });
  }

  /* ----------------------------------------------------- language switch */

  const lang = $('#lang');
  const langToggle = $('#langToggle');

  if (lang && langToggle) {
    const close = () => {
      lang.classList.remove('is-open');
      langToggle.setAttribute('aria-expanded', 'false');
    };

    langToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = lang.classList.toggle('is-open');
      langToggle.setAttribute('aria-expanded', String(open));
    });

    document.addEventListener('click', (e) => {
      if (!lang.contains(e.target)) close();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') close();
    });
  }

  /* ----------------------------------------------------- reveal on scroll */

  const revealables = $$('.reveal');

  if (revealables.length) {
    if (reduced || !('IntersectionObserver' in window)) {
      revealables.forEach((el) => el.classList.add('is-in'));
    } else {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);
          }
        });
      }, { rootMargin: '0px 0px -12% 0px', threshold: 0.08 });

      revealables.forEach((el) => io.observe(el));
    }
  }

  /* -------------------------------------------------------------- parallax */

  const hero = $('.hero');

  if (hero && !reduced) {
    let ticking = false;

    const update = () => {
      // 0 at the top of the hero, 1 once it has scrolled fully past. Written as
      // one custom property so the CSS decides what moves and by how much.
      const progress = Math.min(1, Math.max(0, window.scrollY / hero.offsetHeight));
      hero.style.setProperty('--scroll', progress.toFixed(4));
      ticking = false;
    };

    addEventListener('scroll', () => {
      if (!ticking) {
        ticking = true;
        requestAnimationFrame(update);
      }
    }, { passive: true });

    update();
  }

  /* ----------------------------------------------------------------- snow */

  const canvas = $('#snow');

  if (canvas && !reduced) {
    const ctx = canvas.getContext('2d');
    let flakes = [];
    let running = true;
    let raf = 0;

    const build = () => {
      const dpr = Math.min(devicePixelRatio || 1, 2);
      const { width, height } = canvas.getBoundingClientRect();

      canvas.width = width * dpr;
      canvas.height = height * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      // Density by area, so a phone does not render a blizzard meant for a 4K
      // monitor and then drop to fifteen frames a second doing it.
      const count = Math.round((width * height) / 16000);

      flakes = Array.from({ length: count }, () => ({
        x: Math.random() * width,
        y: Math.random() * height,
        r: Math.random() * 1.6 + 0.4,
        d: Math.random() * 0.5 + 0.18,
        s: Math.random() * 0.35 + 0.08,
        o: Math.random() * 0.45 + 0.12,
      }));
    };

    const frame = () => {
      if (!running) return;

      const { width, height } = canvas.getBoundingClientRect();
      ctx.clearRect(0, 0, width, height);

      for (const f of flakes) {
        f.y += f.d;
        f.x += Math.sin(f.y / 48) * f.s;

        if (f.y > height + 4) {
          f.y = -4;
          f.x = Math.random() * width;
        }

        ctx.beginPath();
        ctx.arc(f.x, f.y, f.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(225, 238, 245, ${f.o})`;
        ctx.fill();
      }

      raf = requestAnimationFrame(frame);
    };

    build();
    frame();

    addEventListener('resize', build);

    // Stop once the hero has scrolled away: there is no sense paying for an
    // animation nobody can see, and a laptop fan is a user-facing feature.
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(([entry]) => {
        running = entry.isIntersecting;

        if (running) {
          frame();
        } else {
          cancelAnimationFrame(raf);
        }
      }, { threshold: 0 }).observe(canvas);
    }
  }

  /* ------------------------------------------------------- loading screen */

  const tipLine = $('#tipLine');
  const tipData = $('#tipData');

  if (tipLine && tipData) {
    let tips = [];

    try {
      tips = JSON.parse(tipData.textContent) || [];
    } catch { /* a malformed tip list is not worth a broken page */ }

    if (tips.length > 1) {
      let i = 0;

      setInterval(() => {
        tipLine.classList.add('is-fading');

        setTimeout(() => {
          i = (i + 1) % tips.length;
          tipLine.textContent = tips[i];
          tipLine.classList.remove('is-fading');
        }, 500);
      }, 7000);
    }
  }

  /* ----------------------------------------------------------------- tabs */

  $$('[data-tabs]').forEach((group) => {
    const tabs = $$('[role="tab"]', group);
    const panels = $$('[role="tabpanel"]', group);

    const select = (id) => {
      tabs.forEach((t) => t.setAttribute('aria-selected', String(t.dataset.tab === id)));
      panels.forEach((p) => { p.hidden = p.dataset.panel !== id; });
    };

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => select(tab.dataset.tab));

      // Arrow keys move between tabs, which is what the ARIA pattern promises
      // and what anyone navigating by keyboard will try.
      tab.addEventListener('keydown', (e) => {
        const step = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
        if (!step) return;

        e.preventDefault();
        const next = tabs[(tabs.indexOf(tab) + step + tabs.length) % tabs.length];
        next.focus();
        select(next.dataset.tab);
      });
    });
  });

  /* ------------------------------------------------------------- copy line */

  $$('[data-copy]').forEach((button) => {
    button.addEventListener('click', async () => {
      const source = document.getElementById(button.dataset.copy);
      if (!source) return;

      try {
        await navigator.clipboard.writeText(source.textContent.trim());
      } catch {
        return; // no clipboard permission: the text is on screen to select
      }

      const original = button.textContent;
      button.textContent = button.dataset.copied || 'Copied';
      button.classList.add('is-done');

      setTimeout(() => {
        button.textContent = original;
        button.classList.remove('is-done');
      }, 1800);
    });
  });
})();
