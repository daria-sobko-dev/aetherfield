<?php
/**
 * Case Study block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$image = get_field( 'case_image' );
$title = get_field( 'case_title' );
$description = get_field( 'case_description' );
$button = get_field( 'case_button' );
?>
<section class="section section--case-study" aria-labelledby="case-title">
	<div class="section__inner">
		<div class="case-study__module">
			<?php if ( $image ) { ?>
				<div class="case-study__image">
					<img loading="lazy" decoding="async" src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
				</div>
			<?php } ?>
			<div class="case-study__content">
				<div class="case-study__paragraph">
					<h2 id="case-title" class="h-card"><?= esc_html( $title ) ?></h2>
					<p class="p-lg">
						<?= esc_html( $description ) ?>
					</p>
				</div>
				<?php if ( $button ) { ?>
					<a class="btn btn--secondary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
