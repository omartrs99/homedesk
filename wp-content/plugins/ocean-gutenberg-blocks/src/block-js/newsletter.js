import { fadeIn, fadeOut } from "./lib/utils";
import OW_Base from "./base";

class OGB_Newsletter extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                subscribeForm: "#mc-embedded-subscribe-form",
                submitBtn: "button",
                emailField: ".email",
                emailFieldError: ".email-err",
                GDPRField: ".gdpr",
                GDPRFieldError: ".gdpr-err",
                responseMessage: ".res-msg",
                errorMessage: ".err-msg",
                require: ".req",
                notValid: ".not-valid",
                success: ".success",
                failed: ".failed",
            },
			options: ogbNewsletterData,
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            subscribeForm: document.querySelector(selectors.subscribeForm),
            submitBtn: document.querySelector(selectors.submitBtn),
            emailField: document.querySelector(selectors.emailField),
            GDPRField: document.querySelector(selectors.GDPRField),
            responseMessages: document.querySelectorAll(selectors.responseMessage),
            errorMessages: document.querySelectorAll(selectors.errorMessage),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setupEventListeners();
    }

    setupEventListeners() {
        this.elements.subscribeForm?.addEventListener("submit", this.onSubmitSubscribeForm.bind(this));
    }

    onSubmitSubscribeForm(event) {
        event.preventDefault();

        const isFormAllowedSubmitted = this.checkFormFields();

        if (isFormAllowedSubmitted) {
            const selectors = this.getSettings("selectors");
            const emailAdress = this.elements.emailField.value.trim();

            this.elements.submitBtn.disabled = true;

			const options = this.getSettings("options");

            const formData = new FormData();
            formData.append("action", "ogb_newsletter_form");
            formData.append("nonce", options.nonce);
            formData.append("email", emailAdress);

            axios.post(options.ajax_url, formData).then(({ data }) => {
                const message = data.status
                    ? document.querySelector(`${selectors.responseMessage}${selectors.success}`)
                    : document.querySelector(`${selectors.responseMessage}${selectors.failed}`);

                fadeIn(message);
                this.elements.submitBtn.disabled = false;

                setTimeout(() => {
                    fadeOut(message);
                }, 5000);
            });
        }
    }

    checkFormFields() {
        const selectors = this.getSettings("selectors");
        const emailAdress = this.elements.emailField.value.trim();
        let isFormAllowedSubmitted = true;

        this.elements.errorMessages.forEach((errorMessage) => {
            errorMessage.style.display = "none";
        });

        this.elements.responseMessages.forEach((responseMessage) => {
            responseMessage.style.display = "none";
        });

        if (emailAdress === "") {
            document.querySelector(`${selectors.emailFieldError}${selectors.require}`).style.display = "block";
            isFormAllowedSubmitted = false;
        } else if (!this.isEmailAddressValid(emailAdress)) {
            document.querySelector(`${selectors.emailFieldError}${selectors.notValid}`).style.display = "block";
            isFormAllowedSubmitted = false;
        }

        if (!!this.elements.GDPRField && this.elements.GDPRField.checked === false) {
            document.querySelector(`${selectors.GDPRFieldError}${selectors.errorMessage}`).style.display = "block";
            isFormAllowedSubmitted = false;
        }

        return isFormAllowedSubmitted;
    }

    isEmailAddressValid(emailAddress) {
        const emailAddressPattern = new RegExp(
            /^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i
        );

        return emailAddressPattern.test(emailAddress);
    }
}


document.addEventListener("DOMContentLoaded", () => {
    new OGB_Newsletter();
});

