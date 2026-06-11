<?php
/**
 * Navigation menus — wp_nav_menu filters and fallbacks.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Move a menu item's CSS classes onto its <a> tag so styles like `.nav__cta`
 * keep working when authored via Appearance → Menus → CSS Classes (Screen
 * Options must be enabled to see the field).
 *
 * The class is moved (not copied): the paired `nav_menu_css_class` filter below
 * strips it from the <li> so selectors like `.nav__cta::after` don't render
 * twice (once on the <li>, once on the <a>).
 */
const AETHERFIELD_NAV_MOVABLE_CLASSES = array( 'nav__cta' );

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
	$classes = (array) $item->classes;

	foreach ( AETHERFIELD_NAV_MOVABLE_CLASSES as $class ) {
		if ( in_array( $class, $classes, true ) ) {
			$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' ' . $class );
		}
	}

	return $atts;
}, 10, 3 );

add_filter( 'nav_menu_css_class', function ( $classes, $item ) {
	return array_values( array_diff( (array) $classes, AETHERFIELD_NAV_MOVABLE_CLASSES ) );
}, 10, 2 );

/**
 * Fallback menu shown in the header when no menu is assigned to the
 * "Primary (Header)" location.
 */
function aetherfield_primary_fallback_menu() {
	?>
	<ul id="nav-menu" class="nav__menu">
		<li><a href="<?= esc_url( home_url( '/' ) ) ?>"><?= esc_html__( 'Home', 'aetherfield' ) ?></a></li>
		<?php
		$about  = get_page_by_path( 'about' );
		$careers = get_post_type_archive_link( 'job' );
		$blog    = get_post_type_archive_link( 'blog' );
		?>
		<?php if ( $blog ) { ?>
			<li><a href="<?= esc_url( $blog ) ?>"><?= esc_html__( 'Journal', 'aetherfield' ) ?></a></li>
		<?php } ?>
		<?php if ( $about ) { ?>
			<li><a href="<?= esc_url( get_permalink( $about ) ) ?>"><?= esc_html__( 'About', 'aetherfield' ) ?></a></li>
		<?php } ?>
		<?php if ( $careers ) { ?>
			<li><a href="<?= esc_url( $careers ) ?>"><?= esc_html__( 'Careers', 'aetherfield' ) ?></a></li>
		<?php } ?>
	</ul>
	<?php
}

/**
 * Fallback menu shown in the footer when no menu is assigned to the
 * "Footer" location.
 */
function aetherfield_footer_fallback_menu() {
	$about   = get_page_by_path( 'about' );
	$careers = get_post_type_archive_link( 'job' );
	$blog    = get_post_type_archive_link( 'blog' );
	?>
	<ul class="footer__links">
		<li><a href="<?= esc_url( home_url( '/' ) ) ?>"><?= esc_html__( 'Home', 'aetherfield' ) ?></a></li>
		<?php if ( $blog ) { ?>
			<li><a href="<?= esc_url( $blog ) ?>"><?= esc_html__( 'Journal', 'aetherfield' ) ?></a></li>
		<?php } ?>
		<?php if ( $about ) { ?>
			<li><a href="<?= esc_url( get_permalink( $about ) ) ?>"><?= esc_html__( 'About', 'aetherfield' ) ?></a></li>
		<?php } ?>
		<?php if ( $careers ) { ?>
			<li><a href="<?= esc_url( $careers ) ?>"><?= esc_html__( 'Careers', 'aetherfield' ) ?></a></li>
		<?php } ?>
	</ul>
	<?php
}
