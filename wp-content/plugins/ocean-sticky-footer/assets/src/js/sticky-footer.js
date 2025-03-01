import OW_Base from "./base/base";

class OW_StickyFooter extends OW_Base {
    modal;

    getDefaultSettings() {
        return {
            selectors: {
                stickyFooterToggleBtn: "#footer-bar .osf-btn a",
                footer: ".site-footer",
                footerBox: "#footer .footer-box",
                main: "#main",
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            stickyFooterToggleBtn: document.querySelector(selectors.stickyFooterToggleBtn),
            footer: document.querySelector(selectors.footer),
            footerBoxes: document.querySelectorAll(selectors.footerBox),
            main: document.querySelector(selectors.main),
            body: document.body,
        };
    }

    onInit() {
        super.onInit();

        if (!!this.elements.stickyFooterToggleBtn && this.isDesktopBrowser()) {
            this.initPerfectScrollbar();
        }
    }

    bindEvents() {
        this.elements.stickyFooterToggleBtn?.addEventListener("click", this.toggleStickyFooter.bind(this));
        this.elements.main?.addEventListener("click", this.closeStickyFooter.bind(this));
    }

    toggleStickyFooter(event) {
        event.preventDefault();

        this.elements.footer.classList.toggle("opened");
        this.elements.body.classList.toggle("osf-opened");
    }

    closeStickyFooter(event) {
        this.elements.footer?.classList.remove("opened");
        this.elements.body?.classList.remove("osf-opened");
    }

    initPerfectScrollbar() {
        this.elements.footerBoxes.forEach((footerBox) => {
            new PerfectScrollbar(footerBox, {
                wheelSpeed: 0.5,
                suppressScrollX: false,
                suppressScrollY: false,
            });
        });
    }

    isDesktopBrowser() {
        return !navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/);
    }
}

("use script");
new OW_StickyFooter();
