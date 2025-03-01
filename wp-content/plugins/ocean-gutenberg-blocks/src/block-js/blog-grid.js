import ResponsiveAutoHeight from "responsive-auto-height";
import OW_Base from "./base";

class OGB_BlogGridBlock extends OW_Base {
    getDefaultSettings() {
        return {
            selectors: {
                blogGrid: ".ogb-blog-grid",
                blogMasonry: ".ogb-blog-grid.ogb-masonry",
            },
            options: oceanwpLocalize,
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            blogGrid: document.querySelectorAll(selectors.blogGrid),
            blogMasonry: document.querySelectorAll(selectors.blogMasonry),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.isMasonry()) {
            this.initMasonry();
        }

        if (this.isEqualHeight()) {
            this.initEqualHeight();
        }
    }

    initMasonry() {
        const options = this.getSettings("options");

        this.elements.blogMasonry?.forEach((blogMasonry) => {
            imagesLoaded(blogMasonry, (instance) => {
                new Isotope(blogMasonry, {
                    itemSelector: ".isotope-entry",
                    transformsEnabled: true,
                    isOriginLeft: options.isRTL ? false : true,
                    transitionDuration: 0,
                });
            });
        });
    }

    initEqualHeight() {
        const blogGridItemsSelector = `${this.getSettings("selectors").blogGrid} .ogb-grid-inner`;

        new ResponsiveAutoHeight(blogGridItemsSelector);
    }

    isMasonry() {
        if (document.body.classList.contains("no-isotope")) {
            return false;
        }

        return this.elements.blogMasonry.length > 0;
    }

    isEqualHeight() {
        return Array.from(this.elements.blogGrid).some(({ classList }) => classList.contains("match-height-grid"));
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new OGB_BlogGridBlock();
});
