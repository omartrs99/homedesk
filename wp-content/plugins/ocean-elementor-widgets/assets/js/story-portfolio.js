(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.registerWidget = exports.isElement = exports.getSiblings = exports.visible = exports.offset = exports.fadeToggle = exports.fadeOut = exports.fadeIn = exports.slideToggle = exports.slideUp = exports.slideDown = void 0;

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var slideDown = function slideDown(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  var display = window.getComputedStyle(element).display;

  if (display === "none") {
    display = "block";
  }

  element.style.transitionProperty = "height";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.opacity = 0;
  element.style.display = display;
  var height = element.offsetHeight;
  element.style.height = 0;
  element.style.opacity = 1;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = "".concat(height, "px");
  }, 5);
  window.setTimeout(function () {
    element.style.removeProperty("height");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
    element.style.removeProperty("opacity");
  }, duration + 50);
};

exports.slideDown = slideDown;

var slideUp = function slideUp(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.boxSizing = "border-box";
  element.style.transitionProperty = "height, margin";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.height = "".concat(element.offsetHeight, "px");
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = 0;
  }, 5);
  window.setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("height");
    element.style.removeProperty("margin-top");
    element.style.removeProperty("margin-bottom");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
  }, duration + 50);
};

exports.slideUp = slideUp;

var slideToggle = function slideToggle(element, duration) {
  window.getComputedStyle(element).display === "none" ? slideDown(element, duration) : slideUp(element, duration);
};

exports.slideToggle = slideToggle;

var fadeIn = function fadeIn(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 1,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 0;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.fadeIn = fadeIn;

var fadeOut = function fadeOut(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 0,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 1;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.fadeOut = fadeOut;

var fadeToggle = function fadeToggle(element, options) {
  window.getComputedStyle(element).display === "none" ? fadeIn(element, options) : fadeOut(element, options);
};

exports.fadeToggle = fadeToggle;

var offset = function offset(element) {
  if (!element.getClientRects().length) {
    return {
      top: 0,
      left: 0
    };
  } // Get document-relative position by adding viewport scroll to viewport-relative gBCR


  var rect = element.getBoundingClientRect();
  var win = element.ownerDocument.defaultView;
  return {
    top: rect.top + win.pageYOffset,
    left: rect.left + win.pageXOffset
  };
};

exports.offset = offset;

var visible = function visible(element) {
  if (!element) {
    return false;
  }

  return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
};

exports.visible = visible;

var getSiblings = function getSiblings(e) {
  // for collecting siblings
  var siblings = []; // if no parent, return no sibling

  if (!e.parentNode) {
    return siblings;
  } // first child of the parent node


  var sibling = e.parentNode.firstChild; // collecting siblings

  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== e) {
      siblings.push(sibling);
    }

    sibling = sibling.nextSibling;
  }

  return siblings;
}; // Returns true if it is a DOM element


exports.getSiblings = getSiblings;

var isElement = function isElement(o) {
  return (typeof HTMLElement === "undefined" ? "undefined" : _typeof(HTMLElement)) === "object" ? o instanceof HTMLElement // DOM2
  : o && _typeof(o) === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string";
};

exports.isElement = isElement;

var registerWidget = function registerWidget(className, widgetName) {
  var skin = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "default";

  if (!(className || widgetName)) {
    return;
  }
  /**
   * Because Elementor plugin uses jQuery custom event,
   * We also have to use jQuery to use this event
   */


  jQuery(window).on("elementor/frontend/init", function () {
    var addHandler = function addHandler($element) {
      elementorFrontend.elementsHandler.addHandler(className, {
        $element: $element
      });
    };

    elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widgetName, ".").concat(skin), addHandler);
  });
};

