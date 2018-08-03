!( function( $ ) {
	'use strict';

	var init = function() {
		$('.filterby-category').on( 'click', clickHandler );
	}

	var clickHandler = function( event ) {
		event.preventDefault();

		var $element = $( this ),
		    data = {
			    action:         filterbyCatParams.action,
			    nonce:          filterbyCatParams.nonce,
			    catId:          $element.data('catid'),
		    };

		ajaxHandler( data, $element );

		return false;
	}

	function ajaxHandler( data, $element ) {
		$.post( filterbyCatParams.ajaxurl, data, function( response ) {
				var posts = $.parseJSON( response );
				if ( ! Array.isArray( posts ) ) {
					console.log( 'whoops, we do not get back the post(s).' );
					return;
				}

				renderPosts( posts );
			})
			.fail(function(){
				console.log( 'failed' );
			})
			.always(function(){

			});
	}

	function renderPosts( posts ) {
		// do your work here to render it.

		// Remove this line of code when you're done.
		console.log( posts );
	}

	$( document ).ready(function() {
		if ( typeof filterbyCatParams !== "object" ) {
			return;
		}

		init();
	});

})( jQuery );