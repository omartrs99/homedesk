(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classPrivateFieldGet(receiver, privateMap) { var descriptor = _classExtractFieldDescriptor(receiver, privateMap, "get"); return _classApplyDescriptorGet(receiver, descriptor); }

function _classApplyDescriptorGet(receiver, descriptor) { if (descriptor.get) { return descriptor.get.call(receiver); } return descriptor.value; }

function _classPrivateFieldSet(receiver, privateMap, value) { var descriptor = _classExtractFieldDescriptor(receiver, privateMap, "set"); _classApplyDescriptorSet(receiver, descriptor, value); return value; }

function _classExtractFieldDescriptor(receiver, privateMap, action) { if (!privateMap.has(receiver)) { throw new TypeError("attempted to " + action + " private field on non-instance"); } return privateMap.get(receiver); }

function _classApplyDescriptorSet(receiver, descriptor, value) { if (descriptor.set) { descriptor.set.call(receiver, value); } else { if (!descriptor.writable) { throw new TypeError("attempted to set read only private field"); } descriptor.value = value; } }

var _settings = /*#__PURE__*/new WeakMap();

var OW_Base = /*#__PURE__*/function () {
  function OW_Base() {
    _classCallCheck(this, OW_Base);

    _settings.set(this, {
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

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _base = _interopRequireDefault(require("./base/base"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var OW_StickyFooter = /*#__PURE__*/function (_OW_Base) {
  _inherits(OW_StickyFooter, _OW_Base);

  var _super = _createSuper(OW_StickyFooter);

  function OW_StickyFooter() {
    var _this;

    _classCallCheck(this, OW_StickyFooter);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "modal", void 0);

    return _this;
  }

  _createClass(OW_StickyFooter, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          stickyFooterToggleBtn: "#footer-bar .osf-btn a",
          footer: ".site-footer",
          footerBox: "#footer .footer-box",
          main: "#main"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        stickyFooterToggleBtn: document.querySelector(selectors.stickyFooterToggleBtn),
        footer: document.querySelector(selectors.footer),
        footerBoxes: document.querySelectorAll(selectors.footerBox),
        main: document.querySelector(selectors.main),
        body: document.body
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      _get(_getPrototypeOf(OW_StickyFooter.prototype), "onInit", this).call(this);

      if (!!this.elements.stickyFooterToggleBtn && this.isDesktopBrowser()) {
        this.initPerfectScrollbar();
      }
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this$elements$sticky, _this$elements$main;

      (_this$elements$sticky = this.elements.stickyFooterToggleBtn) === null || _this$elements$sticky === void 0 ? void 0 : _this$elements$sticky.addEventListener("click", this.toggleStickyFooter.bind(this));
      (_this$elements$main = this.elements.main) === null || _this$elements$main === void 0 ? void 0 : _this$elements$main.addEventListener("click", this.closeStickyFooter.bind(this));
    }
  }, {
    key: "toggleStickyFooter",
    value: function toggleStickyFooter(event) {
      event.preventDefault();
      this.elements.footer.classList.toggle("opened");
      this.elements.body.classList.toggle("osf-opened");
    }
  }, {
    key: "closeStickyFooter",
    value: function closeStickyFooter(event) {
      var _this$elements$footer, _this$elements$body;

      (_this$elements$footer = this.elements.footer) === null || _this$elements$footer === void 0 ? void 0 : _this$elements$footer.classList.remove("opened");
      (_this$elements$body = this.elements.body) === null || _this$elements$body === void 0 ? void 0 : _this$elements$body.classList.remove("osf-opened");
    }
  }, {
    key: "initPerfectScrollbar",
    value: function initPerfectScrollbar() {
      this.elements.footerBoxes.forEach(function (footerBox) {
        new PerfectScrollbar(footerBox, {
          wheelSpeed: 0.5,
          suppressScrollX: false,
          suppressScrollY: false
        });
      });
    }
  }, {
    key: "isDesktopBrowser",
    value: function isDesktopBrowser() {
      return !navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/);
    }
  }]);

  return OW_StickyFooter;
}(_base["default"]);

"use script";
new OW_StickyFooter();

},{"./base/base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2Jhc2UvYmFzZS5qcyIsImFzc2V0cy9zcmMvanMvc3RpY2t5LWZvb3Rlci5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQ0FNLE87QUFJRixxQkFBYztBQUFBOztBQUFBO0FBQUE7QUFBQTtBQUFBOztBQUFBOztBQUNWLFNBQUssTUFBTDtBQUNBLFNBQUssVUFBTDtBQUNIOzs7O1dBRUQsOEJBQXFCO0FBQ2pCLGFBQU8sRUFBUDtBQUNIOzs7V0FFRCw4QkFBcUI7QUFDakIsYUFBTyxFQUFQO0FBQ0g7OztXQUVELGtCQUFTO0FBQ0wsNkNBQWlCLEtBQUssa0JBQUwsRUFBakI7O0FBQ0EsV0FBSyxRQUFMLEdBQWdCLEtBQUssa0JBQUwsRUFBaEI7QUFDSDs7O1dBRUQsc0JBQWEsQ0FBRTs7O1dBRWYsdUJBQXdCO0FBQUEsVUFBWixHQUFZLHVFQUFOLElBQU07O0FBQ3BCLFVBQUksQ0FBQyxDQUFDLEdBQU4sRUFBVztBQUNQLGVBQU8sdUNBQWUsR0FBZixDQUFQO0FBQ0g7O0FBRUQsbUNBQU8sSUFBUDtBQUNIOzs7V0FFRCx1QkFBMkI7QUFBQSxVQUFmLFFBQWUsdUVBQUosRUFBSTs7QUFDdkIsVUFBSSxDQUFDLFFBQUwsRUFBZTtBQUNYO0FBQ0g7O0FBRUQsNkNBQWlCLE1BQU0sQ0FBQyxNQUFQLHVCQUFjLElBQWQsY0FBOEIsUUFBOUIsQ0FBakI7QUFDSDs7Ozs7O2VBR1UsTzs7Ozs7Ozs7QUN6Q2Y7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLGU7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O1dBR0YsOEJBQXFCO0FBQ2pCLGFBQU87QUFDSCxRQUFBLFNBQVMsRUFBRTtBQUNQLFVBQUEscUJBQXFCLEVBQUUsd0JBRGhCO0FBRVAsVUFBQSxNQUFNLEVBQUUsY0FGRDtBQUdQLFVBQUEsU0FBUyxFQUFFLHFCQUhKO0FBSVAsVUFBQSxJQUFJLEVBQUU7QUFKQztBQURSLE9BQVA7QUFRSDs7O1dBRUQsOEJBQXFCO0FBQ2pCLFVBQU0sU0FBUyxHQUFHLEtBQUssV0FBTCxDQUFpQixXQUFqQixDQUFsQjtBQUVBLGFBQU87QUFDSCxRQUFBLHFCQUFxQixFQUFFLFFBQVEsQ0FBQyxhQUFULENBQXVCLFNBQVMsQ0FBQyxxQkFBakMsQ0FEcEI7QUFFSCxRQUFBLE1BQU0sRUFBRSxRQUFRLENBQUMsYUFBVCxDQUF1QixTQUFTLENBQUMsTUFBakMsQ0FGTDtBQUdILFFBQUEsV0FBVyxFQUFFLFFBQVEsQ0FBQyxnQkFBVCxDQUEwQixTQUFTLENBQUMsU0FBcEMsQ0FIVjtBQUlILFFBQUEsSUFBSSxFQUFFLFFBQVEsQ0FBQyxhQUFULENBQXVCLFNBQVMsQ0FBQyxJQUFqQyxDQUpIO0FBS0gsUUFBQSxJQUFJLEVBQUUsUUFBUSxDQUFDO0FBTFosT0FBUDtBQU9IOzs7V0FFRCxrQkFBUztBQUNMOztBQUVBLFVBQUksQ0FBQyxDQUFDLEtBQUssUUFBTCxDQUFjLHFCQUFoQixJQUF5QyxLQUFLLGdCQUFMLEVBQTdDLEVBQXNFO0FBQ2xFLGFBQUssb0JBQUw7QUFDSDtBQUNKOzs7V0FFRCxzQkFBYTtBQUFBOztBQUNULG9DQUFLLFFBQUwsQ0FBYyxxQkFBZCxnRkFBcUMsZ0JBQXJDLENBQXNELE9BQXRELEVBQStELEtBQUssa0JBQUwsQ0FBd0IsSUFBeEIsQ0FBNkIsSUFBN0IsQ0FBL0Q7QUFDQSxrQ0FBSyxRQUFMLENBQWMsSUFBZCw0RUFBb0IsZ0JBQXBCLENBQXFDLE9BQXJDLEVBQThDLEtBQUssaUJBQUwsQ0FBdUIsSUFBdkIsQ0FBNEIsSUFBNUIsQ0FBOUM7QUFDSDs7O1dBRUQsNEJBQW1CLEtBQW5CLEVBQTBCO0FBQ3RCLE1BQUEsS0FBSyxDQUFDLGNBQU47QUFFQSxXQUFLLFFBQUwsQ0FBYyxNQUFkLENBQXFCLFNBQXJCLENBQStCLE1BQS9CLENBQXNDLFFBQXRDO0FBQ0EsV0FBSyxRQUFMLENBQWMsSUFBZCxDQUFtQixTQUFuQixDQUE2QixNQUE3QixDQUFvQyxZQUFwQztBQUNIOzs7V0FFRCwyQkFBa0IsS0FBbEIsRUFBeUI7QUFBQTs7QUFDckIsb0NBQUssUUFBTCxDQUFjLE1BQWQsZ0ZBQXNCLFNBQXRCLENBQWdDLE1BQWhDLENBQXVDLFFBQXZDO0FBQ0Esa0NBQUssUUFBTCxDQUFjLElBQWQsNEVBQW9CLFNBQXBCLENBQThCLE1BQTlCLENBQXFDLFlBQXJDO0FBQ0g7OztXQUVELGdDQUF1QjtBQUNuQixXQUFLLFFBQUwsQ0FBYyxXQUFkLENBQTBCLE9BQTFCLENBQWtDLFVBQUMsU0FBRCxFQUFlO0FBQzdDLFlBQUksZ0JBQUosQ0FBcUIsU0FBckIsRUFBZ0M7QUFDNUIsVUFBQSxVQUFVLEVBQUUsR0FEZ0I7QUFFNUIsVUFBQSxlQUFlLEVBQUUsS0FGVztBQUc1QixVQUFBLGVBQWUsRUFBRTtBQUhXLFNBQWhDO0FBS0gsT0FORDtBQU9IOzs7V0FFRCw0QkFBbUI7QUFDZixhQUFPLENBQUMsU0FBUyxDQUFDLFNBQVYsQ0FBb0IsS0FBcEIsQ0FBMEIsZ0RBQTFCLENBQVI7QUFDSDs7OztFQS9EeUIsZ0I7O0FBa0U3QixZQUFEO0FBQ0EsSUFBSSxlQUFKIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiY2xhc3MgT1dfQmFzZSB7XG4gICAgI3NldHRpbmdzO1xuICAgIGVsZW1lbnRzO1xuXG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMub25Jbml0KCk7XG4gICAgICAgIHRoaXMuYmluZEV2ZW50cygpO1xuICAgIH1cblxuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHt9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgcmV0dXJuIHt9O1xuICAgIH1cblxuICAgIG9uSW5pdCgpIHtcbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSB0aGlzLmdldERlZmF1bHRTZXR0aW5ncygpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzID0gdGhpcy5nZXREZWZhdWx0RWxlbWVudHMoKTtcbiAgICB9XG5cbiAgICBiaW5kRXZlbnRzKCkge31cblxuICAgIGdldFNldHRpbmdzKGtleSA9IG51bGwpIHtcbiAgICAgICAgaWYgKCEha2V5KSB7XG4gICAgICAgICAgICByZXR1cm4gdGhpcy4jc2V0dGluZ3Nba2V5XTtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5ncztcbiAgICB9XG5cbiAgICBzZXRTZXR0aW5ncyhzZXR0aW5ncyA9IHt9KSB7XG4gICAgICAgIGlmICghc2V0dGluZ3MpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuI3NldHRpbmdzID0gT2JqZWN0LmFzc2lnbih0aGlzLiNzZXR0aW5ncywgc2V0dGluZ3MpO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgT1dfQmFzZTtcbiIsImltcG9ydCBPV19CYXNlIGZyb20gXCIuL2Jhc2UvYmFzZVwiO1xuXG5jbGFzcyBPV19TdGlja3lGb290ZXIgZXh0ZW5kcyBPV19CYXNlIHtcbiAgICBtb2RhbDtcblxuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIHN0aWNreUZvb3RlclRvZ2dsZUJ0bjogXCIjZm9vdGVyLWJhciAub3NmLWJ0biBhXCIsXG4gICAgICAgICAgICAgICAgZm9vdGVyOiBcIi5zaXRlLWZvb3RlclwiLFxuICAgICAgICAgICAgICAgIGZvb3RlckJveDogXCIjZm9vdGVyIC5mb290ZXItYm94XCIsXG4gICAgICAgICAgICAgICAgbWFpbjogXCIjbWFpblwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHN0aWNreUZvb3RlclRvZ2dsZUJ0bjogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuc3RpY2t5Rm9vdGVyVG9nZ2xlQnRuKSxcbiAgICAgICAgICAgIGZvb3RlcjogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZm9vdGVyKSxcbiAgICAgICAgICAgIGZvb3RlckJveGVzOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5mb290ZXJCb3gpLFxuICAgICAgICAgICAgbWFpbjogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubWFpbiksXG4gICAgICAgICAgICBib2R5OiBkb2N1bWVudC5ib2R5LFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCgpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KCk7XG5cbiAgICAgICAgaWYgKCEhdGhpcy5lbGVtZW50cy5zdGlja3lGb290ZXJUb2dnbGVCdG4gJiYgdGhpcy5pc0Rlc2t0b3BCcm93c2VyKCkpIHtcbiAgICAgICAgICAgIHRoaXMuaW5pdFBlcmZlY3RTY3JvbGxiYXIoKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuc3RpY2t5Rm9vdGVyVG9nZ2xlQnRuPy5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy50b2dnbGVTdGlja3lGb290ZXIuYmluZCh0aGlzKSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMubWFpbj8uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMuY2xvc2VTdGlja3lGb290ZXIuYmluZCh0aGlzKSk7XG4gICAgfVxuXG4gICAgdG9nZ2xlU3RpY2t5Rm9vdGVyKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5mb290ZXIuY2xhc3NMaXN0LnRvZ2dsZShcIm9wZW5lZFwiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5ib2R5LmNsYXNzTGlzdC50b2dnbGUoXCJvc2Ytb3BlbmVkXCIpO1xuICAgIH1cblxuICAgIGNsb3NlU3RpY2t5Rm9vdGVyKGV2ZW50KSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuZm9vdGVyPy5jbGFzc0xpc3QucmVtb3ZlKFwib3BlbmVkXCIpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmJvZHk/LmNsYXNzTGlzdC5yZW1vdmUoXCJvc2Ytb3BlbmVkXCIpO1xuICAgIH1cblxuICAgIGluaXRQZXJmZWN0U2Nyb2xsYmFyKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmZvb3RlckJveGVzLmZvckVhY2goKGZvb3RlckJveCkgPT4ge1xuICAgICAgICAgICAgbmV3IFBlcmZlY3RTY3JvbGxiYXIoZm9vdGVyQm94LCB7XG4gICAgICAgICAgICAgICAgd2hlZWxTcGVlZDogMC41LFxuICAgICAgICAgICAgICAgIHN1cHByZXNzU2Nyb2xsWDogZmFsc2UsXG4gICAgICAgICAgICAgICAgc3VwcHJlc3NTY3JvbGxZOiBmYWxzZSxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBpc0Rlc2t0b3BCcm93c2VyKCkge1xuICAgICAgICByZXR1cm4gIW5hdmlnYXRvci51c2VyQWdlbnQubWF0Y2goLyhBbmRyb2lkfGlQb2R8aVBob25lfGlQYWR8SUVNb2JpbGV8T3BlcmEgTWluaSkvKTtcbiAgICB9XG59XG5cbihcInVzZSBzY3JpcHRcIik7XG5uZXcgT1dfU3RpY2t5Rm9vdGVyKCk7XG4iXX0=
