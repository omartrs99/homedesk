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

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

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

var OGB_Clipboard = /*#__PURE__*/function (_OW_Base) {
  _inherits(OGB_Clipboard, _OW_Base);

  var _super = _createSuper(OGB_Clipboard);

  function OGB_Clipboard() {
    _classCallCheck(this, OGB_Clipboard);

    return _super.apply(this, arguments);
  }

  _createClass(OGB_Clipboard, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          clipboardButton: ".ogb-clipboard-button",
          clipboardValue: ".ogb-clipboard-value"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        clipboardButton: document.querySelector(selectors.clipboardButton),
        clipboardValue: document.querySelector(selectors.clipboardValue)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OGB_Clipboard.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setupEventListeners();
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (!this.elements.clipboardButton) {
        return;
      }

      this.elements.clipboardButton.addEventListener("click", this.copy.bind(this));
    }
  }, {
    key: "copy",
    value: function copy(event) {
      var data = this.elements.clipboardValue.dataset.clipboardTarget;
      this.elements.clipboardButton.insertAdjacentHTML("beforeend", "<input type=\"text\" value=\"".concat(data, "\" id=\"ogbClipboardInput\" />"));
      var clipboardInput = document.querySelector("#ogbClipboardInput");
      clipboardInput.select();
      document.execCommand("copy");
      clipboardInput.remove();
    }
  }]);

  return OGB_Clipboard;
}(_base["default"]);

