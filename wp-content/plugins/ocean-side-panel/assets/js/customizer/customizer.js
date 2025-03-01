/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize,
    body = document.body,
	panelPosition = [
		'osp-right',
		'osp-left'
	];

api('osp_beside_open_btn_icon_size', function(value) {
    value.bind(function(to) {
        var styleElement = document.querySelector('.customizer-osp_beside_open_btn_icon_size');

        if (to) {
            var styleContent = '#side-panel-wrap a.side-panel-btn { font-size: ' + to + 'px; } ' +
                               '#side-panel-wrap a.side-panel-btn .owp-icon { width: ' + to + 'px; height: ' + to + 'px; }';
            if (styleElement) {
                styleElement.textContent = styleContent;
            } else {
                styleElement = document.createElement('style');
                styleElement.className = 'customizer-osp_beside_open_btn_icon_size';
                styleElement.textContent = styleContent;
                document.head.appendChild(styleElement);
            }
        } else {
            if (styleElement) {
                styleElement.remove();
            }
        }
    });
});


var sidePanelBtn = document.querySelector('.side-panel-btn');
if (sidePanelBtn && !sidePanelBtn.classList.contains('has-text')) {
    var span = document.createElement('span');
    span.className = 'side-panel-text';
    sidePanelBtn.appendChild(span);
}
api('osp_side_panel_open_btn_text', function(value) {
    value.bind(function(newval) {
        sidePanelBtn.classList.remove('has-text');
        sidePanelBtn.classList.add('has-text');
        var sidePanelText = sidePanelBtn.querySelector('.side-panel-text');
        if (sidePanelText) {
            sidePanelText.innerHTML = newval;
        }
    });
});

api('osp_side_panel_displace', function(value) {
    value.bind(function(newVal) {
        if (newVal) {
            body.classList.remove('osp-no-displace');
        } else {
            body.classList.add('osp-no-displace');
        }
    });
});

api('osp_side_panel_position', function(value) {
    value.bind(function(newval) {
        if (body) {
            panelPosition.forEach(function(v) {
                body.classList.remove(v);
            });
            body.classList.add(newval);
        }
    });
});

function updateStyle(customizerSetting, className, mediaQuery = '') {
    api(customizerSetting, function(value) {
        value.bind(function(to) {
            var existingStyleElement = document.querySelector('.' + className);
            if (to) {
                var styleContent = `${mediaQuery}#side-panel-wrap{width:${to}px;}.osp-right #side-panel-wrap{right:-${to}px;}.osp-right.osp-opened #outer-wrap{left:-${to}px;}.osp-left #side-panel-wrap{left:-${to}px;}.osp-left.osp-opened #outer-wrap{right:-${to}px;}`;
                var styleElement = `<style class="${className}">${styleContent}</style>`;
                if (existingStyleElement) {
                    existingStyleElement.outerHTML = styleElement;
                } else {
                    document.head.insertAdjacentHTML('beforeend', styleElement);
                }
            } else if (existingStyleElement) {
                existingStyleElement.remove();
            }
        });
    });
}

updateStyle('osp_side_panel_width', 'customizer-osp_side_panel_width');
updateStyle('osp_side_panel_width_tablet', 'customizer-osp_side_panel_width_tablet', '@media (max-width: 768px){');
updateStyle('osp_side_panel_width_mobile', 'customizer-osp_side_panel_width_mobile', '@media (max-width: 480px){');

api('osp_close_button_text', function(value) {
    value.bind(function(newval) {
        var closeButton = document.querySelector('#side-panel-wrap .close-panel-text');
        if (closeButton) {
            closeButton.innerHTML = newval;
        }
    });
});

api('osp_close_button_hover_bg', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-osp_close_button_hover_bg');
        if (to) {
            var style = '<style class="customizer-osp_close_button_hover_bg">#side-panel-wrap a.close-panel:hover { background-color: ' + to + ' !important; }</style>';
            if (child) {
                var newStyle = document.createElement('style');
                newStyle.className = 'customizer-osp_close_button_hover_bg';
                newStyle.innerHTML = '#side-panel-wrap a.close-panel:hover { background-color: ' + to + ' !important; }';
                child.replaceWith(newStyle);
            } else {
                var head = document.querySelector('head');
                head.insertAdjacentHTML('beforeend', style);
            }
        } else if (child) {
            child.remove();
        }
    });
});

api('osp_links_hover_color', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-osp_links_hover_color');
        if (to) {
            var styleContent = '#side-panel-wrap a:not(.close-panel):hover { color: ' + to + ' !important; }';
            if (child) {
                var newStyle = document.createElement('style');
                newStyle.className = 'customizer-osp_links_hover_color';
                newStyle.textContent = styleContent;
                child.replaceWith(newStyle);
            } else {
                var head = document.querySelector('head');
                var styleElement = document.createElement('style');
                styleElement.className = 'customizer-osp_links_hover_color';
                styleElement.textContent = styleContent;
                head.appendChild(styleElement);
            }
        } else if (child) {
            child.remove();
        }
    });
});
