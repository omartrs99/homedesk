/**
 * Update Customizer settings live.
 *
 * @version 1.0.0
 */

var api = wp.customize,
    filterPosition = [
        'full',
        'left',
        'center',
        'right'
    ];

api('op_portfolio_filter_position', function(value) {
    value.bind(function(newval) {
        var filters = document.querySelectorAll('.portfolio-entries .portfolio-filters');
        filters.forEach(function(filter) {
            if (filter) {
                filterPosition.forEach(function(pos) {
                    filter.classList.remove('filter-pos-' + pos);
                });
                filter.classList.add('filter-pos-' + newval);
            }
        });
    });
});

api('op_portfolio_filter_margin', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var filters = document.querySelectorAll('.portfolio-entries .portfolio-filters');
            filters.forEach(function(filter) {
                filter.style.margin = newval;
            });
        }
    });
});

api('op_portfolio_filter_links_padding', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var filters = document.querySelectorAll('.portfolio-entries .portfolio-filters li a');
            filters.forEach(function(filter) {
                filter.style.padding = newval;
            });
        }
    });
});

api('op_portfolio_filter_links_margin', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var filters = document.querySelectorAll('.portfolio-entries .portfolio-filters li');
            filters.forEach(function(filter) {
                filter.style.margin = newval;
            });
        }
    });
});


api('op_portfolio_img_overlay_icons_width', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.width = newval + 'px';
            });
        }
    });
});

api('op_portfolio_img_overlay_icons_height', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.height = newval + 'px';
            });
        }
    });
});


api('op_portfolio_img_overlay_icons_size', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.fontSize = newval + 'px';
                var owpIcon = icon.querySelector('.owp-icon');
                if (owpIcon) {
                    owpIcon.style.width = newval + 'px';
                    owpIcon.style.height = newval + 'px';
                }
            });
        }
    });
});

api('op_portfolio_img_overlay_icons_border_radius', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.borderRadius = newval;
            });
        }
    });
});

api('op_portfolio_img_overlay_icons_border_width', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.borderWidth = newval;
            });
        }
    });
});

api('op_portfolio_img_overlay_icons_border_style', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var overlayIcons = document.querySelectorAll('.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a');
            overlayIcons.forEach(function(icon) {
                icon.style.borderStyle = newval;
            });
        }
    });
});

api('op_portfolio_item_margin', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioEntries = document.querySelector('.portfolio-entries');
            if (portfolioEntries) {
                portfolioEntries.style.margin = '0 -' + newval;
            }

            var portfolioEntriesItems = document.querySelectorAll('.portfolio-entries .portfolio-entry');
            portfolioEntriesItems.forEach(function(item) {
                item.style.padding = newval;
            });
        }
    });
});

api('op_portfolio_item_padding', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioItem = document.querySelectorAll('.portfolio-entries .portfolio-entry .portfolio-entry-inner');
            portfolioItem.forEach(function(item) {
                item.style.padding = newval;
            });
        }
    });
});

api('op_portfolio_item_border_radius', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioItem = document.querySelectorAll('.portfolio-entries .portfolio-entry .portfolio-entry-inner');
            portfolioItem.forEach(function(item) {
                item.style.overflow = 'hidden';
                item.style.borderRadius = newval;
            });
        }
    });
});

api('op_portfolio_item_border_width', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioItem = document.querySelectorAll('.portfolio-entries .portfolio-entry .portfolio-entry-inner');
            portfolioItem.forEach(function(item) {
                item.style.borderWidth = newval;
            });
        }
    });
});

api('op_portfolio_item_border_style', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioItem = document.querySelectorAll('.portfolio-entries .portfolio-entry .portfolio-entry-inner');
            portfolioItem.forEach(function(item) {
                item.style.borderStyle = newval;
            });
        }
    });
});

api('op_portfolio_outside_content_padding', function(value) {
    value.bind(function(newval) {
        if (newval) {
            var portfolioItem = document.querySelectorAll('.portfolio-entries .portfolio-content');
            portfolioItem.forEach(function(item) {
                item.style.padding = newval;
            });
        }
    });
});

