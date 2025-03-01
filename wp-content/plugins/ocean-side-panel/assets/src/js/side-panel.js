import OW_Base from "./base/base";

class OW_SidePanel extends OW_Base {
    perfectScrollbar;

    getDefaultSettings() {
        return {
            selectors: {
                sidePanel: "#side-panel-inner",
                sidePanelOpenButtons: "a.side-panel-btn, .side-panel-btn a",
                sidePanelCloseElements: "#side-panel-inner a.close-panel, .osp-overlay",
                sidePanelHamburgerIcon: ".side-panel-btn > .side-panel-icon.hamburger",
                mobileMenu: "#ocean-mobile-menu-icon a.mobile-menu",
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            sidePanel: document.querySelector(selectors.sidePanel),
            sidePanelOpenButtons: document.querySelectorAll(selectors.sidePanelOpenButtons),
            sidePanelCloseElements: document.querySelectorAll(selectors.sidePanelCloseElements),
            sidePanelHamburgerIcon: document.querySelector(selectors.sidePanelHamburgerIcon),
            mobileMenu: document.querySelector(selectors.mobileMenu),
            body: document.body,
        };
    }

    onInit() {
        super.onInit();

        if (this.isDesktopBrowser()) {
            this.initPerfectScrollbar();
        }
    }

    bindEvents() {
        this.elements.sidePanelOpenButtons.forEach((openBtn) => {
            openBtn.addEventListener("click", this.openSidePanel.bind(this));
        });

        this.elements.sidePanelCloseElements.forEach((closeBtn) => {
            closeBtn.addEventListener("click", this.closeSidePanel.bind(this));
        });
    }

    initPerfectScrollbar() {
        if ( ! this.elements.sidePanel ) {
            return;
        }
        this.perfectScrollbar = new PerfectScrollbar(this.elements.sidePanel, {
            wheelSpeed: 0.5,
            suppressScrollX: false,
            suppressScrollY: false,
        });
    }

    openSidePanel(event) {
        event.preventDefault();

        const isOpenSidePanel = Array.from(this.elements.sidePanelOpenButtons).some(({ classList }) =>
            classList.contains("opened")
        );

        if (isOpenSidePanel) {
            this.closeSidePanel(event);
            return;
        }

        const openBtn = event.currentTarget;

        openBtn.classList.add("opened");
        this.elements.body.classList.add("osp-opened");
        this.elements.sidePanelHamburgerIcon?.classList.add("is-active");
        this.elements.sidePanel.style.visibility = "visible";
    }

    closeSidePanel(event) {
        event.preventDefault();

        this.elements.sidePanelOpenButtons.forEach((closeBtn) => {
            closeBtn.classList.remove("opened");
        });
        this.elements.body.classList.remove("osp-opened");
        this.elements.sidePanelHamburgerIcon?.classList.remove("is-active");
        this.elements.sidePanel.style.visibility = "hidden";
    }

    isDesktopBrowser() {
        return !navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/);
    }
}

new OW_SidePanel();
