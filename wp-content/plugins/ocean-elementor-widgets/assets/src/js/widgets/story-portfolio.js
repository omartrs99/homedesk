import {
  registerWidget
} from "../lib/utils";

class OEW_Story_Portfolio extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        portfolioContainer: '.story-portfolio',
        prevButton: '.prev',
        nextButton: '.next',
        textContainer: '.portfolio-text > div',
        bigImageContainer: '.portfolio-big-image',
        mobileImageContainer: '.portfolio-mobile-image',
        svgPreloader: '.video-preloader'
      }
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    const widgetID = this.$element.attr('id');

    return {
      prevButton: this.$element.find(selectors.prevButton),
      nextButton: this.$element.find(selectors.nextButton),
      textContainers: this.$element.find(selectors.textContainer),
      bigImageContainer: this.$element.find(selectors.bigImageContainer),
      mobileImageContainer: this.$element.find(selectors.mobileImageContainer),
      portfolioContainer: this.$element.find(selectors.portfolioContainer),
      svgPreloader: this.$element.find(selectors.svgPreloader)
    };
  }

  onInit() {
    super.onInit();
    this.elements = this.getDefaultElements();

    if (this.elements.portfolioContainer.length > 0) {
      this.slides = JSON.parse(this.elements.portfolioContainer.attr('data-settings'));
      this.currentIndex = 0;
      // this.updateSlide(this.currentIndex, true);
      this.updateSlide(this.currentIndex);
      this.setupEventListeners();
    } else {
      console.error('Portfolio container not found');
    }
  }

  setupEventListeners() {
    const widget = this;

    this.elements.prevButton.on('click', () => widget.handleTransition('prev'));
    this.elements.nextButton.on('click', () => widget.handleTransition('next'));
  }


  updateSlide(index) {
    const slide = this.slides[index];
    this.elements.svgPreloader.show();

    // Clear the content first to handle transitions smoothly
    // this.elements.bigImageContainer.empty().hide();

    let videoContent = '';

    if (slide.video_type === 'youtube' && slide.video_youtube) {
      // const autoplay = firstLoad || slide.autoplay ? 1 : 0; // Ensure autoplay on first load
      const autoplay = slide.autoplay ? 1 : 0;
      const mute = slide.mute ? 1 : 0;
      const loop = slide.loop ? 1 : 0;
      const youtubeEmbedUrl = this.getYoutubeEmbedUrl(slide.video_youtube, autoplay, mute, loop);
      // console.log('Generated YouTube Embed URL:', youtubeEmbedUrl);
      videoContent = `<iframe src="${youtubeEmbedUrl}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    } else if (slide.video_type === 'mp4' && slide.video_mp4 && slide.video_mp4.url) {
      const autoplay = slide.autoplay ? 'autoplay' : '';
      const mute = slide.mute ? 'muted' : '';
      const loop = slide.loop ? 'loop' : '';
      const posterUrl = slide.poster_image ? slide.poster_image.url : '';
      videoContent = `<video ${mute} ${autoplay} playsinline ${loop} poster="${posterUrl}">
                        <source src="${slide.video_mp4.url}" type="video/mp4">
                      </video>`;
    } else if (slide.video_type === 'image' && slide.slide_image && slide.slide_image.url) {
      videoContent = `<img src="${slide.slide_image.url}" alt="Displayed Image">`;
    }

    // Append new content and then show the container
    this.elements.bigImageContainer.html(videoContent).fadeIn(300);

    const videoElement = this.elements.bigImageContainer.find('video')[0];
    if (videoElement) {
      videoElement.oncanplaythrough = () => {
        this.elements.svgPreloader.hide();
        videoElement.classList.add('active');
      };
    } else {
      // Delay to prevent flickering when switching to an image
      setTimeout(() => {
        this.elements.svgPreloader.hide();
      }, 300); // Match the fadeIn duration
    }

    // Check if the mobile image URL exists before appending the mobile image container
    if (slide.mobile_image && slide.mobile_image.url) {
      this.elements.bigImageContainer.append(`<div id="${this.$element.data('id')}-mobile-image" class="portfolio-mobile-image"><img src="${slide.mobile_image.url}" /></div>`);
    }

    this.updateNavigationLabels(index);
  }

  getYoutubeEmbedUrl(url, autoplay, mute, loop) {
    const urlParams = new URLSearchParams(new URL(url).search);
    const videoId = urlParams.get('v');
    const autoplayParam = autoplay ? 'autoplay=1' : 'autoplay=0';
    const muteParam = mute ? '&mute=1' : '&mute=0';
    const loopParam = loop ? `&loop=1&playlist=${videoId}` : '';
    return `https://www.youtube.com/embed/${videoId}?${autoplayParam}${muteParam}${loopParam}`;
  }

  handleTransition(direction) {
    if (!this.elements.portfolioContainer.hasClass("noact")) {
      this.elements.portfolioContainer.removeClass("actEnd").addClass("noact");

      this.switchProject(direction);

      setTimeout(() => {
        this.elements.portfolioContainer.addClass("actEnd").removeClass("noact");
      }, 800);
    }
  }

  switchProject(direction) {
    const numSlides = this.slides.length;
    const increment = direction === 'next' ? 1 : -1;
    const newIndex = (this.currentIndex + increment + numSlides) % numSlides;

    this.elements.textContainers.eq(this.currentIndex).removeClass('active').hide();
    this.elements.textContainers.eq(newIndex).addClass('active').show();

    this.currentIndex = newIndex;
    this.updateSlide(this.currentIndex);
  }

  updateNavigationLabels(index) {
    const numSlides = this.slides.length;
    const prevIndex = (index - 1 + numSlides) % numSlides;
    const nextIndex = (index + 1) % numSlides;

    this.elements.prevButton.find('.nav-project').text(this.slides[prevIndex].title);
    this.elements.nextButton.find('.nav-project').text(this.slides[nextIndex].title);
  }
}

registerWidget(OEW_Story_Portfolio, "oew-story-portfolio");
