<?php
/**
 * Large blog card — used in archive-blog.php grid.
 *
 * Expects the global `$post` (standard WP loop).
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$hero         = get_field( 'hero_image' );
$thumb_id     = get_post_thumbnail_id();
$thumb_url    = ! empty( $hero['url'] ) ? $hero['url'] : ( $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '' );
$thumb_alt    = ! empty( $hero['alt'] ) ? $hero['alt'] : ( $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '' );
$permalink    = get_permalink();
$title        = get_the_title();
$excerpt      = get_the_excerpt();
$reading_time = aetherfield_reading_time();
$topics       = get_the_terms( get_the_ID(), 'blog_topic' );
$topic        = ( ! is_wp_error( $topics ) && ! empty( $topics ) ) ? $topics[0]->name : '';
?>
<article class="blog-card blog-card--large">
	<a class="blog-card__link" href="<?= esc_url( $permalink ) ?>">
		<?php if ( $thumb_url ) { ?>
			<div class="blog-card__image">
				<img loading="lazy" decoding="async" src="<?= esc_url( $thumb_url ) ?>" alt="<?= esc_attr( $thumb_alt ) ?>">
			</div>
		<?php } ?>
		<div class="blog-card__text">
			<div class="blog-card__top">
				<h3 class="h-card blog-card__title"><?= esc_html( $title ) ?></h3>
				<?php if ( $topic || $reading_time ) { ?>
					<div class="blog-card__details">
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
			<?php if ( $excerpt ) { ?>
				<p class="p-lg blog-card__excerpt"><?= esc_html( $excerpt ) ?></p>
			<?php } ?>
		</div>
	</a>
</article>
