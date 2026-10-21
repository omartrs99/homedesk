/* HomeDesk — page « Notre histoire » : fond qui suit le chapitre, barre de lecture,
 * apparitions au défilement, léger zoom de l'image d'ouverture. Vanilla JS, sans dépendance.
 */
(function () {
  'use strict';
  var story = document.querySelector('.hd-story');
  if (!story) return;
  document.documentElement.classList.add('hd-js');

  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var hasIO = 'IntersectionObserver' in window;

  // Apparitions au défilement
  var reveals = story.querySelectorAll('.reveal');
  if (hasIO && !reduce) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
      });
    }, { rootMargin: '0px 0px -12% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  }

  // Couleur de fond : celle du chapitre qui occupe le milieu de l'écran
  var sections = story.querySelectorAll(':scope > [data-tone]');
  if (hasIO) {
    var toneIO = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) story.setAttribute('data-tone', en.target.getAttribute('data-tone'));
      });
    }, { rootMargin: '-50% 0px -50% 0px' });
    sections.forEach(function (s) { toneIO.observe(s); });
  }

  // Barre de lecture + zoom de l'image d'ouverture
  var bar = story.querySelector('.hd-story__progress');
  var hero = story.querySelector('.hd-story__hero');
  var heroImg = story.querySelector('.hd-story__hero-img');
  var ticking = false;
  function update() {
    ticking = false;
    var rect = story.getBoundingClientRect();
    var total = story.offsetHeight - window.innerHeight;
    var read = total > 0 ? Math.min(1, Math.max(0, -rect.top / total)) : 0;
    if (bar) bar.style.setProperty('--read', read.toFixed(4));
    if (heroImg && hero && !reduce) {
      var h = hero.offsetHeight || 1;
      var p = Math.min(1, Math.max(0, -hero.getBoundingClientRect().top / h));
      heroImg.style.setProperty('--zoom', (1.08 - p * 0.08).toFixed(4));
    }
  }
  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; requestAnimationFrame(update); }
  }, { passive: true });
  window.addEventListener('resize', update);
  update();
})();
