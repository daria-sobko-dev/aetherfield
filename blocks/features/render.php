<?php
/**
 * Features block render template.
 *
 * @package Aetherfield
 */

$title = get_field( 'features_title' );
$image = get_field( 'features_image' );
$items = get_field( 'features_items' );
$button = get_field( 'features_button' );
?>
<section class="section section--features" aria-labelledby="features-title">
	<div class="section__inner">
		<h2 id="features-title" class="h-section features__title">
			<?= esc_html( $title ) ?>
		</h2>
		<div class="section__content features__content">
			<?php if ( $image ) { ?>
				<div class="features__image">
					<img src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
				</div>
			<?php } ?>
			<div class="features__list">
				<?php if ( $items ) { ?>
					<ul class="feature-list">
						<?php foreach ( $items as $item ) {
							$item_title = $item['title'];
							$item_number = $item['number'];
							$item_description = $item['description'];
							?>
							<li class="feature-list__item">
								<div class="feature-list__header">
									<h3 class="h-card feature-list__title"><?= esc_html( $item_title ) ?></h3>
									<span class="caption"><?= esc_html( $item_number ) ?></span>
								</div>
								<p class="p-lg feature-list__desc"><?= esc_html( $item_description ) ?></p>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				<?php if ( $button ) { ?>
					<a class="btn btn--primary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
