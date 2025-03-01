(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.visible = exports.slideUp = exports.slideToggle = exports.slideDown = exports.offset = exports.isElement = exports.getSiblings = exports.fadeToggle = exports.fadeOut = exports.fadeIn = void 0;

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

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

},{}],3:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

var _utils = require("./lib/utils");

var _base = _interopRequireDefault(require("./base"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _get() { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get.bind(); } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(arguments.length < 3 ? target : receiver); } return desc.value; }; } return _get.apply(this, arguments); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OGB_Newsletter = /*#__PURE__*/function (_OW_Base) {
  _inherits(OGB_Newsletter, _OW_Base);

  var _super = _createSuper(OGB_Newsletter);

  function OGB_Newsletter() {
    _classCallCheck(this, OGB_Newsletter);

    return _super.apply(this, arguments);
  }

  _createClass(OGB_Newsletter, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
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
          failed: ".failed"
        },
        options: ogbNewsletterData
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        subscribeForm: document.querySelector(selectors.subscribeForm),
        submitBtn: document.querySelector(selectors.submitBtn),
        emailField: document.querySelector(selectors.emailField),
        GDPRField: document.querySelector(selectors.GDPRField),
        responseMessages: document.querySelectorAll(selectors.responseMessage),
        errorMessages: document.querySelectorAll(selectors.errorMessage)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OGB_Newsletter.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setupEventListeners();
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this$elements$subscr;

      (_this$elements$subscr = this.elements.subscribeForm) === null || _this$elements$subscr === void 0 ? void 0 : _this$elements$subscr.addEventListener("submit", this.onSubmitSubscribeForm.bind(this));
    }
  }, {
    key: "onSubmitSubscribeForm",
    value: function onSubmitSubscribeForm(event) {
      var _this = this;

      event.preventDefault();
      var isFormAllowedSubmitted = this.checkFormFields();

      if (isFormAllowedSubmitted) {
        var selectors = this.getSettings("selectors");
        var emailAdress = this.elements.emailField.value.trim();
        this.elements.submitBtn.disabled = true;
        var options = this.getSettings("options");
        var formData = new FormData();
        formData.append("action", "ogb_newsletter_form");
        formData.append("nonce", options.nonce);
        formData.append("email", emailAdress);
        axios.post(options.ajax_url, formData).then(function (_ref) {
          var data = _ref.data;
          var message = data.status ? document.querySelector("".concat(selectors.responseMessage).concat(selectors.success)) : document.querySelector("".concat(selectors.responseMessage).concat(selectors.failed));
          (0, _utils.fadeIn)(message);
          _this.elements.submitBtn.disabled = false;
          setTimeout(function () {
            (0, _utils.fadeOut)(message);
          }, 5000);
        });
      }
    }
  }, {
    key: "checkFormFields",
    value: function checkFormFields() {
      var selectors = this.getSettings("selectors");
      var emailAdress = this.elements.emailField.value.trim();
      var isFormAllowedSubmitted = true;
      this.elements.errorMessages.forEach(function (errorMessage) {
        errorMessage.style.display = "none";
      });
      this.elements.responseMessages.forEach(function (responseMessage) {
        responseMessage.style.display = "none";
      });

      if (emailAdress === "") {
        document.querySelector("".concat(selectors.emailFieldError).concat(selectors.require)).style.display = "block";
        isFormAllowedSubmitted = false;
      } else if (!this.isEmailAddressValid(emailAdress)) {
        document.querySelector("".concat(selectors.emailFieldError).concat(selectors.notValid)).style.display = "block";
        isFormAllowedSubmitted = false;
      }

      if (!!this.elements.GDPRField && this.elements.GDPRField.checked === false) {
        document.querySelector("".concat(selectors.GDPRFieldError).concat(selectors.errorMessage)).style.display = "block";
        isFormAllowedSubmitted = false;
      }

      return isFormAllowedSubmitted;
    }
  }, {
    key: "isEmailAddressValid",
    value: function isEmailAddressValid(emailAddress) {
      var emailAddressPattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
      return emailAddressPattern.test(emailAddress);
    }
  }]);

  return OGB_Newsletter;
}(_base["default"]);

