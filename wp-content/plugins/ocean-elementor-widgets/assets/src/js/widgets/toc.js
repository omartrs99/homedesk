import {
    registerWidget
} from "../lib/utils";

class OEW_TOC extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
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

    getDefaultElements() {
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

    getTocContainer() {
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
    bindEvents() {
        var _this = this;

        var elementSettings = this.getElementSettings();

        if (elementSettings.minimize_box) {
            this.elements.$expandButton.on('click', function() {
                return _this.expandTocBox();
            });
            this.elements.$collapseButton.on('click', function() {
                return _this.collapseTocBox();
            });
        }

        if (elementSettings.collapse_subitems) {
            this.elements.$listItems.hover(function(event) {
                return jQuery(event.target).slideToggle();
            });
        }
    }
    getHeadings() {
        // Get all headings from document by user-selected tags
        var elementSettings = this.getElementSettings(),
            tags = elementSettings.headings_by_tags.join(','),
            selectors = this.getSettings('selectors'),
            excludedSelectors = elementSettings.exclude_headings_by_selector;
        return this.elements.$pageContainer.find(tags).not(selectors.headerTitle).filter(function(index, heading) {
            return !jQuery(heading).closest(excludedSelectors).length; // Handle excluded selectors if there are any
        });
    }
    addAnchorsBeforeHeadings() {
        // Add an anchor element right before each TOC heading to create anchors for TOC links
        var classes = this.getSettings('classes');
        var elementSettings = this.getElementSettings();
        this.elements.$headings.each(function(index) {
          if (elementSettings.duplicate_anchor_fix == 'yes') {
              var anchorText = this.textContent.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase() + '-' + index;
          } else {
              var anchorText = this.textContent.replace(/\s+/g, '-').replace(/[^\w-]+/g, '').toLowerCase();
          }
          this.setAttribute('id', anchorText);
      });

    }
    _getPrototypeOf(o) {
        return o.__proto__ || Object.getPrototypeOf(o);
    }
    onInit() {
        var _get2,
            _this6 = this;

        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
            args[_key] = arguments[_key];
        }

        (_get2 = (0, this._get3)((0, this._getPrototypeOf)(OEW_TOC.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

        this.viewportItems = [];
        jQuery(document).ready(function() {
            return _this6.run();
        });
    }

    onListItemClick(event) {
      var _this7 = this;

      this.itemClicked = true;
      setTimeout(function() {
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


    activateTocItem($listItem) {

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

    deactivateTocActiveItem($activeToBe) {
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

    followTocAnchor($element, index) {
      var _this2 = this;

      var anchorSelector = $element[0].hash;
      var $anchor;

      try {
          // `decodeURIComponent` for UTF8 characters in the hash.
          $anchor = jQuery(decodeURIComponent(anchorSelector));
      } catch (e) {
          return;
      }

      // Implement Intersection Observer instead of Waypoint
      const observerOptions = {
          root: null, // viewport
          rootMargin: '0px',
          threshold: 0.1 // trigger when 10% of the element is visible
      };

      const callback = (entries) => {
          entries.forEach(entry => {
              if (_this2.itemClicked) {
                  return;
              }

              const id = entry.target.getAttribute('id');

              if (entry.isIntersecting) {
                  if (entry.boundingClientRect.top > 0) { // Scrolling down
                      _this2.viewportItems[id] = true;
                      _this2.activateTocItem($element);
                  }
              } else {
                  if (entry.boundingClientRect.top < 0) { // Scrolling up
                      delete _this2.viewportItems[id];
                      _this2.activateTocItem(_this2.$listItemTexts.eq(index - 1));
                  }
              }
          });
      };

      const observer = new IntersectionObserver(callback, observerOptions);
      const target = document.getElementById(anchorSelector.replace('#', ''));
      if (target) {
          observer.observe(target);
      }

  }


    followTocAnchors() {
        var _this3 = this;

        this.$listItemTexts.each(function(index, element) {
            return _this3.followTocAnchor(jQuery(element), index);
        });
    }

    populateTOC() {
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

    createNestedList() {
        var _this4 = this;

        this.headingsData.forEach(function(heading, index) {
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

    createFlatList() {
        this.elements.$tocBody.html(this.getNestedTocLevel());
    }

    getNestedTocLevel(level) {
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
    handleNoHeadingsFound() {
        var noHeadingsText = elementorProFrontend.config.i18n['toc_no_headings_found'];

        if (elementorFrontend.isEditMode()) {
            noHeadingsText = elementorPro.translate('toc_no_headings_found');
        }

        return this.elements.$tocBody.html(noHeadingsText);
    }
    collapseOnInit() {
        var minimizedOn = this.getElementSettings('minimized_on'),
            currentDeviceMode = elementorFrontend.getCurrentDeviceMode();

        if ('tablet' === minimizedOn && 'desktop' !== currentDeviceMode || 'mobile' === minimizedOn && 'mobile' === currentDeviceMode) {
            this.collapseTocBox();
        }
    }
    setHeadingsData() {
        var _this5 = this;

        this.headingsData = []; // Create an array for simplifying TOC list creation

        this.elements.$headings.each(function(index, element) {
            _this5.headingsData.push({
                tag: +element.nodeName.slice(1),
                text: element.textContent
            });
        });
    }
    run() {
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
    expandTocBox() {
        var boxHeight = this.getCurrentDeviceSetting('min_height');
        this.$element.removeClass(this.getSettings('classes.collapsed'));
        this.elements.$tocBody.slideDown(); // return container to the full height in case a min-height is defined by the user

        this.elements.$widgetTocContainer.css('min-height', boxHeight.size + boxHeight.unit);
    }
    collapseTocBox() {
        this.$element.addClass(this.getSettings('classes.collapsed'));
        this.elements.$tocBody.slideUp(); // close container in case a min-height is defined by the user

        this.elements.$widgetTocContainer.css('min-height', '0px');
    }

    _superPropBase(object, property) {
        while (!Object.prototype.hasOwnProperty.call(object, property)) {
            object = getPrototypeOf(object);
            if (object === null) break;
        }

        return object;
    }
    _get3(target, property, receiver) {
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


}

registerWidget(OEW_TOC, "oew-toc");
