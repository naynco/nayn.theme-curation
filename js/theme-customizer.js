( function( $ ) {

	//Update site accent color in real time...
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( newval ) {
			$('.header').css('background-color', newval );
			$('.post-content a').css('color', newval );
		} );
	} );
	
} )( jQuery );