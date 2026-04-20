<?php
/**
 * CTA block render template.
 *
 * @package Aetherfield
 */

$title = get_field( 'cta_title' );
$button = get_field( 'cta_button' );
?>
<section class="section section--cta" aria-labelledby="cta-title">
	<div class="section__inner">
		<h2 id="cta-title" class="h-section cta__title">
			<?= esc_html( $title ) ?>
		</h2>
		<?php if ( $button ) { ?>
			<a class="btn btn--primary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
		<?php } ?>
	</div>
</section>
