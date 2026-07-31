//alert('Hello World');
// Script pour le carousel de la galerie
/*(function() {
  // Configuration du carousel
  const carouselConfig = {
    slidesToShow: 3,
    slidesToScroll: 1, 
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: true,
    infinite: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  };

  // Initialisation du carousel avec Flickity
  document.addEventListener('DOMContentLoaded', function() {
    const galleries = document.querySelectorAll('.wp-block-gallery');
    
    galleries.forEach(gallery => {
      // Créer le container du carousel
      const carousel = document.createElement('div');
      carousel.className = 'gallery-carousel';
      
      // Déplacer les images de la galerie dans le carousel
      const images = gallery.querySelectorAll('img');
      images.forEach(img => {
        const slide = document.createElement('div');
        slide.className = 'carousel-cell';
        slide.appendChild(img.cloneNode(true));
        carousel.appendChild(slide);
      });

      // Remplacer la galerie par le carousel
      gallery.parentNode.replaceChild(carousel, gallery);

      // Initialiser Flickity
      new Flickity(carousel, carouselConfig);
    });
  });
})();

// Script pour ouvrir une image de la galerie dans une popup responsive avec navigation et animations
(function() {
  // Options d'animation pour la galerie
  const animationOptions = {
    fade: {
      in: { opacity: 1, transform: 'translateY(0)' },
      out: { opacity: 0, transform: 'translateY(20px)' }
    },
    slide: {
      in: { opacity: 1, transform: 'translateX(0)' },
      out: { opacity: 0, transform: 'translateX(50px)' }
    },
    zoom: {
      in: { opacity: 1, transform: 'scale(1)' },
      out: { opacity: 0, transform: 'scale(0.8)' }
    },
    rotate: {
      in: { opacity: 1, transform: 'rotate(0deg)' },
      out: { opacity: 0, transform: 'rotate(180deg)' }
    }
  };

  // Choisir l'animation souhaitée (fade, slide, zoom, rotate)
  const selectedAnimation = 'zoom'; // Changez ici pour tester différentes animations

  // Crée la popup et le fond si ce n'est pas déjà fait
  function createPopup() {
    if (document.getElementById('custom-img-popup')) return;
    var popupBg = document.createElement('div');
    popupBg.id = 'custom-img-popup-bg';
    popupBg.style.position = 'fixed';
    popupBg.style.top = 0;
    popupBg.style.left = 0;
    popupBg.style.width = '100%';
    popupBg.style.height = '100%';
    popupBg.style.display = 'flex';
    popupBg.style.alignItems = 'center';
    popupBg.style.justifyContent = 'center';
    popupBg.style.objectFit = 'contain';
    popupBg.style.overflow = 'hidden';
    popupBg.style.padding = '10vh 10vw';
    popupBg.style.zIndex = 9999;
    popupBg.style.cursor = 'zoom-out';
    popupBg.style.transition = 'opacity 0.2s';
    popupBg.style.opacity = 0;
    popupBg.style.pointerEvents = 'none';
    popupBg.style.boxSizing = 'border-box';
    popupBg.style.background = 'rgba(0,0,0,0.8)';

    var popup = document.createElement('div');
    popup.id = 'custom-img-popup';
    popup.style.maxWidth = '80vw';
    popup.style.maxHeight = '80vh';
    popup.style.display = 'flex';
    popup.style.alignItems = 'center';
    popup.style.justifyContent = 'center';
    popup.style.overflow = 'auto';
    popup.style.background = 'transparent';

    var img = document.createElement('img');
    img.id = 'custom-img-popup-img';
    img.style.maxWidth = '500px';
    img.style.maxHeight = '100%';
    img.style.borderRadius = '8px';
    img.style.boxShadow = '0 2px 16px rgba(0,0,0,0.5)';
    img.style.transition = 'all 0.3s ease';
    img.alt = '';

    popup.appendChild(img);
    popupBg.appendChild(popup);

    // Ajouter le bouton de fermeture
    var closeButton = document.createElement('button');
    closeButton.innerHTML = '×';
    closeButton.style.position = 'absolute';
    closeButton.style.top = '20px';
    closeButton.style.right = '20px';
    closeButton.style.background = 'rgba(255,255,255,0.5)';
    closeButton.style.border = 'none';
    closeButton.style.borderRadius = '50%';
    closeButton.style.width = '40px';
    closeButton.style.height = '40px';
    closeButton.style.cursor = 'pointer';
    closeButton.style.fontSize = '24px';
    closeButton.style.color = '#333';
    closeButton.style.transition = 'all 0.3s ease';
    closeButton.style.zIndex = '10000';
    closeButton.onmouseover = function() {
      this.style.background = 'rgba(255,255,255,0.8)';
      this.style.transform = 'scale(1.1)';
    };
    closeButton.onmouseout = function() {
      this.style.background = 'rgba(255,255,255,0.5)';
      this.style.transform = 'scale(1)';
    };
    closeButton.onclick = function(e) {
      e.stopPropagation();
      popupBg.style.opacity = 0;
      popupBg.style.pointerEvents = 'none';
      setTimeout(function() {
        img.src = '';
      }, 200);
    };
    popupBg.appendChild(closeButton);

    document.body.appendChild(popupBg);

    // Fermer la popup au clic sur le fond
    popupBg.addEventListener('click', function(e) {
      if (e.target === popupBg) {
        popupBg.style.opacity = 0;
        popupBg.style.pointerEvents = 'none';
        setTimeout(function() {
          img.src = '';
        }, 200);
      }
    });
  }

  function showPopup(src, alt, galleryImages, currentIndex) {
    var popupBg = document.getElementById('custom-img-popup-bg');
    var img = document.getElementById('custom-img-popup-img');
    if (!popupBg || !img) return;
    img.src = src;
    img.alt = alt || '';
    popupBg.style.opacity = 1;
    popupBg.style.pointerEvents = 'auto';

    // Appliquer l'animation d'entrée
    Object.assign(img.style, animationOptions[selectedAnimation].in);

    // Ajouter des boutons de navigation avec animations
    var prevButton = document.createElement('button');
    prevButton.innerHTML = '&lt;';
    prevButton.style.position = 'absolute';
    prevButton.style.left = '20px';
    prevButton.style.top = '50%';
    prevButton.style.transform = 'translateY(-50%)';
    prevButton.style.background = 'rgba(255,255,255,0.5)';
    prevButton.style.border = 'none';
    prevButton.style.borderRadius = '50%';
    prevButton.style.width = '40px';
    prevButton.style.height = '40px';
    prevButton.style.cursor = 'pointer';
    prevButton.style.fontSize = '20px';
    prevButton.style.color = '#333';
    prevButton.style.transition = 'all 0.3s ease';
    prevButton.onmouseover = function() {
      this.style.background = 'rgba(255,255,255,0.8)';
      this.style.transform = 'translateY(-50%) scale(1.1)';
    };
    prevButton.onmouseout = function() {
      this.style.background = 'rgba(255,255,255,0.5)';
      this.style.transform = 'translateY(-50%) scale(1)';
    };
    prevButton.onclick = function(e) {
      e.stopPropagation();
      var newIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
      
      // Précharger l'image précédente
      var preloadImg = new Image();
      preloadImg.src = galleryImages[newIndex].src;
      
      // Animation de sortie
      Object.assign(img.style, animationOptions[selectedAnimation].out);
      
      setTimeout(function() {
        showPopup(galleryImages[newIndex].src, galleryImages[newIndex].alt, galleryImages, newIndex);
      }, 300);
    };

    var nextButton = document.createElement('button');
    nextButton.innerHTML = '&gt;';
    nextButton.style.position = 'absolute';
    nextButton.style.right = '20px';
    nextButton.style.top = '50%';
    nextButton.style.transform = 'translateY(-50%)';
    nextButton.style.background = 'rgba(255,255,255,0.5)';
    nextButton.style.border = 'none';
    nextButton.style.borderRadius = '50%';
    nextButton.style.width = '40px';
    nextButton.style.height = '40px';
    nextButton.style.cursor = 'pointer';
    nextButton.style.fontSize = '20px';
    nextButton.style.color = '#333';
    nextButton.style.transition = 'all 0.3s ease';
    nextButton.onmouseover = function() {
      this.style.background = 'rgba(255,255,255,0.8)';
      this.style.transform = 'translateY(-50%) scale(1.1)';
    };
    nextButton.onmouseout = function() {
      this.style.background = 'rgba(255,255,255,0.5)';
      this.style.transform = 'translateY(-50%) scale(1)';
    };
    nextButton.onclick = function(e) {
      e.stopPropagation();
      var newIndex = (currentIndex + 1) % galleryImages.length;
      
      // Précharger l'image suivante
      var preloadImg = new Image();
      preloadImg.src = galleryImages[newIndex].src;
      
      // Animation de sortie
      Object.assign(img.style, animationOptions[selectedAnimation].out);
      
      setTimeout(function() {
        showPopup(galleryImages[newIndex].src, galleryImages[newIndex].alt, galleryImages, newIndex);
      }, 300);
    };

    popupBg.appendChild(prevButton);
    popupBg.appendChild(nextButton);
  }

  document.addEventListener('DOMContentLoaded', function() {
    createPopup();
    // Sélectionne les galeries avec les classes 'gal1' et 'gal2'
    var gal1 = document.querySelector('.gal1');
    var gal2 = document.querySelector('.gal2');
    if (gal1) {
      var gal1Images = gal1.querySelectorAll('img');
      gal1Images.forEach(function(img, index) {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(img.src, img.alt, gal1Images, index);
        });
      });
    }
    if (gal2) {
      var gal2Images = gal2.querySelectorAll('img');
      gal2Images.forEach(function(img, index) {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(img.src, img.alt, gal2Images, index);
        });
      });
    }
  });
})();
*/


