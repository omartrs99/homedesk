var $j = jQuery.noConflict();

// Reset filter.
$j( '.portfolio__filter-style-button .filter-button.open' ).on( 'click', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $j( this ).toggleClass( 'show' );

    if ( ! $j( this ).parent().hasClass('full') ) {

        var btnPosition = $j( this ).position(),
            btnWidth    = $j( this ).outerWidth(),
            finalWidth  = btnWidth / 2,
            arrowPos    = btnPosition.left + finalWidth;

        $j( '.portfolio-filter-area' ).toggleClass( 'active' );
        $j( '.portfolio-filter-area > .has-arrow' ).css({
            'left' : arrowPos,
            'transform' : 'translateX(-'+ finalWidth +'%)'
        });
    } else {
        $j( '.portfolio-filter-area' ).toggleClass( 'active' );
        $j( '.portfolio-filter-area > .has-arrow' ).css({
            'left' : '50%',
            'transform' : 'translateX(-50%)'
        });
    }

    if ( $j( '.portfolio-filter-area' ).hasClass( 'active' ) ) {
        $j( 'body' ).on( 'click', function () {
            $j( '.portfolio-filter-area' ).removeClass( 'active' );
            $j( '.portfolio__filter-style-button .filter-button.open' ).removeClass( 'show' );
        });

        $j(".portfolio-filter-area").on( 'click', function (e) {
            e.stopPropagation();
        });
    }

});

$j( '.portfolio__filter-style-button .filter-action .apply-button' ).on( 'click', function (e) {

    e.preventDefault();

	var category = $j( '.portfolio__filter-style-button .by-category').val();
	var tag      = $j( '.portfolio__filter-style-button .by-tag').val();
    var search   = $j( '.portfolio__filter-style-button .by-search').val();

    var shortcode_id = $j( this ).parents( '.portfolio__filter-style-button' ).attr( 'data-shortcode-id' );

	if ( category || tag ) {
		$j( '.portfolio__filter-style-button' ).find('.by-search').val('');
	}

	if ( search ) {
		$j( '.portfolio__filter-style-button' ).find('.by-category').val('');
        $j( '.portfolio__filter-style-button' ).find('.by-tag').val('');
	}

	var data = {
		action: 'portfolio_get_posts',
		_ajax_nonce: oceanwpLocalize.opWpNonce,
		category: category,
        tag: tag,
		search: search,
        shortcode_id: shortcode_id,
	};

	$j.ajax({
        type: 'POST',
        url: oceanwpLocalize.ajax_url,
        dataType: "html",
        data : data,
		beforeSend : function ( xhr ) {
            $j( '.portfolio-filter-area' ).removeClass( 'active' );
            $j( '.portfolio__filter-style-button .filter-button' ).removeClass( 'show' );
			$j( '.portfolio-wrap' ).html( '' );
            $j( '.portfolio-entries .oceanwp-pagination' ).remove();
            $j( '.portfolio-wrap' ).attr('data-category', category)
                                   .attr('data-tag', tag)
                                   .attr('data-search', search);
		},
		complete: function() {
            $j( '.portfolio__filter-style-button .reset' ).addClass( 'show' );
		},
        success: function( result ) {

            var obj = JSON.parse(result);

			$j( '.portfolio-wrap' ).html( obj.data.response );
            $j( obj.data.paging ).insertAfter( '.portfolio-wrap' );

            initializePagination();
            opIsotopView();
        },
		error: function ( e ) {
			console.log('Something went wrong. Please try again.');
		}
    });

});

