<?php
/**
 * CTA section — shared template part.
 *
 * Pass args via get_template_part(..., $args):
 *   - title    (string) Heading text
 *   - form_id  (int)    Contact Form 7 post ID. If set, renders the form instead of the button.
 *   - button   (array)  ACF link field (url, title, target). Fallback when no form is selected.
 *   - title_id (string) Optional id for the h2 (used by aria-labelledby).
 *
 * @package Aetherfield
 */

$title    = $args['title'] ?? '';
$form_id  = $args['form_id'] ?? 0;
$button   = $args['button'] ?? null;
$title_id = $args['title_id'] ?? 'cta-title';

if ( ! $title ) {
	return;
}
?>
<section class="section section--cta" aria-labelledby="<?= esc_attr( $title_id ) ?>">
	<div class="section__inner">
		<h2 id="<?= esc_attr( $title_id ) ?>" class="h-section cta__title">
			<?= esc_html( $title ) ?>
		</h2>
		<?php if ( $form_id && shortcode_exists( 'contact-form-7' ) ) { ?>
			<div class="cta-form">
				<?= do_shortcode( '[contact-form-7 id="' . (int) $form_id . '"]' ) ?>
			</div>
		<?php } elseif ( $button ) { ?>
			<a class="btn btn--primary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
		<?php } ?>
	</div>
</section>
