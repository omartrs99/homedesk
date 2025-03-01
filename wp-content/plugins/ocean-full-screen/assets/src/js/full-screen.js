import OW_Base from "./base/base";

class OW_FullScreen extends OW_Base {

  getDefaultSettings() {

    // let elSectionsWrapper = "#oceanwp-fullpage .elementor-section-wrap",
    //     elSections = "#oceanwp-fullpage .elementor-section-wrap > .elementor-section",
    //     elTopSections = "#oceanwp-fullpage .elementor-top-section";

    // if ( elementorFrontend.config.experimentalFeatures.e_dom_optimization && ! elementorFrontend.config.experimentalFeatures.container ) {
    //   elSectionsWrapper = "#oceanwp-fullpage .elementor"
    //   elSections = "#oceanwp-fullpage .elementor > .elementor-section"
    //   elTopSections = "#oceanwp-fullpage .elementor-top-section"
    // } else if ( ! elementorFrontend.config.experimentalFeatures.e_dom_optimization && ! elementorFrontend.config.experimentalFeatures.container ) {
    //   elSectionsWrapper = "#oceanwp-fullpage .elementor"
    //   elSections = "#oceanwp-fullpage .elementor > .elementor-section"
    //   elTopSections = "#oceanwp-fullpage .elementor-top-section"
    // } else if ( elementorFrontend.config.experimentalFeatures.container ) {
    //   elSectionsWrapper = "#oceanwp-fullpage .elementor"
    //   elSections = "#oceanwp-fullpage .elementor > .elementor-element"
    //   elTopSections = "#oceanwp-fullpage .e-flex"
    // }

    let elSectionsWrapper = "#oceanwp-fullpage .elementor-section-wrap",
        elSections = "#oceanwp-fullpage .elementor-section-wrap > .elementor-section",
        elTopSections = "#oceanwp-fullpage .elementor-top-section";

    const { container } = elementorFrontend.config.experimentalFeatures;

    if (!container) {
      elSectionsWrapper = "#oceanwp-fullpage .elementor";
      elSections = "#oceanwp-fullpage .elementor > .elementor-section";
      elTopSections = "#oceanwp-fullpage .elementor-top-section";
    } else if (container) {
      elSectionsWrapper = "#oceanwp-fullpage .elementor";
      elSections = "#oceanwp-fullpage .elementor > .elementor-element";
      elTopSections = "#oceanwp-fullpage .e-flex";
    }


    return {
      selectors: {
        sectionsWrapper: elSectionsWrapper,
        sections: elSections,
        topSections: elTopSections,
      },
      options: oceanwpLocalize,
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      sectionsWrapper: document.querySelector(selectors.sectionsWrapper),
      sections: document.querySelectorAll(selectors.sections),
      topSections: document.querySelectorAll(selectors.topSections),
      body: document.body,
    };
  }

  onInit() {
    super.onInit();

    if (this.isElementorEditorPage()) {
      return;
    }

    this.wrapSections();
    this.initFullPage();
    this.bindModalEvents();
  }

  wrapSections() {
    const anchors = new Set();
    if (this.elements.sections) {
        this.elements.sections.forEach((section, index) => {
            if (!section.id) {
                let sectionId = `fs-section-${index}`;
                while (document.getElementById(sectionId) || anchors.has(sectionId)) {
                    index++;
                    sectionId = `fs-section-${index}`;
                }
                section.id = sectionId;
            }
            anchors.add(section.id);
            const sectionWrapperId = `#${section.id}`;
            section.removeAttribute("id");
            section.outerHTML = `<div id="${sectionWrapperId}" class="wrap-section" data-anchor="${section.id}">${section.outerHTML}</div>`;
        });
    }
  }

  initFullPage() {
    const selectors = this.getSettings("selectors");

    new fullpage(selectors.sectionsWrapper, this.getFullPageOptions());
  }

  getFullPageOptions() {
    const self = this;
    const options = this.getSettings("options");
    const selectors = this.getSettings("selectors");
    const sections = document.querySelectorAll(
      `${selectors.sectionsWrapper} > .wrap-section`
    );

    const fullPageOptions = {
      licenseKey: "2802F989-785845A8-B0E376B6-EA1BD751",
      sectionSelector: ".wrap-section",
      scrollOverflow: true,
      v2compatible: true,
      onLeave: (index, nextIndex, direction) => {
        const nextSection = sections[nextIndex - 1];

        if (direction === "down" || direction === "up") {
          self.setFullPageNavColor(nextSection);
        }
      },
      afterLoad: function (anchorLink, index) {
        const nextSection = this;

        if (nextSection.classList.contains("active")) {
          self.setFullPageNavColor(nextSection);

          const sectionLoadedEvent = new Event('sectionLoaded');
          document.dispatchEvent(sectionLoadedEvent);
        }
      },
      anchors: [], // Reset the anchors array to ensure it's not causing issues
    };

    // Scrolling speed
    if (
      ("0" != options.ofcSpeed || "700" != options.ofcSpeed) &&
      "" != options.ofcSpeed
    ) {
      fullPageOptions.scrollingSpeed = options.ofcSpeed;
    }

    // Responsive
    if ("0" != options.ofcRes && "" != options.ofcRes) {
      fullPageOptions.responsiveWidth = options.ofcRes;
    }

    // If navigation
    if ("enable" == options.ofcNav) {
      // Anchors and tooltips
      const anchors = [];
      const navTooltips = [];

      sections.forEach(topSection => {
        let sectionID = topSection.id.replace("#", "");

        if (sectionID) {
          anchors.push(sectionID);
          navTooltips.push(sectionID.replace(/[\-_]/g, " ")); // Replace hyphens with space in tooltips
        } else {
          anchors.push(" ");
          navTooltips.push(" ");
        }
      });

      // Add anchors and tooltips to fullPageOptions
      fullPageOptions.anchors = anchors;

      // Settings
      fullPageOptions.menu = "#fp-nav";
      fullPageOptions.navigation = true;
      fullPageOptions.navigationPosition = options.ofcNavPos;
      fullPageOptions.navigationTooltips = navTooltips;
    }

    return fullPageOptions;
  }

  setFullPageNavColor(section) {
    for (const sectionChild of section.children) {
      this.elements.body.classList.remove("ofc-light-nav");
      this.elements.body.classList.remove("ofc-dark-nav");

      const children = sectionChild.children;

      const lightSection = Array.from(children).some(
        ({ classList }) =>
          classList.contains("elementor-top-section") &&
          classList.contains("light")
      );

      if (lightSection) {
        this.elements.body.classList.add("ofc-light-nav");
        break;
      }

      const darkSection = Array.from(children).some(
        ({ classList }) =>
          classList.contains("elementor-top-section") &&
          classList.contains("dark")
      );

      if (darkSection) {
        this.elements.body.classList.add("ofc-dark-nav");
        break;
      }
    }
  }

  bindModalEvents() { 
    document.querySelectorAll('#oceanwp-fullpage .omw-open-modal').forEach(linkElement => { 
      const eventInitOWM = new CustomEvent("init-omw-for-element", { 
        bubbles: true,
        cancelable: true
      }); 
      linkElement.dispatchEvent(eventInitOWM ); 
    }); 
  }

  isElementorEditorPage() {
    return this.elements.body.classList.contains("elementor-editor-active");
  }
}

("use script");
window.addEventListener("DOMContentLoaded", () => {
  new OW_FullScreen();
});
