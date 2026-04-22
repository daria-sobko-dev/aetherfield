<?php
/**
 * Register ACF Options pages.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', 'aetherfield_register_options_pages' );
function aetherfield_register_options_pages() {
	if ( ! function_exists( 'acf_add_options_sub_page' ) ) {
		return;
	}

	acf_add_options_sub_page( array(
		'page_title'  => __( 'Blog Archive', 'aetherfield' ),
		'menu_title'  => __( 'Archive Settings', 'aetherfield' ),
		'menu_slug'   => 'aetherfield-blog-archive',
		'parent_slug' => 'edit.php?post_type=blog',
		'capability'  => 'edit_posts',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => __( 'Careers Settings', 'aetherfield' ),
		'menu_title'  => __( 'Careers Settings', 'aetherfield' ),
		'menu_slug'   => 'aetherfield-careers-settings',
		'parent_slug' => 'edit.php?post_type=job',
		'capability'  => 'edit_posts',
	) );
}