document.addEventListener("DOMContentLoaded", function () {
  new OGB_Newsletter();
});

},{"./base":1,"./lib/utils":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvYmxvY2stanMvYmFzZS5qcyIsInNyYy9ibG9jay1qcy9saWIvdXRpbHMuanMiLCJzcmMvYmxvY2stanMvbmV3c2xldHRlci5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUNBTSxPO0VBSUYsbUJBQWM7SUFBQTs7SUFBQTtNQUFBO01BQUE7SUFBQTs7SUFBQTs7SUFDVixLQUFLLE1BQUw7SUFDQSxLQUFLLFVBQUw7RUFDSDs7OztXQUVELDhCQUFxQjtNQUNqQixPQUFPLEVBQVA7SUFDSDs7O1dBRUQsOEJBQXFCO01BQ2pCLE9BQU8sRUFBUDtJQUNIOzs7V0FFRCxrQkFBUztNQUNMLHVDQUFpQixLQUFLLGtCQUFMLEVBQWpCOztNQUNBLEtBQUssUUFBTCxHQUFnQixLQUFLLGtCQUFMLEVBQWhCO0lBQ0g7OztXQUVELHNCQUFhLENBQUU7OztXQUVmLHVCQUF3QjtNQUFBLElBQVosR0FBWSx1RUFBTixJQUFNOztNQUNwQixJQUFJLENBQUMsQ0FBQyxHQUFOLEVBQVc7UUFDUCxPQUFPLHVDQUFlLEdBQWYsQ0FBUDtNQUNIOztNQUVELDZCQUFPLElBQVA7SUFDSDs7O1dBRUQsdUJBQTJCO01BQUEsSUFBZixRQUFlLHVFQUFKLEVBQUk7O01BQ3ZCLElBQUksQ0FBQyxRQUFMLEVBQWU7UUFDWDtNQUNIOztNQUVELHVDQUFpQixNQUFNLENBQUMsTUFBUCx1QkFBYyxJQUFkLGNBQThCLFFBQTlCLENBQWpCO0lBQ0g7Ozs7OztlQUdVLE87Ozs7Ozs7Ozs7Ozs7QUN6Q1IsSUFBTSxTQUFTLEdBQUcsU0FBWixTQUFZLENBQUMsT0FBRCxFQUE2QjtFQUFBLElBQW5CLFFBQW1CLHVFQUFSLEdBQVE7RUFDbEQsSUFBSSxPQUFPLEdBQUcsTUFBTSxDQUFDLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLE9BQS9DOztFQUVBLElBQUks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QUFMLEVBQTRDO1FBQy9DLFFBQVEsQ0FBQyxhQUFULFdBQTBCLFNBQVMsQ0FBQyxlQUFwQyxTQUFzRCxTQUFTLENBQUMsUUFBaEUsR0FBNEUsS0FBNUUsQ0FBa0YsT0FBbEYsR0FBNEYsT0FBNUY7UUFDQSxzQkFBc0IsR0FBRyxLQUF6QjtNQUNIOztNQUVELElBQUksQ0FBQyxDQUFDLEtBQUssUUFBTCxDQUFjLFNBQWhCLElBQTZCLEtBQUssUUFBTCxDQUFjLFNBQWQsQ0FBd0IsT0FBeEIsS0FBb0MsS0FBckUsRUFBNEU7UUFDeEUsUUFBUSxDQUFDLGFBQVQsV0FBMEIsU0FBUyxDQUFDLGNBQXBDLFNBQXFELFNBQVMsQ0FBQyxZQUEvRCxHQUErRSxLQUEvRSxDQUFxRixPQUFyRixHQUErRixPQUEvRjtRQUNBLHNCQUFzQixHQUFHLEtBQXpCO01BQ0g7O01BRUQsT0FBTyxzQkFBUDtJQUNIOzs7V0FFRCw2QkFBb0IsWUFBcEIsRUFBa0M7TUFDOUIsSUFBTSxtQkFBbUIsR0FBRyxJQUFJLE1BQUosQ0FDeEIsZ1NBRHdCLENBQTVCO01BSUEsT0FBTyxtQkFBbUIsQ0FBQyxJQUFwQixDQUF5QixZQUF6QixDQUFQO0lBQ0g7Ozs7RUFoSHdCLGdCOztBQW9IN0IsUUFBUSxDQUFDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFNO0VBQ2hELElBQUksY0FBSjtBQUNILENBRkQiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJjbGFzcyBPV19CYXNlIHtcbiAgICAjc2V0dGluZ3M7XG4gICAgZWxlbWVudHM7XG5cbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5vbkluaXQoKTtcbiAgICAgICAgdGhpcy5iaW5kRXZlbnRzKCk7XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgb25Jbml0KCkge1xuICAgICAgICB0aGlzLiNzZXR0aW5ncyA9IHRoaXMuZ2V0RGVmYXVsdFNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMgPSB0aGlzLmdldERlZmF1bHRFbGVtZW50cygpO1xuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7fVxuXG4gICAgZ2V0U2V0dGluZ3Moa2V5ID0gbnVsbCkge1xuICAgICAgICBpZiAoISFrZXkpIHtcbiAgICAgICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5nc1trZXldO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuI3NldHRpbmdzO1xuICAgIH1cblxuICAgIHNldFNldHRpbmdzKHNldHRpbmdzID0ge30pIHtcbiAgICAgICAgaWYgKCFzZXR0aW5ncykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSBPYmplY3QuYXNzaWduKHRoaXMuI3NldHRpbmdzLCBzZXR0aW5ncyk7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBPV19CYXNlO1xuIiwiZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xyXG4gICAgbGV0IGRpc3BsYXkgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5O1xyXG5cclxuICAgIGlmIChkaXNwbGF5ID09PSBcIm5vbmVcIikge1xyXG4gICAgICAgIGRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICB9XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodFwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXk7XHJcbiAgICBsZXQgaGVpZ2h0ID0gZWxlbWVudC5vZmZzZXRIZWlnaHQ7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcclxuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7aGVpZ2h0fXB4YDtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3BhY2l0eVwiKTtcclxuICAgIH0sIGR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHNsaWRlVXAgPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcclxuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW5cIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpbkJvdHRvbSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLXRvcFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XHJcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBzbGlkZVRvZ2dsZSA9IChlbGVtZW50LCBkdXJhdGlvbikgPT4ge1xyXG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDEsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDAsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIG9wdGlvbnMpID0+IHtcclxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiID8gZmFkZUluKGVsZW1lbnQsIG9wdGlvbnMpIDogZmFkZU91dChlbGVtZW50LCBvcHRpb25zKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBvZmZzZXQgPSAoZWxlbWVudCkgPT4ge1xyXG4gICAgaWYgKCFlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKSB7XHJcbiAgICAgICAgcmV0dXJuIHsgdG9wOiAwLCBsZWZ0OiAwIH07XHJcbiAgICB9XHJcblxyXG4gICAgLy8gR2V0IGRvY3VtZW50LXJlbGF0aXZlIHBvc2l0aW9uIGJ5IGFkZGluZyB2aWV3cG9ydCBzY3JvbGwgdG8gdmlld3BvcnQtcmVsYXRpdmUgZ0JDUlxyXG4gICAgY29uc3QgcmVjdCA9IGVsZW1lbnQuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCk7XHJcbiAgICBjb25zdCB3aW4gPSBlbGVtZW50Lm93bmVyRG9jdW1lbnQuZGVmYXVsdFZpZXc7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIHRvcDogcmVjdC50b3AgKyB3aW4ucGFnZVlPZmZzZXQsXHJcbiAgICAgICAgbGVmdDogcmVjdC5sZWZ0ICsgd2luLnBhZ2VYT2Zmc2V0LFxyXG4gICAgfTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCB2aXNpYmxlID0gKGVsZW1lbnQpID0+IHtcclxuICAgIGlmICghZWxlbWVudCkge1xyXG4gICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gISEoZWxlbWVudC5vZmZzZXRXaWR0aCB8fCBlbGVtZW50Lm9mZnNldEhlaWdodCB8fCBlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBnZXRTaWJsaW5ncyA9IChlKSA9PiB7XHJcbiAgICAvLyBmb3IgY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgY29uc3Qgc2libGluZ3MgPSBbXTtcclxuXHJcbiAgICAvLyBpZiBubyBwYXJlbnQsIHJldHVybiBubyBzaWJsaW5nXHJcbiAgICBpZiAoIWUucGFyZW50Tm9kZSkge1xyXG4gICAgICAgIHJldHVybiBzaWJsaW5ncztcclxuICAgIH1cclxuXHJcbiAgICAvLyBmaXJzdCBjaGlsZCBvZiB0aGUgcGFyZW50IG5vZGVcclxuICAgIGxldCBzaWJsaW5nID0gZS5wYXJlbnROb2RlLmZpcnN0Q2hpbGQ7XHJcblxyXG4gICAgLy8gY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgd2hpbGUgKHNpYmxpbmcpIHtcclxuICAgICAgICBpZiAoc2libGluZy5ub2RlVHlwZSA9PT0gMSAmJiBzaWJsaW5nICE9PSBlKSB7XHJcbiAgICAgICAgICAgIHNpYmxpbmdzLnB1c2goc2libGluZyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBzaWJsaW5nID0gc2libGluZy5uZXh0U2libGluZztcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gc2libGluZ3M7XHJcbn07XHJcblxyXG4vLyBSZXR1cm5zIHRydWUgaWYgaXQgaXMgYSBET00gZWxlbWVudFxyXG5leHBvcnQgY29uc3QgaXNFbGVtZW50ID0gKG8pID0+IHtcclxuICAgIHJldHVybiB0eXBlb2YgSFRNTEVsZW1lbnQgPT09IFwib2JqZWN0XCJcclxuICAgICAgICA/IG8gaW5zdGFuY2VvZiBIVE1MRWxlbWVudCAvLyBET00yXHJcbiAgICAgICAgOiBvICYmIHR5cGVvZiBvID09PSBcIm9iamVjdFwiICYmIG8gIT09IG51bGwgJiYgby5ub2RlVHlwZSA9PT0gMSAmJiB0eXBlb2Ygby5ub2RlTmFtZSA9PT0gXCJzdHJpbmdcIjtcclxufTtcclxuIiwiaW1wb3J0IHsgZmFkZUluLCBmYWRlT3V0IH0gZnJvbSBcIi4vbGliL3V0aWxzXCI7XG5pbXBvcnQgT1dfQmFzZSBmcm9tIFwiLi9iYXNlXCI7XG5cbmNsYXNzIE9HQl9OZXdzbGV0dGVyIGV4dGVuZHMgT1dfQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgc3Vic2NyaWJlRm9ybTogXCIjbWMtZW1iZWRkZWQtc3Vic2NyaWJlLWZvcm1cIixcbiAgICAgICAgICAgICAgICBzdWJtaXRCdG46IFwiYnV0dG9uXCIsXG4gICAgICAgICAgICAgICAgZW1haWxGaWVsZDogXCIuZW1haWxcIixcbiAgICAgICAgICAgICAgICBlbWFpbEZpZWxkRXJyb3I6IFwiLmVtYWlsLWVyclwiLFxuICAgICAgICAgICAgICAgIEdEUFJGaWVsZDogXCIuZ2RwclwiLFxuICAgICAgICAgICAgICAgIEdEUFJGaWVsZEVycm9yOiBcIi5nZHByLWVyclwiLFxuICAgICAgICAgICAgICAgIHJlc3BvbnNlTWVzc2FnZTogXCIucmVzLW1zZ1wiLFxuICAgICAgICAgICAgICAgIGVycm9yTWVzc2FnZTogXCIuZXJyLW1zZ1wiLFxuICAgICAgICAgICAgICAgIHJlcXVpcmU6IFwiLnJlcVwiLFxuICAgICAgICAgICAgICAgIG5vdFZhbGlkOiBcIi5ub3QtdmFsaWRcIixcbiAgICAgICAgICAgICAgICBzdWNjZXNzOiBcIi5zdWNjZXNzXCIsXG4gICAgICAgICAgICAgICAgZmFpbGVkOiBcIi5mYWlsZWRcIixcbiAgICAgICAgICAgIH0sXG5cdFx0XHRvcHRpb25zOiBvZ2JOZXdzbGV0dGVyRGF0YSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHN1YnNjcmliZUZvcm06IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnN1YnNjcmliZUZvcm0pLFxuICAgICAgICAgICAgc3VibWl0QnRuOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5zdWJtaXRCdG4pLFxuICAgICAgICAgICAgZW1haWxGaWVsZDogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZW1haWxGaWVsZCksXG4gICAgICAgICAgICBHRFBSRmllbGQ6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLkdEUFJGaWVsZCksXG4gICAgICAgICAgICByZXNwb25zZU1lc3NhZ2VzOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5yZXNwb25zZU1lc3NhZ2UpLFxuICAgICAgICAgICAgZXJyb3JNZXNzYWdlczogZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuZXJyb3JNZXNzYWdlKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXR1cEV2ZW50TGlzdGVuZXJzKCk7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5zdWJzY3JpYmVGb3JtPy5hZGRFdmVudExpc3RlbmVyKFwic3VibWl0XCIsIHRoaXMub25TdWJtaXRTdWJzY3JpYmVGb3JtLmJpbmQodGhpcykpO1xuICAgIH1cblxuICAgIG9uU3VibWl0U3Vic2NyaWJlRm9ybShldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGNvbnN0IGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSB0aGlzLmNoZWNrRm9ybUZpZWxkcygpO1xuXG4gICAgICAgIGlmIChpc0Zvcm1BbGxvd2VkU3VibWl0dGVkKSB7XG4gICAgICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuICAgICAgICAgICAgY29uc3QgZW1haWxBZHJlc3MgPSB0aGlzLmVsZW1lbnRzLmVtYWlsRmllbGQudmFsdWUudHJpbSgpO1xuXG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLnN1Ym1pdEJ0bi5kaXNhYmxlZCA9IHRydWU7XG5cblx0XHRcdGNvbnN0IG9wdGlvbnMgPSB0aGlzLmdldFNldHRpbmdzKFwib3B0aW9uc1wiKTtcblxuICAgICAgICAgICAgY29uc3QgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImFjdGlvblwiLCBcIm9nYl9uZXdzbGV0dGVyX2Zvcm1cIik7XG4gICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoXCJub25jZVwiLCBvcHRpb25zLm5vbmNlKTtcbiAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImVtYWlsXCIsIGVtYWlsQWRyZXNzKTtcblxuICAgICAgICAgICAgYXhpb3MucG9zdChvcHRpb25zLmFqYXhfdXJsLCBmb3JtRGF0YSkudGhlbigoeyBkYXRhIH0pID0+IHtcbiAgICAgICAgICAgICAgICBjb25zdCBtZXNzYWdlID0gZGF0YS5zdGF0dXNcbiAgICAgICAgICAgICAgICAgICAgPyBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGAke3NlbGVjdG9ycy5yZXNwb25zZU1lc3NhZ2V9JHtzZWxlY3RvcnMuc3VjY2Vzc31gKVxuICAgICAgICAgICAgICAgICAgICA6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoYCR7c2VsZWN0b3JzLnJlc3BvbnNlTWVzc2FnZX0ke3NlbGVjdG9ycy5mYWlsZWR9YCk7XG5cbiAgICAgICAgICAgICAgICBmYWRlSW4obWVzc2FnZSk7XG4gICAgICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5zdWJtaXRCdG4uZGlzYWJsZWQgPSBmYWxzZTtcblxuICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBmYWRlT3V0KG1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgIH0sIDUwMDApO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBjaGVja0Zvcm1GaWVsZHMoKSB7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG4gICAgICAgIGNvbnN0IGVtYWlsQWRyZXNzID0gdGhpcy5lbGVtZW50cy5lbWFpbEZpZWxkLnZhbHVlLnRyaW0oKTtcbiAgICAgICAgbGV0IGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSB0cnVlO1xuXG4gICAgICAgIHRoaXMuZWxlbWVudHMuZXJyb3JNZXNzYWdlcy5mb3JFYWNoKChlcnJvck1lc3NhZ2UpID0+IHtcbiAgICAgICAgICAgIGVycm9yTWVzc2FnZS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIHRoaXMuZWxlbWVudHMucmVzcG9uc2VNZXNzYWdlcy5mb3JFYWNoKChyZXNwb25zZU1lc3NhZ2UpID0+IHtcbiAgICAgICAgICAgIHJlc3BvbnNlTWVzc2FnZS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGlmIChlbWFpbEFkcmVzcyA9PT0gXCJcIikge1xuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgJHtzZWxlY3RvcnMuZW1haWxGaWVsZEVycm9yfSR7c2VsZWN0b3JzLnJlcXVpcmV9YCkuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcbiAgICAgICAgICAgIGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSBmYWxzZTtcbiAgICAgICAgfSBlbHNlIGlmICghdGhpcy5pc0VtYWlsQWRkcmVzc1ZhbGlkKGVtYWlsQWRyZXNzKSkge1xuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgJHtzZWxlY3RvcnMuZW1haWxGaWVsZEVycm9yfSR7c2VsZWN0b3JzLm5vdFZhbGlkfWApLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XG4gICAgICAgICAgICBpc0Zvcm1BbGxvd2VkU3VibWl0dGVkID0gZmFsc2U7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoISF0aGlzLmVsZW1lbnRzLkdEUFJGaWVsZCAmJiB0aGlzLmVsZW1lbnRzLkdEUFJGaWVsZC5jaGVja2VkID09PSBmYWxzZSkge1xuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgJHtzZWxlY3RvcnMuR0RQUkZpZWxkRXJyb3J9JHtzZWxlY3RvcnMuZXJyb3JNZXNzYWdlfWApLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XG4gICAgICAgICAgICBpc0Zvcm1BbGxvd2VkU3VibWl0dGVkID0gZmFsc2U7XG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gaXNGb3JtQWxsb3dlZFN1Ym1pdHRlZDtcbiAgICB9XG5cbiAgICBpc0VtYWlsQWRkcmVzc1ZhbGlkKGVtYWlsQWRkcmVzcykge1xuICAgICAgICBjb25zdCBlbWFpbEFkZHJlc3NQYXR0ZXJuID0gbmV3IFJlZ0V4cChcbiAgICAgICAgICAgIC9eKChcIltcXHctK1xcc10rXCIpfChbXFx3LStdKyg/OlxcLltcXHctK10rKSopfChcIltcXHctK1xcc10rXCIpKFtcXHctK10rKD86XFwuW1xcdy0rXSspKikpKEAoKD86W1xcdy0rXStcXC4pKlxcd1tcXHctK117MCw2Nn0pXFwuKFthLXpdezIsNn0oPzpcXC5bYS16XXsyfSk/KSQpfChAXFxbPygoMjVbMC01XVxcLnwyWzAtNF1bXFxkXVxcLnwxW1xcZF17Mn1cXC58W1xcZF17MSwyfVxcLikpKCgyNVswLTVdfDJbMC00XVtcXGRdfDFbXFxkXXsyfXxbXFxkXXsxLDJ9KVxcLil7Mn0oMjVbMC01XXwyWzAtNF1bXFxkXXwxW1xcZF17Mn18W1xcZF17MSwyfSlcXF0/JCkvaVxuICAgICAgICApO1xuXG4gICAgICAgIHJldHVybiBlbWFpbEFkZHJlc3NQYXR0ZXJuLnRlc3QoZW1haWxBZGRyZXNzKTtcbiAgICB9XG59XG5cblxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcIkRPTUNvbnRlbnRMb2FkZWRcIiwgKCkgPT4ge1xuICAgIG5ldyBPR0JfTmV3c2xldHRlcigpO1xufSk7XG5cbiJdfQ==
