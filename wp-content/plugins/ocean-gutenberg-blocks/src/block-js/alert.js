import OW_Base from './base';
import { fadeOut } from "./lib/utils";

class OGB_Alert extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                alert: ".ogb-alert",
                alertCloseBtn: ".ogb-alert-close-btn",
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            alert: document.querySelector(selectors.alert),
            alertCloseBtn: document.querySelector(selectors.alertCloseBtn),
        };
    }

    bindEvents() {
        this.elements.alertCloseBtn?.addEventListener("click", this.onCloseBtnClick.bind(this));
    }

    onCloseBtnClick(event) {
        fadeOut(this.elements.alert);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new OGB_Alert();
});
