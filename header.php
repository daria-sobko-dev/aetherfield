<?php
/**
 * The header for our theme
 *
 * @package Aetherfield
 */

$logo_url      = get_template_directory_uri() . '/assets/images/logo.svg';
$menu_icon_url = get_template_directory_uri() . '/assets/images/menu-icon.svg';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?= esc_html__( 'Skip to content', 'aetherfield' ) ?></a>

	<header id="masthead" class="site-header">
		<nav class="nav" aria-label="<?= esc_attr__( 'Primary', 'aetherfield' ) ?>">
			<div class="nav__inner">
				<a class="nav__logo" href="<?= esc_url( home_url( '/' ) ) ?>" aria-label="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
					<img src="<?= esc_url( $logo_url ) ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
				</a>

				<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-menu" aria-label="<?= esc_attr__( 'Toggle menu', 'aetherfield' ) ?>">
					<img src="<?= esc_url( $menu_icon_url ) ?>" alt="" aria-hidden="true">
				</button>

				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'nav-menu',
					'menu_class'     => 'nav__menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'aetherfield_primary_fallback_menu',
				) ); ?>
			</div>
		</nav>
	</header>
