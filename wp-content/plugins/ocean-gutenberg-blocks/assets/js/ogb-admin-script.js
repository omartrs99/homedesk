/**
 * Ocean Gutenberg Blocks
 * Admin scripts
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

var $j = jQuery.noConflict();

$j(document).ready( function() {
	"use strict";

	ogbDismissNotice();
	ogbBlockSettings();
	blockIconColor();
} );

function ogbDismissNotice() {

	$j('.ogb-notice-dismiss').click( function() {

		var is_notice = $j(this).attr('data-ogb-dismiss');

		var data = {
			action: 'ogb_dismiss_notice',
			_ajax_nonce: ogbBlocks.wpnonce,
			is_notice: is_notice,
		};

		$j.ajax({
			url : ogbBlocks.ajaxurl,
			data : data,
			type : 'GET',

			success : function( response ){
				window.location.reload();
			},
			error: function (e){
				alert( 'Opps!, Something went wrong, please try again later.' );
			}
		});

	} );
}

function ogbBlockSettings() {

	var disabledBlocks = [];
    var checked_blocks = $j('.ogb-block-border .switch input:not(:checked)');

    checked_blocks.each(function(){
        disabledBlocks.push($j(this).val())
    })

    $j(document).on('click', '.switch input', function() {
        var blockName = $j(this).val();

        if( $j(this).is(':checked') ) {
            var filtered = disabledBlocks.filter( value => value !== blockName )
            disabledBlocks = filtered
        } else {
            disabledBlocks.push(blockName);
        }

        var data = {
			_ajax_nonce: ogbBlocks.wpnonce,
			action: 'ogb_blocks_settings',
            disabledBlocks: disabledBlocks,
        };

		$j.ajax({
			url : ogbBlocks.ajaxurl,
			data : data,
			type : 'POST',

			success : function( response ){
				// Do something.
			}
		});

    });

}

function blockIconColor() {

	$j(document).on('click', '.edit-post-header-toolbar__inserter-toggle:not(.is-pressed)', function(e) {
		e.preventDefault();

		setTimeout( function() {

			let wrapper = document.querySelector(".block-editor-inserter__panel-content [aria-label^='OceanWP Blocks']");

			if ( ! wrapper ) {
				return
			}

			let iconEle = wrapper.querySelectorAll("span.block-editor-block-icon.has-colors");

			if ( ! iconEle.length ) {
				return
			}

			for( const icon of iconEle ) {
				icon.style.color = "#FFB100";
			}

		}, 500 );

	} );

}
