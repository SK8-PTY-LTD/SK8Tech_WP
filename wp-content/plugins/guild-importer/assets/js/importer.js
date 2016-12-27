(function ( $ ) {
	'use strict';

	// Switch active preview
	$( document ).on( 'click', '.gi-variants-preview label', function ( e ) {
		$( '.gi-variants-preview li' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	} );

	// Show loader after clicking "import"
	$( document ).on( 'submit', '#gi-do-import', function ( e ) {
		var $form = $( this );
		var $submit = $form.find(':submit');
		var $loader = $( '.gi-loading' );

		$submit.prop('disabled', true);
		$loader.addClass( 'gi-show' );
	} );
})( jQuery );