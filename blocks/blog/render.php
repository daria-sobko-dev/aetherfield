<?php
/**
 * Blog block render template.
 *
 * @package Aetherfield
 */

$title = get_field( 'blog_title' );
$items = get_field( 'blog_items' );
$button = get_field( 'blog_button' );
$sticker_url = get_template_directory_uri() . '/blocks/blog/sticker.svg';
?>
<section class="section section--blog" aria-labelledby="blog-title">
	<div class="section__inner">
		<h2 id="blog-title" class="h-section blog__title"><?= esc_html( $title ) ?></h2>
		<div class="section__content blog__body">
			<div class="blog__sticker" aria-hidden="true">
				<img src="<?= esc_url( $sticker_url ) ?>" alt="">
			</div>
			<?php if ( $items ) { ?>
				<div class="journal-list">
					<?php foreach ( $items as $p ) {
						$p_image = $p['image'];
						$p_title = $p['title'];
						$p_category = $p['category'];
						$p_reading_time = $p['reading_time'];
						$p_link = $p['link'];
						$p_link_url = ! empty( $p_link['url'] ) ? $p_link['url'] : '#';
						$p_link_target = ! empty( $p_link['target'] ) ? $p_link['target'] : '';
						?>
						<article class="journal-item">
							<a class="journal-item__content" href="<?= esc_url( $p_link_url ) ?>"<?= $p_link_target ? ' target="' . esc_attr( $p_link_target ) . '"' : '' ?>>
								<?php if ( $p_image ) { ?>
									<div class="journal-item__image">
										<img src="<?= esc_url( $p_image['url'] ) ?>" alt="<?= esc_attr( $p_image['alt'] ) ?>">
									</div>
								<?php } ?>
								<div class="journal-item__info">
									<h3 class="h-card"><?= esc_html( $p_title ) ?></h3>
									<div class="journal-item__details">
										<span><?= esc_html( $p_category ) ?></span>
										<span>·</span>
										<span><?= esc_html( $p_reading_time ) ?></span>
									</div>
								</div>
							</a>
						</article>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if ( $button ) { ?>
				<a class="btn btn--secondary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
			<?php } ?>
		</div>
	</div>
</section>