// Reset filter.
$j( '.portfolio__filter-style-button .reset-button, .portfolio__filter-style-button .reset' ).on( 'click', function (e) {
    e.preventDefault();

	var search = $j( '.portfolio__filter-style-button .by-search').val();

    var shortcode_id = $j( this ).parents( '.portfolio__filter-style-button' ).attr( 'data-shortcode-id' );

	search = '';
	$j( '.portfolio__filter-style-button .by-category').val('');
    $j( '.portfolio__filter-style-button .by-tag').val('');
	$j( '.portfolio__filter-style-button .by-search').val('');

    // Remove data attributes from .portfolio-wrap
    $j( '.portfolio-wrap' ).removeAttr('data-category')
                           .removeAttr('data-tag')
                           .removeAttr('data-search');


	var data = {
		action: 'op_reset_filter_posts',
		_ajax_nonce: oceanwpLocalize.opWpNonce,
        shortcode_id: shortcode_id,
	};

	$j.ajax({
        type: 'POST',
        url: oceanwpLocalize.ajax_url,
        dataType: "html",
        data : data,
		beforeSend : function ( xhr ) {
			$j( '.portfolio-wrap' ).html( '' );
            $j( '.portfolio-entries .oceanwp-pagination' ).remove();
		},
		complete: function() {
            $j( '.portfolio__filter-style-button .reset' ).removeClass( 'show' );
		},
        success: function( result ) {
            var obj = JSON.parse(result);

			$j( '.portfolio-wrap' ).html( obj.data.response );
            $j( obj.data.paging ).insertAfter( '.portfolio-wrap' );

            initializePagination();
            opIsotopView();

        },
		error: function ( e ) {
			console.log('Something went wrong. Please try again.');
		}
    });

});

// $j(document).on("ready", function () {

//     var isAjaxFilter = $j( '.portfolio-entries .portfolio__filter-style-button' );
//     var isPagination = $j( '.portfolio-entries .oceanwp-pagination' );

//     if ( ! isAjaxFilter && ! isPagination ) {
//         return;
//     }

//     isPagination.find( 'li > .page-numbers' ).each( function() {
//         var htmlText = $j( this ).text();
//         var currentPage = '';

//         $j( this ).attr( 'data-page', htmlText );

//         var current = $j( 'li > .page-numbers.current' );
//         if ( current ) {
//             currentPage = current.attr( 'data-page' );
//         }

//         if ( $j( this ).hasClass( 'next' ) ) {
//             $j( this ).attr( 'data-page', parseInt( currentPage )+1 );
//         }
//         if ( $j( this ).hasClass( 'prev' ) ) {
//             $j( this ).attr( 'data-page', parseInt( currentPage )-1 );
//         }
//     });

//     $j( '.op-has-animation .portfolio-entry-thumbnail' ).mouseenter (function(){
//         $j( this ).find( 'img' ).css({
//             'animation': 'move 10s ease',
//         });
//     });

//     $j( '.op-has-animation .portfolio-entry-thumbnail' ).mouseleave(function(){
//         $j( this ).find( 'img' ).css({
//             'animation': 'moveout 10s ease',
//         });
//     });

// });

$j(document).on("ready", function () {
    initializePagination();
    addAnimationHandlers();
});

function initializePagination() {
    var isPagination = $j('.portfolio-entries .oceanwp-pagination');
    var totalPages = isPagination.data('total-pages');

    if (!isPagination.length) {
        return;
    }

    isPagination.find('li > .page-numbers').each(function() {
        var htmlText = $j(this).text();
        var currentPage = '';

        $j(this).attr('data-page', htmlText);

        var current = $j('li > .page-numbers.current');
        if (current.length) {
            currentPage = current.attr('data-page');
        }

        if ($j(this).hasClass('next')) {
            if (parseInt(currentPage) >= parseInt(totalPages)) {
                $j(this).hide();
            } else {
                $j(this).attr('data-page', parseInt(currentPage) + 1).show();
            }
        }

        if ($j(this).hasClass('prev')) {
            if (parseInt(currentPage) <= 1) {
                $j(this).hide();
            } else {
                $j(this).attr('data-page', parseInt(currentPage) - 1).show();
            }
        }
    });
}

function addAnimationHandlers() {
    $j('.op-has-animation .portfolio-entry-thumbnail').mouseenter(function() {
        $j(this).find('img').css({
            'animation': 'move 10s ease',
        });
    });

    $j('.op-has-animation .portfolio-entry-thumbnail').mouseleave(function() {
        $j(this).find('img').css({
            'animation': 'moveout 10s ease',
        });
    });
}


