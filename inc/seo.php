<?php
/**
 * SEO head output.
 *
 * Adds the social/meta layer WordPress core does not provide:
 * meta description, Open Graph, Twitter Card, canonical for non-singular views,
 * and site-wide Organization + WebSite JSON-LD on the front page.
 *
 * Self-contained — no SEO plugin required. If Yoast/RankMath is later installed,
 * disable this module (remove the require in functions.php) to avoid duplicate tags.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Best canonical/share URL for the current request.
 *
 * @return string
 */
function aetherfield_current_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		return (string) get_permalink();
	}
	if ( is_home() ) {
		$page_for_posts = (int) get_option( 'page_for_posts' );
		return $page_for_posts ? (string) get_permalink( $page_for_posts ) : home_url( '/' );
	}
	if ( is_post_type_archive() ) {
		$pt = get_queried_object();
		if ( $pt instanceof WP_Post_Type ) {
			$link = get_post_type_archive_link( $pt->name );
			return $link ?: home_url( '/' );
		}
	}
	if ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$link = get_term_link( $term );
			return is_wp_error( $link ) ? home_url( '/' ) : $link;
		}
	}
	return home_url( '/' );
}

/**
 * Context-aware meta description (plain text, trimmed to ~160 chars).
 *
 * @return string
 */
function aetherfield_meta_description() {
	$desc = '';

	if ( is_front_page() ) {
		$desc = get_bloginfo( 'description' );
	} elseif ( is_singular() ) {
		$post_id = get_queried_object_id();
		if ( function_exists( 'get_field' ) ) {
			$desc = get_field( 'intro_text', $post_id ) ?: get_field( 'short_description', $post_id ) ?: '';
		}
		if ( ! $desc ) {
			$desc = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : get_post_field( 'post_content', $post_id );
		}
	} elseif ( is_post_type_archive() ) {
		$pt   = get_queried_object();
		$desc = ( $pt instanceof WP_Post_Type && ! empty( $pt->description ) ) ? $pt->description : get_bloginfo( 'description' );
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$desc = term_description() ?: get_bloginfo( 'description' );
	} else {
		$desc = get_bloginfo( 'description' );
	}

	$desc = wp_strip_all_tags( (string) $desc, true );
	$desc = trim( preg_replace( '/\s+/', ' ', $desc ) );

	if ( mb_strlen( $desc ) > 160 ) {
		$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
	}

	return $desc;
}

/**
 * Best share image (absolute URL) for the current context.
 * Order: featured image → ACF hero_image → site-wide default_share_image option.
 *
 * @return string
 */
function aetherfield_share_image() {
	$url = '';

	if ( is_singular() ) {
		$post_id = get_queried_object_id();
		if ( has_post_thumbnail( $post_id ) ) {
			$url = (string) get_the_post_thumbnail_url( $post_id, 'full' );
		} elseif ( function_exists( 'get_field' ) ) {
			$hero = get_field( 'hero_image', $post_id );
			if ( is_array( $hero ) && ! empty( $hero['url'] ) ) {
				$url = $hero['url'];
			}
		}
	}

	if ( ! $url && function_exists( 'get_field' ) ) {
		$default = get_field( 'default_share_image', 'option' );
		if ( is_array( $default ) && ! empty( $default['url'] ) ) {
			$url = $default['url'];
		}
	}

	return $url;
}

/**
 * Output meta description, Open Graph and Twitter Card tags.
 */
add_action( 'wp_head', 'aetherfield_meta_tags', 5 );
function aetherfield_meta_tags() {
	$description = aetherfield_meta_description();
	$title       = wp_get_document_title();
	$url         = aetherfield_current_url();
	$image       = aetherfield_share_image();
	$type        = ( is_singular() && ! is_front_page() ) ? 'article' : 'website';

	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}

	echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $description ) {
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}

	echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $description ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}
}

/**
 * Canonical link for non-singular views (WP core handles singular via rel_canonical).
 */
add_action( 'wp_head', 'aetherfield_canonical', 5 );
function aetherfield_canonical() {
	if ( is_singular() ) {
		return;
	}
	$url = aetherfield_current_url();
	if ( $url ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	}
}

/**
 * Site-wide Organization + WebSite JSON-LD on the front page.
 *
 * sameAs is populated from ACF option fields (social_linkedin, social_x, …) when present.
 */
add_action( 'wp_head', 'aetherfield_schema_site' );
function aetherfield_schema_site() {
	if ( ! is_front_page() ) {
		return;
	}

	$org_id  = home_url( '/#organization' );
	$site_id = home_url( '/#website' );

	$same_as = array();
	if ( function_exists( 'get_field' ) ) {
		$social_keys = array( 'social_linkedin', 'social_x', 'social_github', 'social_instagram', 'social_facebook', 'social_youtube' );
		foreach ( $social_keys as $key ) {
			$val = get_field( $key, 'option' );
			if ( $val ) {
				$same_as[] = $val;
			}
		}
	}

	$organization = array(
		'@type' => 'Organization',
		'@id'   => $org_id,
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
		'logo'  => array(
			'@type' => 'ImageObject',
			'url'   => get_template_directory_uri() . '/assets/images/logo-big.svg',
		),
	);
	if ( $same_as ) {
		$organization['sameAs'] = array_values( $same_as );
	}

	$website = array(
		'@type'     => 'WebSite',
		'@id'       => $site_id,
		'name'      => get_bloginfo( 'name' ),
		'url'       => home_url( '/' ),
		'publisher' => array( '@id' => $org_id ),
	);

	$graph = array(
		'@context' => 'https://schema.org',
		'@graph'   => array( $organization, $website ),
	);

	$json = wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	if ( $json ) {
		echo "\n" . '<script type="application/ld+json">' . $json . '</script>' . "\n";
	}
}
