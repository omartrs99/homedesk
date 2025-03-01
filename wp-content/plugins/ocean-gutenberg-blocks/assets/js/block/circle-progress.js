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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var OGB_CircleProccess = /*#__PURE__*/function (_OW_Base) {
  _inherits(OGB_CircleProccess, _OW_Base);

  var _super = _createSuper(OGB_CircleProccess);

  function OGB_CircleProccess() {
    var _this;

    _classCallCheck(this, OGB_CircleProccess);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "pieProgress", void 0);

    return _this;
  }

  _createClass(OGB_CircleProccess, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          circleProgress: ".ogb-circle-progress"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings("selectors");
      return {
        circleProgress: document.querySelector(selectors.circleProgress),
        $circleProgress: document.querySelectorAll(selectors.circleProgress)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get2 = _get(_getPrototypeOf(OGB_CircleProccess.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (!this.elements.circleProgress) {
        return;
      }

      this.registerPieProgress();
      this.observer();
    }
  }, {
    key: "registerPieProgress",
    value: function registerPieProgress() {
      jQuery('.ogb-circle-progress').asPieProgress({
        namespace: "pieProgress",
        classes: {
          svg: "ogb-circle-progress-svg",
          number: "ogb-circle-progress-number",
          content: "ogb-circle-progress-content"
        }
      });
    }
  }, {
    key: "initPieProgress",
    value: function initPieProgress() {
      jQuery('.ogb-circle-progress').asPieProgress("start");
    }
  }, {
    key: "observer",
    value: function observer() {
      var observer = new IntersectionObserver(this.observerCallback.bind(this), {
        threshold: 0.65
      });
      observer.observe(this.elements.circleProgress);
    }
  }, {
    key: "observerCallback",
    value: function observerCallback(entries, observer) {
      var entry = entries[0];

      if (!entry.isIntersecting) {
        return;
      }

      this.initPieProgress();
      observer.unobserve(entry.target);
    }
  }]);

  return OGB_CircleProccess;
}(_base["default"]);

