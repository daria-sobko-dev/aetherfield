<?php
/**
 * Front-end performance cleanups.
 *
 * Removes WP features we don't use so that HTML/head stays lean:
 *   - emoji script + styles (~8 KB + 1 request)
 *   - oEmbed discovery links (Reddit/Twitter embed support, rarely used)
 *   - WP generator meta tag (version disclosure)
 *   - REST API and wlwmanifest links from <head>
 *   - short link from <head>
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable emoji script on the front end.
 */
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
} );

/**
 * Trim <head>.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