/* Carousel galerie produit (pgf) */
document.addEventListener('DOMContentLoaded', function () {
	var carousel  = document.getElementById('pgf-carousel');
	var mainView  = document.getElementById('pgf-main-view');
	var dotsWrap  = document.getElementById('pgf-carousel-dots');
	if (!carousel || !mainView) return;

	var thumbs     = carousel.querySelectorAll('.pgf-thumb-slide');
	var mainSlides = mainView.querySelectorAll('.pgf-main-slide');
	if (thumbs.length < 2) return;

	var dots    = [];
	var current = 0;
	var timer;

	thumbs.forEach(function (thumb, i) {
		var dot = document.createElement('button');
		dot.className = 'pgf-carousel-dot';
		dot.setAttribute('aria-label', 'Image ' + (i + 1));
		dot.addEventListener('click', function () { stop(); goTo(i); start(); });
		dotsWrap.appendChild(dot);
		dots.push(dot);

		thumb.addEventListener('click', function () { stop(); goTo(i); start(); });
	});

	function goTo(index) {
		thumbs[current].classList.remove('is-active');
		mainSlides[current].classList.remove('is-active');
		dots[current].classList.remove('is-active');
		current = index;
		thumbs[current].classList.add('is-active');
		mainSlides[current].classList.add('is-active');
		dots[current].classList.add('is-active');
	}

	function advance() { goTo((current + 1) % thumbs.length); }
	function start()   { timer = setInterval(advance, 3000); }
	function stop()    { clearInterval(timer); }

	goTo(0);
	start();

	mainView.addEventListener('mouseenter', stop);
	mainView.addEventListener('mouseleave', start);
	carousel.addEventListener('mouseenter', stop);
	carousel.addEventListener('mouseleave', start);
});

