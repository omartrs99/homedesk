import delegate from "delegate";
import OW_Base from "./base/base";
import { fadeIn, fadeOut, slideDown, slideUp } from "./lib/utils";

class OW_CookieNotice extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                cookieNotice: "#ocn-cookie-wrap",
                cookieNoticeOverlay: "#ocn-cookie-overlay",
                cookieNoticeCloseBtn: "#ocn-cookie-wrap .ocn-close",
            },
            options: oceanwpLocalize,
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            cookieNotice: document.querySelector(selectors.cookieNotice),
            cookieNoticeOverlay: document.querySelector(selectors.cookieNoticeOverlay),
            html: document.querySelector("html"),
        };
    }

    onInit() {
        super.onInit();

        const options = this.getSettings("options");
        const cookie = this.getCookie();

        if (typeof cookie === "undefined") {
            slideDown(this.elements.cookieNotice);

            if (options.overlay === "yes") {
                fadeIn(this.elements.cookieNoticeOverlay);
                this.elements.html.style.overflowY = "hidden";
            }
        }
    }

    bindEvents() {
        const selectors = this.getSettings("selectors");

        delegate(selectors.cookieNoticeCloseBtn, "click", this.closeCookieNotice.bind(this));
    }

    closeCookieNotice(event) {
        event.preventDefault();

        const now = new Date();
        const expireTime = new Date();
        const options = this.getSettings("options");

        // Set expire time in seconds.
        expireTime.setTime(parseInt(now.getTime()) + parseInt(options.cookieTime) * 1000);

        // Set cookie.
        document.cookie =
            `${options.cookieName}=true;expires=${expireTime.toUTCString()};` +
            `${!!options.cookieDomain ? `domain=${options.cookieDomain};` : ""}` +
            `${!!options.cookiePath ? `path=${options.cookiePath};` : ""}` +
            `${options.secure === "1" ? "secure;" : ""}`;

        // Trigger jQuery event.
        jQuery.event.trigger({
            type: "ocnSetCookieNotice",
            value: "true",
            time: now,
            expires: expireTime,
        });

        slideUp(this.elements.cookieNotice);

        if (options.overlay === "yes") {
            fadeOut(this.elements.cookieNoticeOverlay);
            this.elements.html.style.overflowY = "auto";
        }

        if (options.reload === "yes") {
            let url = `${window.location.protocol}//`;
            const hostName = `${window.location.host}/${window.location.pathname}`;

            if (options.cache === "1") {
                url =
                    `${url}${hostName.replace("//", "/")}` +
                    `${window.location.search === "" ? "?" : `${window.location.search}&`}` +
                    `cn-reloaded=1${window.location.hash}`;

                window.location.href = url;
            } else {
                url = `${url}${hostName.replace("//", "/")}${window.location.search}${window.location.hash}`;

                window.location.reload(true);
            }

            return;
        }
    }

    getCookie() {
        const value = `; ${document.cookie}`;
        const parts = value.split("; ocn_accepted=");

        if (parts.length === 2) {
            return parts.pop().split(";").shift();
        } else {
            return;
        }
    }
}

("use script");

document.addEventListener("DOMContentLoaded", (event) => {
    new OW_CookieNotice();
});
