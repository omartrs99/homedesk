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

var _base = _interopRequireDefault(require("./base/base"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
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
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var OW_SidePanel = /*#__PURE__*/function (_OW_Base) {
  _inherits(OW_SidePanel, _OW_Base);
  var _super = _createSuper(OW_SidePanel);
  function OW_SidePanel() {
    var _this;
    _classCallCheck(this, OW_SidePanel);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _super.call.apply(_super, [this].concat(args));
    _defineProperty(_assertThisInitialized(_this), "perfectScrollbar", void 0);
    return _this;
  }
  _createClass(OW_SidePanel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          sidePanel: "#side-panel-inner",
          sidePanelOpenButtons: "a.side-panel-btn, .side-panel-btn a",
          sidePanelCloseElements: "#side-panel-inner a.close-panel, .osp-overlay",
          sidePanelHamburgerIcon: ".side-panel-btn > .side-panel-icon.hamburger",
          mobileMenu: "#ocean-mobile-menu-icon a.mobile-menu"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        sidePanel: document.querySelector(selectors.sidePanel),
        sidePanelOpenButtons: document.querySelectorAll(selectors.sidePanelOpenButtons),
        sidePanelCloseElements: document.querySelectorAll(selectors.sidePanelCloseElements),
        sidePanelHamburgerIcon: document.querySelector(selectors.sidePanelHamburgerIcon),
        mobileMenu: document.querySelector(selectors.mobileMenu),
        body: document.body
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      _get(_getPrototypeOf(OW_SidePanel.prototype), "onInit", this).call(this);
      if (this.isDesktopBrowser()) {
        this.initPerfectScrollbar();
      }
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this2 = this;
      this.elements.sidePanelOpenButtons.forEach(function (openBtn) {
        openBtn.addEventListener("click", _this2.openSidePanel.bind(_this2));
      });
      this.elements.sidePanelCloseElements.forEach(function (closeBtn) {
        closeBtn.addEventListener("click", _this2.closeSidePanel.bind(_this2));
      });
    }
  }, {
    key: "initPerfectScrollbar",
    value: function initPerfectScrollbar() {
      if (!this.elements.sidePanel) {
        return;
      }
      this.perfectScrollbar = new PerfectScrollbar(this.elements.sidePanel, {
        wheelSpeed: 0.5,
        suppressScrollX: false,
        suppressScrollY: false
      });
    }
  }, {
    key: "openSidePanel",
    value: function openSidePanel(event) {
      var _this$elements$sidePa;
      event.preventDefault();
      var isOpenSidePanel = Array.from(this.elements.sidePanelOpenButtons).some(function (_ref) {
        var classList = _ref.classList;
        return classList.contains("opened");
      });
      if (isOpenSidePanel) {
        this.closeSidePanel(event);
        return;
      }
      var openBtn = event.currentTarget;
      openBtn.classList.add("opened");
      this.elements.body.classList.add("osp-opened");
      (_this$elements$sidePa = this.elements.sidePanelHamburgerIcon) === null || _this$elements$sidePa === void 0 ? void 0 : _this$elements$sidePa.classList.add("is-active");
      this.elements.sidePanel.style.visibility = "visible";
    }
  }, {
    key: "closeSidePanel",
    value: function closeSidePanel(event) {
      var _this$elements$sidePa2;
      event.preventDefault();
      this.elements.sidePanelOpenButtons.forEach(function (closeBtn) {
        closeBtn.classList.remove("opened");
      });
      this.elements.body.classList.remove("osp-opened");
      (_this$elements$sidePa2 = this.elements.sidePanelHamburgerIcon) === null || _this$elements$sidePa2 === void 0 ? void 0 : _this$elements$sidePa2.classList.remove("is-active");
      this.elements.sidePanel.style.visibility = "hidden";
    }
  }, {
    key: "isDesktopBrowser",
    value: function isDesktopBrowser() {
      return !navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/);
    }
  }]);
  return OW_SidePanel;
}(_base["default"]);
new OW_SidePanel();

},{"./base/base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2Jhc2UvYmFzZS5qcyIsImFzc2V0cy9zcmMvanMvc2lkZS1wYW5lbC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQ0FNLE9BQU87RUFJVCxTQUFBLFFBQUEsRUFBYztJQUFBLGVBQUEsT0FBQSxPQUFBO0lBQUEsMEJBQUEsT0FBQSxTQUFBO01BQUEsUUFBQTtNQUFBLEtBQUE7SUFBQTtJQUFBLGVBQUE7SUFDVixJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7SUFDYixJQUFJLENBQUMsVUFBVSxDQUFDLENBQUM7RUFDckI7RUFBQyxZQUFBLENBQUEsT0FBQTtJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRUQsU0FBQSxtQkFBQSxFQUFxQjtNQUNqQixPQUFPLENBQUMsQ0FBQztJQUNiO0VBQUM7SUFBQSxHQUFBO0lBQUEsS0FBQSxFQUVELFNBQUEsbUJBQUEsRUFBcUI7TUFDakIsT0FBTyxDQUFDLENBQUM7SUFDYjtFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLE9BQUEsRUFBUztNQUNMLHFCQUFBLEtBQUksRUFBQSxTQUFBLEVBQWEsSUFBSSxDQUFDLGtCQUFrQixDQUFDLENBQUM7TUFDMUMsSUFBSSxDQUFDLFFBQVEsR0FBRyxJQUFJLENBQUMsa0JBQWtCLENBQUMsQ0FBQztJQUM3QztFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLFdBQUEsRUFBYSxDQUFDO0VBQUM7SUFBQSxHQUFBO0lBQUEsS0FBQSxFQUVmLFNBQUEsWUFBQSxFQUF3QjtNQUFBLElBQVosR0FBRyxHQUFBLFNBQUEsQ0FBQSxNQUFBLFFBQUEsU0FBQSxRQUFBLFNBQUEsR0FBQSxTQUFBLE1BQUcsSUFBSTtNQUNsQixJQUFJLENBQUMsQ0FBQyxHQUFHLEVBQUU7UUFDUCxPQUFPLHFCQUFBLEtBQUksRUFBQSxTQUFBLEVBQVcsR0FBRyxDQUFDO01BQzlCO01BRUEsT0FBQSxxQkFBQSxDQUFPLElBQUksRUFBQSxTQUFBO0lBQ2Y7RUFBQztJQUFBLEdBQUE7SUFBQSxLQUFBLEVBRUQsU0FBQSxZQUFBLEVBQTJCO01BQUEsSUFBZixRQUFRLEdBQUEsU0FBQSxDQUFBLE1BQUEsUUFBQSxTQUFBLFFBQUEsU0FBQSxHQUFBLFNBQUEsTUFBRyxDQUFDLENBQUM7TUFDckIsSUFBSSxDQUFDLFFBQVEsRUFBRTtRQUNYO01BQ0o7TUFFQSxxQkFBQSxLQUFJLEVBQUEsU0FBQSxFQUFhLE1BQU0sQ0FBQyxNQUFNLENBQUEscUJBQUEsQ0FBQyxJQUFJLEVBQUEsU0FBQSxHQUFZLFFBQVEsQ0FBQztJQUM1RDtFQUFDO0VBQUEsT0FBQSxPQUFBO0FBQUE7QUFBQSxJQUFBLFFBQUEsR0FHVSxPQUFPO0FBQUEsT0FBQSxjQUFBLFFBQUE7Ozs7O0FDekN0QixJQUFBLEtBQUEsR0FBQSxzQkFBQSxDQUFBLE9BQUE7QUFBa0MsU0FBQSx1QkFBQSxHQUFBLFdBQUEsR0FBQSxJQUFBLEdBQUEsQ0FBQSxVQUFBLEdBQUEsR0FBQSxnQkFBQSxHQUFBO0FBQUEsU0FBQSxRQUFBLEdBQUEsc0NBQUEsT0FBQSx3QkFBQSxNQUFBLHVCQUFBLE1BQUEsQ0FBQSxRQUFBLGFBQUEsR0FBQSxrQkFBQSxHQUFBLGdCQUFBLEdBQUEsV0FBQSxHQUFBLHlCQUFBLE1BQUEsSUFBQSxHQUFBLENBQUEsV0FBQSxLQUFBLE1BQUEsSUFBQSxHQUFBLEtBQUEsTUFBQSxDQUFBLFNBQUEscUJBQUEsR0FBQSxLQUFBLE9BQUEsQ0FBQSxHQUFBO0FBQUEsU0FBQSxnQkFBQSxRQUFBLEVBQUEsV0FBQSxVQUFBLFFBQUEsWUFBQSxXQUFBLGVBQUEsU0FBQTtBQUFBLFNBQUEsa0JBQUEsTUFBQSxFQUFBLEtBQUEsYUFBQSxDQUFBLE1BQUEsQ0FBQSxHQUFBLEtBQUEsQ0FBQSxNQUFBLEVBQUEsQ0FBQSxVQUFBLFVBQUEsR0FBQSxLQUFBLENBQUEsQ0FBQSxHQUFBLFVBQUEsQ0FBQSxVQUFBLEdBQUEsVUFBQSxDQUFBLFVBQUEsV0FBQSxVQUFBLENBQUEsWUFBQSx3QkFBQSxVQUFBLEVBQUEsVUFBQSxDQUFBLFFBQUEsU0FBQSxNQUFBLENBQUEsY0FBQSxDQUFBLE1BQUEsRUFBQSxjQUFBLENBQUEsVUFBQSxDQUFBLEdBQUEsR0FBQSxVQUFBO0FBQUEsU0FBQSxhQUFBLFdBQUEsRUFBQSxVQUFBLEVBQUEsV0FBQSxRQUFBLFVBQUEsRUFBQSxpQkFBQSxDQUFBLFdBQUEsQ0FBQSxTQUFBLEVBQUEsVUFBQSxPQUFBLFdBQUEsRUFBQSxpQkFBQSxDQUFBLFdBQUEsRUFBQSxXQUFBLEdBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxXQUFBLGlCQUFBLFFBQUEsbUJBQUEsV0FBQTtBQUFBLFNBQUEsS0FBQSxlQUFBLE9BQUEsb0JBQUEsT0FBQSxDQUFBLEdBQUEsSUFBQSxJQUFBLEdBQUEsT0FBQSxDQUFBLEdBQUEsQ0FBQSxJQUFBLGFBQUEsSUFBQSxZQUFBLEtBQUEsTUFBQSxFQUFBLFFBQUEsRUFBQSxRQUFBLFFBQUEsSUFBQSxHQUFBLGNBQUEsQ0FBQSxNQUFBLEVBQUEsUUFBQSxRQUFBLElBQUEsY0FBQSxJQUFBLEdBQUEsTUFBQSxDQUFBLHdCQUFBLENBQUEsSUFBQSxFQUFBLFFBQUEsT0FBQSxJQUFBLENBQUEsR0FBQSxXQUFBLElBQUEsQ0FBQSxHQUFBLENBQUEsSUFBQSxDQUFBLFNBQUEsQ0FBQSxNQUFBLE9BQUEsTUFBQSxHQUFBLFFBQUEsWUFBQSxJQUFBLENBQUEsS0FBQSxjQUFBLElBQUEsQ0FBQSxLQUFBLE9BQUEsU0FBQTtBQUFBLFNBQUEsZUFBQSxNQUFBLEVBQUEsUUFBQSxZQUFBLE1BQUEsQ0FBQSxTQUFBLENBQUEsY0FBQSxDQUFBLElBQUEsQ0FBQSxNQUFBLEVBQUEsUUFBQSxLQUFBLE1BQUEsR0FBQSxlQUFBLENBQUEsTUFBQSxPQUFBLE1BQUEsMkJBQUEsTUFBQTtBQUFBLFNBQUEsVUFBQSxRQUFBLEVBQUEsVUFBQSxlQUFBLFVBQUEsbUJBQUEsVUFBQSx1QkFBQSxTQUFBLDBEQUFBLFFBQUEsQ0FBQSxTQUFBLEdBQUEsTUFBQSxDQUFBLE1BQUEsQ0FBQSxVQUFBLElBQUEsVUFBQSxDQUFBLFNBQUEsSUFBQSxXQUFBLElBQUEsS0FBQSxFQUFBLFFBQUEsRUFBQSxRQUFBLFFBQUEsWUFBQSxhQUFBLE1BQUEsQ0FBQSxjQUFBLENBQUEsUUFBQSxpQkFBQSxRQUFBLGdCQUFBLFVBQUEsRUFBQSxlQUFBLENBQUEsUUFBQSxFQUFBLFVBQUE7QUFBQSxTQUFBLGdCQUFBLENBQUEsRUFBQSxDQUFBLElBQUEsZUFBQSxHQUFBLE1BQUEsQ0FBQSxjQUFBLEdBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxJQUFBLGNBQUEsZ0JBQUEsQ0FBQSxFQUFBLENBQUEsSUFBQSxDQUFBLENBQUEsU0FBQSxHQUFBLENBQUEsU0FBQSxDQUFBLFlBQUEsZUFBQSxDQUFBLENBQUEsRUFBQSxDQUFBO0FBQUEsU0FBQSxhQUFBLE9BQUEsUUFBQSx5QkFBQSxHQUFBLHlCQUFBLG9CQUFBLHFCQUFBLFFBQUEsS0FBQSxHQUFBLGVBQUEsQ0FBQSxPQUFBLEdBQUEsTUFBQSxNQUFBLHlCQUFBLFFBQUEsU0FBQSxHQUFBLGVBQUEsT0FBQSxXQUFBLEVBQUEsTUFBQSxHQUFBLE9BQUEsQ0FBQSxTQUFBLENBQUEsS0FBQSxFQUFBLFNBQUEsRUFBQSxTQUFBLFlBQUEsTUFBQSxHQUFBLEtBQUEsQ0FBQSxLQUFBLE9BQUEsU0FBQSxZQUFBLDBCQUFBLE9BQUEsTUFBQTtBQUFBLFNBQUEsMkJBQUEsSUFBQSxFQUFBLElBQUEsUUFBQSxJQUFBLEtBQUEsT0FBQSxDQUFBLElBQUEseUJBQUEsSUFBQSwyQkFBQSxJQUFBLGFBQUEsSUFBQSx5QkFBQSxTQUFBLHVFQUFBLHNCQUFBLENBQUEsSUFBQTtBQUFBLFNBQUEsdUJBQUEsSUFBQSxRQUFBLElBQUEseUJBQUEsY0FBQSx3RUFBQSxJQUFBO0FBQUEsU0FBQSwwQkFBQSxlQUFBLE9BQUEscUJBQUEsT0FBQSxDQUFBLFNBQUEsb0JBQUEsT0FBQSxDQUFBLFNBQUEsQ0FBQSxJQUFBLDJCQUFBLEtBQUEsb0NBQUEsT0FBQSxDQUFBLFNBQUEsQ0FBQSxPQUFBLENBQUEsSUFBQSxDQUFBLE9BQUEsQ0FBQSxTQUFBLENBQUEsT0FBQSw4Q0FBQSxDQUFBO0FBQUEsU0FBQSxnQkFBQSxDQUFBLElBQUEsZUFBQSxHQUFBLE1BQUEsQ0FBQSxjQUFBLEdBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxJQUFBLGNBQUEsZ0JBQUEsQ0FBQSxXQUFBLENBQUEsQ0FBQSxTQUFBLElBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxDQUFBLGFBQUEsZUFBQSxDQUFBLENBQUE7QUFBQSxTQUFBLGdCQUFBLEdBQUEsRUFBQSxHQUFBLEVBQUEsS0FBQSxJQUFBLEdBQUEsR0FBQSxjQUFBLENBQUEsR0FBQSxPQUFBLEdBQUEsSUFBQSxHQUFBLElBQUEsTUFBQSxDQUFBLGNBQUEsQ0FBQSxHQUFBLEVBQUEsR0FBQSxJQUFBLEtBQUEsRUFBQSxLQUFBLEVBQUEsVUFBQSxRQUFBLFlBQUEsUUFBQSxRQUFBLG9CQUFBLEdBQUEsQ0FBQSxHQUFBLElBQUEsS0FBQSxXQUFBLEdBQUE7QUFBQSxTQUFBLGVBQUEsR0FBQSxRQUFBLEdBQUEsR0FBQSxZQUFBLENBQUEsR0FBQSxvQkFBQSxPQUFBLENBQUEsR0FBQSxpQkFBQSxHQUFBLEdBQUEsTUFBQSxDQUFBLEdBQUE7QUFBQSxTQUFBLGFBQUEsS0FBQSxFQUFBLElBQUEsUUFBQSxPQUFBLENBQUEsS0FBQSxrQkFBQSxLQUFBLGtCQUFBLEtBQUEsTUFBQSxJQUFBLEdBQUEsS0FBQSxDQUFBLE1BQUEsQ0FBQSxXQUFBLE9BQUEsSUFBQSxLQUFBLFNBQUEsUUFBQSxHQUFBLEdBQUEsSUFBQSxDQUFBLElBQUEsQ0FBQSxLQUFBLEVBQUEsSUFBQSxvQkFBQSxPQUFBLENBQUEsR0FBQSx1QkFBQSxHQUFBLFlBQUEsU0FBQSw0REFBQSxJQUFBLGdCQUFBLE1BQUEsR0FBQSxNQUFBLEVBQUEsS0FBQTtBQUFBLElBRTVCLFlBQVksMEJBQUEsUUFBQTtFQUFBLFNBQUEsQ0FB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Q3JELFFBQVEsQ0FBQyxTQUFTLENBQUMsTUFBTSxDQUFDLFFBQVEsQ0FBQztNQUN2QyxDQUFDLENBQUM7TUFDRixJQUFJLENBQUMsUUFBUSxDQUFDLElBQUksQ0FBQyxTQUFTLENBQUMsTUFBTSxDQUFDLFlBQVksQ0FBQztNQUNqRCxDQUFBLHNCQUFBLE9BQUksQ0FBQyxRQUFRLENBQUMsc0JBQXNCLGNBQUEsc0JBQUEsdUJBQXBDLHNCQUFBLENBQXNDLFNBQVMsQ0FBQyxNQUFNLENBQUMsV0FBVyxDQUFDO01BQ25FLElBQUksQ0FBQyxRQUFRLENBQUMsU0FBUyxDQUFDLEtBQUssQ0FBQyxVQUFVLEdBQUcsUUFBUTtJQUN2RDtFQUFDO0lBQUEsR0FBQTtJQUFBLEtBQUEsRUFFRCxTQUFBLGlCQUFBLEVBQW1CO01BQ2YsT0FBTyxDQUFDLFNBQVMsQ0FBQyxTQUFTLENBQUMsS0FBSyxDQUFDLGdEQUFnRCxDQUFDO0lBQ3ZGO0VBQUM7RUFBQSxPQUFBLFlBQUE7QUFBQSxFQTFGc0IsZ0JBQU87QUE2RmxDLElBQUksWUFBWSxDQUFDLENBQUMiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJjbGFzcyBPV19CYXNlIHtcbiAgICAjc2V0dGluZ3M7XG4gICAgZWxlbWVudHM7XG5cbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5vbkluaXQoKTtcbiAgICAgICAgdGhpcy5iaW5kRXZlbnRzKCk7XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgb25Jbml0KCkge1xuICAgICAgICB0aGlzLiNzZXR0aW5ncyA9IHRoaXMuZ2V0RGVmYXVsdFNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMgPSB0aGlzLmdldERlZmF1bHRFbGVtZW50cygpO1xuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7fVxuXG4gICAgZ2V0U2V0dGluZ3Moa2V5ID0gbnVsbCkge1xuICAgICAgICBpZiAoISFrZXkpIHtcbiAgICAgICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5nc1trZXldO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuI3NldHRpbmdzO1xuICAgIH1cblxuICAgIHNldFNldHRpbmdzKHNldHRpbmdzID0ge30pIHtcbiAgICAgICAgaWYgKCFzZXR0aW5ncykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSBPYmplY3QuYXNzaWduKHRoaXMuI3NldHRpbmdzLCBzZXR0aW5ncyk7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBPV19CYXNlO1xuIiwiaW1wb3J0IE9XX0Jhc2UgZnJvbSBcIi4vYmFzZS9iYXNlXCI7XG5cbmNsYXNzIE9XX1NpZGVQYW5lbCBleHRlbmRzIE9XX0Jhc2Uge1xuICAgIHBlcmZlY3RTY3JvbGxiYXI7XG5cbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBzaWRlUGFuZWw6IFwiI3NpZGUtcGFuZWwtaW5uZXJcIixcbiAgICAgICAgICAgICAgICBzaWRlUGFuZWxPcGVuQnV0dG9uczogXCJhLnNpZGUtcGFuZWwtYnRuLCAuc2lkZS1wYW5lbC1idG4gYVwiLFxuICAgICAgICAgICAgICAgIHNpZGVQYW5lbENsb3NlRWxlbWVudHM6IFwiI3NpZGUtcGFuZWwtaW5uZXIgYS5jbG9zZS1wYW5lbCwgLm9zcC1vdmVybGF5XCIsXG4gICAgICAgICAgICAgICAgc2lkZVBhbmVsSGFtYnVyZ2VySWNvbjogXCIuc2lkZS1wYW5lbC1idG4gPiAuc2lkZS1wYW5lbC1pY29uLmhhbWJ1cmdlclwiLFxuICAgICAgICAgICAgICAgIG1vYmlsZU1lbnU6IFwiI29jZWFuLW1vYmlsZS1tZW51LWljb24gYS5tb2JpbGUtbWVudVwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNpZGVQYW5lbDogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuc2lkZVBhbmVsKSxcbiAgICAgICAgICAgIHNpZGVQYW5lbE9wZW5CdXR0b25zOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5zaWRlUGFuZWxPcGVuQnV0dG9ucyksXG4gICAgICAgICAgICBzaWRlUGFuZWxDbG9zZUVsZW1lbnRzOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5zaWRlUGFuZWxDbG9zZUVsZW1lbnRzKSxcbiAgICAgICAgICAgIHNpZGVQYW5lbEhhbWJ1cmdlckljb246IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnNpZGVQYW5lbEhhbWJ1cmdlckljb24pLFxuICAgICAgICAgICAgbW9iaWxlTWVudTogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubW9iaWxlTWVudSksXG4gICAgICAgICAgICBib2R5OiBkb2N1bWVudC5ib2R5LFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCgpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KCk7XG5cbiAgICAgICAgaWYgKHRoaXMuaXNEZXNrdG9wQnJvd3NlcigpKSB7XG4gICAgICAgICAgICB0aGlzLmluaXRQZXJmZWN0U2Nyb2xsYmFyKCk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBiaW5kRXZlbnRzKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnNpZGVQYW5lbE9wZW5CdXR0b25zLmZvckVhY2goKG9wZW5CdG4pID0+IHtcbiAgICAgICAgICAgIG9wZW5CdG4uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMub3BlblNpZGVQYW5lbC5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5zaWRlUGFuZWxDbG9zZUVsZW1lbnRzLmZvckVhY2goKGNsb3NlQnRuKSA9PiB7XG4gICAgICAgICAgICBjbG9zZUJ0bi5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5jbG9zZVNpZGVQYW5lbC5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgaW5pdFBlcmZlY3RTY3JvbGxiYXIoKSB7XG4gICAgICAgIGlmICggISB0aGlzLmVsZW1lbnRzLnNpZGVQYW5lbCApIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuICAgICAgICB0aGlzLnBlcmZlY3RTY3JvbGxiYXIgPSBuZXcgUGVyZmVjdFNjcm9sbGJhcih0aGlzLmVsZW1lbnRzLnNpZGVQYW5lbCwge1xuICAgICAgICAgICAgd2hlZWxTcGVlZDogMC41LFxuICAgICAgICAgICAgc3VwcHJlc3NTY3JvbGxYOiBmYWxzZSxcbiAgICAgICAgICAgIHN1cHByZXNzU2Nyb2xsWTogZmFsc2UsXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIG9wZW5TaWRlUGFuZWwoZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICBjb25zdCBpc09wZW5TaWRlUGFuZWwgPSBBcnJheS5mcm9tKHRoaXMuZWxlbWVudHMuc2lkZVBhbmVsT3BlbkJ1dHRvbnMpLnNvbWUoKHsgY2xhc3NMaXN0IH0pID0+XG4gICAgICAgICAgICBjbGFzc0xpc3QuY29udGFpbnMoXCJvcGVuZWRcIilcbiAgICAgICAgKTtcblxuICAgICAgICBpZiAoaXNPcGVuU2lkZVBhbmVsKSB7XG4gICAgICAgICAgICB0aGlzLmNsb3NlU2lkZVBhbmVsKGV2ZW50KTtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIGNvbnN0IG9wZW5CdG4gPSBldmVudC5jdXJyZW50VGFyZ2V0O1xuXG4gICAgICAgIG9wZW5CdG4uY2xhc3NMaXN0LmFkZChcIm9wZW5lZFwiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5ib2R5LmNsYXNzTGlzdC5hZGQoXCJvc3Atb3BlbmVkXCIpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnNpZGVQYW5lbEhhbWJ1cmdlckljb24/LmNsYXNzTGlzdC5hZGQoXCJpcy1hY3RpdmVcIik7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuc2lkZVBhbmVsLnN0eWxlLnZpc2liaWxpdHkgPSBcInZpc2libGVcIjtcbiAgICB9XG5cbiAgICBjbG9zZVNpZGVQYW5lbChldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIHRoaXMuZWxlbWVudHMuc2lkZVBhbmVsT3BlbkJ1dHRvbnMuZm9yRWFjaCgoY2xvc2VCdG4pID0+IHtcbiAgICAgICAgICAgIGNsb3NlQnRuLmNsYXNzTGlzdC5yZW1vdmUoXCJvcGVuZWRcIik7XG4gICAgICAgIH0pO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmJvZHkuY2xhc3NMaXN0LnJlbW92ZShcIm9zcC1vcGVuZWRcIik7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuc2lkZVBhbmVsSGFtYnVyZ2VySWNvbj8uY2xhc3NMaXN0LnJlbW92ZShcImlzLWFjdGl2ZVwiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5zaWRlUGFuZWwuc3R5bGUudmlzaWJpbGl0eSA9IFwiaGlkZGVuXCI7XG4gICAgfVxuXG4gICAgaXNEZXNrdG9wQnJvd3NlcigpIHtcbiAgICAgICAgcmV0dXJuICFuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC8oQW5kcm9pZHxpUG9kfGlQaG9uZXxpUGFkfElFTW9iaWxlfE9wZXJhIE1pbmkpLyk7XG4gICAgfVxufVxuXG5uZXcgT1dfU2lkZVBhbmVsKCk7XG4iXX0=
