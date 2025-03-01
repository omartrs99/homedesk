import OW_Base from './base';

class OGB_Clipboard extends OW_Base {
  getDefaultSettings() {
    return {
      selectors: {
        clipboardButton: ".ogb-clipboard-button",
        clipboardValue: ".ogb-clipboard-value",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      clipboardButton: document.querySelector(selectors.clipboardButton),
      clipboardValue: document.querySelector(selectors.clipboardValue),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.setupEventListeners();
  }

  setupEventListeners() {
    if ( ! this.elements.clipboardButton ) {
      return;
    }

    this.elements.clipboardButton.addEventListener(
      "click",
      this.copy.bind(this)
    );
  }

  copy(event) {
    const data = this.elements.clipboardValue.dataset.clipboardTarget;
    this.elements.clipboardButton.insertAdjacentHTML(
      "beforeend",
      `<input type="text" value="${data}" id="ogbClipboardInput" />`
    );
    const clipboardInput = document.querySelector("#ogbClipboardInput");
    clipboardInput.select();
    document.execCommand("copy");
    clipboardInput.remove();
  }
}

document.addEventListener("DOMContentLoaded", () => {
    new OGB_Clipboard();
});
