/* HomeDesk — Landing pages Meta : interactions communes (vanilla JS, sans dépendance) */
(function () {
  'use strict';
  document.documentElement.classList.add('js');

  // Prix officiels du site (source : homedesk.tn) — en DT
  var PRICES = {
    medium: { oui: 199, non: 169, old: 219 },
    large:  { oui: 209, non: 179, old: 229 }
  };
  var LABELS = { medium: 'Medium', large: 'Large' };

  var form = document.getElementById('commander-form');
  var qty = 1;

  function get(name) {
    var el = form && form.querySelector('input[name="' + name + '"]:checked');
    return el ? el.value : null;
  }
  function setRadio(name, value) {
    if (!form || !value) return;
    var el = form.querySelector('input[name="' + name + '"][value="' + value + '"]');
    if (el) el.checked = true;
  }
  function fmt(n) { return n + ' DT'; }

  function update() {
    if (!form) return;
    var taille = get('taille') || 'medium';
    var sac = get('sac') || 'oui';
    var unit = PRICES[taille][sac];
    var total = unit * qty;
    var label = 'HomeDesk ' + LABELS[taille] + (sac === 'oui' ? ' + sac offert' : ' Essentiel (sans sac)');

    document.querySelectorAll('[data-total]').forEach(function (el) { el.textContent = fmt(total); });
    document.querySelectorAll('[data-total-old]').forEach(function (el) {
      el.textContent = sac === 'oui' ? fmt(PRICES[taille].old * qty) : '';
    });
    document.querySelectorAll('[data-version-label]').forEach(function (el) { el.textContent = label; });
    var out = form.querySelector('[data-qty-out]');
    if (out) out.textContent = qty;

    // Synchronise les cartes « Choisir sa version »
    document.querySelectorAll('[data-pick-taille]').forEach(function (card) {
      if (!card.classList.contains('version')) return;
      var match = card.getAttribute('data-pick-taille') === taille &&
        (!card.hasAttribute('data-pick-sac') || card.getAttribute('data-pick-sac') === sac);
      card.classList.toggle('is-selected', match);
      card.setAttribute('aria-pressed', match ? 'true' : 'false');
    });
  }

  if (form) {
    form.addEventListener('change', update);
    form.querySelectorAll('[data-qty]').forEach(function (b) {
      b.addEventListener('click', function () {
        qty = Math.min(5, Math.max(1, qty + parseInt(b.getAttribute('data-qty'), 10)));
        update();
      });
    });

    // InitiateCheckout : premier focus dans le formulaire (brancher fbq sur le site réel)
    var started = false;
    form.addEventListener('focusin', function () {
      if (started) return;
      started = true;
      if (window.fbq) window.fbq('track', 'InitiateCheckout');
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var ok = true;
      form.querySelectorAll('[required]').forEach(function (input) {
        var v = input.value.trim();
        var valid = v.length > 1;
        if (input.type === 'tel') valid = /^[2-9]\d{7}$/.test(v.replace(/\D/g, '').replace(/^216(?=\d{8}$)/, ''));
        input.classList.toggle('is-invalid', !valid);
        if (!valid && ok) { input.focus(); ok = false; }
      });
      if (!ok) return;
      // Maquette : la vraie soumission passe par le plugin one-page-cod (AJAX opc_submit_order)
      form.classList.add('is-sent');
      form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
    form.querySelectorAll('[required]').forEach(function (input) {
      input.addEventListener('input', function () { input.classList.remove('is-invalid'); });
    });
  }

  // Boutons / cartes qui présélectionnent une version puis descendent au formulaire
  document.querySelectorAll('[data-pick-taille]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      setRadio('taille', el.getAttribute('data-pick-taille'));
      setRadio('sac', el.getAttribute('data-pick-sac'));
      update();
      if (el.classList.contains('version')) return; // les cartes restent sur place
      e.preventDefault();
      var target = document.getElementById('commander');
      if (target) target.scrollIntoView({ behavior: 'smooth' });
    });
    if (el.classList.contains('version')) {
      el.setAttribute('role', 'button');
      el.setAttribute('tabindex', '0');
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); el.click(); }
      });
    }
  });

  // Slider avant / après
  document.querySelectorAll('.ba').forEach(function (ba) {
    var range = ba.querySelector('input[type=range]');
    if (!range) return;
    var set = function () { ba.style.setProperty('--pos', range.value + '%'); };
    range.addEventListener('input', set);
    set();
  });

  // CTA collant mobile : visible après le hero, masqué quand le formulaire est à l'écran
  var sticky = document.getElementById('sticky-cta');
  var hero = document.querySelector('.hero');
  var order = document.getElementById('commander');
  if (sticky && hero && 'IntersectionObserver' in window) {
    var heroOut = false, orderIn = false;
    var refresh = function () { sticky.classList.toggle('is-visible', heroOut && !orderIn); };
    new IntersectionObserver(function (en) { heroOut = !en[0].isIntersecting; refresh(); }).observe(hero);
    if (order) new IntersectionObserver(function (en) { orderIn = en[0].isIntersecting; refresh(); }, { threshold: 0.15 }).observe(order);
  }

  // Apparition au scroll (le contenu reste visible sans JS)
  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); } });
    }, { rootMargin: '0px 0px -8% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  }

  update();
})();
