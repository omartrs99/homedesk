import { fadeIn, fadeOut } from "./lib/utils";
import OW_Base from './base';

class OGB_Modal extends OW_Base {
  getDefaultSettings() {
    return {
      selectors: {
        modal: ".ogb-modal-wrap",
        openModalButton: ".ogb-modal-button a",
        closeModalElements: ".ogb-modal-close, .ogb-modal-overlay",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      modal: document.querySelectorAll(selectors.modal),
      openModalButton: document.querySelectorAll(selectors.openModalButton),
      closeModalElements: document.querySelectorAll(
        selectors.closeModalElements
      ),
      body: document.body,
      html: document.querySelector("html"),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.moveModalToEndOfBody();
    this.setupEventListeners();
  }

  moveModalToEndOfBody() {
    document.querySelectorAll('.ogb-modal-wrap').forEach(modal => {
        this.elements.modal?.forEach(modalItem => {
            if (modalItem !== modal) {
                modal.remove();
            }
            document.body.insertAdjacentElement("beforeend", modal);
        });
    });
  }

  setupEventListeners() {
    this.elements.openModalButton?.forEach(openButton => {
        openButton.addEventListener(
            "click",
            this.openModal.bind(this)
        );
    });

    this.elements.closeModalElements?.forEach(closeModalElement => {
        closeModalElement.addEventListener("click", this.closeModal.bind(this));
    });
  }

  openModal(event) {
    event.preventDefault();

    const openModalButton = event.currentTarget;
    const targetID = openModalButton.getAttribute("href");
    const modal = document.querySelector(targetID);

    modal.classList.remove("ogb-temp-styles");

    const initialHTMLInnerWidth = this.elements.html.innerWidth;
    this.elements.html.style.overflow = "hidden";

    const afterInitialHTMLInnerWidth = this.elements.html.innerWidth;
    this.elements.html.style.marginRight =
      afterInitialHTMLInnerWidth - initialHTMLInnerWidth + "px";

    fadeIn(modal);
  }

  closeModal(event) {
    const closeModalElements = event.currentTarget;
    const modal = closeModalElements.closest(".ogb-modal-wrap");

    this.elements.html.style.overflow = "";
    this.elements.html.style.marginRight = "";

    fadeOut(modal);
  }
}

document.addEventListener("DOMContentLoaded", () => {
    new OGB_Modal();
});
