<?php
/**
 * Contact Form 7 integration tweaks.
 *
 * The consult form's markup (labels, wrapper spans, classes) is styled by
 * .consult_form in style.css, so the CF7-rendered <form> must carry that
 * class, and must not be reflowed by CF7's built-in wpautop pass — the
 * template already provides its own <p> structure.
 *
 * @package beauty-institute
 */

add_filter( 'wpcf7_autop', '__return_false' );

add_filter(
	'wpcf7_form_class_attr',
	function ( $class ) {
		return trim( $class . ' consult_form' );
	}
);
