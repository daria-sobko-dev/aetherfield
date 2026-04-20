<?php
/**
 * Theme helper functions.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Detect if the current request is from a mobile device.
 *
 * Uses WordPress core `wp_is_mobile()` which checks the User-Agent string.
 * Returns true for phones and tablets.
 *
 * Note: this is server-side User-Agent sniffing — it does NOT reflect
 * viewport width. For viewport-based logic use CSS media queries.
 *
 * @return bool
 */
function aetherfield_is_mobile_device() {
	return function_exists( 'wp_is_mobile' ) ? wp_is_mobile() : false;
}

/**
 * Calculate reading time for a post.
 *
 * Uses the ACF `reading_time` field if filled (manual override).
 * Otherwise counts words in the post content and divides by the average
 * reading speed (200 words per minute).
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return string Formatted reading time, e.g. "4 min".
 */
function aetherfield_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$override = function_exists( 'get_field' ) ? get_field( 'reading_time', $post_id ) : '';
	if ( ! empty( $override ) ) {
		return $override;
	}

	$content    = get_post_field( 'post_content', $post_id );
	$plain_text = wp_strip_all_tags( $content );
	$word_count = str_word_count( $plain_text );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );

	/* translators: %d: reading time in minutes */
	return sprintf( _n( '%d min', '%d min', $minutes, 'aetherfield' ), $minutes );
}
