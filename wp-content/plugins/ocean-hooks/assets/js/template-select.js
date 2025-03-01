var $j = jQuery.noConflict();

$j(document).on("ready", function () {

    $j('a.page-title-action').remove();

    var data = {
        action: 'oh_select_template_type',
        _ajax_nonce: ohLocalize.wpnonce,
    };

    $j.ajax( {
        url : ohLocalize.ajaxurl,
        data: data,
        type: 'GET',

        complete: function( data ) {
            $j( data.responseText ).insertAfter( $j( '.wp-heading-inline' ) );
        },
        error: function (e){
            alert( 'Opps!, Something went wrong, please try again later.' );
        }

    } );
});

$j( document ).on( 'click', '.oh-page-title-button-action', function (e) {
    e.preventDefault();
    e.stopPropagation();

    var templateType = $j('#ocean_template_type').val();

    var data = {
        action: 'oh_insert_template',
        _ajax_nonce: ohLocalize.wpnonce,
        templateType: templateType,
    };

    $j.ajax( {
        url : ohLocalize.ajaxurl,
        data: data,
        type: 'GET',

        success : function( response ){
            window.location.href = response.data.location;
        },
        error: function (e){
            alert( 'Opps!, Something went wrong, please try again later.' );
        }

    } );

});