document.addEventListener("DOMContentLoaded", function () {
  new OGB_Clipboard();
});

},{"./base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvYmxvY2stanMvYmFzZS5qcyIsInNyYy9ibG9jay1qcy9jbGlwYm9hcmQuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDQU0sTztFQUlGLG1CQUFjO0lBQUE7O0lBQUE7TUFBQTtNQUFBO0lBQUE7O0lBQUE7O0lBQ1YsS0FBSyxNQUFMO0lBQ0EsS0FBSyxVQUFMO0VBQ0g7Ozs7V0FFRCw4QkFBcUI7TUFDakIsT0FBTyxFQUFQO0lBQ0g7OztXQUVELDhCQUFxQjtNQUNqQixPQUFPLEVBQVA7SUFDSDs7O1dBRUQsa0JBQVM7TUFDTCx1Q0FBaUIsS0FBSyxrQkFBTCxFQUFqQjs7TUFDQSxLQUFLLFFBQUwsR0FBZ0IsS0FBSyxrQkFBTCxFQUFoQjtJQUNIOzs7V0FFRCxzQkFBYSxDQUFFOzs7V0FFZix1QkFBd0I7TUFBQSxJQUFaLEdBQVksdUVBQU4sSUFBTTs7TUFDcEIsSUFBSSxDQUFDLENBQUMsR0FBTixFQUFXO1FBQ1AsT0FBTyx1Q0FBZSxHQUFmLENBQVA7TUFDSDs7TUFFRCw2QkFBTyxJQUFQO0lBQ0g7OztXQUVELHVCQUEyQjtNQUFBLElBQWYsUUFBZSx1RUFBSixFQUFJOztNQUN2QixJQUFJLENBQUMsUUFBTCxFQUFlO1FBQ1g7TUFDSDs7TUFFRCx1Q0FBaUIsTUFBTSxDQUFDLE1BQVAsdUJBQWMsSUFBZCxjQUE4QixRQUE5QixDQUFqQjtJQUNIOzs7Ozs7ZUFHVSxPOzs7Ozs7OztBQ3pDZjs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLGE7Ozs7Ozs7Ozs7Ozs7V0FDSiw4QkFBcUI7TUFDbkIsT0FBTztRQUNMLFNBQVMsRUFBRTtVQUNULGVBQWUsRUFBRSx1QkFEUjtVQUVULGNBQWMsRUFBRTtRQUZQO01BRE4sQ0FBUDtJQU1EOzs7V0FFRCw4QkFBcUI7TUFDbkIsSUFBTSxTQUFTLEdBQUcsS0FBSyxXQUFMLENBQWlCLFdBQWpCLENBQWxCO01BRUEsT0FBTztRQUNMLGVBQWUsRUFBRSxRQUFRLENBQUMsYUFBVCxDQUF1QixTQUFTLENBQUMsZUFBakMsQ0FEWjtRQUVMLGNBQWMsRUFBRSxRQUFRLENBQUMsYUFBVCxDQUF1QixTQUFTLENBQUMsY0FBakM7TUFGWCxDQUFQO0lBSUQ7OztXQUVELGtCQUFnQjtNQUFBOztNQUFBLGtDQUFOLElBQU07UUFBTixJQUFNO01BQUE7O01BQ2QseUdBQWdCLElBQWhCOztNQUVBLEtBQUssbUJBQUw7SUFDRDs7O1dBRUQsK0JBQXNCO01BQ3BCLElBQUssQ0FBRSxLQUFLLFFBQUwsQ0FBYyxlQUFyQixFQUF1QztRQUNyQztNQUNEOztNQUVELEtBQUssUUFBTCxDQUFjLGVBQWQsQ0FBOEIsZ0JBQTlCLENBQ0UsT0FERixFQUVFLEtBQUssSUFBTCxDQUFVLElBQVYsQ0FBZSxJQUFmLENBRkY7SUFJRDs7O1dBRUQsY0FBSyxLQUFMLEVBQVk7TUFDVixJQUFNLElBQUksR0FBRyxLQUFLLFFBQUwsQ0FBYyxjQUFkLENBQTZCLE9BQTdCLENBQXFDLGVBQWxEO01BQ0EsS0FBSyxRQUFMLENBQWMsZUFBZCxDQUE4QixrQkFBOUIsQ0FDRSxXQURGLHlDQUUrQixJQUYvQjtNQUlBLElBQU0sY0FBYyxHQUFHLFFBQVEsQ0FBQyxhQUFULENBQXVCLG9CQUF2QixDQUF2QjtNQUNBLGNBQWMsQ0FBQyxNQUFmO01BQ0EsUUFBUSxDQUFDLFdBQVQsQ0FBcUIsTUFBckI7TUFDQSxjQUFjLENBQUMsTUFBZjtJQUNEOzs7O0VBOUN5QixnQjs7QUFpRDVCLFFBQVEsQ0FBQyxnQkFBVCxDQUEwQixrQkFBMUIsRUFBOEMsWUFBTTtFQUNoRCxJQUFJLGFBQUo7QUFDSCxDQUZEIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiY2xhc3MgT1dfQmFzZSB7XG4gICAgI3NldHRpbmdzO1xuICAgIGVsZW1lbnRzO1xuXG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMub25Jbml0KCk7XG4gICAgICAgIHRoaXMuYmluZEV2ZW50cygpO1xuICAgIH1cblxuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHt9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgcmV0dXJuIHt9O1xuICAgIH1cblxuICAgIG9uSW5pdCgpIHtcbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSB0aGlzLmdldERlZmF1bHRTZXR0aW5ncygpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzID0gdGhpcy5nZXREZWZhdWx0RWxlbWVudHMoKTtcbiAgICB9XG5cbiAgICBiaW5kRXZlbnRzKCkge31cblxuICAgIGdldFNldHRpbmdzKGtleSA9IG51bGwpIHtcbiAgICAgICAgaWYgKCEha2V5KSB7XG4gICAgICAgICAgICByZXR1cm4gdGhpcy4jc2V0dGluZ3Nba2V5XTtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5ncztcbiAgICB9XG5cbiAgICBzZXRTZXR0aW5ncyhzZXR0aW5ncyA9IHt9KSB7XG4gICAgICAgIGlmICghc2V0dGluZ3MpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuI3NldHRpbmdzID0gT2JqZWN0LmFzc2lnbih0aGlzLiNzZXR0aW5ncywgc2V0dGluZ3MpO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgT1dfQmFzZTtcbiIsImltcG9ydCBPV19CYXNlIGZyb20gJy4vYmFzZSc7XG5cbmNsYXNzIE9HQl9DbGlwYm9hcmQgZXh0ZW5kcyBPV19CYXNlIHtcbiAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgIHJldHVybiB7XG4gICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgY2xpcGJvYXJkQnV0dG9uOiBcIi5vZ2ItY2xpcGJvYXJkLWJ1dHRvblwiLFxuICAgICAgICBjbGlwYm9hcmRWYWx1ZTogXCIub2diLWNsaXBib2FyZC12YWx1ZVwiLFxuICAgICAgfSxcbiAgICB9O1xuICB9XG5cbiAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICByZXR1cm4ge1xuICAgICAgY2xpcGJvYXJkQnV0dG9uOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jbGlwYm9hcmRCdXR0b24pLFxuICAgICAgY2xpcGJvYXJkVmFsdWU6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNsaXBib2FyZFZhbHVlKSxcbiAgICB9O1xuICB9XG5cbiAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgfVxuXG4gIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgaWYgKCAhIHRoaXMuZWxlbWVudHMuY2xpcGJvYXJkQnV0dG9uICkge1xuICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIHRoaXMuZWxlbWVudHMuY2xpcGJvYXJkQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoXG4gICAgICBcImNsaWNrXCIsXG4gICAgICB0aGlzLmNvcHkuYmluZCh0aGlzKVxuICAgICk7XG4gIH1cblxuICBjb3B5KGV2ZW50KSB7XG4gICAgY29uc3QgZGF0YSA9IHRoaXMuZWxlbWVudHMuY2xpcGJvYXJkVmFsdWUuZGF0YXNldC5jbGlwYm9hcmRUYXJnZXQ7XG4gICAgdGhpcy5lbGVtZW50cy5jbGlwYm9hcmRCdXR0b24uaW5zZXJ0QWRqYWNlbnRIVE1MKFxuICAgICAgXCJiZWZvcmVlbmRcIixcbiAgICAgIGA8aW5wdXQgdHlwZT1cInRleHRcIiB2YWx1ZT1cIiR7ZGF0YX1cIiBpZD1cIm9nYkNsaXBib2FyZElucHV0XCIgLz5gXG4gICAgKTtcbiAgICBjb25zdCBjbGlwYm9hcmRJbnB1dCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIjb2diQ2xpcGJvYXJkSW5wdXRcIik7XG4gICAgY2xpcGJvYXJkSW5wdXQuc2VsZWN0KCk7XG4gICAgZG9jdW1lbnQuZXhlY0NvbW1hbmQoXCJjb3B5XCIpO1xuICAgIGNsaXBib2FyZElucHV0LnJlbW92ZSgpO1xuICB9XG59XG5cbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsICgpID0+IHtcbiAgICBuZXcgT0dCX0NsaXBib2FyZCgpO1xufSk7XG4iXX0=