api('op_portfolio_tablet_item_margin', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_tablet_item_margin');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_tablet_item_margin';
            style.innerHTML = '@media (max-width: 1023px) {.portfolio-entries { margin: 0 -' + to + '; }.portfolio-entries .portfolio-entry { padding: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_tablet_item_padding', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_tablet_item_padding');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_tablet_item_padding';
            style.innerHTML = '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry { padding: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_tablet_item_border_radius', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_tablet_item_border_radius');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_tablet_item_border_radius';
            style.innerHTML = '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner { overflow: hidden; }.portfolio-entries .portfolio-entry .portfolio-entry-inner { border-radius: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_tablet_item_border_width', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_tablet_item_border_width');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_tablet_item_border_width';
            style.innerHTML = '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner { border-width: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_mobile_item_margin', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_mobile_item_margin');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_mobile_item_margin';
            style.innerHTML = '@media (max-width: 767px) {.portfolio-entries { margin: 0 -' + to + '; }.portfolio-entries .portfolio-entry { padding: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_mobile_item_padding', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_mobile_item_padding');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_mobile_item_padding';
            style.innerHTML = '@media (max-width: 767px) {.portfolio-entries .portfolio-entry { padding: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_mobile_item_border_radius', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_mobile_item_border_radius');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_mobile_item_border_radius';
            style.innerHTML = '@media (max-width: 767px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner { overflow: hidden; }.portfolio-entries .portfolio-entry .portfolio-entry-inner { border-radius: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_mobile_item_border_width', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_mobile_item_border_width');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_mobile_item_border_width';
            style.innerHTML = '@media (max-width: 767px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner { border-width: ' + to + '; }}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_single_title_bg_image_height', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_single_title_bg_image_height');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_single_title_bg_image_height';
            style.innerHTML = '.single-ocean_portfolio .page-header{height: ' + to + 'px;}';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_single_title_bg_image_overlay_opacity', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_single_title_bg_image_overlay_opacity');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_single_title_bg_image_overlay_opacity';
            style.innerHTML = '.single-ocean_portfolio .background-image-page-header-overlay { opacity: ' + to + '!important; }';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_single_both_sidebars_content_width', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_single_both_sidebars_content_width');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_single_both_sidebars_content_width';
            style.innerHTML = '@media only screen and (min-width: 960px){ body.single-ocean_portfolio.content-both-sidebars .content-area { width: ' + to + '%; } body.single-ocean_portfolio.content-both-sidebars.scs-style .widget-area.sidebar-secondary, body.single-ocean_portfolio.content-both-sidebars.ssc-style .widget-area {left: -' + to + '%;} }';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_single_both_sidebars_sidebars_width', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-op_portfolio_single_both_sidebars_sidebars_width');
        if (to) {
            var style = document.createElement('style');
            style.className = 'customizer-op_portfolio_single_both_sidebars_sidebars_width';
            style.innerHTML = '@media only screen and (min-width: 960px){ body.single-ocean_portfolio.content-both-sidebars .widget-area{width:' + to + '%;} body.single-ocean_portfolio.content-both-sidebars.scs-style .content-area{left:' + to + '%;} body.single-ocean_portfolio.content-both-sidebars.ssc-style .content-area{left:'+ to * 2 +'%;} }';

            if (child) {
                child.parentNode.replaceChild(style, child);
            } else {
                document.head.appendChild(style);
            }
        } else if (child) {
            child.parentNode.removeChild(child);
        }
    });
});

api('op_portfolio_filter_button_border_width', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter-buttons-wrap a.open');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderWidth = newval;
                button.style.borderStyle = 'solid';
            });
        }
    });
});

api('op_portfolio_filter_button_border_radius', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter-buttons-wrap a.open');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderRadius = newval;
            });
        }
    });
});

api('op_portfolio_filter_reset_button_border_width', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter-buttons-wrap a.reset');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderWidth = newval;
                button.style.borderStyle = 'solid';
            });
        }
    });
});

api('op_portfolio_filter_reset_button_border_radius', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter-buttons-wrap a.reset');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderRadius = newval;
            });
        }
    });
});

api('op_portfolio_filter_apply_button_border_width', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter--form-wrap .apply-button');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderWidth = newval;
                button.style.borderStyle = 'solid';
            });
        }
    });
});

api('op_portfolio_filter_apply_button_border_radius', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter--form-wrap .apply-button');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderRadius = newval;
            });
        }
    });
});

api('op_portfolio_filter_inside_reset_button_border_width', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter--form-wrap .reset-button');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderWidth = newval;
                button.style.borderStyle = 'solid';
            });
        }
    });
});

api('op_portfolio_filter_inside_reset_button_border_radius', function(value) {
    value.bind(function(newval) {
        var filterButtons = document.querySelectorAll('.filter--form-wrap .reset-button');
        if (newval) {
            filterButtons.forEach(function(button) {
                button.style.borderRadius = newval;
            });
        }
    });
});
