import OW_Base from './base';

class OGB_CircleProccess extends OW_Base {
    pieProgress;

    getDefaultSettings() {
        return {
            selectors: {
                circleProgress: ".ogb-circle-progress",
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings("selectors");

        return {
            circleProgress: document.querySelector(selectors.circleProgress),
            $circleProgress: document.querySelectorAll(selectors.circleProgress),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if ( ! this.elements.circleProgress ) {
            return;
        }

        this.registerPieProgress();
        this.observer();
    }

    registerPieProgress() {
        jQuery('.ogb-circle-progress').asPieProgress({
            namespace: "pieProgress",
            classes: {
                svg: "ogb-circle-progress-svg",
                number: "ogb-circle-progress-number",
                content: "ogb-circle-progress-content",
            },
        });
    }

    initPieProgress() {
        jQuery('.ogb-circle-progress').asPieProgress("start");
    }

    observer() {
        const observer = new IntersectionObserver(this.observerCallback.bind(this), {
            threshold: 0.65,
        });

        observer.observe(this.elements.circleProgress);
    }

    observerCallback(entries, observer) {
        const entry = entries[0];

        if (!entry.isIntersecting) {
            return;
        }

        this.initPieProgress();

        observer.unobserve(entry.target);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new OGB_CircleProccess();
});