// Load more posts.
$j('body').on('click', '.portfolio-entries .oceanwp-pagination li > .page-numbers', function(e) {

    if ( ! $j( this ).parents( '.portfolio-entries' ).hasClass( 'filter-type--button' ) ) {
        console.log('return');
        return;
    }

    e.preventDefault();

    var currentPage = $j( this ).attr( 'data-page' );

    var shortcode_id = $j( this ).parents( '.portfolio-entries' ).find( '.portfolio__filter-style-button' ).attr( 'data-shortcode-id' );

    var portfolioWrap = $j( '.portfolio-wrap' );
    var category = portfolioWrap.attr( 'data-category' );
    var tag = portfolioWrap.attr( 'data-tag' );
    var search = portfolioWrap.attr( 'data-search' );

    $j( '.portfolio-entries .oceanwp-pagination li > .page-numbers' ).removeClass( 'current' )
    $j( this ).addClass( 'current' )

    var activeitem = '';
    var currentItem = $j( 'li > .page-numbers.current' );
    if ( currentItem ) {
        activeitem = currentItem.attr( 'data-page' );
    }

    var totalPages = $j('.oceanwp-pagination').data('total-pages');
    var activePage = parseInt(currentPage);

    if (activePage >= totalPages) {
        $j('.oceanwp-pagination .next').hide();
    } else {
        $j('.oceanwp-pagination .next').attr('data-page', activePage + 1).show();
    }

    if (activePage <= 1) {
        $j('.oceanwp-pagination .prev').hide();
    } else {
        $j('.oceanwp-pagination .prev').attr('data-page', activePage - 1).show();
    }

    var data = {
		action: 'op_ajax_pagination',
		_ajax_nonce: oceanwpLocalize.opWpNonce,
        page: parseInt(currentPage),
        shortcode_id: shortcode_id,
        category: category,
        tag: tag,
        search: search
	};

    $j.ajax({
        url : oceanwpLocalize.ajax_url,
        data : data,
        type : 'POST',
        beforeSend : function ( xhr ) {
            $j( '.portfolio-wrap' ).html( '' );
		},
        complete: function() {
		},
        success : function( response ){
            $j( '.portfolio-wrap' ).html( response );

            opIsotopView();

        }
    });
    return false;
});

function opIsotopView() {

    $j( '.portfolio-entries.isotope-grid .portfolio-wrap' ).each( function() {

        var $wrap = $j( this );

        $wrap.isotope();
        $wrap.isotope('destroy');
        $wrap.imagesLoaded( function() {
            $wrap.isotope( {
                itemSelector       : '.portfolio-entry',
                transformsEnabled  : true,
                isOriginLeft       : oceanwpLocalize.isRTL ? false : true,
                transitionDuration : '0.4s',
                layoutMode         : $wrap.data( 'layout' ) ? $wrap.data( 'layout' ) : 'masonry'
            });
        });

    });

    $j( '.portfolio-entries.masonry-grid .portfolio-wrap' ).each( function() {

        var $wrap = $j( this );

        $wrap.isotope();
        $wrap.isotope('destroy');
        $wrap.imagesLoaded( function() {
            $wrap.isotope( {
                itemSelector       : '.portfolio-entry',
                transformsEnabled  : true,
                isOriginLeft       : oceanwpLocalize.isRTL ? false : true,
                transitionDuration : '0.4s',
                layoutMode         : 'masonry'
            });
        });

    });

}

// Accessibility.
( function() {

	var opFilter = document.querySelector('.portfolio__filter-style-button');
	if ( ! opFilter ) {
		return;
	}

	document.addEventListener( 'keydown', function( event ) {

		var selectors = 'input, a, button',
            elements  = opFilter.querySelectorAll( selectors ),
            isFilter  = opFilter.querySelector( '.filter-button.open.show' ),
			lastEl    = elements[ elements.length - 1 ],
			firstEl   = elements[0],
			activeEl  = document.activeElement,
			tabKey    = event.key === 'Tab',
			shiftKey  = event.shiftKey;


		if ( ! shiftKey && tabKey && lastEl === activeEl ) {
			event.preventDefault();
			firstEl.focus();
		}

        if ( isFilter ) {
            if ( shiftKey && tabKey && firstEl === activeEl ) {
                event.preventDefault();
                lastEl.focus();
            }
        }

	});

}() );