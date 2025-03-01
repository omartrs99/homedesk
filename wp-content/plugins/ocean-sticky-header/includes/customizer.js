/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize;

api('osh_no_shadow', function(value) {
    value.bind(function(newVal) {
		var stickyHeader = document.querySelector('.is-sticky #site-header');
        if (newVal) {
            stickyHeader.classList.add('no-shadow');
        } else {
            stickyHeader.classList.remove('no-shadow');
        }
    });
});

api('osh_shrink_header_logo_height', function(value) {
    value.bind(function(to) {
        var existingStyleElement = document.querySelector('.customizer-osh_shrink_header_logo_height');
        if (to) {
            var styleContent = '.is-sticky .shrink-header #site-logo #site-logo-inner a img, .is-sticky #site-header.shrink-header.center-header #site-navigation .middle-site-logo a img { max-height: ' + to + 'px !important; }';
            var styleElement = document.createElement('style');
            styleElement.className = 'customizer-osh_shrink_header_logo_height';
            styleElement.textContent = styleContent;
            if (existingStyleElement) {
                existingStyleElement.replaceWith(styleElement);
            } else {
                document.head.appendChild(styleElement);
            }
        } else {
            if (existingStyleElement) {
                existingStyleElement.remove();
            }
        }
    });
});

api('osh_background_color', function(value) {
	value.bind(function(to) {
		var child = document.querySelector('.customizer-osh_background_color');
		if (to) {
			var style = '<style class="customizer-osh_background_color">.is-sticky #site-header,.is-sticky #searchform-header-replace { background-color: ' + to + ' !important; }</style>';
			if (child) {
				var newStyle = document.createElement('style');
				newStyle.className = 'customizer-osh_background_color';
				newStyle.innerHTML = '.is-sticky #site-header,.is-sticky #searchform-header-replace { background-color: ' + to + ' !important; }';
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

api('ocean_medium_header_hidden_menu', function(value) {
    value.bind(function(newVal) {
		var mediumHeader = document.querySelector('#site-header.medium-header');
        if (newVal) {
            mediumHeader.classList.add('hidden-menu');
        } else {
            mediumHeader.classList.remove('hidden-menu');
        }
    });
});
