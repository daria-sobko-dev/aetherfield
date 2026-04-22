<?php
/**
 * Contact Form 7 integration tweaks.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable CF7's automatic <p>/<br> wrapping so raw HTML inside forms stays intact.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Add a custom class to every CF7 <form> so styles can target it.
 */
add_filter( 'wpcf7_form_class_attr', function ( $class ) {
	return trim( $class . ' cta-form__form' );
} );

