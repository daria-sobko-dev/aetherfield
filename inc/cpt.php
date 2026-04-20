<?php
/**
 * Register custom post types and taxonomies.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Blog CPT.
 */
add_action( 'init', 'aetherfield_register_post_types' );
function aetherfield_register_post_types() {
	register_post_type( 'blog', array(
		'label'         => __( 'Blog', 'aetherfield' ),
		'labels'        => array(
			'name'               => __( 'Blog', 'aetherfield' ),
			'singular_name'      => __( 'Blog post', 'aetherfield' ),
			'add_new'            => __( 'Add new', 'aetherfield' ),
			'add_new_item'       => __( 'Add new blog post', 'aetherfield' ),
			'edit_item'          => __( 'Edit blog post', 'aetherfield' ),
			'new_item'           => __( 'New blog post', 'aetherfield' ),
			'view_item'          => __( 'View blog post', 'aetherfield' ),
			'search_items'       => __( 'Search blog posts', 'aetherfield' ),
			'not_found'          => __( 'No blog posts found', 'aetherfield' ),
			'not_found_in_trash' => __( 'No blog posts found in trash', 'aetherfield' ),
			'all_items'          => __( 'All blog posts', 'aetherfield' ),
			'menu_name'          => __( 'Blog', 'aetherfield' ),
		),
		'public'        => true,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-book',
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'show_in_rest'  => true,
		'rewrite'       => array( 'slug' => 'blog' ),
	) );
}

/**
 * Register the Blog taxonomy (topics).
 */
add_action( 'init', 'aetherfield_register_taxonomies' );
function aetherfield_register_taxonomies() {
	register_taxonomy( 'blog_topic', 'blog', array(
		'label'             => __( 'Topics', 'aetherfield' ),
		'labels'            => array(
			'name'              => __( 'Topics', 'aetherfield' ),
			'singular_name'     => __( 'Topic', 'aetherfield' ),
			'search_items'      => __( 'Search topics', 'aetherfield' ),
			'all_items'         => __( 'All topics', 'aetherfield' ),
			'edit_item'         => __( 'Edit topic', 'aetherfield' ),
			'update_item'       => __( 'Update topic', 'aetherfield' ),
			'add_new_item'      => __( 'Add new topic', 'aetherfield' ),
			'new_item_name'     => __( 'New topic name', 'aetherfield' ),
			'menu_name'         => __( 'Topics', 'aetherfield' ),
		),
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'blog/topic' ),
	) );
}
