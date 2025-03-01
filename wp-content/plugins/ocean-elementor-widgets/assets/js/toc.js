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

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_TOC = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_TOC, _elementorModules$fro);

  var _super = _createSuper(OEW_TOC);

  function OEW_TOC() {
    _classCallCheck(this, OEW_TOC);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_TOC, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      var elementSettings = this.getElementSettings(),
          listWrapperTag = 'numbers' === elementSettings.marker_view ? 'ol' : 'ul';
      return {
        selectors: {
          widgetTocContainer: '.elementor-widget-container',
          postContentContainer: '.elementor:not([data-elementor-type="header"]):not([data-elementor-type="footer"]):not([data-elementor-type="popup"])',
          expandButton: '.oew-toc-toggle-button-expand',
          collapseButton: '.oew-toc-toggle-button-collapse',
          body: '.oew-toc-body',
          headerTitle: '.oew-toc-header-title'
        },
        classes: {
          anchor: 'elementor-menu-anchor',
          listWrapper: 'oew-toc-list-wrapper',
          listItem: 'oew-toc-list-item',
          listTextWrapper: 'oew-toc-list-item-text-wrapper',
          firstLevelListItem: 'oew-toc-top-level',
          listItemText: 'oew-toc-list-item-text',
          activeItem: 'elementor-item-active',
          headingAnchor: 'oew-toc-heading-anchor',
          collapsed: 'oew-toc-collapsed'
        },
        listWrapperTag: listWrapperTag
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var settings = this.getSettings();
      return {
        $pageContainer: this.getTocContainer(),
        $widgetTocContainer: this.$element.find(settings.selectors.widgetTocContainer),
        $expandButton: this.$element.find(settings.selectors.expandButton),
        $collapseButton: this.$element.find(settings.selectors.collapseButton),
        $tocBody: this.$element.find(settings.selectors.body),
        $listItems: this.$element.find('.' + settings.classes.listItem)
      };
    }
  }, {
    key: "getTocContainer",
    value: function getTocContainer() {
      var settings = this.getSettings(),
          elementSettings = this.getElementSettings();

      if (elementSettings.container) {
        return jQuery(elementSettings.container);
      }

      var $documentWrapper = this.$element.parents('.elementor');

      if ('popup' === $documentWrapper.attr('data-elementor-type')) {
        return $documentWrapper;
      }

      return jQuery(settings.selectors.postContentContainer);
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this = this;

      var elementSettings = this.getElementSettings();

      if (elementSettings.minimize_box) {
        this.elements.$expandButton.on('click', function () {
          return _this.expandTocBox();
        });
        this.elements.$collapseButton.on('click', function () {
          return _this.collapseTocBox();
        });
      }

      if (elementSettings.collapse_subitems) {
        this.elements.$listItems.hover(function (event) {
          return jQuery(event.target).slideToggle();
        });
      }
    }
  }, {
    key: "getHeadings",
    value: function getHeadings() {
      // Get all headings from document by user-selected tags
      var elementSettings = this.getElementSettings(),
          tags = elementSettings.headings_by_tags.join(','),
          selectors = this.getSettings('selectors'),
          excludedSelectors = elementSettings.exclude_headings_by_selector;
      return this.elements.$pageContainer.find(tags).not(selectors.headerTitle).filter(function (index, heading) {
        return !jQuery(heading).closest(excludedSelectors).length; // Handle excluded selectors if there are any
      });
    }
  }, {
    key: "addAnchorsBeforeHeadings",
    value: function addAnchorsBeforeHeadings() {
      // Add an anchor element right before each TOC heading to create anchors for TOC links
      var classes = this.getSettings('classes');
      var elementSettings = this.getElementSettings();
      this.elements.$headings.each(function (index) {
        if (elementSettings.duplicate_anchor_fix == 'yes') {
          var anchorText = this.textContent.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase() + '-' + index;
        } else {
          var anchorText = this.textContent.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase();
        }

        this.setAttribute('id', anchorText);
      });
    }
  }, {
    key: "_getPrototypeOf",
    value: function _getPrototypeOf(o) {
      return o.__proto__ || Object.getPrototypeOf(o);
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2,
          _this6 = this;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, this._get3)((0, this._getPrototypeOf)(OEW_TOC.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.viewportItems = [];
      jQuery(document).ready(function () {
        return _this6.run();
      });
    }
  }, {
    key: "onListItemClick",
    value: function onListItemClick(event) {
      var _this7 = this;

      this.itemClicked = true;
      setTimeout(function () {
        return _this7.itemClicked = false;
      }, 2000);
      var $clickedItem = jQuery(event.currentTarget),
          $list = $clickedItem.parent().next(),
          collapseNestedList = this.getElementSettings('collapse_subitems');
      var listIsActive;

      if (collapseNestedList && $clickedItem.hasClass(this.getSettings('classes.firstLevelListItem'))) {
        if ($list.is(':visible')) {
          listIsActive = true;
        }
      }

      this.activateTocItem($clickedItem);

      if (collapseNestedList && listIsActive) {
        $list.slideUp();
      }
    }
  }, {
    key: "activateTocItem",
    value: function activateTocItem($listItem) {
      var classes = this.getSettings('classes');
      this.deactivateTocActiveItem($listItem);
      $listItem.addClass(classes.activeItem);
      this.$activeItem = $listItem;

      if (!this.getElementSettings('collapse_subitems')) {
        return;
      }

      var $activeList;

      if ($listItem.hasClass(classes.firstLevelListItem)) {
        $activeList = $listItem.parent().next();
      } else {
        $activeList = $listItem.parents('.' + classes.listWrapper).eq(-2);
      }

      if (!$activeList.length) {
        delete this.$activeList;
        return;
      }

      this.$activeList = $activeList;
      this.$activeList.stop().slideDown();
    }
  }, {
    key: "deactivateTocActiveItem",
    value: function deactivateTocActiveItem($activeToBe) {
      if (!this.$activeItem || this.$activeItem.is($activeToBe)) {
        return;
      }

      var _this$getSettings = this.getSettings(),
          classes = _this$getSettings.classes;

      this.$activeItem.removeClass(classes.activeItem);

      if (this.$activeList && (!$activeToBe || !this.$activeList[0].contains($activeToBe[0]))) {
        this.$activeList.slideUp();
      }
    }
  }, {
    key: "followTocAnchor",
    value: function followTocAnchor($element, index) {
      var _this2 = this;

      var anchorSelector = $element[0].hash;
      var $anchor;

      try {
        // `decodeURIComponent` for UTF8 characters in the hash.
        $anchor = jQuery(decodeURIComponent(anchorSelector));
      } catch (e) {
        return;
      } // Implement Intersection Observer instead of Waypoint


      var observerOptions = {
        root: null,
        // viewport
        rootMargin: '0px',
        threshold: 0.1 // trigger when 10% of the element is visible

      };

      var callback = function callback(entries) {
        entries.forEach(function (entry) {
          if (_this2.itemClicked) {
            return;
          }

          var id = entry.target.getAttribute('id');

          if (entry.isIntersecting) {
            if (entry.boundingClientRect.top > 0) {
              // Scrolling down
              _this2.viewportItems[id] = true;

              _this2.activateTocItem($element);
            }
          } else {
            if (entry.boundingClientRect.top < 0) {
              // Scrolling up
              delete _this2.viewportItems[id];

              _this2.activateTocItem(_this2.$listItemTexts.eq(index - 1));
            }
          }
        });
      };

      var observer = new IntersectionObserver(callback, observerOptions);
      var target = document.getElementById(anchorSelector.replace('#', ''));

      if (target) {
        observer.observe(target);
      }
    }
  }, {
    key: "followTocAnchors",
    value: function followTocAnchors() {
      var _this3 = this;

      this.$listItemTexts.each(function (index, element) {
        return _this3.followTocAnchor(jQuery(element), index);
      });
    }
  }, {
    key: "populateTOC",
    value: function populateTOC() {
      this.listItemPointer = 0;
      var elementSettings = this.getElementSettings();

      if (elementSettings.hierarchical_view) {
        this.createNestedList();
      } else {
        this.createFlatList();
      }

      this.$listItemTexts = this.$element.find('.oew-toc-list-item-text');
      this.$listItemTexts.on('click', this.onListItemClick.bind(this));

      if (!elementorFrontend.isEditMode()) {
        this.followTocAnchors();
      }
    }
  }, {
    key: "createNestedList",
    value: function createNestedList() {
      var _this4 = this;

      this.headingsData.forEach(function (heading, index) {
        heading.level = 0;

        for (var i = index - 1; i >= 0; i--) {
          var currentOrderedItem = _this4.headingsData[i];

          if (currentOrderedItem.tag <= heading.tag) {
            heading.level = currentOrderedItem.level;

            if (currentOrderedItem.tag < heading.tag) {
              heading.level++;
            }

            break;
          }
        }
      });
      this.elements.$tocBody.html(this.getNestedTocLevel(0));
    }
  }, {
    key: "createFlatList",
    value: function createFlatList() {
      this.elements.$tocBody.html(this.getNestedTocLevel());
    }
  }, {
    key: "getNestedTocLevel",
    value: function getNestedTocLevel(level) {
      var settings = this.getSettings(),
          elementSettings = this.getElementSettings(),
          icon = this.getElementSettings('icon'); // Open new list/nested list

      var html = "<".concat(settings.listWrapperTag, " class=\"").concat(settings.classes.listWrapper, "\">"); // for each list item, build its markup.

      while (this.listItemPointer < this.headingsData.length) {
        var currentItem = this.headingsData[this.listItemPointer];
        var listItemTextClasses = settings.classes.listItemText;

        if (0 === currentItem.level) {
          // If the current list item is a top level item, give it the first level class
          listItemTextClasses += ' ' + settings.classes.firstLevelListItem;
        }

        if (level > currentItem.level) {
          break;
        }

        if (level === currentItem.level) {
          html += "<li class=\"".concat(settings.classes.listItem, "\">");
          html += "<div class=\"".concat(settings.classes.listTextWrapper, "\">");

          if (elementSettings.duplicate_anchor_fix == 'yes') {
            var anchorText = currentItem.text.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase() + '-' + this.listItemPointer;
          } else {
            var anchorText = currentItem.text.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase();
          }

          var liContent = "<a href=\"#".concat(anchorText, "\" class=\"").concat(listItemTextClasses, "\">").concat(currentItem.text, "</a>"); // If list type is bullets, add the bullet icon as an <i> tag

          if ('bullets' === elementSettings.marker_view && icon) {
            liContent = "<i class=\"".concat(icon.value, "\"></i>").concat(liContent);
          }

          html += liContent;
          html += '</div>';
          this.listItemPointer++;
          var nextItem = this.headingsData[this.listItemPointer];

          if (nextItem && level < nextItem.level) {
            // If a new nested list has to be created under the current item,
            // this entire method is called recursively (outside the while loop, a list wrapper is created)
            html += this.getNestedTocLevel(nextItem.level);
          }

          html += '</li>';
        }
      }

      html += "</".concat(settings.listWrapperTag, ">");
      return html;
    }
  }, {
    key: "handleNoHeadingsFound",
    value: function handleNoHeadingsFound() {
      var noHeadingsText = elementorProFrontend.config.i18n['toc_no_headings_found'];

      if (elementorFrontend.isEditMode()) {
        noHeadingsText = elementorPro.translate('toc_no_headings_found');
      }

      return this.elements.$tocBody.html(noHeadingsText);
    }
  }, {
    key: "collapseOnInit",
    value: function collapseOnInit() {
      var minimizedOn = this.getElementSettings('minimized_on'),
          currentDeviceMode = elementorFrontend.getCurrentDeviceMode();

      if ('tablet' === minimizedOn && 'desktop' !== currentDeviceMode || 'mobile' === minimizedOn && 'mobile' === currentDeviceMode) {
        this.collapseTocBox();
      }
    }
  }, {
    key: "setHeadingsData",
    value: function setHeadingsData() {
      var _this5 = this;

      this.headingsData = []; // Create an array for simplifying TOC list creation

      this.elements.$headings.each(function (index, element) {
        _this5.headingsData.push({
          tag: +element.nodeName.slice(1),
          text: element.textContent
        });
      });
    }
  }, {
    key: "run",
    value: function run() {
      this.elements.$headings = this.getHeadings();

      if (!this.elements.$headings.length) {
        return this.handleNoHeadingsFound();
      }

      this.setHeadingsData();

      if (!elementorFrontend.isEditMode()) {
        this.addAnchorsBeforeHeadings();
      }

      this.populateTOC();

      if (this.getElementSettings('minimize_box')) {
        this.collapseOnInit();
      }
    }
  }, {
    key: "expandTocBox",
    value: function expandTocBox() {
      var boxHeight = this.getCurrentDeviceSetting('min_height');
      this.$element.removeClass(this.getSettings('classes.collapsed'));
      this.elements.$tocBody.slideDown(); // return container to the full height in case a min-height is defined by the user

      this.elements.$widgetTocContainer.css('min-height', boxHeight.size + boxHeight.unit);
    }
  }, {
    key: "collapseTocBox",
    value: function collapseTocBox() {
      this.$element.addClass(this.getSettings('classes.collapsed'));
      this.elements.$tocBody.slideUp(); // close container in case a min-height is defined by the user

      this.elements.$widgetTocContainer.css('min-height', '0px');
    }
  }, {
    key: "_superPropBase",
    value: function _superPropBase(object, property) {
      while (!Object.prototype.hasOwnProperty.call(object, property)) {
        object = getPrototypeOf(object);
        if (object === null) break;
      }

      return object;
    }
  }, {
    key: "_get3",
    value: function _get3(target, property, receiver) {
      if (typeof Reflect !== "undefined" && Reflect.get) {
        return Reflect.get(target, property, receiver || target);
        module.exports = _get = Reflect.get;
      } else {
        var base = superPropBase(target, property);
        if (!base) return;
        var desc = Object.getOwnPropertyDescriptor(base, property);

        if (desc.get) {
          return desc.get.call(receiver);
        }

        return desc.value;
      }

      return _get(target, property, receiver || target);
    }
  }]);

  return OEW_TOC;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_TOC, "oew-toc");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy90b2MuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7QUNBTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxNQUFJLE9BQU8sR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsT0FBL0M7O0FBRUEsTUFBSSxPQUFPLEtBQUssTUFBaEIsRUFBd0I7QUFDcEIsSUFBQSxPQUFPLEdBQUcsT0FBVjtBQUNIOztBQUVELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFDQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLFVBQVUsQ0FBQyxZQUFNO0FBQ2IsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsTUFBMUI7QUFDSCxHQUZTLEVBRVAsQ0FGTyxDQUFWO0FBSUEsRUFBQSxNQUFNLENBQUMsVUFBUCxDQUFrQixZQUFNO0FBQ3BCLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENB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QjtBQUNBLFlBQUksTUFBTSxLQUFLLElBQWYsRUFBcUI7QUFDeEI7O0FBRUQsYUFBTyxNQUFQO0FBQ0g7OztXQUNELGVBQU0sTUFBTixFQUFjLFFBQWQsRUFBd0IsUUFBeEIsRUFBa0M7QUFDOUIsVUFBSSxPQUFPLE9BQVAsS0FBbUIsV0FBbkIsSUFBa0MsT0FBTyxDQUFDLEdBQTlDLEVBQW1EO0FBQy9DLGVBQU8sT0FBTyxDQUFDLEdBQVIsQ0FBWSxNQUFaLEVBQW9CLFFBQXBCLEVBQThCLFFBQVEsSUFBSSxNQUExQyxDQUFQO0FBQ0EsUUFBQSxNQUFNLENBQUMsT0FBUCxHQUFpQixJQUFJLEdBQUcsT0FBTyxDQUFDLEdBQWhDO0FBQ0gsT0FIRCxNQUdPO0FBQ0gsWUFBSSxJQUFJLEdBQUcsYUFBYSxDQUFDLE1BQUQsRUFBUyxRQUFULENBQXhCO0FBQ0EsWUFBSSxDQUFDLElBQUwsRUFBVztBQUNYLFlBQUksSUFBSSxHQUFHLE1BQU0sQ0FBQyx3QkFBUCxDQUFnQyxJQUFoQyxFQUFzQyxRQUF0QyxDQUFYOztBQUVBLFlBQUksSUFBSSxDQUFDLEdBQVQsRUFBYztBQUNWLGlCQUFPLElBQUksQ0FBQyxHQUFMLENBQVMsSUFBVCxDQUFjLFFBQWQsQ0FBUDtBQUNIOztBQUVELGVBQU8sSUFBSSxDQUFDLEtBQVo7QUFFSDs7QUFFRCxhQUFPLElBQUksQ0FBQyxNQUFELEVBQVMsUUFBVCxFQUFtQixRQUFRLElBQUksTUFBL0IsQ0FBWDtBQUNIOzs7O0VBdGJpQixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQTJiekQsMkJBQWUsT0FBZixFQUF3QixTQUF4QiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCBzbGlkZURvd24gPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcbiAgICBsZXQgZGlzcGxheSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXk7XG5cbiAgICBpZiAoZGlzcGxheSA9PT0gXCJub25lXCIpIHtcbiAgICAgICAgZGlzcGxheSA9IFwiYmxvY2tcIjtcbiAgICB9XG5cbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0XCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXk7XG4gICAgbGV0IGhlaWdodCA9IGVsZW1lbnQub2Zmc2V0SGVpZ2h0O1xuXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtoZWlnaHR9cHhgO1xuICAgIH0sIDUpO1xuXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm9wYWNpdHlcIik7XG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3Qgc2xpZGVVcCA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodCwgbWFyZ2luXCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XG4gICAgfSwgNSk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLXRvcFwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi1ib3R0b21cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xuICAgIH0sIGR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IHNsaWRlVG9nZ2xlID0gKGVsZW1lbnQsIGR1cmF0aW9uKSA9PiB7XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAxLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAwLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZVRvZ2dsZSA9IChlbGVtZW50LCBvcHRpb25zKSA9PiB7XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBmYWRlSW4oZWxlbWVudCwgb3B0aW9ucykgOiBmYWRlT3V0KGVsZW1lbnQsIG9wdGlvbnMpO1xufTtcblxuZXhwb3J0IGNvbnN0IG9mZnNldCA9IChlbGVtZW50KSA9PiB7XG4gICAgaWYgKCFlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKSB7XG4gICAgICAgIHJldHVybiB7IHRvcDogMCwgbGVmdDogMCB9O1xuICAgIH1cblxuICAgIC8vIEdldCBkb2N1bWVudC1yZWxhdGl2ZSBwb3NpdGlvbiBieSBhZGRpbmcgdmlld3BvcnQgc2Nyb2xsIHRvIHZpZXdwb3J0LXJlbGF0aXZlIGdCQ1JcbiAgICBjb25zdCByZWN0ID0gZWxlbWVudC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKTtcbiAgICBjb25zdCB3aW4gPSBlbGVtZW50Lm93bmVyRG9jdW1lbnQuZGVmYXVsdFZpZXc7XG4gICAgcmV0dXJuIHtcbiAgICAgICAgdG9wOiByZWN0LnRvcCArIHdpbi5wYWdlWU9mZnNldCxcbiAgICAgICAgbGVmdDogcmVjdC5sZWZ0ICsgd2luLnBhZ2VYT2Zmc2V0LFxuICAgIH07XG59O1xuXG5leHBvcnQgY29uc3QgdmlzaWJsZSA9IChlbGVtZW50KSA9PiB7XG4gICAgaWYgKCFlbGVtZW50KSB7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG5cbiAgICByZXR1cm4gISEoZWxlbWVudC5vZmZzZXRXaWR0aCB8fCBlbGVtZW50Lm9mZnNldEhlaWdodCB8fCBlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKTtcbn07XG5cbmV4cG9ydCBjb25zdCBnZXRTaWJsaW5ncyA9IChlKSA9PiB7XG4gICAgLy8gZm9yIGNvbGxlY3Rpbmcgc2libGluZ3NcbiAgICBjb25zdCBzaWJsaW5ncyA9IFtdO1xuXG4gICAgLy8gaWYgbm8gcGFyZW50LCByZXR1cm4gbm8gc2libGluZ1xuICAgIGlmICghZS5wYXJlbnROb2RlKSB7XG4gICAgICAgIHJldHVybiBzaWJsaW5ncztcbiAgICB9XG5cbiAgICAvLyBmaXJzdCBjaGlsZCBvZiB0aGUgcGFyZW50IG5vZGVcbiAgICBsZXQgc2libGluZyA9IGUucGFyZW50Tm9kZS5maXJzdENoaWxkO1xuXG4gICAgLy8gY29sbGVjdGluZyBzaWJsaW5nc1xuICAgIHdoaWxlIChzaWJsaW5nKSB7XG4gICAgICAgIGlmIChzaWJsaW5nLm5vZGVUeXBlID09PSAxICYmIHNpYmxpbmcgIT09IGUpIHtcbiAgICAgICAgICAgIHNpYmxpbmdzLnB1c2goc2libGluZyk7XG4gICAgICAgIH1cblxuICAgICAgICBzaWJsaW5nID0gc2libGluZy5uZXh0U2libGluZztcbiAgICB9XG5cbiAgICByZXR1cm4gc2libGluZ3M7XG59O1xuXG4vLyBSZXR1cm5zIHRydWUgaWYgaXQgaXMgYSBET00gZWxlbWVudFxuZXhwb3J0IGNvbnN0IGlzRWxlbWVudCA9IChvKSA9PiB7XG4gICAgcmV0dXJuIHR5cGVvZiBIVE1MRWxlbWVudCA9PT0gXCJvYmplY3RcIlxuICAgICAgICA/IG8gaW5zdGFuY2VvZiBIVE1MRWxlbWVudCAvLyBET00yXG4gICAgICAgIDogbyAmJiB0eXBlb2YgbyA9PT0gXCJvYmplY3RcIiAmJiBvICE9PSBudWxsICYmIG8ubm9kZVR5cGUgPT09IDEgJiYgdHlwZW9mIG8ubm9kZU5hbWUgPT09IFwic3RyaW5nXCI7XG59O1xuXG5leHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gXCJkZWZhdWx0XCIpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbihcImVsZW1lbnRvci9mcm9udGVuZC9pbml0XCIsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHtcbiAgICByZWdpc3RlcldpZGdldFxufSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIE9FV19UT0MgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICB2YXIgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKSxcbiAgICAgICAgICAgIGxpc3RXcmFwcGVyVGFnID0gJ251bWJlcnMnID09PSBlbGVtZW50U2V0dGluZ3MubWFya2VyX3ZpZXcgPyAnb2wnIDogJ3VsJztcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIHdpZGdldFRvY0NvbnRhaW5lcjogJy5lbGVtZW50b3Itd2lkZ2V0LWNvbnRhaW5lcicsXG4gICAgICAgICAgICAgICAgcG9zdENvbnRlbnRDb250YWluZXI6ICcuZWxlbWVudG9yOm5vdChbZGF0YS1lbGVtZW50b3ItdHlwZT1cImhlYWRlclwiXSk6bm90KFtkYXRhLWVsZW1lbnRvci10eXBlPVwiZm9vdGVyXCJdKTpub3QoW2RhdGEtZWxlbWVudG9yLXR5cGU9XCJwb3B1cFwiXSknLFxuICAgICAgICAgICAgICAgIGV4cGFuZEJ1dHRvbjogJy5vZXctdG9jLXRvZ2dsZS1idXR0b24tZXhwYW5kJyxcbiAgICAgICAgICAgICAgICBjb2xsYXBzZUJ1dHRvbjogJy5vZXctdG9jLXRvZ2dsZS1idXR0b24tY29sbGFwc2UnLFxuICAgICAgICAgICAgICAgIGJvZHk6ICcub2V3LXRvYy1ib2R5JyxcbiAgICAgICAgICAgICAgICBoZWFkZXJUaXRsZTogJy5vZXctdG9jLWhlYWRlci10aXRsZSdcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjbGFzc2VzOiB7XG4gICAgICAgICAgICAgICAgYW5jaG9yOiAnZWxlbWVudG9yLW1lbnUtYW5jaG9yJyxcbiAgICAgICAgICAgICAgICBsaXN0V3JhcHBlcjogJ29ldy10b2MtbGlzdC13cmFwcGVyJyxcbiAgICAgICAgICAgICAgICBsaXN0SXRlbTogJ29ldy10b2MtbGlzdC1pdGVtJyxcbiAgICAgICAgICAgICAgICBsaXN0VGV4dFdyYXBwZXI6ICdvZXctdG9jLWxpc3QtaXRlbS10ZXh0LXdyYXBwZXInLFxuICAgICAgICAgICAgICAgIGZpcnN0TGV2ZWxMaXN0SXRlbTogJ29ldy10b2MtdG9wLWxldmVsJyxcbiAgICAgICAgICAgICAgICBsaXN0SXRlbVRleHQ6ICdvZXctdG9jLWxpc3QtaXRlbS10ZXh0JyxcbiAgICAgICAgICAgICAgICBhY3RpdmVJdGVtOiAnZWxlbWVudG9yLWl0ZW0tYWN0aXZlJyxcbiAgICAgICAgICAgICAgICBoZWFkaW5nQW5jaG9yOiAnb2V3LXRvYy1oZWFkaW5nLWFuY2hvcicsXG4gICAgICAgICAgICAgICAgY29sbGFwc2VkOiAnb2V3LXRvYy1jb2xsYXBzZWQnXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgbGlzdFdyYXBwZXJUYWc6IGxpc3RXcmFwcGVyVGFnXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICB2YXIgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICAkcGFnZUNvbnRhaW5lcjogdGhpcy5nZXRUb2NDb250YWluZXIoKSxcbiAgICAgICAgICAgICR3aWRnZXRUb2NDb250YWluZXI6IHRoaXMuJGVsZW1lbnQuZmluZChzZXR0aW5ncy5zZWxlY3RvcnMud2lkZ2V0VG9jQ29udGFpbmVyKSxcbiAgICAgICAgICAgICRleHBhbmRCdXR0b246IHRoaXMuJGVsZW1lbnQuZmluZChzZXR0aW5ncy5zZWxlY3RvcnMuZXhwYW5kQnV0dG9uKSxcbiAgICAgICAgICAgICRjb2xsYXBzZUJ1dHRvbjogdGhpcy4kZWxlbWVudC5maW5kKHNldHRpbmdzLnNlbGVjdG9ycy5jb2xsYXBzZUJ1dHRvbiksXG4gICAgICAgICAgICAkdG9jQm9keTogdGhpcy4kZWxlbWVudC5maW5kKHNldHRpbmdzLnNlbGVjdG9ycy5ib2R5KSxcbiAgICAgICAgICAgICRsaXN0SXRlbXM6IHRoaXMuJGVsZW1lbnQuZmluZCgnLicgKyBzZXR0aW5ncy5jbGFzc2VzLmxpc3RJdGVtKVxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldFRvY0NvbnRhaW5lcigpIHtcbiAgICAgICAgdmFyIHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpLFxuICAgICAgICAgICAgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKTtcblxuICAgICAgICBpZiAoZWxlbWVudFNldHRpbmdzLmNvbnRhaW5lcikge1xuICAgICAgICAgICAgcmV0dXJuIGpRdWVyeShlbGVtZW50U2V0dGluZ3MuY29udGFpbmVyKTtcbiAgICAgICAgfVxuXG5cbiAgICAgICAgdmFyICRkb2N1bWVudFdyYXBwZXIgPSB0aGlzLiRlbGVtZW50LnBhcmVudHMoJy5lbGVtZW50b3InKTtcblxuICAgICAgICBpZiAoJ3BvcHVwJyA9PT0gJGRvY3VtZW50V3JhcHBlci5hdHRyKCdkYXRhLWVsZW1lbnRvci10eXBlJykpIHtcbiAgICAgICAgICAgIHJldHVybiAkZG9jdW1lbnRXcmFwcGVyO1xuICAgICAgICB9XG5cblxuICAgICAgICByZXR1cm4galF1ZXJ5KHNldHRpbmdzLnNlbGVjdG9ycy5wb3N0Q29udGVudENvbnRhaW5lcik7XG4gICAgfVxuICAgIGJpbmRFdmVudHMoKSB7XG4gICAgICAgIHZhciBfdGhpcyA9IHRoaXM7XG5cbiAgICAgICAgdmFyIGVsZW1lbnRTZXR0aW5ncyA9IHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCk7XG5cbiAgICAgICAgaWYgKGVsZW1lbnRTZXR0aW5ncy5taW5pbWl6ZV9ib3gpIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuJGV4cGFuZEJ1dHRvbi5vbignY2xpY2snLCBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gX3RoaXMuZXhwYW5kVG9jQm94KCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuJGNvbGxhcHNlQnV0dG9uLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIHJldHVybiBfdGhpcy5jb2xsYXBzZVRvY0JveCgpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoZWxlbWVudFNldHRpbmdzLmNvbGxhcHNlX3N1Yml0ZW1zKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLiRsaXN0SXRlbXMuaG92ZXIoZnVuY3Rpb24oZXZlbnQpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4galF1ZXJ5KGV2ZW50LnRhcmdldCkuc2xpZGVUb2dnbGUoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxuICAgIGdldEhlYWRpbmdzKCkge1xuICAgICAgICAvLyBHZXQgYWxsIGhlYWRpbmdzIGZyb20gZG9jdW1lbnQgYnkgdXNlci1zZWxlY3RlZCB0YWdzXG4gICAgICAgIHZhciBlbGVtZW50U2V0dGluZ3MgPSB0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygpLFxuICAgICAgICAgICAgdGFncyA9IGVsZW1lbnRTZXR0aW5ncy5oZWFkaW5nc19ieV90YWdzLmpvaW4oJywnKSxcbiAgICAgICAgICAgIHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycycpLFxuICAgICAgICAgICAgZXhjbHVkZWRTZWxlY3RvcnMgPSBlbGVtZW50U2V0dGluZ3MuZXhjbHVkZV9oZWFkaW5nc19ieV9zZWxlY3RvcjtcbiAgICAgICAgcmV0dXJuIHRoaXMuZWxlbWVudHMuJHBhZ2VDb250YWluZXIuZmluZCh0YWdzKS5ub3Qoc2VsZWN0b3JzLmhlYWRlclRpdGxlKS5maWx0ZXIoZnVuY3Rpb24oaW5kZXgsIGhlYWRpbmcpIHtcbiAgICAgICAgICAgIHJldHVybiAhalF1ZXJ5KGhlYWRpbmcpLmNsb3Nlc3QoZXhjbHVkZWRTZWxlY3RvcnMpLmxlbmd0aDsgLy8gSGFuZGxlIGV4Y2x1ZGVkIHNlbGVjdG9ycyBpZiB0aGVyZSBhcmUgYW55XG4gICAgICAgIH0pO1xuICAgIH1cbiAgICBhZGRBbmNob3JzQmVmb3JlSGVhZGluZ3MoKSB7XG4gICAgICAgIC8vIEFkZCBhbiBhbmNob3IgZWxlbWVudCByaWdodCBiZWZvcmUgZWFjaCBUT0MgaGVhZGluZyB0byBjcmVhdGUgYW5jaG9ycyBmb3IgVE9DIGxpbmtzXG4gICAgICAgIHZhciBjbGFzc2VzID0gdGhpcy5nZXRTZXR0aW5ncygnY2xhc3NlcycpO1xuICAgICAgICB2YXIgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy4kaGVhZGluZ3MuZWFjaChmdW5jdGlvbihpbmRleCkge1xuICAgICAgICAgIGlmIChlbGVtZW50U2V0dGluZ3MuZHVwbGljYXRlX2FuY2hvcl9maXggPT0gJ3llcycpIHtcbiAgICAgICAgICAgICAgdmFyIGFuY2hvclRleHQgPSB0aGlzLnRleHRDb250ZW50LnJlcGxhY2UoL1xccysvZywgJy0nKS5yZXBsYWNlKC9bXlxcdy1dKy9nLCAnJykudG9Mb3dlckNhc2UoKSArICctJyArIGluZGV4O1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHZhciBhbmNob3JUZXh0ID0gdGhpcy50ZXh0Q29udGVudC5yZXBsYWNlKC9cXHMrL2csICctJykucmVwbGFjZSgvW15cXHctXSsvZywgJycpLnRvTG93ZXJDYXNlKCk7XG4gICAgICAgICAgfVxuICAgICAgICAgIHRoaXMuc2V0QXR0cmlidXRlKCdpZCcsIGFuY2hvclRleHQpO1xuICAgICAgfSk7XG5cbiAgICB9XG4gICAgX2dldFByb3RvdHlwZU9mKG8pIHtcbiAgICAgICAgcmV0dXJuIG8uX19wcm90b19fIHx8IE9iamVjdC5nZXRQcm90b3R5cGVPZihvKTtcbiAgICB9XG4gICAgb25Jbml0KCkge1xuICAgICAgICB2YXIgX2dldDIsXG4gICAgICAgICAgICBfdGhpczYgPSB0aGlzO1xuXG4gICAgICAgIGZvciAodmFyIF9sZW4gPSBhcmd1bWVudHMubGVuZ3RoLCBhcmdzID0gbmV3IEFycmF5KF9sZW4pLCBfa2V5ID0gMDsgX2tleSA8IF9sZW47IF9rZXkrKykge1xuICAgICAgICAgICAgYXJnc1tfa2V5XSA9IGFyZ3VtZW50c1tfa2V5XTtcbiAgICAgICAgfVxuXG4gICAgICAgIChfZ2V0MiA9ICgwLCB0aGlzLl9nZXQzKSgoMCwgdGhpcy5fZ2V0UHJvdG90eXBlT2YpKE9FV19UT0MucHJvdG90eXBlKSwgXCJvbkluaXRcIiwgdGhpcykpLmNhbGwuYXBwbHkoX2dldDIsIFt0aGlzXS5jb25jYXQoYXJncykpO1xuXG4gICAgICAgIHRoaXMudmlld3BvcnRJdGVtcyA9IFtdO1xuICAgICAgICBqUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgcmV0dXJuIF90aGlzNi5ydW4oKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgb25MaXN0SXRlbUNsaWNrKGV2ZW50KSB7XG4gICAgICB2YXIgX3RoaXM3ID0gdGhpcztcblxuICAgICAgdGhpcy5pdGVtQ2xpY2tlZCA9IHRydWU7XG4gICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAgIHJldHVybiBfdGhpczcuaXRlbUNsaWNrZWQgPSBmYWxzZTtcbiAgICAgIH0sIDIwMDApO1xuXG4gICAgICB2YXIgJGNsaWNrZWRJdGVtID0galF1ZXJ5KGV2ZW50LmN1cnJlbnRUYXJnZXQpLFxuICAgICAgICAgICRsaXN0ID0gJGNsaWNrZWRJdGVtLnBhcmVudCgpLm5leHQoKSxcbiAgICAgICAgICBjb2xsYXBzZU5lc3RlZExpc3QgPSB0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygnY29sbGFwc2Vfc3ViaXRlbXMnKTtcbiAgICAgIHZhciBsaXN0SXNBY3RpdmU7XG5cbiAgICAgIGlmIChjb2xsYXBzZU5lc3RlZExpc3QgJiYgJGNsaWNrZWRJdGVtLmhhc0NsYXNzKHRoaXMuZ2V0U2V0dGluZ3MoJ2NsYXNzZXMuZmlyc3RMZXZlbExpc3RJdGVtJykpKSB7XG4gICAgICAgICAgaWYgKCRsaXN0LmlzKCc6dmlzaWJsZScpKSB7XG4gICAgICAgICAgICAgIGxpc3RJc0FjdGl2ZSA9IHRydWU7XG4gICAgICAgICAgfVxuICAgICAgfVxuXG4gICAgICB0aGlzLmFjdGl2YXRlVG9jSXRlbSgkY2xpY2tlZEl0ZW0pO1xuXG4gICAgICBpZiAoY29sbGFwc2VOZXN0ZWRMaXN0ICYmIGxpc3RJc0FjdGl2ZSkge1xuICAgICAgICAgICRsaXN0LnNsaWRlVXAoKTtcbiAgICAgIH1cblxuICB9XG5cblxuICAgIGFjdGl2YXRlVG9jSXRlbSgkbGlzdEl0ZW0pIHtcblxuICAgICAgICB2YXIgY2xhc3NlcyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ2NsYXNzZXMnKTtcbiAgICAgICAgdGhpcy5kZWFjdGl2YXRlVG9jQWN0aXZlSXRlbSgkbGlzdEl0ZW0pO1xuICAgICAgICAkbGlzdEl0ZW0uYWRkQ2xhc3MoY2xhc3Nlcy5hY3RpdmVJdGVtKTtcbiAgICAgICAgdGhpcy4kYWN0aXZlSXRlbSA9ICRsaXN0SXRlbTtcblxuICAgICAgICBpZiAoIXRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCdjb2xsYXBzZV9zdWJpdGVtcycpKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH1cblxuICAgICAgICB2YXIgJGFjdGl2ZUxpc3Q7XG5cbiAgICAgICAgaWYgKCRsaXN0SXRlbS5oYXNDbGFzcyhjbGFzc2VzLmZpcnN0TGV2ZWxMaXN0SXRlbSkpIHtcbiAgICAgICAgICAgICRhY3RpdmVMaXN0ID0gJGxpc3RJdGVtLnBhcmVudCgpLm5leHQoKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICRhY3RpdmVMaXN0ID0gJGxpc3RJdGVtLnBhcmVudHMoJy4nICsgY2xhc3Nlcy5saXN0V3JhcHBlcikuZXEoLTIpO1xuICAgICAgICB9XG5cbiAgICAgICAgaWYgKCEkYWN0aXZlTGlzdC5sZW5ndGgpIHtcbiAgICAgICAgICAgIGRlbGV0ZSB0aGlzLiRhY3RpdmVMaXN0O1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy4kYWN0aXZlTGlzdCA9ICRhY3RpdmVMaXN0O1xuICAgICAgICB0aGlzLiRhY3RpdmVMaXN0LnN0b3AoKS5zbGlkZURvd24oKTtcbiAgICB9XG5cbiAgICBkZWFjdGl2YXRlVG9jQWN0aXZlSXRlbSgkYWN0aXZlVG9CZSkge1xuICAgICAgICBpZiAoIXRoaXMuJGFjdGl2ZUl0ZW0gfHwgdGhpcy4kYWN0aXZlSXRlbS5pcygkYWN0aXZlVG9CZSkpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIHZhciBfdGhpcyRnZXRTZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKSxcbiAgICAgICAgICAgIGNsYXNzZXMgPSBfdGhpcyRnZXRTZXR0aW5ncy5jbGFzc2VzO1xuXG4gICAgICAgIHRoaXMuJGFjdGl2ZUl0ZW0ucmVtb3ZlQ2xhc3MoY2xhc3Nlcy5hY3RpdmVJdGVtKTtcblxuICAgICAgICBpZiAodGhpcy4kYWN0aXZlTGlzdCAmJiAoISRhY3RpdmVUb0JlIHx8ICF0aGlzLiRhY3RpdmVMaXN0WzBdLmNvbnRhaW5zKCRhY3RpdmVUb0JlWzBdKSkpIHtcbiAgICAgICAgICAgIHRoaXMuJGFjdGl2ZUxpc3Quc2xpZGVVcCgpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgZm9sbG93VG9jQW5jaG9yKCRlbGVtZW50LCBpbmRleCkge1xuICAgICAgdmFyIF90aGlzMiA9IHRoaXM7XG5cbiAgICAgIHZhciBhbmNob3JTZWxlY3RvciA9ICRlbGVtZW50WzBdLmhhc2g7XG4gICAgICB2YXIgJGFuY2hvcjtcblxuICAgICAgdHJ5IHtcbiAgICAgICAgICAvLyBgZGVjb2RlVVJJQ29tcG9uZW50YCBmb3IgVVRGOCBjaGFyYWN0ZXJzIGluIHRoZSBoYXNoLlxuICAgICAgICAgICRhbmNob3IgPSBqUXVlcnkoZGVjb2RlVVJJQ29tcG9uZW50KGFuY2hvclNlbGVjdG9yKSk7XG4gICAgICB9IGNhdGNoIChlKSB7XG4gICAgICAgICAgcmV0dXJuO1xuICAgICAgfVxuXG4gICAgICAvLyBJbXBsZW1lbnQgSW50ZXJzZWN0aW9uIE9ic2VydmVyIGluc3RlYWQgb2YgV2F5cG9pbnRcbiAgICAgIGNvbnN0IG9ic2VydmVyT3B0aW9ucyA9IHtcbiAgICAgICAgICByb290OiBudWxsLCAvLyB2aWV3cG9ydFxuICAgICAgICAgIHJvb3RNYXJnaW46ICcwcHgnLFxuICAgICAgICAgIHRocmVzaG9sZDogMC4xIC8vIHRyaWdnZXIgd2hlbiAxMCUgb2YgdGhlIGVsZW1lbnQgaXMgdmlzaWJsZVxuICAgICAgfTtcblxuICAgICAgY29uc3QgY2FsbGJhY2sgPSAoZW50cmllcykgPT4ge1xuICAgICAgICAgIGVudHJpZXMuZm9yRWFjaChlbnRyeSA9PiB7XG4gICAgICAgICAgICAgIGlmIChfdGhpczIuaXRlbUNsaWNrZWQpIHtcbiAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgIGNvbnN0IGlkID0gZW50cnkudGFyZ2V0LmdldEF0dHJpYnV0ZSgnaWQnKTtcblxuICAgICAgICAgICAgICBpZiAoZW50cnkuaXNJbnRlcnNlY3RpbmcpIHtcbiAgICAgICAgICAgICAgICAgIGlmIChlbnRyeS5ib3VuZGluZ0NsaWVudFJlY3QudG9wID4gMCkgeyAvLyBTY3JvbGxpbmcgZG93blxuICAgICAgICAgICAgICAgICAgICAgIF90aGlzMi52aWV3cG9ydEl0ZW1zW2lkXSA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgICAgX3RoaXMyLmFjdGl2YXRlVG9jSXRlbSgkZWxlbWVudCk7XG4gICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICBpZiAoZW50cnkuYm91bmRpbmdDbGllbnRSZWN0LnRvcCA8IDApIHsgLy8gU2Nyb2xsaW5nIHVwXG4gICAgICAgICAgICAgICAgICAgICAgZGVsZXRlIF90aGlzMi52aWV3cG9ydEl0ZW1zW2lkXTtcbiAgICAgICAgICAgICAgICAgICAgICBfdGhpczIuYWN0aXZhdGVUb2NJdGVtKF90aGlzMi4kbGlzdEl0ZW1UZXh0cy5lcShpbmRleCAtIDEpKTtcbiAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgfVxuICAgICAgICAgIH0pO1xuICAgICAgfTtcblxuICAgICAgY29uc3Qgb2JzZXJ2ZXIgPSBuZXcgSW50ZXJzZWN0aW9uT2JzZXJ2ZXIoY2FsbGJhY2ssIG9ic2VydmVyT3B0aW9ucyk7XG4gICAgICBjb25zdCB0YXJnZXQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChhbmNob3JTZWxlY3Rvci5yZXBsYWNlKCcjJywgJycpKTtcbiAgICAgIGlmICh0YXJnZXQpIHtcbiAgICAgICAgICBvYnNlcnZlci5vYnNlcnZlKHRhcmdldCk7XG4gICAgICB9XG5cbiAgfVxuXG5cbiAgICBmb2xsb3dUb2NBbmNob3JzKCkge1xuICAgICAgICB2YXIgX3RoaXMzID0gdGhpcztcblxuICAgICAgICB0aGlzLiRsaXN0SXRlbVRleHRzLmVhY2goZnVuY3Rpb24oaW5kZXgsIGVsZW1lbnQpIHtcbiAgICAgICAgICAgIHJldHVybiBfdGhpczMuZm9sbG93VG9jQW5jaG9yKGpRdWVyeShlbGVtZW50KSwgaW5kZXgpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBwb3B1bGF0ZVRPQygpIHtcbiAgICAgICAgdGhpcy5saXN0SXRlbVBvaW50ZXIgPSAwO1xuICAgICAgICB2YXIgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKTtcblxuICAgICAgICBpZiAoZWxlbWVudFNldHRpbmdzLmhpZXJhcmNoaWNhbF92aWV3KSB7XG4gICAgICAgICAgICB0aGlzLmNyZWF0ZU5lc3RlZExpc3QoKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuY3JlYXRlRmxhdExpc3QoKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuJGxpc3RJdGVtVGV4dHMgPSB0aGlzLiRlbGVtZW50LmZpbmQoJy5vZXctdG9jLWxpc3QtaXRlbS10ZXh0Jyk7XG4gICAgICAgIHRoaXMuJGxpc3RJdGVtVGV4dHMub24oJ2NsaWNrJywgdGhpcy5vbkxpc3RJdGVtQ2xpY2suYmluZCh0aGlzKSk7XG5cbiAgICAgICAgaWYgKCFlbGVtZW50b3JGcm9udGVuZC5pc0VkaXRNb2RlKCkpIHtcbiAgICAgICAgICAgIHRoaXMuZm9sbG93VG9jQW5jaG9ycygpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgY3JlYXRlTmVzdGVkTGlzdCgpIHtcbiAgICAgICAgdmFyIF90aGlzNCA9IHRoaXM7XG5cbiAgICAgICAgdGhpcy5oZWFkaW5nc0RhdGEuZm9yRWFjaChmdW5jdGlvbihoZWFkaW5nLCBpbmRleCkge1xuICAgICAgICAgICAgaGVhZGluZy5sZXZlbCA9IDA7XG5cbiAgICAgICAgICAgIGZvciAodmFyIGkgPSBpbmRleCAtIDE7IGkgPj0gMDsgaS0tKSB7XG4gICAgICAgICAgICAgICAgdmFyIGN1cnJlbnRPcmRlcmVkSXRlbSA9IF90aGlzNC5oZWFkaW5nc0RhdGFbaV07XG5cbiAgICAgICAgICAgICAgICBpZiAoY3VycmVudE9yZGVyZWRJdGVtLnRhZyA8PSBoZWFkaW5nLnRhZykge1xuICAgICAgICAgICAgICAgICAgICBoZWFkaW5nLmxldmVsID0gY3VycmVudE9yZGVyZWRJdGVtLmxldmVsO1xuXG4gICAgICAgICAgICAgICAgICAgIGlmIChjdXJyZW50T3JkZXJlZEl0ZW0udGFnIDwgaGVhZGluZy50YWcpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGhlYWRpbmcubGV2ZWwrKztcbiAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuJHRvY0JvZHkuaHRtbCh0aGlzLmdldE5lc3RlZFRvY0xldmVsKDApKTtcbiAgICB9XG5cbiAgICBjcmVhdGVGbGF0TGlzdCgpIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy4kdG9jQm9keS5odG1sKHRoaXMuZ2V0TmVzdGVkVG9jTGV2ZWwoKSk7XG4gICAgfVxuXG4gICAgZ2V0TmVzdGVkVG9jTGV2ZWwobGV2ZWwpIHtcbiAgICAgICAgdmFyIHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpLFxuICAgICAgICAgICAgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKSxcbiAgICAgICAgICAgIGljb24gPSB0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygnaWNvbicpOyAvLyBPcGVuIG5ldyBsaXN0L25lc3RlZCBsaXN0XG5cbiAgICAgICAgdmFyIGh0bWwgPSBcIjxcIi5jb25jYXQoc2V0dGluZ3MubGlzdFdyYXBwZXJUYWcsIFwiIGNsYXNzPVxcXCJcIikuY29uY2F0KHNldHRpbmdzLmNsYXNzZXMubGlzdFdyYXBwZXIsIFwiXFxcIj5cIik7IC8vIGZvciBlYWNoIGxpc3QgaXRlbSwgYnVpbGQgaXRzIG1hcmt1cC5cblxuICAgICAgICB3aGlsZSAodGhpcy5saXN0SXRlbVBvaW50ZXIgPCB0aGlzLmhlYWRpbmdzRGF0YS5sZW5ndGgpIHtcbiAgICAgICAgICAgIHZhciBjdXJyZW50SXRlbSA9IHRoaXMuaGVhZGluZ3NEYXRhW3RoaXMubGlzdEl0ZW1Qb2ludGVyXTtcbiAgICAgICAgICAgIHZhciBsaXN0SXRlbVRleHRDbGFzc2VzID0gc2V0dGluZ3MuY2xhc3Nlcy5saXN0SXRlbVRleHQ7XG5cbiAgICAgICAgICAgIGlmICgwID09PSBjdXJyZW50SXRlbS5sZXZlbCkge1xuICAgICAgICAgICAgICAgIC8vIElmIHRoZSBjdXJyZW50IGxpc3QgaXRlbSBpcyBhIHRvcCBsZXZlbCBpdGVtLCBnaXZlIGl0IHRoZSBmaXJzdCBsZXZlbCBjbGFzc1xuICAgICAgICAgICAgICAgIGxpc3RJdGVtVGV4dENsYXNzZXMgKz0gJyAnICsgc2V0dGluZ3MuY2xhc3Nlcy5maXJzdExldmVsTGlzdEl0ZW07XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmIChsZXZlbCA+IGN1cnJlbnRJdGVtLmxldmVsKSB7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmIChsZXZlbCA9PT0gY3VycmVudEl0ZW0ubGV2ZWwpIHtcbiAgICAgICAgICAgICAgICBodG1sICs9IFwiPGxpIGNsYXNzPVxcXCJcIi5jb25jYXQoc2V0dGluZ3MuY2xhc3Nlcy5saXN0SXRlbSwgXCJcXFwiPlwiKTtcbiAgICAgICAgICAgICAgICBodG1sICs9IFwiPGRpdiBjbGFzcz1cXFwiXCIuY29uY2F0KHNldHRpbmdzLmNsYXNzZXMubGlzdFRleHRXcmFwcGVyLCBcIlxcXCI+XCIpO1xuICAgICAgICAgICAgICAgIGlmIChlbGVtZW50U2V0dGluZ3MuZHVwbGljYXRlX2FuY2hvcl9maXggPT0gJ3llcycpIHtcbiAgICAgICAgICAgICAgICAgICAgdmFyIGFuY2hvclRleHQgPSBjdXJyZW50SXRlbS50ZXh0LnJlcGxhY2UoL1xccysvZywgJy0nKS5yZXBsYWNlKC9bXlxcdy1dKy9nLCAnJykudG9Mb3dlckNhc2UoKSArICctJyArIHRoaXMubGlzdEl0ZW1Qb2ludGVyO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIHZhciBhbmNob3JUZXh0ID0gY3VycmVudEl0ZW0udGV4dC5yZXBsYWNlKC9cXHMrL2csICctJykucmVwbGFjZSgvW15cXHctXSsvZywgJycpLnRvTG93ZXJDYXNlKCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgdmFyIGxpQ29udGVudCA9IFwiPGEgaHJlZj1cXFwiI1wiLmNvbmNhdChhbmNob3JUZXh0LCBcIlxcXCIgY2xhc3M9XFxcIlwiKS5jb25jYXQobGlzdEl0ZW1UZXh0Q2xhc3NlcywgXCJcXFwiPlwiKS5jb25jYXQoY3VycmVudEl0ZW0udGV4dCwgXCI8L2E+XCIpOyAvLyBJZiBsaXN0IHR5cGUgaXMgYnVsbGV0cywgYWRkIHRoZSBidWxsZXQgaWNvbiBhcyBhbiA8aT4gdGFnXG5cbiAgICAgICAgICAgICAgICBpZiAoJ2J1bGxldHMnID09PSBlbGVtZW50U2V0dGluZ3MubWFya2VyX3ZpZXcgJiYgaWNvbikge1xuICAgICAgICAgICAgICAgICAgICBsaUNvbnRlbnQgPSBcIjxpIGNsYXNzPVxcXCJcIi5jb25jYXQoaWNvbi52YWx1ZSwgXCJcXFwiPjwvaT5cIikuY29uY2F0KGxpQ29udGVudCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaHRtbCArPSBsaUNvbnRlbnQ7XG4gICAgICAgICAgICAgICAgaHRtbCArPSAnPC9kaXY+JztcbiAgICAgICAgICAgICAgICB0aGlzLmxpc3RJdGVtUG9pbnRlcisrO1xuICAgICAgICAgICAgICAgIHZhciBuZXh0SXRlbSA9IHRoaXMuaGVhZGluZ3NEYXRhW3RoaXMubGlzdEl0ZW1Qb2ludGVyXTtcblxuICAgICAgICAgICAgICAgIGlmIChuZXh0SXRlbSAmJiBsZXZlbCA8IG5leHRJdGVtLmxldmVsKSB7XG4gICAgICAgICAgICAgICAgICAgIC8vIElmIGEgbmV3IG5lc3RlZCBsaXN0IGhhcyB0byBiZSBjcmVhdGVkIHVuZGVyIHRoZSBjdXJyZW50IGl0ZW0sXG4gICAgICAgICAgICAgICAgICAgIC8vIHRoaXMgZW50aXJlIG1ldGhvZCBpcyBjYWxsZWQgcmVjdXJzaXZlbHkgKG91dHNpZGUgdGhlIHdoaWxlIGxvb3AsIGEgbGlzdCB3cmFwcGVyIGlzIGNyZWF0ZWQpXG4gICAgICAgICAgICAgICAgICAgIGh0bWwgKz0gdGhpcy5nZXROZXN0ZWRUb2NMZXZlbChuZXh0SXRlbS5sZXZlbCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaHRtbCArPSAnPC9saT4nO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICAgICAgaHRtbCArPSBcIjwvXCIuY29uY2F0KHNldHRpbmdzLmxpc3RXcmFwcGVyVGFnLCBcIj5cIik7XG4gICAgICAgIHJldHVybiBodG1sO1xuICAgIH1cbiAgICBoYW5kbGVOb0hlYWRpbmdzRm91bmQoKSB7XG4gICAgICAgIHZhciBub0hlYWRpbmdzVGV4dCA9IGVsZW1lbnRvclByb0Zyb250ZW5kLmNvbmZpZy5pMThuWyd0b2Nfbm9faGVhZGluZ3NfZm91bmQnXTtcblxuICAgICAgICBpZiAoZWxlbWVudG9yRnJvbnRlbmQuaXNFZGl0TW9kZSgpKSB7XG4gICAgICAgICAgICBub0hlYWRpbmdzVGV4dCA9IGVsZW1lbnRvclByby50cmFuc2xhdGUoJ3RvY19ub19oZWFkaW5nc19mb3VuZCcpO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuZWxlbWVudHMuJHRvY0JvZHkuaHRtbChub0hlYWRpbmdzVGV4dCk7XG4gICAgfVxuICAgIGNvbGxhcHNlT25Jbml0KCkge1xuICAgICAgICB2YXIgbWluaW1pemVkT24gPSB0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygnbWluaW1pemVkX29uJyksXG4gICAgICAgICAgICBjdXJyZW50RGV2aWNlTW9kZSA9IGVsZW1lbnRvckZyb250ZW5kLmdldEN1cnJlbnREZXZpY2VNb2RlKCk7XG5cbiAgICAgICAgaWYgKCd0YWJsZXQnID09PSBtaW5pbWl6ZWRPbiAmJiAnZGVza3RvcCcgIT09IGN1cnJlbnREZXZpY2VNb2RlIHx8ICdtb2JpbGUnID09PSBtaW5pbWl6ZWRPbiAmJiAnbW9iaWxlJyA9PT0gY3VycmVudERldmljZU1vZGUpIHtcbiAgICAgICAgICAgIHRoaXMuY29sbGFwc2VUb2NCb3goKTtcbiAgICAgICAgfVxuICAgIH1cbiAgICBzZXRIZWFkaW5nc0RhdGEoKSB7XG4gICAgICAgIHZhciBfdGhpczUgPSB0aGlzO1xuXG4gICAgICAgIHRoaXMuaGVhZGluZ3NEYXRhID0gW107IC8vIENyZWF0ZSBhbiBhcnJheSBmb3Igc2ltcGxpZnlpbmcgVE9DIGxpc3QgY3JlYXRpb25cblxuICAgICAgICB0aGlzLmVsZW1lbnRzLiRoZWFkaW5ncy5lYWNoKGZ1bmN0aW9uKGluZGV4LCBlbGVtZW50KSB7XG4gICAgICAgICAgICBfdGhpczUuaGVhZGluZ3NEYXRhLnB1c2goe1xuICAgICAgICAgICAgICAgIHRhZzogK2VsZW1lbnQubm9kZU5hbWUuc2xpY2UoMSksXG4gICAgICAgICAgICAgICAgdGV4dDogZWxlbWVudC50ZXh0Q29udGVudFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cbiAgICBydW4oKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuJGhlYWRpbmdzID0gdGhpcy5nZXRIZWFkaW5ncygpO1xuXG4gICAgICAgIGlmICghdGhpcy5lbGVtZW50cy4kaGVhZGluZ3MubGVuZ3RoKSB7XG4gICAgICAgICAgICByZXR1cm4gdGhpcy5oYW5kbGVOb0hlYWRpbmdzRm91bmQoKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuc2V0SGVhZGluZ3NEYXRhKCk7XG5cbiAgICAgICAgaWYgKCFlbGVtZW50b3JGcm9udGVuZC5pc0VkaXRNb2RlKCkpIHtcbiAgICAgICAgICAgIHRoaXMuYWRkQW5jaG9yc0JlZm9yZUhlYWRpbmdzKCk7XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLnBvcHVsYXRlVE9DKCk7XG5cbiAgICAgICAgaWYgKHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCdtaW5pbWl6ZV9ib3gnKSkge1xuICAgICAgICAgICAgdGhpcy5jb2xsYXBzZU9uSW5pdCgpO1xuICAgICAgICB9XG4gICAgfVxuICAgIGV4cGFuZFRvY0JveCgpIHtcbiAgICAgICAgdmFyIGJveEhlaWdodCA9IHRoaXMuZ2V0Q3VycmVudERldmljZVNldHRpbmcoJ21pbl9oZWlnaHQnKTtcbiAgICAgICAgdGhpcy4kZWxlbWVudC5yZW1vdmVDbGFzcyh0aGlzLmdldFNldHRpbmdzKCdjbGFzc2VzLmNvbGxhcHNlZCcpKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy4kdG9jQm9keS5zbGlkZURvd24oKTsgLy8gcmV0dXJuIGNvbnRhaW5lciB0byB0aGUgZnVsbCBoZWlnaHQgaW4gY2FzZSBhIG1pbi1oZWlnaHQgaXMgZGVmaW5lZCBieSB0aGUgdXNlclxuXG4gICAgICAgIHRoaXMuZWxlbWVudHMuJHdpZGdldFRvY0NvbnRhaW5lci5jc3MoJ21pbi1oZWlnaHQnLCBib3hIZWlnaHQuc2l6ZSArIGJveEhlaWdodC51bml0KTtcbiAgICB9XG4gICAgY29sbGFwc2VUb2NCb3goKSB7XG4gICAgICAgIHRoaXMuJGVsZW1lbnQuYWRkQ2xhc3ModGhpcy5nZXRTZXR0aW5ncygnY2xhc3Nlcy5jb2xsYXBzZWQnKSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuJHRvY0JvZHkuc2xpZGVVcCgpOyAvLyBjbG9zZSBjb250YWluZXIgaW4gY2FzZSBhIG1pbi1oZWlnaHQgaXMgZGVmaW5lZCBieSB0aGUgdXNlclxuXG4gICAgICAgIHRoaXMuZWxlbWVudHMuJHdpZGdldFRvY0NvbnRhaW5lci5jc3MoJ21pbi1oZWlnaHQnLCAnMHB4Jyk7XG4gICAgfVxuXG4gICAgX3N1cGVyUHJvcEJhc2Uob2JqZWN0LCBwcm9wZXJ0eSkge1xuICAgICAgICB3aGlsZSAoIU9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KSkge1xuICAgICAgICAgICAgb2JqZWN0ID0gZ2V0UHJvdG90eXBlT2Yob2JqZWN0KTtcbiAgICAgICAgICAgIGlmIChvYmplY3QgPT09IG51bGwpIGJyZWFrO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIG9iamVjdDtcbiAgICB9XG4gICAgX2dldDModGFyZ2V0LCBwcm9wZXJ0eSwgcmVjZWl2ZXIpIHtcbiAgICAgICAgaWYgKHR5cGVvZiBSZWZsZWN0ICE9PSBcInVuZGVmaW5lZFwiICYmIFJlZmxlY3QuZ2V0KSB7XG4gICAgICAgICAgICByZXR1cm4gUmVmbGVjdC5nZXQodGFyZ2V0LCBwcm9wZXJ0eSwgcmVjZWl2ZXIgfHwgdGFyZ2V0KTtcbiAgICAgICAgICAgIG1vZHVsZS5leHBvcnRzID0gX2dldCA9IFJlZmxlY3QuZ2V0O1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgdmFyIGJhc2UgPSBzdXBlclByb3BCYXNlKHRhcmdldCwgcHJvcGVydHkpO1xuICAgICAgICAgICAgaWYgKCFiYXNlKSByZXR1cm47XG4gICAgICAgICAgICB2YXIgZGVzYyA9IE9iamVjdC5nZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IoYmFzZSwgcHJvcGVydHkpO1xuXG4gICAgICAgICAgICBpZiAoZGVzYy5nZXQpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gZGVzYy5nZXQuY2FsbChyZWNlaXZlcik7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHJldHVybiBkZXNjLnZhbHVlO1xuXG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gX2dldCh0YXJnZXQsIHByb3BlcnR5LCByZWNlaXZlciB8fCB0YXJnZXQpO1xuICAgIH1cblxuXG59XG5cbnJlZ2lzdGVyV2lkZ2V0KE9FV19UT0MsIFwib2V3LXRvY1wiKTtcbiJdfQ==