/* Slider bloc sac offert (pgb) */
document.addEventListener('DOMContentLoaded', function () {
    var track = document.getElementById('pgb-track');
    if (!track) return;

    var slides = track.querySelectorAll('.pgb-slide');
    var thumbs = document.querySelectorAll('[data-pgb]');
    if (slides.length < 2) return;

    var current = 0;
    var pgbTimer;

    function pgbGoTo(i) {
        slides[current].classList.remove('pgb-slide--active');
        if (thumbs[current]) thumbs[current].classList.remove('pgb-thumb--active');
        current = i;
        slides[current].classList.add('pgb-slide--active');
        if (thumbs[current]) thumbs[current].classList.add('pgb-thumb--active');
    }

    function pgbNext()  { pgbGoTo((current + 1) % slides.length); }
    function pgbStart() { pgbTimer = setInterval(pgbNext, 3200); }
    function pgbStop()  { clearInterval(pgbTimer); }

    thumbs.forEach(function (th) {
        th.addEventListener('click', function () {
            pgbStop();
            pgbGoTo(parseInt(th.dataset.pgb, 10));
            pgbStart();
        });
    });

    track.addEventListener('mouseenter', pgbStop);
    track.addEventListener('mouseleave', pgbStart);

    pgbGoTo(0);
    pgbStart();

    /* Apparition au scroll */
    var pgbItems = document.querySelectorAll('.pgb-hero, .pgb-offer, .pgb-gallery');
    if (pgbItems.length && 'IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('pgb--visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.15 });
        pgbItems.forEach(function (el) { io.observe(el); });
    } else {
        pgbItems.forEach(function (el) { el.classList.add('pgb--visible'); });
    }
});

