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
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
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
var OW_FullScreen = /*#__PURE__*/function (_OW_Base) {
  _inherits(OW_FullScreen, _OW_Base);
  var _super = _createSuper(OW_FullScreen);
  function OW_FullScreen() {
    _classCallCheck(this, OW_FullScreen);
    return _super.apply(this, arguments);
  }
  _createClass(OW_FullScreen, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
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

      var elSectionsWrapper = "#oceanwp-fullpage .elementor-section-wrap",
        elSections = "#oceanwp-fullpage .elementor-section-wrap > .elementor-section",
        elTopSections = "#oceanwp-fullpage .elementor-top-section";
      var container = elementorFrontend.config.experimentalFeatures.container;
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
          topSections: elTopSections
        },
        options: oceanwpLocalize
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        sectionsWrapper: document.querySelector(selectors.sectionsWrapper),
        sections: document.querySelectorAll(selectors.sections),
        topSections: document.querySelectorAll(selectors.topSections),
        body: document.body
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      _get(_getPrototypeOf(OW_FullScreen.prototype), "onInit", this).call(this);
      if (this.isElementorEditorPage()) {
        return;
      }
      this.wrapSections();
      this.initFullPage();
      this.bindModalEvents();
    }
  }, {
    key: "wrapSections",
    value: function wrapSections() {
      var anchors = new Set();
      if (this.elements.sections) {
        this.elements.sections.forEach(function (section, index) {
          if (!section.id) {
            var sectionId = "fs-section-".concat(index);
            while (document.getElementById(sectionId) || anchors.has(sectionId)) {
              index++;
              sectionId = "fs-section-".concat(index);
            }
            section.id = sectionId;
          }
          anchors.add(section.id);
          var sectionWrapperId = "#".concat(section.id);
          section.removeAttribute("id");
          section.outerHTML = "<div id=\"".concat(sectionWrapperId, "\" class=\"wrap-section\" data-anchor=\"").concat(section.id, "\">").concat(section.outerHTML, "</div>");
        });
      }
    }
  }, {
    key: "initFullPage",
    value: function initFullPage() {
      var selectors = this.getSettings("selectors");
      new fullpage(selectors.sectionsWrapper, this.getFullPageOptions());
    }
  }, {
    key: "getFullPageOptions",
    value: function getFullPageOptions() {
      var self = this;
      var options = this.getSettings("options");
      var selectors = this.getSettings("selectors");
      var sections = document.querySelectorAll("".concat(selectors.sectionsWrapper, " > .wrap-section"));
      var fullPageOptions = {
        licenseKey: "2802F989-785845A8-B0E376B6-EA1BD751",
        sectionSelector: ".wrap-section",
        scrollOverflow: true,
        v2compatible: true,
        onLeave: function onLeave(index, nextIndex, direction) {
          var nextSection = sections[nextIndex - 1];
          if (direction === "down" || direction === "up") {
            self.setFullPageNavColor(nextSection);
          }
        },
        afterLoad: function afterLoad(anchorLink, index) {
          var nextSection = this;
          if (nextSection.classList.contains("active")) {
            self.setFullPageNavColor(nextSection);
            var sectionLoadedEvent = new Event('sectionLoaded');
            document.dispatchEvent(sectionLoadedEvent);
          }
        },
        anchors: [] // Reset the anchors array to ensure it's not causing issues
      };

      // Scrolling speed
      if (("0" != options.ofcSpeed || "700" != options.ofcSpeed) && "" != options.ofcSpeed) {
        fullPageOptions.scrollingSpeed = options.ofcSpeed;
      }

      // Responsive
      if ("0" != options.ofcRes && "" != options.ofcRes) {
        fullPageOptions.responsiveWidth = options.ofcRes;
      }

      // If navigation
      if ("enable" == options.ofcNav) {
        // Anchors and tooltips
        var anchors = [];
        var navTooltips = [];
        sections.forEach(function (topSection) {
          var sectionID = topSection.id.replace("#", "");
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
  }, {
    key: "setFullPageNavColor",
    value: function setFullPageNavColor(section) {
      var _iterator = _createForOfIteratorHelper(section.children),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var sectionChild = _step.value;
          this.elements.body.classList.remove("ofc-light-nav");
          this.elements.body.classList.remove("ofc-dark-nav");
          var children = sectionChild.children;
          var lightSection = Array.from(children).some(function (_ref) {
            var classList = _ref.classList;
            return classList.contains("elementor-top-section") && classList.contains("light");
          });
          if (lightSection) {
            this.elements.body.classList.add("ofc-light-nav");
            break;
          }
          var darkSection = Array.from(children).some(function (_ref2) {
            var classList = _ref2.classList;
            return classList.contains("elementor-top-section") && classList.contains("dark");
          });
          if (darkSection) {
            this.elements.body.classList.add("ofc-dark-nav");
            break;
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  }, {
    key: "bindModalEvents",
    value: function bindModalEvents() {
      document.querySelectorAll('#oceanwp-fullpage .omw-open-modal').forEach(function (linkElement) {
        var eventInitOWM = new CustomEvent("init-omw-for-element", {
          bubbles: true,
          cancelable: true
        });
        linkElement.dispatchEvent(eventInitOWM);
      });
    }
  }, {
    key: "isElementorEditorPage",
    value: function isElementorEditorPage() {
      return this.elements.body.classList.contains("elementor-editor-active");
    }
  }]);
  return OW_FullScreen;
}(_base["default"]);
"use script";
window.addEventListener("DOMContentLoaded", function () {
  new OW_FullScreen();
});

},{"./base/base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2Jhc2UvYmFzZS5qcyIsImFzc2V0cy9zcmMvanMvZnVsbC1zY3JlZW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUNBTSxPQUFPO0VBSVQsU0FBQSxRQUFBLEVBQWM7SUFBQSxlQUFBLE9BQUEsT0FBQTtJQUFBLDBCQUFBLE9BQUEsU0FBQTtNQUFBLFFBQUE7TUFBQSxLQUFBO0lBQUE7SUFBQSxlQUFBO0lBQ1YsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDO0lBQ2IsSUFBSSxDQUFDLFVBQVUsQ0FBQyxDQUFDO0VBQ3JCO0VBQUMsWUFBQSxDQUFBLE9BQUE7SUFBQSxHQUFBO0lBQUEsS0FBQSxFQUVELFNBQUEsbUJBQUEsRUFBcUI7TUFDakIsT0FBTyxDQUFDLENBQUM7SUFDYjtFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLG1CQUFBLEVBQXFCO01BQ2pCLE9BQU8sQ0FBQyxDQUFDO0lBQ2I7RUFBQztJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRUQsU0FBQSxPQUFBLEVBQVM7TUFDTCxxQkFBQSxLQUFJLEVBQUEsU0FBQSxFQUFhLElBQUksQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDO01BQzFDLElBQUksQ0FBQyxRQUFRLEdBQUcsSUFBSSxDQUFDLGtCQUFrQixDQUFDLENBQUM7SUFDN0M7RUFBQztJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRUQsU0FBQSxXQUFBLEVBQWEsQ0FBQztFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFZixTQUFBLFlBQUEsRUFBd0I7TUFBQSxJQUFaLEdBQUcsR0FBQSxTQUFBLENBQUEsTUFBQSxRQUFBLFNBQUEsUUFBQSxTQUFBLEdBQUEsU0FBQSxNQUFHLElBQUk7TUFDbEIsSUFBSSxDQUFDLENBQUMsR0FBRyxFQUFFO1FBQ1AsT0FBTyxxQkFBQSxLQUFJLEVBQUEsU0FB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QSxJQUFBLEdBQUEsQ0FBQSxDQUFBLFVBQUEsSUFBQTtBQUFBLFNBQUEsZ0JBQUEsUUFBQSxFQUFBLFdBQUEsVUFBQSxRQUFBLFlBQUEsV0FBQSxlQUFBLFNBQUE7QUFBQSxTQUFBLGtCQUFBLE1BQUEsRUFBQSxLQUFBLGFBQUEsQ0FBQSxNQUFBLENBQUEsR0FBQSxLQUFBLENBQUEsTUFBQSxFQUFBLENBQUEsVUFBQSxVQUFBLEdBQUEsS0FBQSxDQUFBLENBQUEsR0FBQSxVQUFBLENBQUEsVUFBQSxHQUFBLFVBQUEsQ0FBQSxVQUFBLFdBQUEsVUFBQSxDQUFBLFlBQUEsd0JBQUEsVUFBQSxFQUFBLFVBQUEsQ0FBQSxRQUFBLFNBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxNQUFBLEVBQUEsY0FBQSxDQUFBLFVBQUEsQ0FBQSxHQUFBLEdBQUEsVUFBQTtBQUFBLFNBQUEsYUFBQSxXQUFBLEVBQUEsVUFBQSxFQUFBLFdBQUEsUUFBQSxVQUFBLEVBQUEsaUJBQUEsQ0FBQSxXQUFBLENBQUEsU0FBQSxFQUFBLFVBQUEsT0FBQSxXQUFBLEVBQUEsaUJBQUEsQ0FBQSxXQUFBLEVBQUEsV0FBQSxHQUFBLE1BQUEsQ0FBQSxjQUFBLENBQUEsV0FBQSxpQkFBQSxRQUFBLG1CQUFBLFdBQUE7QUFBQSxTQUFBLGVBQUEsR0FBQSxRQUFBLEdBQUEsR0FBQSxZQUFBLENBQUEsR0FBQSxvQkFBQSxPQUFBLENBQUEsR0FBQSxpQkFBQSxHQUFBLEdBQUEsTUFBQSxDQUFBLEdBQUE7QUFBQSxTQUFBLGFBQUEsS0FBQSxFQUFBLElBQUEsUUFBQSxPQUFBLENBQUEsS0FBQSxrQkFBQSxLQUFBLGtCQUFBLEtBQUEsTUFBQSxJQUFBLEdBQUEsS0FBQSxDQUFBLE1BQUEsQ0FBQSxXQUFBLE9BQUEsSUFBQSxLQUFBLFNBQUEsUUFBQSxHQUFBLEdBQUEsSUFBQSxDQUFBLElBQUEsQ0FBQSxLQUFBLEVBQUEsSUFBQSxvQkFBQSxPQUFBLENBQUEsR0FBQSx1QkFBQSxHQUFBLFlBQUEsU0FBQSw0REFBQSxJQUFBLGdCQUFBLE1BQUEsR0FBQSxNQUFBLEVBQUEsS0FBQTtBQUFBLFNBQUEsS0FBQSxlQUFBLE9BQUEsb0JBQUEsT0FBQSxDQUFBLEdBQUEsSUFBQSxJQUFBLEdBQUEsT0FBQSxDQUFBLEdBQUEsQ0FBQSxJQUFBLGFBQUEsSUFBQSxZQUFBLEtBQUEsTUFBQSxFQUFBLFFBQUEsRUFBQSxRQUFBLFFBQUEsSUFBQSxHQUFBLGNBQUEsQ0FBQSxNQUFBLEVBQUEsUUFBQSxRQUFBLElBQUEsY0FBQSxJQUFBLEdBQUEsTUFBQSxDQUFBLHdCQUFBLENBQUEsSUFBQSxFQUFBLFFBQUEsT0FBQSxJQUFBLENBQUEsR0FBQSxXQUFBLElBQUEsQ0FBQSxHQUFBLENBQUEsSUFBQSxDQUFBLFNBQUEsQ0FBQSxNQUFBLE9BQUEsTUFBQSxHQUFBLFFBQUEsWUFBQSxJQUFBLENBQUEsS0FBQSxjQUFBLElBQUEsQ0FBQSxLQUFBLE9BQUEsU0FBQTtBQUFBLFNBQUEsZUFBQSxNQUFBLEVBQUEsUUFBQSxZQUFBLE1BQUEsQ0FBQSxTQUFBLENBQUEsY0FBQSxDQUFBLElBQUEsQ0FBQSxNQUFBLEVBQUEsUUFBQSxLQUFBLE1BQUEsR0FBQSxlQUFBLENBQUEsTUFBQSxPQUFBLE1BQUEsMkJBQUEsTUFBQTtBQUFBLFNBQUEsVUFBQSxRQUFBLEVBQUEsVUFBQSxlQUFBLFVBQUEsbUJBQUEsVUFBQSx1QkFBQSxTQUFBLDBEQUFBLFFBQUEsQ0FBQSxTQUFBLEdBQUEsTUFBQSxDQUFBLE1BQUEsQ0FBQSxVQUFBLElBQUEsVUFBQSxDQUFBLFNBQUEsSUFBQSxXQUFBLElBQUEsS0FBQSxFQUFBLFFBQUEsRUFBQSxRQUFBLFFBQUEsWUFBQSxhQUFBLE1BQUEsQ0FBQSxjQUFBLENBQUEsUUFBQSxpQkFBQSxRQUFBLGdCQUFBLFVBQUEsRUFBQSxlQUFBLENBQUEsUUFBQSxFQUFBLFVBQUE7QUFBQSxTQUFBLGdCQUFBLENBQUEsRUFBQSxDQUFBLElBQUEsZUFBQSxHQUFBLE1BQUEsQ0FBQSxjQUFBLEdBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxJQUFBLGNBQUEsZ0JBQUEsQ0FB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RCxTQUFBLHNCQUFBLEVBQXdCO01BQ3RCLE9BQU8sSUFBSSxDQUFDLFFBQVEsQ0FBQyxJQUFJLENBQUMsU0FBUyxDQUFDLFFBQVEsQ0FBQyx5QkFBeUIsQ0FBQztJQUN6RTtFQUFDO0VBQUEsT0FBQSxhQUFBO0FBQUEsRUExTnlCLGdCQUFPO0FBNk5sQyxZQUFZO0FBQ2IsTUFBTSxDQUFDLGdCQUFnQixDQUFDLGtCQUFrQixFQUFFLFlBQU07RUFDaEQsSUFBSSxhQUFhLENBQUMsQ0FBQztBQUNyQixDQUFDLENBQUMiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJjbGFzcyBPV19CYXNlIHtcbiAgICAjc2V0dGluZ3M7XG4gICAgZWxlbWVudHM7XG5cbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5vbkluaXQoKTtcbiAgICAgICAgdGhpcy5iaW5kRXZlbnRzKCk7XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgb25Jbml0KCkge1xuICAgICAgICB0aGlzLiNzZXR0aW5ncyA9IHRoaXMuZ2V0RGVmYXVsdFNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMgPSB0aGlzLmdldERlZmF1bHRFbGVtZW50cygpO1xuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7fVxuXG4gICAgZ2V0U2V0dGluZ3Moa2V5ID0gbnVsbCkge1xuICAgICAgICBpZiAoISFrZXkpIHtcbiAgICAgICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5nc1trZXldO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuI3NldHRpbmdzO1xuICAgIH1cblxuICAgIHNldFNldHRpbmdzKHNldHRpbmdzID0ge30pIHtcbiAgICAgICAgaWYgKCFzZXR0aW5ncykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSBPYmplY3QuYXNzaWduKHRoaXMuI3NldHRpbmdzLCBzZXR0aW5ncyk7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBPV19CYXNlO1xuIiwiaW1wb3J0IE9XX0Jhc2UgZnJvbSBcIi4vYmFzZS9iYXNlXCI7XG5cbmNsYXNzIE9XX0Z1bGxTY3JlZW4gZXh0ZW5kcyBPV19CYXNlIHtcblxuICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG5cbiAgICAvLyBsZXQgZWxTZWN0aW9uc1dyYXBwZXIgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lbGVtZW50b3Itc2VjdGlvbi13cmFwXCIsXG4gICAgLy8gICAgIGVsU2VjdGlvbnMgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lbGVtZW50b3Itc2VjdGlvbi13cmFwID4gLmVsZW1lbnRvci1zZWN0aW9uXCIsXG4gICAgLy8gICAgIGVsVG9wU2VjdGlvbnMgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lbGVtZW50b3ItdG9wLXNlY3Rpb25cIjtcblxuICAgIC8vIGlmICggZWxlbWVudG9yRnJvbnRlbmQuY29uZmlnLmV4cGVyaW1lbnRhbEZlYXR1cmVzLmVfZG9tX29wdGltaXphdGlvbiAmJiAhIGVsZW1lbnRvckZyb250ZW5kLmNvbmZpZy5leHBlcmltZW50YWxGZWF0dXJlcy5jb250YWluZXIgKSB7XG4gICAgLy8gICBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvclwiXG4gICAgLy8gICBlbFNlY3Rpb25zID0gXCIjb2NlYW53cC1mdWxscGFnZSAuZWxlbWVudG9yID4gLmVsZW1lbnRvci1zZWN0aW9uXCJcbiAgICAvLyAgIGVsVG9wU2VjdGlvbnMgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lbGVtZW50b3ItdG9wLXNlY3Rpb25cIlxuICAgIC8vIH0gZWxzZSBpZiAoICEgZWxlbWVudG9yRnJvbnRlbmQuY29uZmlnLmV4cGVyaW1lbnRhbEZlYXR1cmVzLmVfZG9tX29wdGltaXphdGlvbiAmJiAhIGVsZW1lbnRvckZyb250ZW5kLmNvbmZpZy5leHBlcmltZW50YWxGZWF0dXJlcy5jb250YWluZXIgKSB7XG4gICAgLy8gICBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvclwiXG4gICAgLy8gICBlbFNlY3Rpb25zID0gXCIjb2NlYW53cC1mdWxscGFnZSAuZWxlbWVudG9yID4gLmVsZW1lbnRvci1zZWN0aW9uXCJcbiAgICAvLyAgIGVsVG9wU2VjdGlvbnMgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lbGVtZW50b3ItdG9wLXNlY3Rpb25cIlxuICAgIC8vIH0gZWxzZSBpZiAoIGVsZW1lbnRvckZyb250ZW5kLmNvbmZpZy5leHBlcmltZW50YWxGZWF0dXJlcy5jb250YWluZXIgKSB7XG4gICAgLy8gICBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvclwiXG4gICAgLy8gICBlbFNlY3Rpb25zID0gXCIjb2NlYW53cC1mdWxscGFnZSAuZWxlbWVudG9yID4gLmVsZW1lbnRvci1lbGVtZW50XCJcbiAgICAvLyAgIGVsVG9wU2VjdGlvbnMgPSBcIiNvY2VhbndwLWZ1bGxwYWdlIC5lLWZsZXhcIlxuICAgIC8vIH1cblxuICAgIGxldCBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvci1zZWN0aW9uLXdyYXBcIixcbiAgICAgICAgZWxTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvci1zZWN0aW9uLXdyYXAgPiAuZWxlbWVudG9yLXNlY3Rpb25cIixcbiAgICAgICAgZWxUb3BTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvci10b3Atc2VjdGlvblwiO1xuXG4gICAgY29uc3QgeyBjb250YWluZXIgfSA9IGVsZW1lbnRvckZyb250ZW5kLmNvbmZpZy5leHBlcmltZW50YWxGZWF0dXJlcztcblxuICAgIGlmICghY29udGFpbmVyKSB7XG4gICAgICBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvclwiO1xuICAgICAgZWxTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvciA+IC5lbGVtZW50b3Itc2VjdGlvblwiO1xuICAgICAgZWxUb3BTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvci10b3Atc2VjdGlvblwiO1xuICAgIH0gZWxzZSBpZiAoY29udGFpbmVyKSB7XG4gICAgICBlbFNlY3Rpb25zV3JhcHBlciA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvclwiO1xuICAgICAgZWxTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmVsZW1lbnRvciA+IC5lbGVtZW50b3ItZWxlbWVudFwiO1xuICAgICAgZWxUb3BTZWN0aW9ucyA9IFwiI29jZWFud3AtZnVsbHBhZ2UgLmUtZmxleFwiO1xuICAgIH1cblxuXG4gICAgcmV0dXJuIHtcbiAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICBzZWN0aW9uc1dyYXBwZXI6IGVsU2VjdGlvbnNXcmFwcGVyLFxuICAgICAgICBzZWN0aW9uczogZWxTZWN0aW9ucyxcbiAgICAgICAgdG9wU2VjdGlvbnM6IGVsVG9wU2VjdGlvbnMsXG4gICAgICB9LFxuICAgICAgb3B0aW9uczogb2NlYW53cExvY2FsaXplLFxuICAgIH07XG4gIH1cblxuICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgIHJldHVybiB7XG4gICAgICBzZWN0aW9uc1dyYXBwZXI6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnNlY3Rpb25zV3JhcHBlciksXG4gICAgICBzZWN0aW9uczogZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuc2VjdGlvbnMpLFxuICAgICAgdG9wU2VjdGlvbnM6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLnRvcFNlY3Rpb25zKSxcbiAgICAgIGJvZHk6IGRvY3VtZW50LmJvZHksXG4gICAgfTtcbiAgfVxuXG4gIG9uSW5pdCgpIHtcbiAgICBzdXBlci5vbkluaXQoKTtcblxuICAgIGlmICh0aGlzLmlzRWxlbWVudG9yRWRpdG9yUGFnZSgpKSB7XG4gICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgdGhpcy53cmFwU2VjdGlvbnMoKTtcbiAgICB0aGlzLmluaXRGdWxsUGFnZSgpO1xuICAgIHRoaXMuYmluZE1vZGFsRXZlbnRzKCk7XG4gIH1cblxuICB3cmFwU2VjdGlvbnMoKSB7XG4gICAgY29uc3QgYW5jaG9ycyA9IG5ldyBTZXQoKTtcbiAgICBpZiAodGhpcy5lbGVtZW50cy5zZWN0aW9ucykge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnNlY3Rpb25zLmZvckVhY2goKHNlY3Rpb24sIGluZGV4KSA9PiB7XG4gICAgICAgICAgICBpZiAoIXNlY3Rpb24uaWQpIHtcbiAgICAgICAgICAgICAgICBsZXQgc2VjdGlvbklkID0gYGZzLXNlY3Rpb24tJHtpbmRleH1gO1xuICAgICAgICAgICAgICAgIHdoaWxlIChkb2N1bWVudC5nZXRFbGVtZW50QnlJZChzZWN0aW9uSWQpIHx8IGFuY2hvcnMuaGFzKHNlY3Rpb25JZCkpIHtcbiAgICAgICAgICAgICAgICAgICAgaW5kZXgrKztcbiAgICAgICAgICAgICAgICAgICAgc2VjdGlvbklkID0gYGZzLXNlY3Rpb24tJHtpbmRleH1gO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBzZWN0aW9uLmlkID0gc2VjdGlvbklkO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgYW5jaG9ycy5hZGQoc2VjdGlvbi5pZCk7XG4gICAgICAgICAgICBjb25zdCBzZWN0aW9uV3JhcHBlcklkID0gYCMke3NlY3Rpb24uaWR9YDtcbiAgICAgICAgICAgIHNlY3Rpb24ucmVtb3ZlQXR0cmlidXRlKFwiaWRcIik7XG4gICAgICAgICAgICBzZWN0aW9uLm91dGVySFRNTCA9IGA8ZGl2IGlkPVwiJHtzZWN0aW9uV3JhcHBlcklkfVwiIGNsYXNzPVwid3JhcC1zZWN0aW9uXCIgZGF0YS1hbmNob3I9XCIke3NlY3Rpb24uaWR9XCI+JHtzZWN0aW9uLm91dGVySFRNTH08L2Rpdj5gO1xuICAgICAgICB9KTtcbiAgICB9XG4gIH1cblxuICBpbml0RnVsbFBhZ2UoKSB7XG4gICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgIG5ldyBmdWxscGFnZShzZWxlY3RvcnMuc2VjdGlvbnNXcmFwcGVyLCB0aGlzLmdldEZ1bGxQYWdlT3B0aW9ucygpKTtcbiAgfVxuXG4gIGdldEZ1bGxQYWdlT3B0aW9ucygpIHtcbiAgICBjb25zdCBzZWxmID0gdGhpcztcbiAgICBjb25zdCBvcHRpb25zID0gdGhpcy5nZXRTZXR0aW5ncyhcIm9wdGlvbnNcIik7XG4gICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcbiAgICBjb25zdCBzZWN0aW9ucyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXG4gICAgICBgJHtzZWxlY3RvcnMuc2VjdGlvbnNXcmFwcGVyfSA+IC53cmFwLXNlY3Rpb25gXG4gICAgKTtcblxuICAgIGNvbnN0IGZ1bGxQYWdlT3B0aW9ucyA9IHtcbiAgICAgIGxpY2Vuc2VLZXk6IFwiMjgwMkY5ODktNzg1ODQ1QTgtQjBFMzc2QjYtRUExQkQ3NTFcIixcbiAgICAgIHNlY3Rpb25TZWxlY3RvcjogXCIud3JhcC1zZWN0aW9uXCIsXG4gICAgICBzY3JvbGxPdmVyZmxvdzogdHJ1ZSxcbiAgICAgIHYyY29tcGF0aWJsZTogdHJ1ZSxcbiAgICAgIG9uTGVhdmU6IChpbmRleCwgbmV4dEluZGV4LCBkaXJlY3Rpb24pID0+IHtcbiAgICAgICAgY29uc3QgbmV4dFNlY3Rpb24gPSBzZWN0aW9uc1tuZXh0SW5kZXggLSAxXTtcblxuICAgICAgICBpZiAoZGlyZWN0aW9uID09PSBcImRvd25cIiB8fCBkaXJlY3Rpb24gPT09IFwidXBcIikge1xuICAgICAgICAgIHNlbGYuc2V0RnVsbFBhZ2VOYXZDb2xvcihuZXh0U2VjdGlvbik7XG4gICAgICAgIH1cbiAgICAgIH0sXG4gICAgICBhZnRlckxvYWQ6IGZ1bmN0aW9uIChhbmNob3JMaW5rLCBpbmRleCkge1xuICAgICAgICBjb25zdCBuZXh0U2VjdGlvbiA9IHRoaXM7XG5cbiAgICAgICAgaWYgKG5leHRTZWN0aW9uLmNsYXNzTGlzdC5jb250YWlucyhcImFjdGl2ZVwiKSkge1xuICAgICAgICAgIHNlbGYuc2V0RnVsbFBhZ2VOYXZDb2xvcihuZXh0U2VjdGlvbik7XG5cbiAgICAgICAgICBjb25zdCBzZWN0aW9uTG9hZGVkRXZlbnQgPSBuZXcgRXZlbnQoJ3NlY3Rpb25Mb2FkZWQnKTtcbiAgICAgICAgICBkb2N1bWVudC5kaXNwYXRjaEV2ZW50KHNlY3Rpb25Mb2FkZWRFdmVudCk7XG4gICAgICAgIH1cbiAgICAgIH0sXG4gICAgICBhbmNob3JzOiBbXSwgLy8gUmVzZXQgdGhlIGFuY2hvcnMgYXJyYXkgdG8gZW5zdXJlIGl0J3Mgbm90IGNhdXNpbmcgaXNzdWVzXG4gICAgfTtcblxuICAgIC8vIFNjcm9sbGluZyBzcGVlZFxuICAgIGlmIChcbiAgICAgIChcIjBcIiAhPSBvcHRpb25zLm9mY1NwZWVkIHx8IFwiNzAwXCIgIT0gb3B0aW9ucy5vZmNTcGVlZCkgJiZcbiAgICAgIFwiXCIgIT0gb3B0aW9ucy5vZmNTcGVlZFxuICAgICkge1xuICAgICAgZnVsbFBhZ2VPcHRpb25zLnNjcm9sbGluZ1NwZWVkID0gb3B0aW9ucy5vZmNTcGVlZDtcbiAgICB9XG5cbiAgICAvLyBSZXNwb25zaXZlXG4gICAgaWYgKFwiMFwiICE9IG9wdGlvbnMub2ZjUmVzICYmIFwiXCIgIT0gb3B0aW9ucy5vZmNSZXMpIHtcbiAgICAgIGZ1bGxQYWdlT3B0aW9ucy5yZXNwb25zaXZlV2lkdGggPSBvcHRpb25zLm9mY1JlcztcbiAgICB9XG5cbiAgICAvLyBJZiBuYXZpZ2F0aW9uXG4gICAgaWYgKFwiZW5hYmxlXCIgPT0gb3B0aW9ucy5vZmNOYXYpIHtcbiAgICAgIC8vIEFuY2hvcnMgYW5kIHRvb2x0aXBzXG4gICAgICBjb25zdCBhbmNob3JzID0gW107XG4gICAgICBjb25zdCBuYXZUb29sdGlwcyA9IFtdO1xuXG4gICAgICBzZWN0aW9ucy5mb3JFYWNoKHRvcFNlY3Rpb24gPT4ge1xuICAgICAgICBsZXQgc2VjdGlvbklEID0gdG9wU2VjdGlvbi5pZC5yZXBsYWNlKFwiI1wiLCBcIlwiKTtcblxuICAgICAgICBpZiAoc2VjdGlvbklEKSB7XG4gICAgICAgICAgYW5jaG9ycy5wdXNoKHNlY3Rpb25JRCk7XG4gICAgICAgICAgbmF2VG9vbHRpcHMucHVzaChzZWN0aW9uSUQucmVwbGFjZSgvW1xcLV9dL2csIFwiIFwiKSk7IC8vIFJlcGxhY2UgaHlwaGVucyB3aXRoIHNwYWNlIGluIHRvb2x0aXBzXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgYW5jaG9ycy5wdXNoKFwiIFwiKTtcbiAgICAgICAgICBuYXZUb29sdGlwcy5wdXNoKFwiIFwiKTtcbiAgICAgICAgfVxuICAgICAgfSk7XG5cbiAgICAgIC8vIEFkZCBhbmNob3JzIGFuZCB0b29sdGlwcyB0byBmdWxsUGFnZU9wdGlvbnNcbiAgICAgIGZ1bGxQYWdlT3B0aW9ucy5hbmNob3JzID0gYW5jaG9ycztcblxuICAgICAgLy8gU2V0dGluZ3NcbiAgICAgIGZ1bGxQYWdlT3B0aW9ucy5tZW51ID0gXCIjZnAtbmF2XCI7XG4gICAgICBmdWxsUGFnZU9wdGlvbnMubmF2aWdhdGlvbiA9IHRydWU7XG4gICAgICBmdWxsUGFnZU9wdGlvbnMubmF2aWdhdGlvblBvc2l0aW9uID0gb3B0aW9ucy5vZmNOYXZQb3M7XG4gICAgICBmdWxsUGFnZU9wdGlvbnMubmF2aWdhdGlvblRvb2x0aXBzID0gbmF2VG9vbHRpcHM7XG4gICAgfVxuXG4gICAgcmV0dXJuIGZ1bGxQYWdlT3B0aW9ucztcbiAgfVxuXG4gIHNldEZ1bGxQYWdlTmF2Q29sb3Ioc2VjdGlvbikge1xuICAgIGZvciAoY29uc3Qgc2VjdGlvbkNoaWxkIG9mIHNlY3Rpb24uY2hpbGRyZW4pIHtcbiAgICAgIHRoaXMuZWxlbWVudHMuYm9keS5jbGFzc0xpc3QucmVtb3ZlKFwib2ZjLWxpZ2h0LW5hdlwiKTtcbiAgICAgIHRoaXMuZWxlbWVudHMuYm9keS5jbGFzc0xpc3QucmVtb3ZlKFwib2ZjLWRhcmstbmF2XCIpO1xuXG4gICAgICBjb25zdCBjaGlsZHJlbiA9IHNlY3Rpb25DaGlsZC5jaGlsZHJlbjtcblxuICAgICAgY29uc3QgbGlnaHRTZWN0aW9uID0gQXJyYXkuZnJvbShjaGlsZHJlbikuc29tZShcbiAgICAgICAgKHsgY2xhc3NMaXN0IH0pID0+XG4gICAgICAgICAgY2xhc3NMaXN0LmNvbnRhaW5zKFwiZWxlbWVudG9yLXRvcC1zZWN0aW9uXCIpICYmXG4gICAgICAgICAgY2xhc3NMaXN0LmNvbnRhaW5zKFwibGlnaHRcIilcbiAgICAgICk7XG5cbiAgICAgIGlmIChsaWdodFNlY3Rpb24pIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5ib2R5LmNsYXNzTGlzdC5hZGQoXCJvZmMtbGlnaHQtbmF2XCIpO1xuICAgICAgICBicmVhaztcbiAgICAgIH1cblxuICAgICAgY29uc3QgZGFya1NlY3Rpb24gPSBBcnJheS5mcm9tKGNoaWxkcmVuKS5zb21lKFxuICAgICAgICAoeyBjbGFzc0xpc3QgfSkgPT5cbiAgICAgICAgICBjbGFzc0xpc3QuY29udGFpbnMoXCJlbGVtZW50b3ItdG9wLXNlY3Rpb25cIikgJiZcbiAgICAgICAgICBjbGFzc0xpc3QuY29udGFpbnMoXCJkYXJrXCIpXG4gICAgICApO1xuXG4gICAgICBpZiAoZGFya1NlY3Rpb24pIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5ib2R5LmNsYXNzTGlzdC5hZGQoXCJvZmMtZGFyay1uYXZcIik7XG4gICAgICAgIGJyZWFrO1xuICAgICAgfVxuICAgIH1cbiAgfVxuXG4gIGJpbmRNb2RhbEV2ZW50cygpIHsgXG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnI29jZWFud3AtZnVsbHBhZ2UgLm9tdy1vcGVuLW1vZGFsJykuZm9yRWFjaChsaW5rRWxlbWVudCA9PiB7IFxuICAgICAgY29uc3QgZXZlbnRJbml0T1dNID0gbmV3IEN1c3RvbUV2ZW50KFwiaW5pdC1vbXctZm9yLWVsZW1lbnRcIiwgeyBcbiAgICAgICAgYnViYmxlczogdHJ1ZSxcbiAgICAgICAgY2FuY2VsYWJsZTogdHJ1ZVxuICAgICAgfSk7IFxuICAgICAgbGlua0VsZW1lbnQuZGlzcGF0Y2hFdmVudChldmVudEluaXRPV00gKTsgXG4gICAgfSk7IFxuICB9XG5cbiAgaXNFbGVtZW50b3JFZGl0b3JQYWdlKCkge1xuICAgIHJldHVybiB0aGlzLmVsZW1lbnRzLmJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKFwiZWxlbWVudG9yLWVkaXRvci1hY3RpdmVcIik7XG4gIH1cbn1cblxuKFwidXNlIHNjcmlwdFwiKTtcbndpbmRvdy5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCAoKSA9PiB7XG4gIG5ldyBPV19GdWxsU2NyZWVuKCk7XG59KTtcbiJdfQ==
