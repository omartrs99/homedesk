/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize;

api( 'ofc_callout_text', function( value ) {
	value.bind( function( newval ) {
		var topbarContent = document.querySelector('.footer-callout-content');
		topbarContent.innerHTML = newval;
	} );
} );

api('ofc_callout_button_txt', function(value) {
	value.bind(function(newval) {
		var element = document.querySelector('.footer-callout-button a');
		if (element) {
			element.textContent = newval;
		}
	});
});

api('ofc_callout_links_color_hover', function(value) {
    value.bind(function(to) {
        var existingStyleElement = document.querySelector('.customizer-ofc_callout_links_color_hover');
        if (to) {
            var styleContent = '.footer-callout-content a:hover { color: ' + to + ' !important; }';
            var styleElement = document.createElement('style');
            styleElement.className = 'customizer-ofc_callout_links_color_hover';
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

api('ofc_callout_button_hover_bg', function(value) {
    value.bind(function(to) {
        var existingStyleElement = document.querySelector('.customizer-ofc_callout_button_hover_bg');
        if (to) {
            var styleContent = '#footer-callout .callout-button:hover { background-color: ' + to + ' !important; }';
            var styleElement = document.createElement('style');
            styleElement.className = 'customizer-ofc_callout_button_hover_bg';
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

api('ofc_callout_button_hover_color', function(value) {
    value.bind(function(to) {
        var existingStyleElement = document.querySelector('.customizer-ofc_callout_button_hover_color');
        if (to) {
            var styleContent = '#footer-callout .callout-button:hover { color: ' + to + ' !important; }';
            var styleElement = document.createElement('style');
            styleElement.className = 'customizer-ofc_callout_button_hover_color';
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
