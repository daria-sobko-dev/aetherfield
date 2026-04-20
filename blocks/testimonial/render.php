<?php
/**
 * Testimonial block render template.
 *
 * @package Aetherfield
 */

$image = get_field( 'testimonial_image' );
$quote = get_field( 'testimonial_quote' );
$name = get_field( 'testimonial_name' );
$role = get_field( 'testimonial_role' );
$quote_icon_url = get_template_directory_uri() . '/blocks/testimonial/quote.svg';
?>
<section class="section section--testimonial" aria-labelledby="testimonial-title">
	<div class="section__inner">
		<div class="section__content testimonial__content">
			<?php if ( $image ) { ?>
				<div class="testimonial__image">
					<img src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
				</div>
			<?php } ?>
			<div class="testimonial__quote">
				<img class="testimonial__icon" src="<?= esc_url( $quote_icon_url ) ?>" alt="" aria-hidden="true">
				<blockquote id="testimonial-title" class="testimonial__text">
					<?= esc_html( $quote ) ?>
				</blockquote>
				<div class="testimonial__meta">
					<p class="testimonial__name"><?= esc_html( $name ) ?></p>
					<p class="testimonial__role"><?= esc_html( $role ) ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
