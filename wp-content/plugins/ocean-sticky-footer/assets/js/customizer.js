/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var api = wp.customize;

// api('osf_opening_icon', function(value) {
//     value.bind(function(newval) {
//         var icon = document.querySelector('#footer-bar .osf-left li.osf-btn a > span');

//         if (icon) {
//             icon.className = '';
//             icon.classList.add(newval);
//         }
//     });
// });

api('osf_opening_icon', function(value) {
    value.bind(function(newval) {
        var icon = document.querySelector('#footer-bar .osf-left li.osf-btn a > span');

        if (icon) {
            icon.className = '';
            newval.split(' ').forEach(function(cls) {
                if (cls) {
                    icon.classList.add(cls);
                }
            });
        }
    });
});

api('osf_text', function(value) {
    value.bind(function(newval) {
        var element = document.querySelector('#footer-bar .osf-text');
        if (element) {
            element.textContent = newval;
        }
    });
});