/* Carousel hero sac (pgb-hero) */
document.addEventListener('DOMContentLoaded', function () {
    var track  = document.getElementById('pgb-hero-track');
    if (!track) return;

    var slides = track.querySelectorAll('.pgb-hero__slide');
    var thumbs = document.querySelectorAll('[data-pgb-hero]');
    if (slides.length < 2) return;

    var current = 0;
    var timer;

    function goTo(i) {
        slides[current].classList.remove('pgb-hero__slide--active');
        if (thumbs[current]) thumbs[current].classList.remove('pgb-thumb--active');
        current = i;
        slides[current].classList.add('pgb-hero__slide--active');
        if (thumbs[current]) thumbs[current].classList.add('pgb-thumb--active');
    }

    thumbs.forEach(function (th) {
        th.addEventListener('click', function () {
            stop(); goTo(parseInt(th.dataset.pgbHero, 10)); start();
        });
    });

    function advance() { goTo((current + 1) % slides.length); }
    function start()   { timer = setInterval(advance, 3000); }
    function stop()    { clearInterval(timer); }

    start();
    track.closest('.pgb-hero__wrap').addEventListener('mouseenter', stop);
    track.closest('.pgb-hero__wrap').addEventListener('mouseleave', start);
});

/* Slider avant/après (bab) */
document.addEventListener('DOMContentLoaded', function () {
    var comparison = document.getElementById('bab-comparison');
    var sliderEl   = document.getElementById('bab-slider');
    var avantPanel = document.querySelector('.bab-panel--avant');
    var apresPanel = document.getElementById('bab-apres');
    if (!comparison || !sliderEl || !avantPanel || !apresPanel) return;

    var isDragging = false;

    function setPos(pct) {
        pct = Math.min(Math.max(pct, 0), 100);
        sliderEl.style.left = pct + '%';
        avantPanel.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
        apresPanel.style.clipPath = 'inset(0 0 0 ' + pct + '%)';
    }

    function getPct(clientX) {
        var rect = comparison.getBoundingClientRect();
        return ((clientX - rect.left) / rect.width) * 100;
    }

    sliderEl.addEventListener('mousedown',  function (e) { e.preventDefault(); isDragging = true; });
    document.addEventListener('mouseup',    function () { isDragging = false; });
    document.addEventListener('mousemove',  function (e) { if (isDragging) setPos(getPct(e.clientX)); });

    sliderEl.addEventListener('touchstart', function (e) { e.preventDefault(); isDragging = true; }, { passive: false });
    document.addEventListener('touchend',   function () { isDragging = false; });
    document.addEventListener('touchmove',  function (e) { if (isDragging) setPos(getPct(e.touches[0].clientX)); }, { passive: true });

    setPos(50);
});

/* Carousel clients [homedesk_carousel] */
document.addEventListener('DOMContentLoaded', function () {
    if (!document.querySelector('.hd-carousel-swiper')) return;
    new Swiper('.hd-carousel-swiper', {
        slidesPerView: 6,
        spaceBetween: 16,
        loop: true,
        autoplay: { delay: 3500, disableOnInteraction: false },
        pagination: { el: '.hd-carousel-pagination', clickable: true },
        navigation: { nextEl: '.hd-carousel-next', prevEl: '.hd-carousel-prev' },
        breakpoints: {
            0:   { slidesPerView: 2,   spaceBetween: 10 },
            600: { slidesPerView: 3,   spaceBetween: 12 },
            1024:{ slidesPerView: 6,   spaceBetween: 16 },
        }
    });
});

/* Scroll vers le formulaire OPC au clic sur .opc-submit-btn et .pcta-btn */
document.addEventListener('DOMContentLoaded', function () {
    var target = document.querySelector('.opc-form-container');
    if (!target) return;

    document.querySelectorAll('.hook-produit-stacked .opc-submit-btn, .product-cta-block__inner .pcta-btn, .hd-comp__cta-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var offset = 80;
            var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        });
    });
});

/*swiper js*/
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 1,
        grabCursor: true,
        loop: true,
        spaceBetween: 20, // Ajout d'un espace de 20px entre les slides
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10, // Espace plus petit sur mobile
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 15, // Espace moyen sur tablette
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 20, // Espace normal sur desktop
            }
        }
    });


});

/* ── Fix floating bar "Sélectionner les options" → scroll OPC ── */
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.owp-floating-bar .button.top, .owp-floating-bar button.top');
    if (!btn) return;

    e.preventDefault();
    e.stopImmediatePropagation(); // bloque le handler OceanWP (bubble phase)

    var form = document.querySelector('.opc-form-container');
    if (!form) return;

    var top = form.getBoundingClientRect().top + window.scrollY - 90;
    window.scrollTo({ top: top, behavior: 'smooth' });

    // Pulse sur le sélecteur de version après le scroll
    setTimeout(function () {
        var radios = form.querySelector('.opc-variation-radios');
        if (radios) {
            radios.classList.add('opc-variation--highlight');
            setTimeout(function () {
                radios.classList.remove('opc-variation--highlight');
            }, 1400);
        }
    }, 600);
}, true); // capture: true → s'exécute avant le handler OceanWP
