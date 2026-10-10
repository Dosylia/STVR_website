/* =============================================================================
   urSovngarde: behaviour
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

  /**
   * navigator.clipboard only exists in a secure context, so on a plain-http
   * deployment (or a .loc dev host) it is simply undefined and the button does
   * nothing at all. execCommand('copy') is deprecated and still works
   * everywhere, which is exactly what a fallback is for.
   */
  const copyText = async (text) => {
    if (navigator.clipboard?.writeText) {
      try {
        await navigator.clipboard.writeText(text);
        return true;
      } catch { /* fall through */ }
    }

    const scratch = document.createElement('textarea');
    scratch.value = text;
    scratch.setAttribute('readonly', '');
    scratch.style.cssText = 'position:fixed;top:0;left:-9999px;opacity:0';
    document.body.appendChild(scratch);
    scratch.select();

    let ok = false;
    try {
      ok = document.execCommand('copy');
    } catch { /* nothing left to try */ }

    scratch.remove();

    return ok;
  };

  $$('[data-copy]').forEach((button) => {
    button.addEventListener('click', async () => {
      const source = document.getElementById(button.dataset.copy);
      if (!source) return;

      const done = await copyText(source.textContent.trim());

      if (!done) {
        // Nothing worked: put the text under the caret so Ctrl+C still does it.
        const range = document.createRange();
        range.selectNodeContents(source);
        const selection = getSelection();
        selection.removeAllRanges();
        selection.addRange(range);

        return;
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
  /* -------------------------------------------------------- public server */

  // The public server page refreshes itself from /api/public-server.json, the site's own cached copy of the hub's
  // status (so the hub is asked at most once per cache period, however many people watch). Only while the tab is
  // visible. Markers are keyed by each connection's random id and glide to their new place; the roster and the count
  // are redrawn. When the server goes from online to offline or back, the page reloads, since its layout changes.

  const server = $('#publicServer');

  if (server && server.dataset.feed) {
    const feed = server.dataset.feed;
    const every = Math.max(5, parseInt(server.dataset.every, 10) || 10) * 1000;
    const wasOnline = server.dataset.online === '1';
    const t = JSON.parse(server.dataset.i18n || '{}');
    const svgNS = 'http://www.w3.org/2000/svg';
    // One layer of dots per drawing (Skyrim, Solstheim), by the map's slug.
    const layers = Object.fromEntries($$('.map__players').map((g) => [g.dataset.map, g]));
    const roster = $('[data-roster]');
    const time = new Intl.DateTimeFormat(server.dataset.locale || 'en', { dateStyle: 'long', timeStyle: 'short' });
    let timer = null;

    const show = (el, on) => { if (el) el.hidden = !on; };
    const place = (g, p) => { g.style.transform = `translate(${p.point[0]}px, ${p.point[1]}px)`; };

    const marker = (p, i, layer) => {
      const g = document.createElementNS(svgNS, 'g');
      g.setAttribute('class', 'map__player');
      g.dataset.id = p.id;
      const glow = document.createElementNS(svgNS, 'circle');
      glow.setAttribute('r', '16');
      glow.setAttribute('fill', `url(#${layer.dataset.glow})`);
      const arrow = document.createElementNS(svgNS, 'path');
      arrow.setAttribute('class', 'map__heading');
      arrow.setAttribute('d', 'M0 -12 L3.6 -6 L-3.6 -6 Z');
      const dot = document.createElementNS(svgNS, 'circle');
      dot.setAttribute('r', '4.5');
      dot.setAttribute('fill', '#3fd6a4');
      dot.setAttribute('stroke', '#07080a');
      dot.setAttribute('stroke-width', '1.5');
      const label = document.createElementNS(svgNS, 'text');
      label.setAttribute('y', String(-15 - (i % 2) * 11));
      label.setAttribute('text-anchor', 'middle');
      label.textContent = p.name;
      g.append(glow, arrow, dot, label);
      return g;
    };

    const drawMap = (players) => {
      const seen = new Set();
      const counts = {};
      players.forEach((p, i) => {
        const layer = p.point && layers[p.map];
        if (!layer) return;
        seen.add(p.id);
        counts[p.map] = (counts[p.map] || 0) + 1;
        let g = document.querySelector(`.map__player[data-id="${CSS.escape(p.id)}"]`);
        if (g && g.parentNode !== layer) {
          // Gone to another map (through a door to Solstheim): drawn afresh there rather than glided across.
          g.remove();
          g = null;
        }
        if (!g) {
          g = marker(p, i, layer);
          place(g, p);
          layer.append(g);
        } else {
          place(g, p);
          g.querySelector('text').textContent = p.name;
        }
        const arrow = g.querySelector('.map__heading');
        // An SVG element has no .hidden property; the attribute, with its CSS rule, does the job.
        if (p.heading === null) {
          arrow.setAttribute('hidden', '');
        } else {
          arrow.removeAttribute('hidden');
          arrow.style.transform = `rotate(${p.heading}deg)`;
        }
      });
      $$('.map__player').forEach((g) => { if (!seen.has(g.dataset.id)) g.remove(); });
      $$('[data-map-count]').forEach((n) => { n.textContent = String(counts[n.dataset.mapCount] || 0); });
    };

    const drawRoster = (players) => {
      if (!roster) return;
      roster.replaceChildren(...players.map((p) => {
        const li = document.createElement('li');
        li.className = 'roster__item';
        li.dataset.id = p.id;
        const rune = document.createElement('span');
        rune.className = 'roster__rune';
        rune.setAttribute('aria-hidden', 'true');
        rune.textContent = p.name.charAt(0).toUpperCase();
        const name = document.createElement('span');
        name.className = 'roster__name';
        name.textContent = p.name;
        const where = document.createElement('span');
        where.className = 'roster__where';
        const area = p.area && t.areas ? t.areas[p.area] : null;
        where.textContent = [p.where, area, p.point || p.area ? null : t.inside].filter(Boolean).join(' · ');
        li.append(rune, name, where);
        return li;
      }));
      show(roster, players.length > 0);
      show($('[data-note]'), players.length > 0);
      show($('[data-none]'), players.length === 0);
    };

    const refresh = async () => {
      try {
        const response = await fetch(feed, { headers: { Accept: 'application/json' } });
        if (!response.ok) return;
        const s = await response.json();
        if (s.online !== wasOnline) {
          location.reload();
          return;
        }
        if (!s.online) return;
        const count = $('[data-count]', server);
        if (count) count.textContent = String(s.count);
        const hidden = $('[data-hidden]');
        if (hidden) {
          hidden.textContent = (s.hidden === 1 ? t.hidden1 : t.hidden).replace(':count', String(s.hidden));
          show(hidden, s.hidden > 0);
        }
        const updated = $('[data-updated]', server);
        if (updated && s.updatedAt && t.updated) updated.textContent = t.updated.replace(':time', time.format(new Date(s.updatedAt)));
        drawRoster(s.players);
        drawMap(s.players);
      } catch {
        // A missed refresh is not worth a word: the next one comes in a few seconds.
      }
    };

    const start = () => { if (!timer) timer = setInterval(refresh, every); };
    const stop = () => { clearInterval(timer); timer = null; };

    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        stop();
      } else {
        refresh();
        start();
      }
    });
    if (!document.hidden) start();
  }

})();
