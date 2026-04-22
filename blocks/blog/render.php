<?php
/**
 * Blog block render template — shows the latest 3 Blog CPT posts.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$title = get_field( 'blog_title' );
$button = get_field( 'blog_button' );
$sticker_url = get_template_directory_uri() . '/blocks/blog/sticker.svg';

$blog_query = new WP_Query( array(
	'post_type'      => 'blog',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
?>
<section class="section section--blog" aria-labelledby="blog-title">
	<div class="section__inner">
		<h2 id="blog-title" class="h-section blog__title"><?= esc_html( $title ) ?></h2>
		<div class="section__content blog__body">
			<div class="blog__sticker" aria-hidden="true">
				<img loading="lazy" decoding="async" src="<?= esc_url( $sticker_url ) ?>" alt="">
			</div>
			<?php if ( $blog_query->have_posts() ) { ?>
				<div class="blog-list">
					<?php while ( $blog_query->have_posts() ) {
						$blog_query->the_post();

						$hero         = get_field( 'hero_image' );
						$thumb_id     = get_post_thumbnail_id();
						$thumb_url    = ! empty( $hero['url'] ) ? $hero['url'] : ( $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '' );
						$thumb_alt    = ! empty( $hero['alt'] ) ? $hero['alt'] : ( $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '' );
						$reading_time = aetherfield_reading_time();
						$topics       = get_the_terms( get_the_ID(), 'blog_topic' );
						$topic        = ( ! is_wp_error( $topics ) && ! empty( $topics ) ) ? $topics[0]->name : '';
						?>
						<article class="blog-item">
							<a class="blog-item__content" href="<?= esc_url( get_permalink() ) ?>">
								<?php if ( $thumb_url ) { ?>
									<div class="blog-item__image">
										<img loading="lazy" decoding="async" src="<?= esc_url( $thumb_url ) ?>" alt="<?= esc_attr( $thumb_alt ) ?>">
									</div>
								<?php } ?>
								<div class="blog-item__info">
									<h3 class="h-card"><?= esc_html( get_the_title() ) ?></h3>
									<?php if ( $topic || $reading_time ) { ?>
										<div class="blog-item__details">
											<?php if ( $topic ) { ?>
												<span><?= esc_html( $topic ) ?></span>
											<?php } ?>
											<?php if ( $topic && $reading_time ) { ?>
												<span>·</span>
											<?php } ?>
											<?php if ( $reading_time ) { ?>
												<span><?= esc_html( $reading_time ) ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</a>
						</article>
					<?php }
					wp_reset_postdata();
					?>
				</div>
			<?php } ?>
			<?php if ( $button ) { ?>
				<a class="btn btn--secondary" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
			<?php } ?>
		</div>
	</div>
</section>