document.addEventListener("DOMContentLoaded", function () {
  new OGB_CircleProccess();
});

},{"./base":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvYmxvY2stanMvYmFzZS5qcyIsInNyYy9ibG9jay1qcy9jaXJjbGUtcHJvZ3Jlc3MuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDQU0sTztFQUlGLG1CQUFjO0lBQUE7O0lBQUE7TUFBQTtNQUFBO0lBQUE7O0lBQUE7O0lBQ1YsS0FBSyxNQUFMO0lBQ0EsS0FBSyxVQUFMO0VBQ0g7Ozs7V0FFRCw4QkFBcUI7TUFDakIsT0FBTyxFQUFQO0lBQ0g7OztXQUVELDhCQUFxQjtNQUNqQixPQUFPLEVBQVA7SUFDSDs7O1dBRUQsa0JBQVM7TUFDTCx1Q0FBaUIsS0FBSyxrQkFBTCxFQUFqQjs7TUFDQSxLQUFLLFFBQUwsR0FBZ0IsS0FBSyxrQkFBTCxFQUFoQjtJQUNIOzs7V0FFRCxzQkFBYSxDQUFFOzs7V0FFZix1QkFBd0I7TUFBQSxJQUFaLEdBQVksdUVBQU4sSUFBTTs7TUFDcEIsSUFBSSxDQUFDLENBQUMsR0FBTixFQUFXO1FBQ1AsT0FBTyx1Q0FBZSxHQUFmLENBQVA7TUFDSDs7TUFFRCw2QkFBTyxJQUFQO0lBQ0g7OztXQUVELHVCQUEyQjtNQUFBLElBQWYsUUFBZSx1RUFBSixFQUFJOztNQUN2QixJQUFJLENBQUMsUUFBTCxFQUFlO1FBQ1g7TUFDSDs7TUFFRCx1Q0FBaUIsTUFBTSxDQUFDLE1BQVAsdUJBQWMsSUFBZCxjQUE4QixRQUE5QixDQUFqQjtJQUNIOzs7Ozs7ZUFHVSxPOzs7Ozs7OztBQ3pDZjs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sa0I7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O1dBR0YsOEJBQXFCO01BQ2pCLE9BQU87UUFDSCxTQUFTLEVBQUU7VUFDUCxjQUFjLEVBQUU7UUFEVDtNQURSLENBQVA7SUFLSDs7O1dBRUQsOEJBQXFCO01BQ2pCLElBQU0sU0FBUyxHQUFHLEtBQUssV0FBTCxDQUFpQixXQUFqQixDQUFsQjtNQUVBLE9BQU87UUFDSCxjQUFjLEVBQUUsUUFBUSxDQUFDLGFBQVQsQ0FBdUIsU0FBUyxDQUFDLGNBQWpDLENBRGI7UUFFSCxlQUFlLEVBQUUsUUFBUSxDQUFDLGdCQUFULENBQTBCLFNBQVMsQ0FBQyxjQUFwQztNQUZkLENBQVA7SUFJSDs7O1dBRUQsa0JBQWdCO01BQUE7O01BQUEsbUNBQU4sSUFBTTtRQUFOLElBQU07TUFBQTs7TUFDWiw4R0FBZ0IsSUFBaEI7O01BRUEsSUFBSyxDQUFFLEtBQUssUUFBTCxDQUFjLGNBQXJCLEVBQXNDO1FBQ2xDO01BQ0g7O01BRUQsS0FBSyxtQkFBTDtNQUNBLEtBQUssUUFBTDtJQUNIOzs7V0FFRCwrQkFBc0I7TUFDbEIsTUFBTSxDQUFDLHNCQUFELENBQU4sQ0FBK0IsYUFBL0IsQ0FBNkM7UUFDekMsU0FBUyxFQUFFLGFBRDhCO1FBRXpDLE9BQU8sRUFBRTtVQUNMLEdBQUcsRUFBRSx5QkFEQTtVQUVMLE1BQU0sRUFBRSw0QkFGSDtVQUdMLE9BQU8sRUFBRTtRQUhKO01BRmdDLENBQTdDO0lBUUg7OztXQUVELDJCQUFrQjtNQUNkLE1BQU0sQ0FBQyxzQkFBRCxDQUFOLENBQStCLGFBQS9CLENBQTZDLE9BQTdDO0lBQ0g7OztXQUVELG9CQUFXO01BQ1AsSUFBTSxRQUFRLEdBQUcsSUFBSSxvQkFBSixDQUF5QixLQUFLLGdCQUFMLENBQXNCLElBQXRCLENBQTJCLElBQTNCLENBQXpCLEVBQTJEO1FBQ3hFLFNBQVMsRUFBRTtNQUQ2RCxDQUEzRCxDQUFqQjtNQUlBLFFBQVEsQ0FBQyxPQUFULENBQWlCLEtBQUssUUFBTCxDQUFjLGNBQS9CO0lBQ0g7OztXQUVELDBCQUFpQixPQUFqQixFQUEwQixRQUExQixFQUFvQztNQUNoQyxJQUFNLEtBQUssR0FBRyxPQUFPLENBQUMsQ0FBRCxDQUFyQjs7TUFFQSxJQUFJLENBQUMsS0FBSyxDQUFDLGNBQVgsRUFBMkI7UUFDdkI7TUFDSDs7TUFFRCxLQUFLLGVBQUw7TUFFQSxRQUFRLENBQUMsU0FBVCxDQUFtQixLQUFLLENBQUMsTUFBekI7SUFDSDs7OztFQWhFNEIsZ0I7O0FBbUVqQyxRQUFRLENBQUMsZ0JBQVQsQ0FBMEIsa0JBQTFCLEVBQThDLFlBQU07RUFDaEQsSUFBSSxrQkFBSjtBQUNILENBRkQiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJjbGFzcyBPV19CYXNlIHtcbiAgICAjc2V0dGluZ3M7XG4gICAgZWxlbWVudHM7XG5cbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5vbkluaXQoKTtcbiAgICAgICAgdGhpcy5iaW5kRXZlbnRzKCk7XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICByZXR1cm4ge307XG4gICAgfVxuXG4gICAgb25Jbml0KCkge1xuICAgICAgICB0aGlzLiNzZXR0aW5ncyA9IHRoaXMuZ2V0RGVmYXVsdFNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMgPSB0aGlzLmdldERlZmF1bHRFbGVtZW50cygpO1xuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7fVxuXG4gICAgZ2V0U2V0dGluZ3Moa2V5ID0gbnVsbCkge1xuICAgICAgICBpZiAoISFrZXkpIHtcbiAgICAgICAgICAgIHJldHVybiB0aGlzLiNzZXR0aW5nc1trZXldO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuI3NldHRpbmdzO1xuICAgIH1cblxuICAgIHNldFNldHRpbmdzKHNldHRpbmdzID0ge30pIHtcbiAgICAgICAgaWYgKCFzZXR0aW5ncykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy4jc2V0dGluZ3MgPSBPYmplY3QuYXNzaWduKHRoaXMuI3NldHRpbmdzLCBzZXR0aW5ncyk7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBPV19CYXNlO1xuIiwiaW1wb3J0IE9XX0Jhc2UgZnJvbSAnLi9iYXNlJztcblxuY2xhc3MgT0dCX0NpcmNsZVByb2NjZXNzIGV4dGVuZHMgT1dfQmFzZSB7XG4gICAgcGllUHJvZ3Jlc3M7XG5cbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBjaXJjbGVQcm9ncmVzczogXCIub2diLWNpcmNsZS1wcm9ncmVzc1wiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGNpcmNsZVByb2dyZXNzOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jaXJjbGVQcm9ncmVzcyksXG4gICAgICAgICAgICAkY2lyY2xlUHJvZ3Jlc3M6IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNpcmNsZVByb2dyZXNzKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgaWYgKCAhIHRoaXMuZWxlbWVudHMuY2lyY2xlUHJvZ3Jlc3MgKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLnJlZ2lzdGVyUGllUHJvZ3Jlc3MoKTtcbiAgICAgICAgdGhpcy5vYnNlcnZlcigpO1xuICAgIH1cblxuICAgIHJlZ2lzdGVyUGllUHJvZ3Jlc3MoKSB7XG4gICAgICAgIGpRdWVyeSgnLm9nYi1jaXJjbGUtcHJvZ3Jlc3MnKS5hc1BpZVByb2dyZXNzKHtcbiAgICAgICAgICAgIG5hbWVzcGFjZTogXCJwaWVQcm9ncmVzc1wiLFxuICAgICAgICAgICAgY2xhc3Nlczoge1xuICAgICAgICAgICAgICAgIHN2ZzogXCJvZ2ItY2lyY2xlLXByb2dyZXNzLXN2Z1wiLFxuICAgICAgICAgICAgICAgIG51bWJlcjogXCJvZ2ItY2lyY2xlLXByb2dyZXNzLW51bWJlclwiLFxuICAgICAgICAgICAgICAgIGNvbnRlbnQ6IFwib2diLWNpcmNsZS1wcm9ncmVzcy1jb250ZW50XCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBpbml0UGllUHJvZ3Jlc3MoKSB7XG4gICAgICAgIGpRdWVyeSgnLm9nYi1jaXJjbGUtcHJvZ3Jlc3MnKS5hc1BpZVByb2dyZXNzKFwic3RhcnRcIik7XG4gICAgfVxuXG4gICAgb2JzZXJ2ZXIoKSB7XG4gICAgICAgIGNvbnN0IG9ic2VydmVyID0gbmV3IEludGVyc2VjdGlvbk9ic2VydmVyKHRoaXMub2JzZXJ2ZXJDYWxsYmFjay5iaW5kKHRoaXMpLCB7XG4gICAgICAgICAgICB0aHJlc2hvbGQ6IDAuNjUsXG4gICAgICAgIH0pO1xuXG4gICAgICAgIG9ic2VydmVyLm9ic2VydmUodGhpcy5lbGVtZW50cy5jaXJjbGVQcm9ncmVzcyk7XG4gICAgfVxuXG4gICAgb2JzZXJ2ZXJDYWxsYmFjayhlbnRyaWVzLCBvYnNlcnZlcikge1xuICAgICAgICBjb25zdCBlbnRyeSA9IGVudHJpZXNbMF07XG5cbiAgICAgICAgaWYgKCFlbnRyeS5pc0ludGVyc2VjdGluZykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy5pbml0UGllUHJvZ3Jlc3MoKTtcblxuICAgICAgICBvYnNlcnZlci51bm9ic2VydmUoZW50cnkudGFyZ2V0KTtcbiAgICB9XG59XG5cbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsICgpID0+IHtcbiAgICBuZXcgT0dCX0NpcmNsZVByb2NjZXNzKCk7XG59KTtcblxuIl19
