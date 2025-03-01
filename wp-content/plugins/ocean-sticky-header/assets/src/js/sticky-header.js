// sticky-header.js
import "./Utils/DOMMethods";
import Utility from "./Utils/Utility";
import Topbar from "./Components/Topbar";
import Header from "./Components/Header";
import Logo from "./Components/Logo";
import DOM from "./Utils/DOM";
import Helpers from "./Utils/Helpers";

class OW_StickyHeader {
    #scrollBarlatestTopPosition;

    constructor() {
        this.topbar = new Topbar();
        this.header = new Header();
        this.logo = new Logo();
    }

    start = () => {
        this.#scrollBarlatestTopPosition = Utility.scrollBarTopPosition();

        this.#setupEventListeners();
        this.#adjustForAnchor();
        this.#setupAnchorClickEvents();
        this.#setupScrollSpy();
    };

    #setupEventListeners = () => {
        window.addEventListener("load", this.#onWindowLoad);
        window.addEventListener("hashchange", this.#onClickLoad);
        window.addEventListener("scroll", this.#onWindowScroll);
        window.addEventListener("resize", this.#onWindowResize);
        window.addEventListener("orientationchange", this.#onWindowResize);
    };

    #getAnchorFromHref = (href) => {
      if (!href || href === "#" || href.startsWith('https://#')) {
          return ''; // Handle empty, hash-only, and invalid href
      }

      try {
          const url = new URL(href, window.location.origin);
          return url.hash.replace('#', '');
      } catch (error) {
          return ''; // Return an empty string or handle it appropriately
      }
  };




  #adjustForAnchor = (id = null) => {
    let anchorId = id;

    // If the 'id' is not passed to the function, then retrieve it from the window.location.hash
    if (!anchorId && window.location.hash) {
        anchorId = window.location.hash.replace("#", "");
    }

    if (anchorId) {
        const element = document.getElementById(anchorId);
        if (element) {
            setTimeout(() => {
                let adjustment = this.header.getHeaderHeight();

                // If WP Admin bar is visible, adjust for its height as well
                if (Utility.isWPAdminbarVisible() && DOM.WPAdminbar) {
                    adjustment += DOM.WPAdminbar.offsetHeight;
                }

                // Adjust the scroll position to take into account the header height and any other adjustments
                const scrollPosition = element.getBoundingClientRect().top + window.pageYOffset - adjustment;
                window.scrollTo({ top: scrollPosition, behavior: "smooth" });
            }, 20); // Delay is to ensure all rendering is done.
        }
    }
};



  #setupAnchorClickEvents = () => {
    const anchorLinks = document.querySelectorAll('a[href*="#"]:not([href="#"])');
    anchorLinks.forEach(link => {
        // Exclude specified classes
        if (
            !link.classList.contains("oew-off-canvas-button") &&
            !link.parentNode.classList.contains("oew-off-canvas-button") &&
            !link.classList.contains("oec-off-canvas-button") &&
            !link.parentNode.classList.contains("oec-off-canvas-button") &&
            !link.closest('.woocommerce-tabs') &&
            !link.closest('.oew-toc')
        ) {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href && href !== "#" && !href.startsWith('https://#')) {
                    try {
                        const id = this.#getAnchorFromHref(href);
                        const isModalLink = link.classList.contains('omw-open-modal') || link.closest('.omw-open-modal');
                        if (isModalLink) {
                            e.preventDefault(); // Prevent default for modal links
                        } else if (window.location.pathname === new URL(link.href).pathname) {
                            this.#adjustForAnchor(id); // Use the modified adjustForAnchor function
                        }
                    } catch (error) {
                    }
                }
            });
        }
    });
};




    #handleInitialPageLoadHighlight = () => {
      // Collect all menu items into an array
        const menuItems = [...document.querySelectorAll('li > a[href*="#"]:not([href="#"])')].map(link => link.parentNode);
        const currentHash = this.#getAnchorFromHref(window.location.href);

      // First, remove highlight from all menu items.
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('current-menu-item');
        });

      // If there's a hash, highlight the corresponding menu item.
        if (currentHash) {
            menuItems.forEach(menuItem => {
                const anchor = this.#getAnchorFromHref(menuItem.querySelector('a').getAttribute('href'));
                if (anchor === currentHash) {
                    menuItem.classList.add('current-menu-item');
                }
            });
        }
    };

    #setupScrollSpy = () => {
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            let currentSection = null;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - this.header.getHeaderHeight();
                if (window.scrollY >= sectionTop) {
                    currentSection = section.getAttribute('id');
                }
            });

            document.querySelectorAll('li > a[href*="#"]:not([href="#"])').forEach(link => {
                const anchor = this.#getAnchorFromHref(link.getAttribute('href'));
                const listItem = link.parentElement;
                listItem.classList.remove('current-menu-item');
                if (anchor === currentSection) {
                    listItem.classList.add('current-menu-item');
                }
            });
        });
    };

    #onClickScrollOffset = (event) => {
      event.preventDefault();
      event.stopPropagation();

      const scrollItem = event.currentTarget;
      if (!scrollItem) {
          return; // Ensure scrollItem is defined
      }

      // Ensure scrollItem and its parent nodes are defined before checking their properties
      if (
          (scrollItem.classList && scrollItem.classList.contains("omw-open-modal")) ||
          (scrollItem.closest && scrollItem.closest(".omw-open-modal")) ||
          (scrollItem.classList && scrollItem.classList.contains("oew-modal-button")) ||
          (scrollItem.closest && scrollItem.closest(".oew-modal-button")) ||
          (scrollItem.classList && scrollItem.classList.contains("opl-link")) ||
          (scrollItem.parentNode && scrollItem.parentNode.classList && scrollItem.parentNode.classList.contains("opl-link")) ||
          (scrollItem.classList && scrollItem.classList.contains("oew-off-canvas-button")) ||
          (scrollItem.parentNode && scrollItem.parentNode.classList && scrollItem.parentNode.classList.contains("oew-off-canvas-button")) ||
          (scrollItem.classList && scrollItem.classList.contains("oec-off-canvas-button")) ||
          (scrollItem.parentNode && scrollItem.parentNode.classList && scrollItem.parentNode.classList.contains("oec-off-canvas-button")) ||
          (scrollItem.closest && scrollItem.closest('.woocommerce-tabs'))  // Exclude TOC body links

      ) {
          return; // Do nothing for excluded classes
      }

        if (Helpers.upStickyEffect()) {
            return;
        }
        const stickyOffset = DOM.headerWrapper.offsetHeight;

        let target = document.querySelector(':target');

        if (target) {
            target.style["scroll-margin-top"] = stickyOffset + 'px';

            target.scrollIntoView({
                top: stickyOffset,
                behavior: 'smooth'
            })
        }

        document
            .querySelectorAll('a.local[href*="#"]:not([href="#"]), .local a[href*="#"]:not([href="#"]), a.menu-link[href*="#"]:not([href="#"]), a.sidr-class-menu-link[href*="#"]:not([href="#"]), #mobile-dropdown a[href*="#"]:not([href="#"])')
            .forEach(navLink => {
                if (
                    !navLink.classList.contains("omw-open-modal") &&
                    !navLink.closest(".omw-open-modal") &&
                    !navLink.classList.contains("oew-modal-button") &&
                    !navLink.closest(".oew-modal-button") &&
                    !navLink.classList.contains("opl-link") &&
                    !navLink.parentNode.classList.contains("opl-link") &&
                    !navLink.classList.contains("oew-off-canvas-button") &&
                    !navLink.parentNode.classList.contains("oew-off-canvas-button") &&
                    !navLink.classList.contains("oec-off-canvas-button") &&
                    !navLink.parentNode.classList.contains("oec-off-canvas-button") &&
                    !navLink.closest('.woocommerce-tabs') // Exclude WooCommerce tabs
                ) {
                    return;
                }
                navLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    const href = navLink.getAttribute("href");
                    let anchorId = '';
                    if (href) {
                        anchorId = document.querySelector(href);
                    }
                    if (anchorId) {
                        anchorId.style["scroll-margin-top"] = stickyOffset + 'px';
                        anchorId.scrollIntoView({
                            top: stickyOffset,
                            behavior: 'smooth'
                        })
                    }
                });
            });
    };

    #onWindowLoad = (e) => {
        this.topbar.createStickyWrapper();
        this.header.createStickyWrapper();
        this.header.addVerticalHeaderSticky();
        this.logo.setMaxHeight();
        this.#onClickScrollOffset(e);
        this.#handleInitialPageLoadHighlight();

      // Adjust for anchor if there is a hash in the URL
        if (window.location.hash) {
            const id = window.location.hash.replace("#", "");
            this.#adjustForAnchor(id);
        }
    };

    #onClickLoad = (e) => {
        this.#onClickScrollOffset(e);
    };

    #onWindowScroll = () => {
        if (Utility.scrollBarTopPosition() != this.#scrollBarlatestTopPosition) {
            this.topbar.sticky();
            this.header.sticky();
            this.header.stickyEffects();
            this.header.addVerticalHeaderSticky();

            this.#scrollBarlatestTopPosition = Utility.scrollBarTopPosition();

        }
    };

    #onWindowResize = () => {
        this.topbar.updateSticky();
        this.header.updateSticky();
    };


}

("use strict");

const stickyHeader = new OW_StickyHeader();
stickyHeader.start();
