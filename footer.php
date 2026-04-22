<?php
/**
 * The template for displaying the footer
 *
 * @package Aetherfield
 */

$footer_image = get_template_directory_uri() . '/assets/images/footer.png';
$footer_logo  = get_template_directory_uri() . '/assets/images/logo-big.svg';
?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__inner">
			<div class="footer__top">
				<?php wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer__links',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'aetherfield_footer_fallback_menu',
				) ); ?>
				<p class="footer__copy"><?= esc_html( sprintf( __( '© %d  ·  All rights reserved', 'aetherfield' ), (int) date( 'Y' ) ) ) ?></p>
			</div>

			<div class="footer__image" aria-hidden="true">
				<img src="<?= esc_url( $footer_image ) ?>" alt="">
			</div>

			<div class="footer__logo" aria-label="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
				<img src="<?= esc_url( $footer_logo ) ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
