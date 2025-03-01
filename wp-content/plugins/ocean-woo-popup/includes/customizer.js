/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize;

function initializePopup(element, options) {
       // Create and style the overlay
       var overlay = document.querySelector('.woo-popup-overlay');
       if (!overlay) {
            var overlay = document.createElement('div');
            overlay.className = 'woo-popup-overlay';
            overlay.style.backgroundColor = options.overlayBgColor;
            overlay.style.opacity = options.overlayOpacity;
            overlay.style.position = options.positionStyle;
            overlay.style.inset = '0px';
            overlay.style.zIndex = '9998';
            overlay.style.cursor = 'pointer';
            overlay.style.display = 'block';

            // Insert the overlay before the popup element
            element.parentNode.insertBefore(overlay, element);

            if (options.modalClose) {
                overlay.addEventListener('click', function() {
                    closePopup(element);
                });
            }
        } else {
            overlay.style.display = 'block'; // Make sure the overlay is visible
        }

        // Apply styles to the popup element
        element.style.display = 'block';
        element.style.position = options.positionStyle;
        element.style.top = '50%';
        element.style.left = '50%';
        element.style.transform = 'translate(-50%, -50%)';
        element.style.zIndex = '9999';

        // // Function to close the popup and remove the overlay
        // function closePopup() {
        //     element.style.display = 'none';
        //     overlay.style.display = 'none';
        // }

    //    // Close the popup and remove the overlay when overlay is clicked if modalClose is true
    //    if (options.modalClose) {
    //        overlay.addEventListener('click', closePopup);
    //    }

}

function closePopup(element) {
    var overlay = document.querySelector('.woo-popup-overlay');
    if (overlay) {
        overlay.style.display = 'none';
    }
    element.style.display = 'none';
}

api('owp_popup_display', function(value) {
    value.bind(function(newval) {
        var bPopup = document.getElementById('woo-popup-wrap');
        if (bPopup) {
            var options = {
                modalClose: true,
                overlayBgColor: bPopup.getAttribute('data-color'),
                overlayOpacity: bPopup.getAttribute('data-opacity'),
                positionStyle: 'fixed'
            };

            if (newval === 'on') {
                initializePopup(bPopup, options);
            } else if (newval === 'off') {
                closePopup(bPopup);
            }
        }
    });
});

api( 'owp_popup_title_text', function( value ) {
    value.bind( function( newval ) {
        var popupTitle = document.querySelector('#woo-popup-wrap .popup-title');
        popupTitle.innerHTML = newval;
    } );
} );

api( 'owp_popup_content', function( value ) {
    value.bind( function( newval ) {
        var popupContent = document.querySelector('#woo-popup-wrap .popup-content');
        popupContent.innerHTML = newval;
    } );
} );

api( 'owp_popup_continue_btn_text', function( value ) {
    value.bind( function( newval ) {
        var contBtn = document.querySelector('#woo-popup-wrap .buttons-wrap a.continue-btn');
        contBtn.innerHTML = newval;
    } );
} );

api( 'owp_popup_cart_btn_text', function( value ) {
    value.bind( function( newval ) {
        var cartBtn = document.querySelector('#woo-popup-wrap .buttons-wrap a.cart-btn');
        cartBtn.innerHTML = newval;
    } );
} );

api( 'owp_popup_bottom_text', function( value ) {
    value.bind( function( newval ) {
        var popupBottom = document.querySelector('#woo-popup-wrap .popup-text');
        popupBottom.innerHTML = newval;
    } );
} );

// Bind the customization value for popup checkmark background
api('owp_popup_checkmark_bg', function(value) {
    value.bind(function(to) {
        var child = document.querySelector('.customizer-owp_popup_checkmark_bg');
        if (to) {
            var style = '<style class="customizer-owp_popup_checkmark_bg">#woo-popup-wrap .checkmark{box-shadow: inset 0 0 0 ' + to + '; }#woo-popup-wrap .checkmark-circle{stroke: ' + to + ';}@keyframes fill {100% { box-shadow: inset 0 0 0 100px ' + to + '; }}</style>';
            if (child) {
                child.outerHTML = style;
            } else {
                var head = document.head || document.getElementsByTagName('head')[0];
                head.insertAdjacentHTML('beforeend', style);
            }
        } else {
            if (child) {
                child.remove();
            }
        }
    });
});
