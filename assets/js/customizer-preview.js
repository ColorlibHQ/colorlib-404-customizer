/**
 * Live preview bindings, running inside the customizer preview iframe.
 *
 * @package Colorlib_404_Customizer
 */

( function ( api ) {
	'use strict';

	if ( ! api ) {
		return;
	}

	/*
	 * Settings whose element id matches the setting key, so the preview can swap
	 * the markup in place instead of reloading the whole frame.
	 */
	var fields = [
		'colorlib_404_customizer_page_heading',
		'colorlib_404_customizer_content',
		'colorlib_404_customizer_button_text'
	];

	fields.forEach( function ( field ) {
		api( 'cnfp_settings[' + field + ']', function ( setting ) {
			setting.bind( function ( value ) {
				var element = document.getElementById( field );

				if ( element ) {
					element.innerHTML = value;
				}
			} );
		} );
	} );
} )( window.wp && window.wp.customize );
