import OW_Base from "./base/base";

class OW_Portfolio extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                portfolio: ".portfolio-wrap",
                portfolioMasonry: ".portfolio-entries.masonry-grid .portfolio-wrap",
                portfolioGrid: ".portfolio-entries.isotope-grid .portfolio-wrap",
                linkIcon: ".portfolio-wrap .op-link",
            },
            options: oceanwpLocalize,
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");
        return {
            portfolio: document.querySelectorAll(selectors.portfolio),
            portfolioMasonry: document.querySelectorAll(selectors.portfolioMasonry),
            portfolioGrid: document.querySelectorAll(selectors.portfolioGrid),
            linkIcon: document.querySelectorAll(selectors.linkIcon),
            body: document.body,
        };
    }

    onInit() {
        super.onInit();
        this.initMasonry();
        this.initGrid();
        if (this.elements.portfolio.length > 0) {
            this.initLightboxGallery();
        }
    }

    bindEvents() {
        this.elements.linkIcon?.forEach((link) => {
            link.addEventListener("click", (event) => {
                event.stopPropagation();
            });
        });
    }

    initMasonry() {
        const options = this.getSettings("options");
        this.elements.portfolioMasonry?.forEach((portfolio) => {
            imagesLoaded(portfolio, () => {
                new Isotope(portfolio, {
                    itemSelector: ".portfolio-entry",
                    transformsEnabled: true,
                    isOriginLeft: options.isRTL ? false : true,
                    transitionDuration: "0.4s",
                    layoutMode: "masonry",
                });
            });
        });
    }

    initGrid() {
        const options = this.getSettings("options");
        this.elements.portfolioGrid?.forEach((portfolio) => {
            imagesLoaded(portfolio, () => {
                const layoutMode = portfolio.dataset.layout ? portfolio.dataset.layout : "masonry";
                const portfolioFilter = portfolio.previousElementSibling;
                const portfolioGridIsotope = new Isotope(portfolio, {
                    itemSelector: ".portfolio-entry",
                    transformsEnabled: true,
                    isOriginLeft: options.isRTL ? false : true,
                    transitionDuration: "0.4s",
                    layoutMode: layoutMode,
                });

                if (!!portfolioFilter && portfolioFilter.classList.contains("portfolio-filters")) {
                    portfolioFilter.querySelectorAll("a").forEach((portfolioFilterLink) => {
                        portfolioFilterLink.addEventListener("click", (event) => {
                            event.preventDefault();
                            event.stopPropagation();

                            portfolioGridIsotope.arrange({
                                filter: portfolioFilterLink.dataset.filter
                            });

                            portfolioFilter.querySelectorAll("li").forEach((listTag) => {
                                listTag.classList.remove("active");
                            });

                            portfolioFilterLink.parentNode.classList.add("active");
                        });
                    });
                }
            });
        });
    }

    initLightboxGallery() {
        this.addPhotoSwipeToDOM();
        const pswpElement = document.querySelector(".pswp");
        const options = this.getSettings("options");

        const openLightbox = (event, portfolio, clickedLightbox) => {
            event.preventDefault();
            const filteredLightboxes = Array.from(portfolio.querySelectorAll(".portfolio-lightbox"))
                                            .filter(lightbox => lightbox.closest(".portfolio-entry").style.display !== 'none');
            const images = filteredLightboxes.map(lightbox => {
                const imageSize = lightbox.dataset.size.split("x");
                return {
                    src: lightbox.href,
                    w: parseInt(imageSize[0], 10),
                    h: parseInt(imageSize[1], 10)
                };
            });

            const clickedIndex = filteredLightboxes.indexOf(clickedLightbox);

            const lightboxGallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, images, {
                index: clickedIndex,
                bgOpacity: 0.7,
                showHideOpacity: true,
                shareButtons: [
                    {id: "facebook", label: options.shareFacebook, url: "https://www.facebook.com/sharer/sharer.php?u={{url}}"},
                    {id: "twitter", label: options.shareTwitter, url: "https://twitter.com/intent/tweet?text={{text}}&url={{url}}"},
                    {id: "pinterest", label: options.sharePinterest, url: "http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}"},
                    {id: "download", label: options.pswpDownload, url: "{{raw_image_url}}", download: true},
                ]
            });

            lightboxGallery.init();
        };

        this.elements.portfolio.forEach((portfolio) => {
            portfolio.querySelectorAll(".portfolio-lightbox").forEach((lightbox) => {
                lightbox.addEventListener("click", (event) => openLightbox(event, portfolio, lightbox));
            });
        });
    }

    addPhotoSwipeToDOM() {
        if (!document.querySelector(".pswp")) {
            this.elements.body.insertAdjacentHTML("beforeend", `

                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="pswp__bg"></div>

                    <div class="pswp__scroll-wrap">

                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>

                        <div class="pswp__ui pswp__ui--hidden">
                            <div class="pswp__top-bar">

                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                <button class="pswp__button pswp__button--share" title="Share"></button>
                                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div>
                            </div>
                            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }
    }

    getImageIndex(figure) {
        const figures = figure.parentNode.children;
        for (let index = 0; index < figures.length; index++) {
            if (figures[index] === figure) {
                return index;
            }
        }
        return 0;
    }
}

("use strict");
new OW_Portfolio();
