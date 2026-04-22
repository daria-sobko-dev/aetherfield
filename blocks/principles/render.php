<?php
/**
 * Principles block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$heading = get_field( 'principles_heading' );
$items = get_field( 'principles_items' );
?>
<section class="section section--principles" aria-labelledby="principles-title">
	<div class="section__inner principles__inner">
		<?php if ( $heading ) { ?>
			<div class="principles__top">
				<h2 id="principles-title" class="h-section principles__title"><?= esc_html( $heading ) ?></h2>
			</div>
		<?php } ?>
		<?php if ( $items ) { ?>
			<div class="principles__grid">
				<?php foreach ( $items as $v ) {
					$v_icon = $v['icon'];
					$v_title = $v['title'];
					$v_description = $v['description'];
					?>
					<article class="principle-card" aria-label="<?= esc_attr( $v_title ) ?>">
						<?php if ( $v_icon ) { ?>
							<div class="principle-card__icon" aria-hidden="true">
								<img loading="lazy" decoding="async" src="<?= esc_url( $v_icon['url'] ) ?>" alt="">
							</div>
						<?php } ?>
						<div class="principle-card__content">
							<h3 class="h-card principle-card__title"><?= esc_html( $v_title ) ?></h3>
							<p class="p-lg principle-card__description"><?= esc_html( $v_description ) ?></p>
						</div>
					</article>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>
