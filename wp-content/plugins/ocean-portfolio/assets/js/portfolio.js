(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _classPrivateFieldInitSpec(obj, privateMap, value) { _checkPrivateRedeclaration(obj, privateMap); privateMap.set(obj, value); }
function _checkPrivateRedeclaration(obj, privateCollection) { if (privateCollection.has(obj)) { throw new TypeError("Cannot initialize the same private elements twice on an object"); } }
function _classPrivateFieldGet(receiver, privateMap) { var descriptor = _classExtractFieldDescriptor(receiver, privateMap, "get"); return _classApplyDescriptorGet(receiver, descriptor); }
function _classApplyDescriptorGet(receiver, descriptor) { if (descriptor.get) { return descriptor.get.call(receiver); } return descriptor.value; }
function _classPrivateFieldSet(receiver, privateMap, value) { var descriptor = _classExtractFieldDescriptor(receiver, privateMap, "set"); _classApplyDescriptorSet(receiver, descriptor, value); return value; }
function _classExtractFieldDescriptor(receiver, privateMap, action) { if (!privateMap.has(receiver)) { throw new TypeError("attempted to " + action + " private field on non-instance"); } return privateMap.get(receiver); }
function _classApplyDescriptorSet(receiver, descriptor, value) { if (descriptor.set) { descriptor.set.call(receiver, value); } else { if (!descriptor.writable) { throw new TypeError("attempted to set read only private field"); } descriptor.value = value; } }
var _settings = /*#__PURE__*/new WeakMap();
var OW_Base = /*#__PURE__*/function () {
  function OW_Base() {
    _classCallCheck(this, OW_Base);
    _classPrivateFieldInitSpec(this, _settings, {
      writable: true,
      value: void 0
    });
    _defineProperty(this, "elements", void 0);
    this.onInit();
    this.bindEvents();
  }
  _createClass(OW_Base, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {};
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      return {};
    }
  }, {
    key: "onInit",
    value: function onInit() {
      _classPrivateFieldSet(this, _settings, this.getDefaultSettings());
      this.elements = this.getDefaultElements();
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {}
  }, {
    key: "getSettings",
    value: function getSettings() {
      var key = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (!!key) {
        return _classPrivateFieldGet(this, _settings)[key];
      }
      return _classPrivateFieldGet(this, _settings);
    }
  }, {
    key: "setSettings",
    value: function setSettings() {
      var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      if (!settings) {
        return;
      }
      _classPrivateFieldSet(this, _settings, Object.assign(_classPrivateFieldGet(this, _settings), settings));
    }
  }]);
  return OW_Base;
}();
var _default = OW_Base;
exports["default"] = _default;

},{}],2:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
var _base = _interopRequireDefault(require("./base/base"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _get() { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get.bind(); } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(arguments.length < 3 ? target : receiver); } return desc.value; }; } return _get.apply(this, arguments); }
function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
var OW_Portfolio = /*#__PURE__*/function (_OW_Base) {
  _inherits(OW_Portfolio, _OW_Base);
  var _super = _createSuper(OW_Portfolio);
  function OW_Portfolio() {
    _classCallCheck(this, OW_Portfolio);
    return _super.apply(this, arguments);
  }
  _createClass(OW_Portfolio, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          portfolio: ".portfolio-wrap",
          portfolioMasonry: ".portfolio-entries.masonry-grid .portfolio-wrap",
          portfolioGrid: ".portfolio-entries.isotope-grid .portfolio-wrap",
          linkIcon: ".portfolio-wrap .op-link"
        },
        options: oceanwpLocalize
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        portfolio: document.querySelectorAll(selectors.portfolio),
        portfolioMasonry: document.querySelectorAll(selectors.portfolioMasonry),
        portfolioGrid: document.querySelectorAll(selectors.portfolioGrid),
        linkIcon: document.querySelectorAll(selectors.linkIcon),
        body: document.body
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      _get(_getPrototypeOf(OW_Portfolio.prototype), "onInit", this).call(this);
      this.initMasonry();
      this.initGrid();
      if (this.elements.portfolio.length > 0) {
        this.initLightboxGallery();
      }
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this$elements$linkIc;
      (_this$elements$linkIc = this.elements.linkIcon) === null || _this$elements$linkIc === void 0 ? void 0 : _this$elements$linkIc.forEach(function (link) {
        link.addEventListener("click", function (event) {
          event.stopPropagation();
        });
      });
    }
  }, {
    key: "initMasonry",
    value: function initMasonry() {
      var _this$elements$portfo;
      var options = this.getSettings("options");
      (_this$elements$portfo = this.elements.portfolioMasonry) === null || _this$elements$portfo === void 0 ? void 0 : _this$elements$portfo.forEach(function (portfolio) {
        imagesLoaded(portfolio, function () {
          new Isotope(portfolio, {
            itemSelector: ".portfolio-entry",
            transformsEnabled: true,
            isOriginLeft: options.isRTL ? false : true,
            transitionDuration: "0.4s",
            layoutMode: "masonry"
          });
        });
      });
    }
  }, {
    key: "initGrid",
    value: function initGrid() {
      var _this$elements$portfo2;
      var options = this.getSettings("options");
      (_this$elements$portfo2 = this.elements.portfolioGrid) === null || _this$elements$portfo2 === void 0 ? void 0 : _this$elements$portfo2.forEach(function (portfolio) {
        imagesLoaded(portfolio, function () {
          var layoutMode = portfolio.dataset.layout ? portfolio.dataset.layout : "masonry";
          var portfolioFilter = portfolio.previousElementSibling;
          var portfolioGridIsotope = new Isotope(portfolio, {
            itemSelector: ".portfolio-entry",
            transformsEnabled: true,
            isOriginLeft: options.isRTL ? false : true,
            transitionDuration: "0.4s",
            layoutMode: layoutMode
          });
          if (!!portfolioFilter && portfolioFilter.classList.contains("portfolio-filters")) {
            portfolioFilter.querySelectorAll("a").forEach(function (portfolioFilterLink) {
              portfolioFilterLink.addEventListener("click", function (event) {
                event.preventDefault();
                event.stopPropagation();
                portfolioGridIsotope.arrange({
                  filter: portfolioFilterLink.dataset.filter
                });
                portfolioFilter.querySelectorAll("li").forEach(function (listTag) {
                  listTag.classList.remove("active");
                });
                portfolioFilterLink.parentNode.classList.add("active");
              });
            });
          }
        });
      });
    }
  }, {
    key: "initLightboxGallery",
    value: function initLightboxGallery() {
      this.addPhotoSwipeToDOM();
      var pswpElement = document.querySelector(".pswp");
      var options = this.getSettings("options");
      var openLightbox = function openLightbox(event, portfolio, clickedLightbox) {
        event.preventDefault();
        var filteredLightboxes = Array.from(portfolio.querySelectorAll(".portfolio-lightbox")).filter(function (lightbox) {
          return lightbox.closest(".portfolio-entry").style.display !== 'none';
        });
        var images = filteredLightboxes.map(function (lightbox) {
          var imageSize = lightbox.dataset.size.split("x");
          return {
            src: lightbox.href,
            w: parseInt(imageSize[0], 10),
            h: parseInt(imageSize[1], 10)
          };
        });
        var clickedIndex = filteredLightboxes.indexOf(clickedLightbox);
        var lightboxGallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, images, {
          index: clickedIndex,
          bgOpacity: 0.7,
          showHideOpacity: true,
          shareButtons: [{
            id: "facebook",
            label: options.shareFacebook,
            url: "https://www.facebook.com/sharer/sharer.php?u={{url}}"
          }, {
            id: "twitter",
            label: options.shareTwitter,
            url: "https://twitter.com/intent/tweet?text={{text}}&url={{url}}"
          }, {
            id: "pinterest",
            label: options.sharePinterest,
            url: "http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}"
          }, {
            id: "download",
            label: options.pswpDownload,
            url: "{{raw_image_url}}",
            download: true
          }]
        });
        lightboxGallery.init();
      };
      this.elements.portfolio.forEach(function (portfolio) {
        portfolio.querySelectorAll(".portfolio-lightbox").forEach(function (lightbox) {
          lightbox.addEventListener("click", function (event) {
            return openLightbox(event, portfolio, lightbox);
          });
        });
      });
    }
  }, {
    key: "addPhotoSwipeToDOM",
    value: function addPhotoSwipeToDOM() {
      if (!document.querySelector(".pswp")) {
        this.elements.body.insertAdjacentHTML("beforeend", "\n\n                <div class=\"pswp\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n\n                    <div class=\"pswp__bg\"></div>\n\n                    <div class=\"pswp__scroll-wrap\">\n\n                        <div class=\"pswp__container\">\n                            <div class=\"pswp__item\"></div>\n                            <div class=\"pswp__item\"></div>\n                            <div class=\"pswp__item\"></div>\n                        </div>\n\n                        <div class=\"pswp__ui pswp__ui--hidden\">\n                            <div class=\"pswp__top-bar\">\n\n                                <div class=\"pswp__counter\"></div>\n                                <button class=\"pswp__button pswp__button--close\" title=\"Close (Esc)\"></button>\n                                <button class=\"pswp__button pswp__button--share\" title=\"Share\"></button>\n                                <button class=\"pswp__button pswp__button--fs\" title=\"Toggle fullscreen\"></button>\n                                <button class=\"pswp__button pswp__button--zoom\" title=\"Zoom in/out\"></button>\n\n                                <div class=\"pswp__preloader\">\n                                    <div class=\"pswp__preloader__icn\">\n                                        <div class=\"pswp__preloader__cut\">\n                                            <div class=\"pswp__preloader__donut\"></div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"pswp__share-modal pswp__share-modal--hidden pswp__single-tap\">\n                                <div class=\"pswp__share-tooltip\"></div>\n                            </div>\n                            <button class=\"pswp__button pswp__button--arrow--left\" title=\"Previous (arrow left)\"></button>\n                            <button class=\"pswp__button pswp__button--arrow--right\" title=\"Next (arrow right)\"></button>\n                            <div class=\"pswp__caption\">\n                                <div class=\"pswp__caption__center\"></div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            ");
      }
    }
  }, {
    key: "getImageIndex",
    value: function getImageIndex(figure) {
      var figures = figure.parentNode.children;
      for (var index = 0; index < figures.length; index++) {
        if (figures[index] === figure) {
          return index;
        }
      }
      return 0;
    }
  }]);
  return OW_Portfolio;
}(_base["default"]);
"use strict";
new OW_Portfolio();

},{"./base/base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2Jhc2UvYmFzZS5qcyIsImFzc2V0cy9zcmMvanMvcG9ydGZvbGlvLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDQU0sT0FBTztFQUlULFNBQUEsUUFBQSxFQUFjO0lBQUEsZUFBQSxPQUFBLE9BQUE7SUFBQSwwQkFBQSxPQUFBLFNBQUE7TUFBQSxRQUFBO01BQUEsS0FBQTtJQUFBO0lBQUEsZUFBQTtJQUNWLElBQUksQ0FBQyxNQUFNLENBQUMsQ0FBQztJQUNiLElBQUksQ0FBQyxVQUFVLENBQUMsQ0FBQztFQUNyQjtFQUFDLFlBQUEsQ0FBQSxPQUFBO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLG1CQUFBLEVBQXFCO01BQ2pCLE9BQU8sQ0FBQyxDQUFDO0lBQ2I7RUFBQztJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRUQsU0FBQSxtQkFBQSxFQUFxQjtNQUNqQixPQUFPLENBQUMsQ0FBQztJQUNiO0VBQUM7SUFBQSxHQUFBO0lBQUEsS0FBQSxFQUVELFNBQUEsT0FBQSxFQUFTO01BQ0wscUJBQUEsS0FBSSxFQUFBLFNBQUEsRUFBYSxJQUFJLENBQUMsa0JBQWtCLENBQUMsQ0FBQztNQUMxQyxJQUFJLENBQUMsUUFBUSxHQUFHLElBQUksQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDO0lBQzdDO0VBQUM7SUFBQSxHQUFBO0lBQUEsS0FBQSxFQUVELFNBQUEsV0FBQSxFQUFhLENBQUM7RUFBQztJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRWYsU0FBQSxZQUFBLEVBQXdCO01BQUEsSUFBWixHQUFHLEdBQUEsU0FBQSxDQUFBLE1BQUEsUUFBQSxTQUFBLFFBQUEsU0FBQSxHQUFBLFNBQUEsTUFBRyxJQUFJO01BQ2xCLElBQUksQ0FBQyxDQUFDLEdBQUcsRUFBRTtRQUNQLE9BQU8scUJBQUEsS0FBSSxFQUFBLFNBQUEsRUFBVyxHQUFHLENBQUM7TUFDOUI7TUFFQSxPQUFBLHFCQUFBLENBQU8sSUFBSSxFQUFBLFNBQUE7SUFDZjtFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLFlBQUEsRUFBMkI7TUFBQSxJQUFmLFFBQVEsR0FBQSxTQUFBLENBQUEsTUFBQSxRQUFBLFNBQUEsUUFBQSxTQUFBLEdBQUEsU0FBQSxNQUFHLENBQUMsQ0FBQztNQUNyQixJQUFJLENBQUMsUUFBUSxFQUFFO1FBQ1g7TUFDSjtNQUVBLHFCQUFBLEtBQUksRUFBQSxTQUFBLEVBQWEsTUFBTSxDQUFDLE1BQU0sQ0FBQSxxQkFBQSxDQUFDLElBQUksRUFBQSxTQUFBLEdBQVksUUFBUSxDQUFDO0lBQzVEO0VBQUM7RUFBQSxPQUFBLE9BQUE7QUFBQTtBQUFBLElBQUEsUUFBQSxHQUdVLE9BQU87QUFBQSxPQUFBLGNBQUEsUUFBQTs7Ozs7O0FDekN0QixJQUFBLEtBQUEsR0FBQSxzQkFBQSxDQUFBLE9BQUE7QUFBa0MsU0FBQSx1QkFBQSxHQUFBLFdBQUEsR0FBQSxJQUFBLEdBQUEsQ0FBQSxVQUFBLEdBQUEsR0FBQSxnQkFBQSxHQUFBO0FBQUEsU0FBQSxnQkFBQSxRQUFBLEVBQUEsV0FBQSxVQUFBLFFBQUEsWUFBQSxXQUFBLGVBQUEsU0FBQTtBQUFBLFNBQUEsa0JBQUEsTUFBQSxFQUFBLEtBQUEsYUFBQSxDQUFBLE1BQUEsQ0FBQSxHQUFBLEtBQUEsQ0FBQSxNQUFBLEVBQUEsQ0FBQSxVQUFBLFVBQUEsR0FBQSxLQUFBLENBQUEsQ0FBQSxHQUFBLFVBQUEsQ0FBQSxVQUFBLEdBQUEsVUFBQSxDQUFBLFVBQUEsV0FBQSxVQUFBLENBQUEsWUFBQSx3QkFBQSxVQUFBLEVBQUEsVUFBQSxDQUFBLFFBQUEsU0FBQSxNQUFBLENBQUEsY0FBQSxDQUFBLE1BQUEsRUFBQSxjQUFBLENBQUEsVUFBQSxDQUFBLEdBQUEsR0FBQSxVQUFBO0FBQUEsU0FBQSxhQUFBLFdBQUEsRUFBQSxVQUFBLEVBQUEsV0FBQSxRQUFBLFVBQUEsRUFBQSxpQkFBQSxDQUFBLFdBQUEsQ0FBQSxTQUFBLEVBQUEsVUFBQSxPQUFBLFdBQUEsRUFBQSxpQkFBQSxDQUFBLFdBQUEsRUFBQSxXQUFBLEdBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxXQUFBLGlCQUFBLFFBQUEsbUJBQUEsV0FBQTtBQUFBLFNBQUEsZUFBQSxHQUFBLFFBQUEsR0FBQSxHQUFBLFlBQUEsQ0FBQSxHQUFBLG9CQUFBLE9BQUEsQ0FBQSxHQUFBLGlCQUFBLEdBQUEsR0FBQSxNQUFBLENBQUEsR0FBQTtBQUFBLFNBQUEsYUFBQSxLQUFBLEVBQUEsSUFBQSxRQUFBLE9BQUEsQ0FBQSxLQUFBLGtCQUFBLEtBQUEsa0JBQUEsS0FBQSxNQUFBLElBQUEsR0FBQSxLQUFBLENBQUEsTUFBQSxDQUFBLFdBQUEsT0FBQSxJQUFBLEtBQUEsU0FBQSxRQUFBLEdBQUEsR0FBQSxJQUFBLENBQUEsSUFBQSxDQUFBLEtBQUEsRUFBQSxJQUFBLG9CQUFBLE9BQUEsQ0FBQSxHQUFBLHVCQUFBLEdBQUEsWUFBQSxTQUFBLDREQUFBLElBQUEsZ0JBQUEsTUFBQSxHQUFBLE1BQUEsRUFBQSxLQUFBO0FBQUEsU0FBQSxLQUFBLGVBQUEsT0FBQSxvQkFBQSxPQUFBLENBQUEsR0FBQSxJQUFBLElBQUEsR0FBQSxPQUFBLENBQUEsR0FBQSxDQUFBLElBQUEsYUFBQSxJQUFBLFlBQUEsS0FBQSxNQUFBLEVBQUEsUUFBQSxFQUFBLFFBQUEsUUFBQSxJQUFBLEdBQUEsY0FBQSxDQUFBLE1BQUEsRUFBQSxRQUFBLFFBQUEsSUFBQSxjQUFBLElBQUEsR0FBQSxNQUFBLENBQUEsd0JBQUEsQ0FBQSxJQUFBLEVBQUEsUUFBQSxPQUFBLElBQUEsQ0FBQSxHQUFBLFdBQUEsSUFBQSxDQUFBLEdBQUEsQ0FBQSxJQUFBLENBQUEsU0FBQSxDQUFBLE1BQUEsT0FBQSxNQUFBLEdBQUEsUUFBQSxZQUFBLElBQUEsQ0FBQSxLQUFBLGNBQUEsSUFBQSxDQUFBLEtBQUEsT0FBQSxTQUFBO0FBQUEsU0FBQSxlQUFBLE1BQUEsRUFBQSxRQUFBLFlBQUEs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QyxLQUFLLENBQUMsS0FBSyxNQUFNLEVBQUU7VUFDM0IsT0FBTyxLQUFLO1FBQ2hCO01BQ0o7TUFDQSxPQUFPLENBQUM7SUFDWjtFQUFDO0VBQUEsT0FBQSxZQUFBO0FBQUEsRUE5THNCLGdCQUFPO0FBaU1qQyxZQUFZO0FBQ2IsSUFBSSxZQUFZLENBQUMsQ0FBQyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImNsYXNzIE9XX0Jhc2Uge1xuICAgICNzZXR0aW5ncztcbiAgICBlbGVtZW50cztcblxuICAgIGNvbnN0cnVjdG9yKCkge1xuICAgICAgICB0aGlzLm9uSW5pdCgpO1xuICAgICAgICB0aGlzLmJpbmRFdmVudHMoKTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7fTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIHJldHVybiB7fTtcbiAgICB9XG5cbiAgICBvbkluaXQoKSB7XG4gICAgICAgIHRoaXMuI3NldHRpbmdzID0gdGhpcy5nZXREZWZhdWx0U2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cyA9IHRoaXMuZ2V0RGVmYXVsdEVsZW1lbnRzKCk7XG4gICAgfVxuXG4gICAgYmluZEV2ZW50cygpIHt9XG5cbiAgICBnZXRTZXR0aW5ncyhrZXkgPSBudWxsKSB7XG4gICAgICAgIGlmICghIWtleSkge1xuICAgICAgICAgICAgcmV0dXJuIHRoaXMuI3NldHRpbmdzW2tleV07XG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gdGhpcy4jc2V0dGluZ3M7XG4gICAgfVxuXG4gICAgc2V0U2V0dGluZ3Moc2V0dGluZ3MgPSB7fSkge1xuICAgICAgICBpZiAoIXNldHRpbmdzKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLiNzZXR0aW5ncyA9IE9iamVjdC5hc3NpZ24odGhpcy4jc2V0dGluZ3MsIHNldHRpbmdzKTtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IE9XX0Jhc2U7XG4iLCJpbXBvcnQgT1dfQmFzZSBmcm9tIFwiLi9iYXNlL2Jhc2VcIjtcblxuY2xhc3MgT1dfUG9ydGZvbGlvIGV4dGVuZHMgT1dfQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgcG9ydGZvbGlvOiBcIi5wb3J0Zm9saW8td3JhcFwiLFxuICAgICAgICAgICAgICAgIHBvcnRmb2xpb01hc29ucnk6IFwiLnBvcnRmb2xpby1lbnRyaWVzLm1hc29ucnktZ3JpZCAucG9ydGZvbGlvLXdyYXBcIixcbiAgICAgICAgICAgICAgICBwb3J0Zm9saW9HcmlkOiBcIi5wb3J0Zm9saW8tZW50cmllcy5pc290b3BlLWdyaWQgLnBvcnRmb2xpby13cmFwXCIsXG4gICAgICAgICAgICAgICAgbGlua0ljb246IFwiLnBvcnRmb2xpby13cmFwIC5vcC1saW5rXCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgb3B0aW9uczogb2NlYW53cExvY2FsaXplLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHBvcnRmb2xpbzogZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMucG9ydGZvbGlvKSxcbiAgICAgICAgICAgIHBvcnRmb2xpb01hc29ucnk6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLnBvcnRmb2xpb01hc29ucnkpLFxuICAgICAgICAgICAgcG9ydGZvbGlvR3JpZDogZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMucG9ydGZvbGlvR3JpZCksXG4gICAgICAgICAgICBsaW5rSWNvbjogZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMubGlua0ljb24pLFxuICAgICAgICAgICAgYm9keTogZG9jdW1lbnQuYm9keSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCgpO1xuICAgICAgICB0aGlzLmluaXRNYXNvbnJ5KCk7XG4gICAgICAgIHRoaXMuaW5pdEdyaWQoKTtcbiAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMucG9ydGZvbGlvLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICAgIHRoaXMuaW5pdExpZ2h0Ym94R2FsbGVyeSgpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgYmluZEV2ZW50cygpIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5saW5rSWNvbj8uZm9yRWFjaCgobGluaykgPT4ge1xuICAgICAgICAgICAgbGluay5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGV2ZW50KSA9PiB7XG4gICAgICAgICAgICAgICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgaW5pdE1hc29ucnkoKSB7XG4gICAgICAgIGNvbnN0IG9wdGlvbnMgPSB0aGlzLmdldFNldHRpbmdzKFwib3B0aW9uc1wiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5wb3J0Zm9saW9NYXNvbnJ5Py5mb3JFYWNoKChwb3J0Zm9saW8pID0+IHtcbiAgICAgICAgICAgIGltYWdlc0xvYWRlZChwb3J0Zm9saW8sICgpID0+IHtcbiAgICAgICAgICAgICAgICBuZXcgSXNvdG9wZShwb3J0Zm9saW8sIHtcbiAgICAgICAgICAgICAgICAgICAgaXRlbVNlbGVjdG9yOiBcIi5wb3J0Zm9saW8tZW50cnlcIixcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3Jtc0VuYWJsZWQ6IHRydWUsXG4gICAgICAgICAgICAgICAgICAgIGlzT3JpZ2luTGVmdDogb3B0aW9ucy5pc1JUTCA/IGZhbHNlIDogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNpdGlvbkR1cmF0aW9uOiBcIjAuNHNcIixcbiAgICAgICAgICAgICAgICAgICAgbGF5b3V0TW9kZTogXCJtYXNvbnJ5XCIsXG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgaW5pdEdyaWQoKSB7XG4gICAgICAgIGNvbnN0IG9wdGlvbnMgPSB0aGlzLmdldFNldHRpbmdzKFwib3B0aW9uc1wiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5wb3J0Zm9saW9HcmlkPy5mb3JFYWNoKChwb3J0Zm9saW8pID0+IHtcbiAgICAgICAgICAgIGltYWdlc0xvYWRlZChwb3J0Zm9saW8sICgpID0+IHtcbiAgICAgICAgICAgICAgICBjb25zdCBsYXlvdXRNb2RlID0gcG9ydGZvbGlvLmRhdGFzZXQubGF5b3V0ID8gcG9ydGZvbGlvLmRhdGFzZXQubGF5b3V0IDogXCJtYXNvbnJ5XCI7XG4gICAgICAgICAgICAgICAgY29uc3QgcG9ydGZvbGlvRmlsdGVyID0gcG9ydGZvbGlvLnByZXZpb3VzRWxlbWVudFNpYmxpbmc7XG4gICAgICAgICAgICAgICAgY29uc3QgcG9ydGZvbGlvR3JpZElzb3RvcGUgPSBuZXcgSXNvdG9wZShwb3J0Zm9saW8sIHtcbiAgICAgICAgICAgICAgICAgICAgaXRlbVNlbGVjdG9yOiBcIi5wb3J0Zm9saW8tZW50cnlcIixcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3Jtc0VuYWJsZWQ6IHRydWUsXG4gICAgICAgICAgICAgICAgICAgIGlzT3JpZ2luTGVmdDogb3B0aW9ucy5pc1JUTCA/IGZhbHNlIDogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNpdGlvbkR1cmF0aW9uOiBcIjAuNHNcIixcbiAgICAgICAgICAgICAgICAgICAgbGF5b3V0TW9kZTogbGF5b3V0TW9kZSxcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGlmICghIXBvcnRmb2xpb0ZpbHRlciAmJiBwb3J0Zm9saW9GaWx0ZXIuY2xhc3NMaXN0LmNvbnRhaW5zKFwicG9ydGZvbGlvLWZpbHRlcnNcIikpIHtcbiAgICAgICAgICAgICAgICAgICAgcG9ydGZvbGlvRmlsdGVyLnF1ZXJ5U2VsZWN0b3JBbGwoXCJhXCIpLmZvckVhY2goKHBvcnRmb2xpb0ZpbHRlckxpbmspID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHBvcnRmb2xpb0ZpbHRlckxpbmsuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIChldmVudCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBwb3J0Zm9saW9HcmlkSXNvdG9wZS5hcnJhbmdlKHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZmlsdGVyOiBwb3J0Zm9saW9GaWx0ZXJMaW5rLmRhdGFzZXQuZmlsdGVyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBwb3J0Zm9saW9GaWx0ZXIucXVlcnlTZWxlY3RvckFsbChcImxpXCIpLmZvckVhY2goKGxpc3RUYWcpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbGlzdFRhZy5jbGFzc0xpc3QucmVtb3ZlKFwiYWN0aXZlXCIpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcG9ydGZvbGlvRmlsdGVyTGluay5wYXJlbnROb2RlLmNsYXNzTGlzdC5hZGQoXCJhY3RpdmVcIik7XG4gICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGluaXRMaWdodGJveEdhbGxlcnkoKSB7XG4gICAgICAgIHRoaXMuYWRkUGhvdG9Td2lwZVRvRE9NKCk7XG4gICAgICAgIGNvbnN0IHBzd3BFbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcIi5wc3dwXCIpO1xuICAgICAgICBjb25zdCBvcHRpb25zID0gdGhpcy5nZXRTZXR0aW5ncyhcIm9wdGlvbnNcIik7XG5cbiAgICAgICAgY29uc3Qgb3BlbkxpZ2h0Ym94ID0gKGV2ZW50LCBwb3J0Zm9saW8sIGNsaWNrZWRMaWdodGJveCkgPT4ge1xuICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIGNvbnN0IGZpbHRlcmVkTGlnaHRib3hlcyA9IEFycmF5LmZyb20ocG9ydGZvbGlvLnF1ZXJ5U2VsZWN0b3JBbGwoXCIucG9ydGZvbGlvLWxpZ2h0Ym94XCIpKVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAuZmlsdGVyKGxpZ2h0Ym94ID0+IGxpZ2h0Ym94LmNsb3Nlc3QoXCIucG9ydGZvbGlvLWVudHJ5XCIpLnN0eWxlLmRpc3BsYXkgIT09ICdub25lJyk7XG4gICAgICAgICAgICBjb25zdCBpbWFnZXMgPSBmaWx0ZXJlZExpZ2h0Ym94ZXMubWFwKGxpZ2h0Ym94ID0+IHtcbiAgICAgICAgICAgICAgICBjb25zdCBpbWFnZVNpemUgPSBsaWdodGJveC5kYXRhc2V0LnNpemUuc3BsaXQoXCJ4XCIpO1xuICAgICAgICAgICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICAgICAgICAgIHNyYzogbGlnaHRib3guaHJlZixcbiAgICAgICAgICAgICAgICAgICAgdzogcGFyc2VJbnQoaW1hZ2VTaXplWzBdLCAxMCksXG4gICAgICAgICAgICAgICAgICAgIGg6IHBhcnNlSW50KGltYWdlU2l6ZVsxXSwgMTApXG4gICAgICAgICAgICAgICAgfTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBjb25zdCBjbGlja2VkSW5kZXggPSBmaWx0ZXJlZExpZ2h0Ym94ZXMuaW5kZXhPZihjbGlja2VkTGlnaHRib3gpO1xuXG4gICAgICAgICAgICBjb25zdCBsaWdodGJveEdhbGxlcnkgPSBuZXcgUGhvdG9Td2lwZShwc3dwRWxlbWVudCwgUGhvdG9Td2lwZVVJX0RlZmF1bHQsIGltYWdlcywge1xuICAgICAgICAgICAgICAgIGluZGV4OiBjbGlja2VkSW5kZXgsXG4gICAgICAgICAgICAgICAgYmdPcGFjaXR5OiAwLjcsXG4gICAgICAgICAgICAgICAgc2hvd0hpZGVPcGFjaXR5OiB0cnVlLFxuICAgICAgICAgICAgICAgIHNoYXJlQnV0dG9uczogW1xuICAgICAgICAgICAgICAgICAgICB7aWQ6IFwiZmFjZWJvb2tcIiwgbGFiZWw6IG9wdGlvbnMuc2hhcmVGYWNlYm9vaywgdXJsOiBcImh0dHBzOi8vd3d3LmZhY2Vib29rLmNvbS9zaGFyZXIvc2hhcmVyLnBocD91PXt7dXJsfX1cIn0sXG4gICAgICAgICAgICAgICAgICAgIHtpZDogXCJ0d2l0dGVyXCIsIGxhYmVsOiBvcHRpb25zLnNoYXJlVHdpdHRlciwgdXJsOiBcImh0dHBzOi8vdHdpdHRlci5jb20vaW50ZW50L3R3ZWV0P3RleHQ9e3t0ZXh0fX0mdXJsPXt7dXJsfX1cIn0sXG4gICAgICAgICAgICAgICAgICAgIHtpZDogXCJwaW50ZXJlc3RcIiwgbGFiZWw6IG9wdGlvbnMuc2hhcmVQaW50ZXJlc3QsIHVybDogXCJodHRwOi8vd3d3LnBpbnRlcmVzdC5jb20vcGluL2NyZWF0ZS9idXR0b24vP3VybD17e3VybH19Jm1lZGlhPXt7aW1hZ2VfdXJsfX0mZGVzY3JpcHRpb249e3t0ZXh0fX1cIn0sXG4gICAgICAgICAgICAgICAgICAgIHtpZDogXCJkb3dubG9hZFwiLCBsYWJlbDogb3B0aW9ucy5wc3dwRG93bmxvYWQsIHVybDogXCJ7e3Jhd19pbWFnZV91cmx9fVwiLCBkb3dubG9hZDogdHJ1ZX0sXG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIGxpZ2h0Ym94R2FsbGVyeS5pbml0KCk7XG4gICAgICAgIH07XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5wb3J0Zm9saW8uZm9yRWFjaCgocG9ydGZvbGlvKSA9PiB7XG4gICAgICAgICAgICBwb3J0Zm9saW8ucXVlcnlTZWxlY3RvckFsbChcIi5wb3J0Zm9saW8tbGlnaHRib3hcIikuZm9yRWFjaCgobGlnaHRib3gpID0+IHtcbiAgICAgICAgICAgICAgICBsaWdodGJveC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGV2ZW50KSA9PiBvcGVuTGlnaHRib3goZXZlbnQsIHBvcnRmb2xpbywgbGlnaHRib3gpKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhZGRQaG90b1N3aXBlVG9ET00oKSB7XG4gICAgICAgIGlmICghZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcIi5wc3dwXCIpKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmJvZHkuaW5zZXJ0QWRqYWNlbnRIVE1MKFwiYmVmb3JlZW5kXCIsIGBcblxuICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJwc3dwXCIgdGFiaW5kZXg9XCItMVwiIHJvbGU9XCJkaWFsb2dcIiBhcmlhLWhpZGRlbj1cInRydWVcIj5cblxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fYmdcIj48L2Rpdj5cblxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fc2Nyb2xsLXdyYXBcIj5cblxuICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInBzd3BfX2NvbnRhaW5lclwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJwc3dwX19pdGVtXCI+PC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInBzd3BfX2l0ZW1cIj48L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9faXRlbVwiPjwvZGl2PlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJwc3dwX191aSBwc3dwX191aS0taGlkZGVuXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInBzd3BfX3RvcC1iYXJcIj5cblxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fY291bnRlclwiPjwvZGl2PlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YnV0dG9uIGNsYXNzPVwicHN3cF9fYnV0dG9uIHBzd3BfX2J1dHRvbi0tY2xvc2VcIiB0aXRsZT1cIkNsb3NlIChFc2MpXCI+PC9idXR0b24+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxidXR0b24gY2xhc3M9XCJwc3dwX19idXR0b24gcHN3cF9fYnV0dG9uLS1zaGFyZVwiIHRpdGxlPVwiU2hhcmVcIj48L2J1dHRvbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGJ1dHRvbiBjbGFzcz1cInBzd3BfX2J1dHRvbiBwc3dwX19idXR0b24tLWZzXCIgdGl0bGU9XCJUb2dnbGUgZnVsbHNjcmVlblwiPjwvYnV0dG9uPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YnV0dG9uIGNsYXNzPVwicHN3cF9fYnV0dG9uIHBzd3BfX2J1dHRvbi0tem9vbVwiIHRpdGxlPVwiWm9vbSBpbi9vdXRcIj48L2J1dHRvbj5cblxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fcHJlbG9hZGVyXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fcHJlbG9hZGVyX19pY25cIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fcHJlbG9hZGVyX19jdXRcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cInBzd3BfX3ByZWxvYWRlcl9fZG9udXRcIj48L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fc2hhcmUtbW9kYWwgcHN3cF9fc2hhcmUtbW9kYWwtLWhpZGRlbiBwc3dwX19zaW5nbGUtdGFwXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJwc3dwX19zaGFyZS10b29sdGlwXCI+PC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGJ1dHRvbiBjbGFzcz1cInBzd3BfX2J1dHRvbiBwc3dwX19idXR0b24tLWFycm93LS1sZWZ0XCIgdGl0bGU9XCJQcmV2aW91cyAoYXJyb3cgbGVmdClcIj48L2J1dHRvbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YnV0dG9uIGNsYXNzPVwicHN3cF9fYnV0dG9uIHBzd3BfX2J1dHRvbi0tYXJyb3ctLXJpZ2h0XCIgdGl0bGU9XCJOZXh0IChhcnJvdyByaWdodClcIj48L2J1dHRvbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fY2FwdGlvblwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwicHN3cF9fY2FwdGlvbl9fY2VudGVyXCI+PC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICBgKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIGdldEltYWdlSW5kZXgoZmlndXJlKSB7XG4gICAgICAgIGNvbnN0IGZpZ3VyZXMgPSBmaWd1cmUucGFyZW50Tm9kZS5jaGlsZHJlbjtcbiAgICAgICAgZm9yIChsZXQgaW5kZXggPSAwOyBpbmRleCA8IGZpZ3VyZXMubGVuZ3RoOyBpbmRleCsrKSB7XG4gICAgICAgICAgICBpZiAoZmlndXJlc1tpbmRleF0gPT09IGZpZ3VyZSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBpbmRleDtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gMDtcbiAgICB9XG59XG5cbihcInVzZSBzdHJpY3RcIik7XG5uZXcgT1dfUG9ydGZvbGlvKCk7XG4iXX0=