exports.registerWidget = registerWidget;

},{}],2:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _utils = require("../lib/utils");

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_Story_Portfolio = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_Story_Portfolio, _elementorModules$fro);

  var _super = _createSuper(OEW_Story_Portfolio);

  function OEW_Story_Portfolio() {
    _classCallCheck(this, OEW_Story_Portfolio);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_Story_Portfolio, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
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
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings('selectors');
      var widgetID = this.$element.attr('id');
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
  }, {
    key: "onInit",
    value: function onInit() {
      _get(_getPrototypeOf(OEW_Story_Portfolio.prototype), "onInit", this).call(this);

      this.elements = this.getDefaultElements();

      if (this.elements.portfolioContainer.length > 0) {
        this.slides = JSON.parse(this.elements.portfolioContainer.attr('data-settings'));
        this.currentIndex = 0; // this.updateSlide(this.currentIndex, true);

        this.updateSlide(this.currentIndex);
        this.setupEventListeners();
      } else {
        console.error('Portfolio container not found');
      }
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var widget = this;
      this.elements.prevButton.on('click', function () {
        return widget.handleTransition('prev');
      });
      this.elements.nextButton.on('click', function () {
        return widget.handleTransition('next');
      });
    }
  }, {
    key: "updateSlide",
    value: function updateSlide(index) {
      var _this = this;

      var slide = this.slides[index];
      this.elements.svgPreloader.show(); // Clear the content first to handle transitions smoothly
      // this.elements.bigImageContainer.empty().hide();

      var videoContent = '';

      if (slide.video_type === 'youtube' && slide.video_youtube) {
        // const autoplay = firstLoad || slide.autoplay ? 1 : 0; // Ensure autoplay on first load
        var autoplay = slide.autoplay ? 1 : 0;
        var mute = slide.mute ? 1 : 0;
        var loop = slide.loop ? 1 : 0;
        var youtubeEmbedUrl = this.getYoutubeEmbedUrl(slide.video_youtube, autoplay, mute, loop); // console.log('Generated YouTube Embed URL:', youtubeEmbedUrl);

        videoContent = "<iframe src=\"".concat(youtubeEmbedUrl, "\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>");
      } else if (slide.video_type === 'mp4' && slide.video_mp4 && slide.video_mp4.url) {
        var _autoplay = slide.autoplay ? 'autoplay' : '';

        var _mute = slide.mute ? 'muted' : '';

        var _loop = slide.loop ? 'loop' : '';

        var posterUrl = slide.poster_image ? slide.poster_image.url : '';
        videoContent = "<video ".concat(_mute, " ").concat(_autoplay, " playsinline ").concat(_loop, " poster=\"").concat(posterUrl, "\">\n                        <source src=\"").concat(slide.video_mp4.url, "\" type=\"video/mp4\">\n                      </video>");
      } else if (slide.video_type === 'image' && slide.slide_image && slide.slide_image.url) {
        videoContent = "<img src=\"".concat(slide.slide_image.url, "\" alt=\"Displayed Image\">");
      } // Append new content and then show the container


      this.elements.bigImageContainer.html(videoContent).fadeIn(300);
      var videoElement = this.elements.bigImageContainer.find('video')[0];

      if (videoElement) {
        videoElement.oncanplaythrough = function () {
          _this.elements.svgPreloader.hide();

          videoElement.classList.add('active');
        };
      } else {
        // Delay to prevent flickering when switching to an image
        setTimeout(function () {
          _this.elements.svgPreloader.hide();
        }, 300); // Match the fadeIn duration
      } // Check if the mobile image URL exists before appending the mobile image container


      if (slide.mobile_image && slide.mobile_image.url) {
        this.elements.bigImageContainer.append("<div id=\"".concat(this.$element.data('id'), "-mobile-image\" class=\"portfolio-mobile-image\"><img src=\"").concat(slide.mobile_image.url, "\" /></div>"));
      }

      this.updateNavigationLabels(index);
    }
  }, {
    key: "getYoutubeEmbedUrl",
    value: function getYoutubeEmbedUrl(url, autoplay, mute, loop) {
      var urlParams = new URLSearchParams(new URL(url).search);
      var videoId = urlParams.get('v');
      var autoplayParam = autoplay ? 'autoplay=1' : 'autoplay=0';
      var muteParam = mute ? '&mute=1' : '&mute=0';
      var loopParam = loop ? "&loop=1&playlist=".concat(videoId) : '';
      return "https://www.youtube.com/embed/".concat(videoId, "?").concat(autoplayParam).concat(muteParam).concat(loopParam);
    }
  }, {
    key: "handleTransition",
    value: function handleTransition(direction) {
      var _this2 = this;

      if (!this.elements.portfolioContainer.hasClass("noact")) {
        this.elements.portfolioContainer.removeClass("actEnd").addClass("noact");
        this.switchProject(direction);
        setTimeout(function () {
          _this2.elements.portfolioContainer.addClass("actEnd").removeClass("noact");
        }, 800);
      }
    }
  }, {
    key: "switchProject",
    value: function switchProject(direction) {
      var numSlides = this.slides.length;
      var increment = direction === 'next' ? 1 : -1;
      var newIndex = (this.currentIndex + increment + numSlides) % numSlides;
      this.elements.textContainers.eq(this.currentIndex).removeClass('active').hide();
      this.elements.textContainers.eq(newIndex).addClass('active').show();
      this.currentIndex = newIndex;
      this.updateSlide(this.currentIndex);
    }
  }, {
    key: "updateNavigationLabels",
    value: function updateNavigationLabels(index) {
      var numSlides = this.slides.length;
      var prevIndex = (index - 1 + numSlides) % numSlides;
      var nextIndex = (index + 1) % numSlides;
      this.elements.prevButton.find('.nav-project').text(this.slides[prevIndex].title);
      this.elements.nextButton.find('.nav-project').text(this.slides[nextIndex].title);
    }
  }]);

  return OEW_Story_Portfolio;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_Story_Portfolio, "oew-story-portfolio");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9zdG9yeS1wb3J0Zm9saW8uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7QUNBTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxNQUFJLE9BQU8sR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsT0FBL0M7O0FBRUEsTUFBSSxPQUFPLEtBQUssTUFBaEIsRUFBd0I7QUFDcEIsSUFBQSxPQUFPLEdBQUcsT0FBVjtBQUNIOztBQUVELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFDQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLFVBQVUsQ0FBQyxZQUFNO0FBQ2IsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsTUFBMUI7QUFDSCxHQUZTLEVBRVAsQ0FGTyxDQUFWO0FBSUEsRUFBQSxNQUFNLENBQUMsVUFBUCxDQUFrQixZQUFNO0FBQ3BCLElBQUEsT0FBTyxDQUFDLEtBQVIs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OztBQXFKckUsMkJBQWUsbUJBQWYsRUFBb0MscUJBQXBDIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xuICAgIGxldCBkaXNwbGF5ID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheTtcblxuICAgIGlmIChkaXNwbGF5ID09PSBcIm5vbmVcIikge1xuICAgICAgICBkaXNwbGF5ID0gXCJibG9ja1wiO1xuICAgIH1cblxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gXCJoZWlnaHRcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheTtcbiAgICBsZXQgaGVpZ2h0ID0gZWxlbWVudC5vZmZzZXRIZWlnaHQ7XG5cbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2hlaWdodH1weGA7XG4gICAgfSwgNSk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3BhY2l0eVwiKTtcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBzbGlkZVVwID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5ib3hTaXppbmcgPSBcImJvcmRlci1ib3hcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW5cIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2VsZW1lbnQub2Zmc2V0SGVpZ2h0fXB4YDtcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcbiAgICB9LCA1KTtcblxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3Qgc2xpZGVUb2dnbGUgPSAoZWxlbWVudCwgZHVyYXRpb24pID0+IHtcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IHNsaWRlRG93bihlbGVtZW50LCBkdXJhdGlvbikgOiBzbGlkZVVwKGVsZW1lbnQsIGR1cmF0aW9uKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlSW4gPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDEsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVPdXQgPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDAsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIG9wdGlvbnMpID0+IHtcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IGZhZGVJbihlbGVtZW50LCBvcHRpb25zKSA6IGZhZGVPdXQoZWxlbWVudCwgb3B0aW9ucyk7XG59O1xuXG5leHBvcnQgY29uc3Qgb2Zmc2V0ID0gKGVsZW1lbnQpID0+IHtcbiAgICBpZiAoIWVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpIHtcbiAgICAgICAgcmV0dXJuIHsgdG9wOiAwLCBsZWZ0OiAwIH07XG4gICAgfVxuXG4gICAgLy8gR2V0IGRvY3VtZW50LXJlbGF0aXZlIHBvc2l0aW9uIGJ5IGFkZGluZyB2aWV3cG9ydCBzY3JvbGwgdG8gdmlld3BvcnQtcmVsYXRpdmUgZ0JDUlxuICAgIGNvbnN0IHJlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpO1xuICAgIGNvbnN0IHdpbiA9IGVsZW1lbnQub3duZXJEb2N1bWVudC5kZWZhdWx0VmlldztcbiAgICByZXR1cm4ge1xuICAgICAgICB0b3A6IHJlY3QudG9wICsgd2luLnBhZ2VZT2Zmc2V0LFxuICAgICAgICBsZWZ0OiByZWN0LmxlZnQgKyB3aW4ucGFnZVhPZmZzZXQsXG4gICAgfTtcbn07XG5cbmV4cG9ydCBjb25zdCB2aXNpYmxlID0gKGVsZW1lbnQpID0+IHtcbiAgICBpZiAoIWVsZW1lbnQpIHtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cblxuICAgIHJldHVybiAhIShlbGVtZW50Lm9mZnNldFdpZHRoIHx8IGVsZW1lbnQub2Zmc2V0SGVpZ2h0IHx8IGVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpO1xufTtcblxuZXhwb3J0IGNvbnN0IGdldFNpYmxpbmdzID0gKGUpID0+IHtcbiAgICAvLyBmb3IgY29sbGVjdGluZyBzaWJsaW5nc1xuICAgIGNvbnN0IHNpYmxpbmdzID0gW107XG5cbiAgICAvLyBpZiBubyBwYXJlbnQsIHJldHVybiBubyBzaWJsaW5nXG4gICAgaWYgKCFlLnBhcmVudE5vZGUpIHtcbiAgICAgICAgcmV0dXJuIHNpYmxpbmdzO1xuICAgIH1cblxuICAgIC8vIGZpcnN0IGNoaWxkIG9mIHRoZSBwYXJlbnQgbm9kZVxuICAgIGxldCBzaWJsaW5nID0gZS5wYXJlbnROb2RlLmZpcnN0Q2hpbGQ7XG5cbiAgICAvLyBjb2xsZWN0aW5nIHNpYmxpbmdzXG4gICAgd2hpbGUgKHNpYmxpbmcpIHtcbiAgICAgICAgaWYgKHNpYmxpbmcubm9kZVR5cGUgPT09IDEgJiYgc2libGluZyAhPT0gZSkge1xuICAgICAgICAgICAgc2libGluZ3MucHVzaChzaWJsaW5nKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHNpYmxpbmcgPSBzaWJsaW5nLm5leHRTaWJsaW5nO1xuICAgIH1cblxuICAgIHJldHVybiBzaWJsaW5ncztcbn07XG5cbi8vIFJldHVybnMgdHJ1ZSBpZiBpdCBpcyBhIERPTSBlbGVtZW50XG5leHBvcnQgY29uc3QgaXNFbGVtZW50ID0gKG8pID0+IHtcbiAgICByZXR1cm4gdHlwZW9mIEhUTUxFbGVtZW50ID09PSBcIm9iamVjdFwiXG4gICAgICAgID8gbyBpbnN0YW5jZW9mIEhUTUxFbGVtZW50IC8vIERPTTJcbiAgICAgICAgOiBvICYmIHR5cGVvZiBvID09PSBcIm9iamVjdFwiICYmIG8gIT09IG51bGwgJiYgby5ub2RlVHlwZSA9PT0gMSAmJiB0eXBlb2Ygby5ub2RlTmFtZSA9PT0gXCJzdHJpbmdcIjtcbn07XG5cbmV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSBcImRlZmF1bHRcIikgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKFwiZWxlbWVudG9yL2Zyb250ZW5kL2luaXRcIiwgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQge1xuICByZWdpc3RlcldpZGdldFxufSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIE9FV19TdG9yeV9Qb3J0Zm9saW8gZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgcmV0dXJuIHtcbiAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICBwb3J0Zm9saW9Db250YWluZXI6ICcuc3RvcnktcG9ydGZvbGlvJyxcbiAgICAgICAgcHJldkJ1dHRvbjogJy5wcmV2JyxcbiAgICAgICAgbmV4dEJ1dHRvbjogJy5uZXh0JyxcbiAgICAgICAgdGV4dENvbnRhaW5lcjogJy5wb3J0Zm9saW8tdGV4dCA+IGRpdicsXG4gICAgICAgIGJpZ0ltYWdlQ29udGFpbmVyOiAnLnBvcnRmb2xpby1iaWctaW1hZ2UnLFxuICAgICAgICBtb2JpbGVJbWFnZUNvbnRhaW5lcjogJy5wb3J0Zm9saW8tbW9iaWxlLWltYWdlJyxcbiAgICAgICAgc3ZnUHJlbG9hZGVyOiAnLnZpZGVvLXByZWxvYWRlcidcbiAgICAgIH1cbiAgICB9O1xuICB9XG5cbiAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycycpO1xuICAgIGNvbnN0IHdpZGdldElEID0gdGhpcy4kZWxlbWVudC5hdHRyKCdpZCcpO1xuXG4gICAgcmV0dXJuIHtcbiAgICAgIHByZXZCdXR0b246IHRoaXMuJGVsZW1lbnQuZmluZChzZWxlY3RvcnMucHJldkJ1dHRvbiksXG4gICAgICBuZXh0QnV0dG9uOiB0aGlzLiRlbGVtZW50LmZpbmQoc2VsZWN0b3JzLm5leHRCdXR0b24pLFxuICAgICAgdGV4dENvbnRhaW5lcnM6IHRoaXMuJGVsZW1lbnQuZmluZChzZWxlY3RvcnMudGV4dENvbnRhaW5lciksXG4gICAgICBiaWdJbWFnZUNvbnRhaW5lcjogdGhpcy4kZWxlbWVudC5maW5kKHNlbGVjdG9ycy5iaWdJbWFnZUNvbnRhaW5lciksXG4gICAgICBtb2JpbGVJbWFnZUNvbnRhaW5lcjogdGhpcy4kZWxlbWVudC5maW5kKHNlbGVjdG9ycy5tb2JpbGVJbWFnZUNvbnRhaW5lciksXG4gICAgICBwb3J0Zm9saW9Db250YWluZXI6IHRoaXMuJGVsZW1lbnQuZmluZChzZWxlY3RvcnMucG9ydGZvbGlvQ29udGFpbmVyKSxcbiAgICAgIHN2Z1ByZWxvYWRlcjogdGhpcy4kZWxlbWVudC5maW5kKHNlbGVjdG9ycy5zdmdQcmVsb2FkZXIpXG4gICAgfTtcbiAgfVxuXG4gIG9uSW5pdCgpIHtcbiAgICBzdXBlci5vbkluaXQoKTtcbiAgICB0aGlzLmVsZW1lbnRzID0gdGhpcy5nZXREZWZhdWx0RWxlbWVudHMoKTtcblxuICAgIGlmICh0aGlzLmVsZW1lbnRzLnBvcnRmb2xpb0NvbnRhaW5lci5sZW5ndGggPiAwKSB7XG4gICAgICB0aGlzLnNsaWRlcyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5wb3J0Zm9saW9Db250YWluZXIuYXR0cignZGF0YS1zZXR0aW5ncycpKTtcbiAgICAgIHRoaXMuY3VycmVudEluZGV4ID0gMDtcbiAgICAgIC8vIHRoaXMudXBkYXRlU2xpZGUodGhpcy5jdXJyZW50SW5kZXgsIHRydWUpO1xuICAgICAgdGhpcy51cGRhdGVTbGlkZSh0aGlzLmN1cnJlbnRJbmRleCk7XG4gICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICB9IGVsc2Uge1xuICAgICAgY29uc29sZS5lcnJvcignUG9ydGZvbGlvIGNvbnRhaW5lciBub3QgZm91bmQnKTtcbiAgICB9XG4gIH1cblxuICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xuICAgIGNvbnN0IHdpZGdldCA9IHRoaXM7XG5cbiAgICB0aGlzLmVsZW1lbnRzLnByZXZCdXR0b24ub24oJ2NsaWNrJywgKCkgPT4gd2lkZ2V0LmhhbmRsZVRyYW5zaXRpb24oJ3ByZXYnKSk7XG4gICAgdGhpcy5lbGVtZW50cy5uZXh0QnV0dG9uLm9uKCdjbGljaycsICgpID0+IHdpZGdldC5oYW5kbGVUcmFuc2l0aW9uKCduZXh0JykpO1xuICB9XG5cblxuICB1cGRhdGVTbGlkZShpbmRleCkge1xuICAgIGNvbnN0IHNsaWRlID0gdGhpcy5zbGlkZXNbaW5kZXhdO1xuICAgIHRoaXMuZWxlbWVudHMuc3ZnUHJlbG9hZGVyLnNob3coKTtcblxuICAgIC8vIENsZWFyIHRoZSBjb250ZW50IGZpcnN0IHRvIGhhbmRsZSB0cmFuc2l0aW9ucyBzbW9vdGhseVxuICAgIC8vIHRoaXMuZWxlbWVudHMuYmlnSW1hZ2VDb250YWluZXIuZW1wdHkoKS5oaWRlKCk7XG5cbiAgICBsZXQgdmlkZW9Db250ZW50ID0gJyc7XG5cbiAgICBpZiAoc2xpZGUudmlkZW9fdHlwZSA9PT0gJ3lvdXR1YmUnICYmIHNsaWRlLnZpZGVvX3lvdXR1YmUpIHtcbiAgICAgIC8vIGNvbnN0IGF1dG9wbGF5ID0gZmlyc3RMb2FkIHx8IHNsaWRlLmF1dG9wbGF5ID8gMSA6IDA7IC8vIEVuc3VyZSBhdXRvcGxheSBvbiBmaXJzdCBsb2FkXG4gICAgICBjb25zdCBhdXRvcGxheSA9IHNsaWRlLmF1dG9wbGF5ID8gMSA6IDA7XG4gICAgICBjb25zdCBtdXRlID0gc2xpZGUubXV0ZSA/IDEgOiAwO1xuICAgICAgY29uc3QgbG9vcCA9IHNsaWRlLmxvb3AgPyAxIDogMDtcbiAgICAgIGNvbnN0IHlvdXR1YmVFbWJlZFVybCA9IHRoaXMuZ2V0WW91dHViZUVtYmVkVXJsKHNsaWRlLnZpZGVvX3lvdXR1YmUsIGF1dG9wbGF5LCBtdXRlLCBsb29wKTtcbiAgICAgIC8vIGNvbnNvbGUubG9nKCdHZW5lcmF0ZWQgWW91VHViZSBFbWJlZCBVUkw6JywgeW91dHViZUVtYmVkVXJsKTtcbiAgICAgIHZpZGVvQ29udGVudCA9IGA8aWZyYW1lIHNyYz1cIiR7eW91dHViZUVtYmVkVXJsfVwiIGZyYW1lYm9yZGVyPVwiMFwiIGFsbG93PVwiYWNjZWxlcm9tZXRlcjsgYXV0b3BsYXk7IGVuY3J5cHRlZC1tZWRpYTsgZ3lyb3Njb3BlOyBwaWN0dXJlLWluLXBpY3R1cmVcIiBhbGxvd2Z1bGxzY3JlZW4+PC9pZnJhbWU+YDtcbiAgICB9IGVsc2UgaWYgKHNsaWRlLnZpZGVvX3R5cGUgPT09ICdtcDQnICYmIHNsaWRlLnZpZGVvX21wNCAmJiBzbGlkZS52aWRlb19tcDQudXJsKSB7XG4gICAgICBjb25zdCBhdXRvcGxheSA9IHNsaWRlLmF1dG9wbGF5ID8gJ2F1dG9wbGF5JyA6ICcnO1xuICAgICAgY29uc3QgbXV0ZSA9IHNsaWRlLm11dGUgPyAnbXV0ZWQnIDogJyc7XG4gICAgICBjb25zdCBsb29wID0gc2xpZGUubG9vcCA/ICdsb29wJyA6ICcnO1xuICAgICAgY29uc3QgcG9zdGVyVXJsID0gc2xpZGUucG9zdGVyX2ltYWdlID8gc2xpZGUucG9zdGVyX2ltYWdlLnVybCA6ICcnO1xuICAgICAgdmlkZW9Db250ZW50ID0gYDx2aWRlbyAke211dGV9ICR7YXV0b3BsYXl9IHBsYXlzaW5saW5lICR7bG9vcH0gcG9zdGVyPVwiJHtwb3N0ZXJVcmx9XCI+XG4gICAgICAgICAgICAgICAgICAgICAgICA8c291cmNlIHNyYz1cIiR7c2xpZGUudmlkZW9fbXA0LnVybH1cIiB0eXBlPVwidmlkZW8vbXA0XCI+XG4gICAgICAgICAgICAgICAgICAgICAgPC92aWRlbz5gO1xuICAgIH0gZWxzZSBpZiAoc2xpZGUudmlkZW9fdHlwZSA9PT0gJ2ltYWdlJyAmJiBzbGlkZS5zbGlkZV9pbWFnZSAmJiBzbGlkZS5zbGlkZV9pbWFnZS51cmwpIHtcbiAgICAgIHZpZGVvQ29udGVudCA9IGA8aW1nIHNyYz1cIiR7c2xpZGUuc2xpZGVfaW1hZ2UudXJsfVwiIGFsdD1cIkRpc3BsYXllZCBJbWFnZVwiPmA7XG4gICAgfVxuXG4gICAgLy8gQXBwZW5kIG5ldyBjb250ZW50IGFuZCB0aGVuIHNob3cgdGhlIGNvbnRhaW5lclxuICAgIHRoaXMuZWxlbWVudHMuYmlnSW1hZ2VDb250YWluZXIuaHRtbCh2aWRlb0NvbnRlbnQpLmZhZGVJbigzMDApO1xuXG4gICAgY29uc3QgdmlkZW9FbGVtZW50ID0gdGhpcy5lbGVtZW50cy5iaWdJbWFnZUNvbnRhaW5lci5maW5kKCd2aWRlbycpWzBdO1xuICAgIGlmICh2aWRlb0VsZW1lbnQpIHtcbiAgICAgIHZpZGVvRWxlbWVudC5vbmNhbnBsYXl0aHJvdWdoID0gKCkgPT4ge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnN2Z1ByZWxvYWRlci5oaWRlKCk7XG4gICAgICAgIHZpZGVvRWxlbWVudC5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKTtcbiAgICAgIH07XG4gICAgfSBlbHNlIHtcbiAgICAgIC8vIERlbGF5IHRvIHByZXZlbnQgZmxpY2tlcmluZyB3aGVuIHN3aXRjaGluZyB0byBhbiBpbWFnZVxuICAgICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuc3ZnUHJlbG9hZGVyLmhpZGUoKTtcbiAgICAgIH0sIDMwMCk7IC8vIE1hdGNoIHRoZSBmYWRlSW4gZHVyYXRpb25cbiAgICB9XG5cbiAgICAvLyBDaGVjayBpZiB0aGUgbW9iaWxlIGltYWdlIFVSTCBleGlzdHMgYmVmb3JlIGFwcGVuZGluZyB0aGUgbW9iaWxlIGltYWdlIGNvbnRhaW5lclxuICAgIGlmIChzbGlkZS5tb2JpbGVfaW1hZ2UgJiYgc2xpZGUubW9iaWxlX2ltYWdlLnVybCkge1xuICAgICAgdGhpcy5lbGVtZW50cy5iaWdJbWFnZUNvbnRhaW5lci5hcHBlbmQoYDxkaXYgaWQ9XCIke3RoaXMuJGVsZW1lbnQuZGF0YSgnaWQnKX0tbW9iaWxlLWltYWdlXCIgY2xhc3M9XCJwb3J0Zm9saW8tbW9iaWxlLWltYWdlXCI+PGltZyBzcmM9XCIke3NsaWRlLm1vYmlsZV9pbWFnZS51cmx9XCIgLz48L2Rpdj5gKTtcbiAgICB9XG5cbiAgICB0aGlzLnVwZGF0ZU5hdmlnYXRpb25MYWJlbHMoaW5kZXgpO1xuICB9XG5cbiAgZ2V0WW91dHViZUVtYmVkVXJsKHVybCwgYXV0b3BsYXksIG11dGUsIGxvb3ApIHtcbiAgICBjb25zdCB1cmxQYXJhbXMgPSBuZXcgVVJMU2VhcmNoUGFyYW1zKG5ldyBVUkwodXJsKS5zZWFyY2gpO1xuICAgIGNvbnN0IHZpZGVvSWQgPSB1cmxQYXJhbXMuZ2V0KCd2Jyk7XG4gICAgY29uc3QgYXV0b3BsYXlQYXJhbSA9IGF1dG9wbGF5ID8gJ2F1dG9wbGF5PTEnIDogJ2F1dG9wbGF5PTAnO1xuICAgIGNvbnN0IG11dGVQYXJhbSA9IG11dGUgPyAnJm11dGU9MScgOiAnJm11dGU9MCc7XG4gICAgY29uc3QgbG9vcFBhcmFtID0gbG9vcCA/IGAmbG9vcD0xJnBsYXlsaXN0PSR7dmlkZW9JZH1gIDogJyc7XG4gICAgcmV0dXJuIGBodHRwczovL3d3dy55b3V0dWJlLmNvbS9lbWJlZC8ke3ZpZGVvSWR9PyR7YXV0b3BsYXlQYXJhbX0ke211dGVQYXJhbX0ke2xvb3BQYXJhbX1gO1xuICB9XG5cbiAgaGFuZGxlVHJhbnNpdGlvbihkaXJlY3Rpb24pIHtcbiAgICBpZiAoIXRoaXMuZWxlbWVudHMucG9ydGZvbGlvQ29udGFpbmVyLmhhc0NsYXNzKFwibm9hY3RcIikpIHtcbiAgICAgIHRoaXMuZWxlbWVudHMucG9ydGZvbGlvQ29udGFpbmVyLnJlbW92ZUNsYXNzKFwiYWN0RW5kXCIpLmFkZENsYXNzKFwibm9hY3RcIik7XG5cbiAgICAgIHRoaXMuc3dpdGNoUHJvamVjdChkaXJlY3Rpb24pO1xuXG4gICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5wb3J0Zm9saW9Db250YWluZXIuYWRkQ2xhc3MoXCJhY3RFbmRcIikucmVtb3ZlQ2xhc3MoXCJub2FjdFwiKTtcbiAgICAgIH0sIDgwMCk7XG4gICAgfVxuICB9XG5cbiAgc3dpdGNoUHJvamVjdChkaXJlY3Rpb24pIHtcbiAgICBjb25zdCBudW1TbGlkZXMgPSB0aGlzLnNsaWRlcy5sZW5ndGg7XG4gICAgY29uc3QgaW5jcmVtZW50ID0gZGlyZWN0aW9uID09PSAnbmV4dCcgPyAxIDogLTE7XG4gICAgY29uc3QgbmV3SW5kZXggPSAodGhpcy5jdXJyZW50SW5kZXggKyBpbmNyZW1lbnQgKyBudW1TbGlkZXMpICUgbnVtU2xpZGVzO1xuXG4gICAgdGhpcy5lbGVtZW50cy50ZXh0Q29udGFpbmVycy5lcSh0aGlzLmN1cnJlbnRJbmRleCkucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpLmhpZGUoKTtcbiAgICB0aGlzLmVsZW1lbnRzLnRleHRDb250YWluZXJzLmVxKG5ld0luZGV4KS5hZGRDbGFzcygnYWN0aXZlJykuc2hvdygpO1xuXG4gICAgdGhpcy5jdXJyZW50SW5kZXggPSBuZXdJbmRleDtcbiAgICB0aGlzLnVwZGF0ZVNsaWRlKHRoaXMuY3VycmVudEluZGV4KTtcbiAgfVxuXG4gIHVwZGF0ZU5hdmlnYXRpb25MYWJlbHMoaW5kZXgpIHtcbiAgICBjb25zdCBudW1TbGlkZXMgPSB0aGlzLnNsaWRlcy5sZW5ndGg7XG4gICAgY29uc3QgcHJldkluZGV4ID0gKGluZGV4IC0gMSArIG51bVNsaWRlcykgJSBudW1TbGlkZXM7XG4gICAgY29uc3QgbmV4dEluZGV4ID0gKGluZGV4ICsgMSkgJSBudW1TbGlkZXM7XG5cbiAgICB0aGlzLmVsZW1lbnRzLnByZXZCdXR0b24uZmluZCgnLm5hdi1wcm9qZWN0JykudGV4dCh0aGlzLnNsaWRlc1twcmV2SW5kZXhdLnRpdGxlKTtcbiAgICB0aGlzLmVsZW1lbnRzLm5leHRCdXR0b24uZmluZCgnLm5hdi1wcm9qZWN0JykudGV4dCh0aGlzLnNsaWRlc1tuZXh0SW5kZXhdLnRpdGxlKTtcbiAgfVxufVxuXG5yZWdpc3RlcldpZGdldChPRVdfU3RvcnlfUG9ydGZvbGlvLCBcIm9ldy1zdG9yeS1wb3J0Zm9saW9cIik7XG4iXX0=
