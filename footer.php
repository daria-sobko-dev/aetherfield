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
		<div class="footer__top">
			<ul class="footer__links">
				<li><a href="#"><?= esc_html__( 'Product', 'aetherfield' ) ?></a></li>
				<li><a href="#"><?= esc_html__( 'Journal', 'aetherfield' ) ?></a></li>
				<li><a href="#"><?= esc_html__( 'About', 'aetherfield' ) ?></a></li>
				<li><a href="#"><?= esc_html__( 'Careers', 'aetherfield' ) ?></a></li>
				<li><a href="#"><?= esc_html__( 'Get started', 'aetherfield' ) ?></a></li>
			</ul>
			<p class="footer__copy"><?= esc_html( sprintf( __( '© %d  ·  All rights reserved', 'aetherfield' ), (int) date( 'Y' ) ) ) ?></p>
		</div>

		<div class="footer__image" aria-hidden="true">
			<img src="<?= esc_url( $footer_image ) ?>" alt="">
		</div>

		<div class="footer__logo" aria-label="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
			<img src="<?= esc_url( $footer_logo ) ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
