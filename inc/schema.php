<?php
/**
 * Schema.org JSON-LD markup for single posts.
 *
 * Outputs BlogPosting on single blog posts and JobPosting on single jobs.
 * Helps search engines understand and surface content richer in results.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', 'aetherfield_schema_single' );
function aetherfield_schema_single() {
	if ( is_singular( 'blog' ) ) {
		aetherfield_schema_blog_posting();
	} elseif ( is_singular( 'job' ) ) {
		aetherfield_schema_job_posting();
	}
}

/**
 * BlogPosting schema for single blog post.
 */
function aetherfield_schema_blog_posting() {
	$post_id   = get_the_ID();
	$hero      = function_exists( 'get_field' ) ? get_field( 'hero_image', $post_id ) : null;
	$intro     = function_exists( 'get_field' ) ? get_field( 'intro_text', $post_id ) : '';
	$author_id = (int) get_post_field( 'post_author', $post_id );
	$author    = function_exists( 'get_field' ) ? get_field( 'author', $post_id ) : '';

	if ( ! $author ) {
		$author = get_the_author_meta( 'display_name', $author_id );
	}

	$data = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'BlogPosting',
		'headline'      => get_the_title( $post_id ),
		'description'   => $intro ? wp_strip_all_tags( $intro ) : wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), 30 ),
		'datePublished' => get_the_date( DATE_ATOM, $post_id ),
		'dateModified'  => get_the_modified_date( DATE_ATOM, $post_id ),
		'mainEntityOfPage' => array(
			'@type' => 'WebPage',
			'@id'   => get_permalink( $post_id ),
		),
		'author' => array(
			'@type' => 'Person',
			'name'  => $author,
		),
		'publisher' => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'logo'  => array(
				'@type' => 'ImageObject',
				'url'   => get_template_directory_uri() . '/assets/images/logo-big.svg',
			),
		),
	);

	if ( is_array( $hero ) && ! empty( $hero['url'] ) ) {
		$data['image'] = $hero['url'];
	}

	aetherfield_schema_print( $data );
}

/**
 * JobPosting schema for single job post.
 */
function aetherfield_schema_job_posting() {
	$post_id         = get_the_ID();
	$location        = function_exists( 'get_field' ) ? get_field( 'location', $post_id ) : '';
	$employment_type = function_exists( 'get_field' ) ? get_field( 'employment_type', $post_id ) : '';
	$short_desc      = function_exists( 'get_field' ) ? get_field( 'short_description', $post_id ) : '';
	$apply           = function_exists( 'get_field' ) ? get_field( 'apply_link', $post_id ) : null;

	$type_map = array(
		'Full-time'   => 'FULL_TIME',
		'Part-time'   => 'PART_TIME',
		'Contract'    => 'CONTRACTOR',
		'Internship'  => 'INTERN',
		'Temporary'   => 'TEMPORARY',
		'Volunteer'   => 'VOLUNTEER',
	);
	$employment_code = $type_map[ $employment_type ] ?? 'FULL_TIME';

	$data = array(
		'@context'       => 'https://schema.org',
		'@type'          => 'JobPosting',
		'title'          => get_the_title( $post_id ),
		'description'    => $short_desc ? wp_strip_all_tags( $short_desc ) : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 50 ),
		'datePosted'     => get_the_date( DATE_ATOM, $post_id ),
		'validThrough'   => get_the_modified_date( DATE_ATOM, $post_id ),
		'employmentType' => $employment_code,
		'hiringOrganization' => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'sameAs' => home_url( '/' ),
		),
	);

	if ( $location ) {
		$parts = array_map( 'trim', explode( ',', $location ) );
		$data['jobLocation'] = array(
			'@type' => 'Place',
			'address' => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $parts[0] ?? $location,
				'addressRegion'   => $parts[1] ?? '',
			),
		);
	}

	if ( is_array( $apply ) && ! empty( $apply['url'] ) ) {
		$data['directApply'] = true;
		$data['applicantLocationRequirements'] = array(
			'@type' => 'Country',
			'name'  => 'US',
		);
	}

	aetherfield_schema_print( $data );
}

/**
 * Output JSON-LD block. Strips nulls/empties to keep payload tidy.
 */
function aetherfield_schema_print( array $data ) {
	$json = wp_json_encode( array_filter( $data ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	if ( $json ) {
		echo "\n" . '<script type="application/ld+json">' . $json . '</script>' . "\n";
	}
}
