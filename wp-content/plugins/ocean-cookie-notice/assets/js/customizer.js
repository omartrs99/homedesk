/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize,
    style = [
        'flyin',
        'floating'
    ];

api( 'ocn_content', function( value ) {
    value.bind( function( newval ) {
        var ocnContent = document.querySelector('#ocn-cookie-wrap .ocn-cookie-content');
        ocnContent.innerHTML = newval;
    } );
} );

api('ocn_button_text', function(value) {
    value.bind(function(newval) {
        var element = document.querySelector('#ocn-cookie-wrap .ocn-btn');
        if (element) {
            element.textContent = newval;
        }
    });
});

api('ocn_style', function(value) {
    value.bind(function(newval) {
        var ocnNotice = document.querySelector('#ocn-cookie-wrap');
        if (ocnNotice) {
            style.forEach(function(className) {
                ocnNotice.classList.remove(className);
            });
            ocnNotice.classList.add(newval);
        }
    });
});
