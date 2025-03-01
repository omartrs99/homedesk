import OW_Base from "./base/base";
import { fadeIn, fadeOut } from "./lib/utils";

class OW_WooPopup extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                wooPopup: "#woo-popup-wrap",
                wooPopupContinueShoppingBtn: "#woo-popup-wrap .continue-btn",
            },
            classes: {
                wooPopupOverlay: "woo-popup-overlay",
            },
            popupOverlayBGColor: "#000",
            popupOverlayOpacity: 0.7,
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            wooPopup: document.querySelector(selectors.wooPopup),
            wooPopupContinueShoppingBtn: document.querySelector(selectors.wooPopupContinueShoppingBtn),
        };
    }

    onInit() {
        super.onInit();

        this.setUserSettings();
    }

    bindEvents() {
        /**
         * Because Woocommerce plugin uses jQuery custom event,
         * We also have to use jQuery to customize this event.
         */
        jQuery("body").on("added_to_cart", this.openPopup.bind(this));

        this.elements.wooPopupContinueShoppingBtn?.addEventListener("click", this.closePopup.bind(this));
    }

    openPopup() {
        if( window.elementor ) {
            return;
        }

        const settings = this.getSettings();

        document.body.insertAdjacentElement("beforeend", this.elements.wooPopup);

        this.elements.wooPopup.insertAdjacentHTML("beforebegin", `<div class="${settings.classes.wooPopupOverlay}"></div>`);

        this.elements.wooPopupOverlay = document.querySelector(`.${settings.classes.wooPopupOverlay}`);

        this.elements.wooPopup.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: block;
            z-index: 9999;`;

        this.elements.wooPopupOverlay.style.cssText = `
            background-color: ${settings.popupOverlayBGColor};
            opacity: ${settings.popupOverlayOpacity};
            position: fixed;
            inset: 0px;
            z-index: 9998;
            cursor: pointer;
            display: none`;

        fadeIn(this.elements.wooPopupOverlay, {
            opacity: 0.7,
        });

        this.elements.wooPopupOverlay.addEventListener("click", this.closePopup.bind(this));
    }

    closePopup(event) {
        event.preventDefault();

        fadeOut(this.elements.wooPopupOverlay);

        this.elements.wooPopupOverlay.remove();
        delete this.elements.wooPopupOverlay;

        this.elements.wooPopup.style.display = "none";
    }

    setUserSettings() {
        const popupOverlayBGColor = this.elements.wooPopup.dataset.color;
        const popupOverlayOpacity = this.elements.wooPopup.dataset.opacity;

        if (!!popupOverlayBGColor) {
            this.setSettings({
                popupOverlayBGColor: popupOverlayBGColor,
            });
        }

        if (!!popupOverlayOpacity) {
            this.setSettings({
                popupOverlayOpacity: popupOverlayOpacity,
            });
        }
    }
}

("use script");
new OW_WooPopup();