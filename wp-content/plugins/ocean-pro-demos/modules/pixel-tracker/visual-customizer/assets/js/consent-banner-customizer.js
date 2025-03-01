jQuery(document).ready(function($) {
    function updateConsentBannerPreview() {
        // Retrieve values from input fields
        var bannerBgColor = $('#consent_banner_bg_color').val();
        var textColor = $('#consent_banner_text_color').val();
        var borderRadius = $('#consent_banner_border_radius').val();
        var padding = $('#consent_banner_padding').val();
        var width = $('#consent_banner_width').val();
        var fontSize = $('#consent_banner_font_size').val();
        var mainText = $('#consent_banner_main_text').val();
        var secondaryText = $('#consent_banner_secondary_text').val();

        var buttonBgColor = $('#consent_button_bg_color').val();
        var buttonTextColor = $('#consent_button_text_color').val();
        var buttonHoverBgColor = $('#consent_button_hover_bg_color').val();
        var buttonHoverTextColor = $('#consent_button_hover_text_color').val();
        var buttonPadding = $('#consent_button_padding').val();
        var buttonBorderRadius = $('#consent_button_border_radius').val();
        var buttonText = $('#consent_button_text').val();

        var denyButtonBgColor = $('#deny_button_bg_color').val();
        var denyButtonTextColor = $('#deny_button_color').val();
        var denyButtonHoverBgColor = $('#deny_button_hover_bg_color').val();
        var denyButtonHoverTextColor = $('#deny_button_hover_text_color').val();
        var denyButtonPadding = $('#deny_button_padding').val();
        var denyButtonBorderRadius = $('#deny_button_border_radius').val();
        var denyButtonText = $('#deny_button_text').val();

        // Apply styles to the preview elements
        $('.consent-banner').css({
            'background-color': bannerBgColor,
            'color': textColor,
            'border-radius': borderRadius,
            'padding': padding,
            'width': width,
            'font-size': fontSize
        });
        $('.consent-banner p:first-of-type').css({
            'font-size': fontSize
        }).text(mainText);

        $('.consent-banner p:last-of-type').css({
            'font-size': fontSize
        }).text(secondaryText);

        $('.consent-banner button.allow').css({
            'background-color': buttonBgColor,
            'color': buttonTextColor,
            'padding': buttonPadding,
            'border-radius': buttonBorderRadius
        }).text(buttonText);

        $('.consent-banner button.allow').hover(
            function() {
                $(this).css({
                    'background-color': buttonHoverBgColor,
                    'color': buttonHoverTextColor
                });
            },
            function() {
                $(this).css({
                    'background-color': buttonBgColor,
                    'color': buttonTextColor
                });
            }
        );

        $('.consent-banner button.deny').css({
            'background-color': denyButtonBgColor,
            'color': denyButtonTextColor,
            'padding': denyButtonPadding,
            'border-radius': denyButtonBorderRadius
        }).text(denyButtonText);

        $('.consent-banner button.deny').hover(
            function() {
                $(this).css({
                    'background-color': denyButtonHoverBgColor,
                    'color': denyButtonHoverTextColor
                });
            },
            function() {
                $(this).css({
                    'background-color': denyButtonBgColor,
                    'color': denyButtonTextColor
                });
            }
        );
    }

    // Listen for changes on all inputs and apply the update function
    $('input, select, textarea').on('input change', function () {
        updateConsentBannerPreview();
    });

    // Initialize the preview on page load
    updateConsentBannerPreview();

    $('.color-picker').wpColorPicker({
        change: function(event, ui) {
            setTimeout(function(){
                updateConsentBannerPreview();
            }, 100);
        },
        clear: function() {
            setTimeout(function(){
                updateConsentBannerPreview();
            }, 100);
        }
    });
});
