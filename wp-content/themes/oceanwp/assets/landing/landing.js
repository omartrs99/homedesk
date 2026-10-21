/* HomeDesk — Landing produit : interactions (vanilla JS).
 * Le formulaire est celui du plugin one-page-cod (#opc-order-form) : ce script ne fait
 * que le piloter (taille, option « sans sac ») depuis les cartes de version.
 */
(function () {
  'use strict';
  document.documentElement.classList.add('js');

  // ---------------------------------------------------------------------------
  // Attribution : UTM de l'URL d'arrivée, conservés pendant la session
  // ---------------------------------------------------------------------------
  var UTM_KEYS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
  var utm = {};
  try {
    var params = new URLSearchParams(location.search);
    UTM_KEYS.forEach(function (k) { if (params.get(k)) utm[k] = params.get(k).slice(0, 150); });
    if (Object.keys(utm).length) {
      sessionStorage.setItem('hd_utm', JSON.stringify(utm));
    } else {
      utm = JSON.parse(sessionStorage.getItem('hd_utm') || '{}') || {};
    }
  } catch (e) { utm = {}; }

  // Champs cachés envoyés avec la commande : UTM + slug de la landing ; profil présélectionné
  function fillAttribution() {
    var form = document.getElementById('opc-order-form');
    var page = document.querySelector('[data-lp-slug]');
    if (!form) return;
    var hidden = function (name, value) {
      var field = form.querySelector('input[name="' + name + '"]');
      if (!field) {
        field = document.createElement('input');
        field.type = 'hidden';
        field.name = name;
        form.appendChild(field);
      }
      field.setAttribute('value', value); // valeur par défaut : survit au reset() du formulaire
      field.value = value;
    };
    hidden('opc_utm', JSON.stringify(utm));
    if (page) hidden('opc_landing', page.getAttribute('data-lp-slug'));

    var profil = page && page.getAttribute('data-lp-profil');
    var select = form.querySelector('#opc_profil');
    if (profil && select && !select.value) select.value = profil;
  }

  // ---------------------------------------------------------------------------
  // Pont cartes de version → formulaire OPC
  // ---------------------------------------------------------------------------
  function opcForm() { return document.getElementById('opc-order-form'); }

  function setTaille(taille) {
    var form = opcForm();
    if (!form || !taille) return;
    var radio = form.querySelector('.opc-variation-radio[value="' + taille + '"]');
    if (radio && !radio.checked) {
      radio.checked = true;
      radio.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  function setSac(sac) {
    var form = opcForm();
    if (!form || !sac) return;
    var radio = form.querySelector('.opc-bag-radio[value="' + (sac === 'non' ? '1' : '0') + '"]');
    if (radio && !radio.checked) {
      radio.checked = true;
      radio.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  function syncCards() {
    var form = opcForm();
    if (!form) return;
    var checked = form.querySelector('.opc-variation-radio:checked');
    var taille = checked ? checked.value : 'medium';
    var bag = form.querySelector('.opc-bag-radio:checked');
    var sac = bag && bag.value === '1' ? 'non' : 'oui';
    document.querySelectorAll('.version[data-pick-taille]').forEach(function (card) {
      var match = card.getAttribute('data-pick-taille') === taille &&
        (!card.hasAttribute('data-pick-sac') || card.getAttribute('data-pick-sac') === sac);
      card.classList.toggle('is-selected', match);
      card.setAttribute('aria-pressed', match ? 'true' : 'false');
    });
  }

  document.querySelectorAll('[data-pick-taille]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      setTaille(el.getAttribute('data-pick-taille'));
      setSac(el.getAttribute('data-pick-sac'));
      syncCards();
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

  document.addEventListener('change', function (e) {
    if (e.target.closest && e.target.closest('#opc-order-form')) syncCards();
  });

  // ---------------------------------------------------------------------------
  // Galerie du hero : vignettes cliquables
  // ---------------------------------------------------------------------------
  document.querySelectorAll('[data-gallery]').forEach(function (g) {
    var main = g.querySelector('[data-gallery-main]');
    var btns = g.querySelectorAll('[data-src]');
    btns.forEach(function (b) {
      b.addEventListener('click', function () {
        main.src = b.getAttribute('data-src');
        main.alt = b.getAttribute('data-alt');
        btns.forEach(function (x) { x.setAttribute('aria-current', x === b ? 'true' : 'false'); });
      });
    });
  });

  // Lien « conditions de remboursement » : ouvre la question de la FAQ
  document.querySelectorAll('[data-open-faq]').forEach(function (a) {
    a.addEventListener('click', function () {
      var d = document.querySelector(a.getAttribute('href'));
      if (d) d.open = true;
    });
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

  // Vidéo démo : lecture automatique (muette) seulement quand elle est à l'écran, pour ne pas la
  // télécharger avant ; pause quand elle sort de l'écran. Les contrôles permettent d'activer le son.
  // Mouvement réduit demandé : pas d'autoplay, le visiteur lance la vidéo lui-même.
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reduceMotion && 'IntersectionObserver' in window) {
    document.querySelectorAll('video[data-autoplay]').forEach(function (v) {
      new IntersectionObserver(function (en) {
        if (en[0].isIntersecting) {
          var p = v.play();
          if (p && p.catch) p.catch(function () {}); // lecture bloquée par le navigateur : bouton lecture
        } else {
          v.pause();
        }
      }, { threshold: 0.35 }).observe(v);
    });
  }

  fillAttribution();
  syncCards();
})();
