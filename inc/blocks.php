<?php
/**
 * Register ACF Blocks.
 *
 * Each block lives in /blocks/{name}/ with:
 *   - block.json (metadata)
 *   - render.php (template)
 *   - style.css (frontend styles)
 *   - fields.json (ACF field group, auto-loaded)
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the theme block category.
 */
add_filter( 'block_categories_all', function ( $categories ) {
	array_unshift( $categories, array(
		'slug'  => 'aetherfield',
		'title' => __( 'Aetherfield', 'aetherfield' ),
	) );
	return $categories;
} );

/**
 * Register all ACF blocks.
 */
add_action( 'acf/init', 'aetherfield_register_blocks' );
function aetherfield_register_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$blocks = array(
		'intro'       => 'Intro',
		'features'    => 'Features',
		'values'      => 'Values',
		'case-study'  => 'Case Study',
		'blog'        => 'Blog',
		'testimonial' => 'Testimonial',
		'cta'         => 'Call to action',
		'mission'     => 'Mission',
		'principles'  => 'Principles',
		'founder'     => 'Founder',
		'team'        => 'Team',
	);

	foreach ( $blocks as $slug => $title ) {
		$dir_uri = get_template_directory_uri() . "/blocks/{$slug}";
		$dir_path = get_template_directory() . "/blocks/{$slug}";

		acf_register_block_type( array(
			'name'            => $slug,
			'title'           => $title,
			'description'     => '',
			'category'        => 'aetherfield',
			'icon'            => 'layout',
			'mode'            => 'preview',
			'render_template' => "blocks/{$slug}/render.php",
			'enqueue_style'   => file_exists( "{$dir_path}/style.css" ) ? "{$dir_uri}/style.css" : '',
			'enqueue_script'  => file_exists( "{$dir_path}/view.js" ) ? "{$dir_uri}/view.js" : '',
			'supports'        => array(
				'align'            => false,
				'anchor'           => false,
				'customClassName' => false,
				'html'             => false,
				'color'            => false,
				'spacing'          => false,
				'typography'       => false,
				'jsx'              => true,
			),
		) );
	}
}

/**
 * Tell ACF to load field group JSON from each block folder.
 */
add_filter( 'acf/settings/load_json', function ( $paths ) {
	$block_dirs = glob( get_template_directory() . '/blocks/*', GLOB_ONLYDIR );
	if ( is_array( $block_dirs ) ) {
		foreach ( $block_dirs as $dir ) {
			$paths[] = $dir;
		}
	}
	return $paths;
} );

/**
 * Restrict Aetherfield page templates to theme blocks only (no core blocks).
 */
add_filter( 'allowed_block_types_all', function ( $allowed, $context ) {
	if ( ! $context->post ) {
		return $allowed;
	}

	$template = get_page_template_slug( $context->post );

	$templates = array(
		'page-home.php'  => array(
			'acf/intro',
			'acf/features',
			'acf/values',
			'acf/case-study',
			'acf/blog',
			'acf/testimonial',
			'acf/cta',
		),
		'page-about.php' => array(
			'acf/mission',
			'acf/principles',
			'acf/founder',
			'acf/team',
			'acf/cta',
		),
	);

	return $templates[ $template ] ?? $allowed;
}, 10, 2 );
