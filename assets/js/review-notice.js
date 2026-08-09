/**
 * Review notice interactions.
 *
 * Replaces the inline jQuery block the notice used to print into the admin
 * footer on every screen.
 *
 * @package Colorlib_404_Customizer
 */

( function () {
	'use strict';

	var notice = document.querySelector( '.cnfp-review-notice' );

	if ( ! notice || ! window.CNFPReview ) {
		return;
	}

	/**
	 * Record the answer, then collapse the notice.
	 *
	 * @param {boolean}     rated  Whether the user says they left a review.
	 * @param {string|null} review URL to open once the answer is stored.
	 */
	function respond( rated, review ) {
		var body = new FormData();

		body.append( 'action', 'cnfp_epsilon_review' );
		body.append( 'security', window.CNFPReview.nonce );

		if ( rated ) {
			body.append( 'epsilon-review', '1' );
		}

		window
			.fetch( window.CNFPReview.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				body: body
			} )
			.catch( function () {
				// The answer is a nicety; never block the UI on it.
			} )
			.then( function () {
				notice.remove();

				if ( review ) {
					window.open( review, '_blank', 'noopener' );
				}
			} );
	}

	notice.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.epsilon-review-button' );

		// WordPress injects the dismiss button after the notice renders, so it is
		// matched here rather than bound directly.
		if ( ! button ) {
			if ( event.target.closest( '.notice-dismiss' ) ) {
				respond( false, null );
			}

			return;
		}

		event.preventDefault();

		if ( 'epsilon-rate' === button.id ) {
			respond( true, button.getAttribute( 'href' ) );
		} else {
			respond( 'epsilon-rated' === button.id, null );
		}
	} );
} )();
