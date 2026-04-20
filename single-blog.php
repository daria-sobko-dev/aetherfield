<?php
/**
 * The template for displaying a single Blog post.
 *
 * @package Aetherfield
 */

get_header();

while ( have_posts() ) {
	the_post();

	$hero_image   = get_field( 'hero_image' );
	$intro_text   = get_field( 'intro_text' );
	$reading_time = aetherfield_reading_time();
	$topics       = get_the_terms( get_the_ID(), 'blog_topic' );
	$topic        = ( ! is_wp_error( $topics ) && ! empty( $topics ) ) ? $topics[0]->name : '';
	$published    = get_the_date();
	$author       = get_the_author();
	?>

	<main id="primary" class="site-main">

		<header class="section section--article-header" aria-labelledby="article-title">
			<div class="section__inner article-header__inner">
				<?php if ( $topic || $reading_time ) { ?>
					<div class="article-header__meta">
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
				<h1 id="article-title" class="h-display-2 article-header__title"><?= esc_html( get_the_title() ) ?></h1>
			</div>
		</header>

		<?php if ( $hero_image ) { ?>
			<section class="section section--article-hero" aria-hidden="true">
				<div class="section__inner article-hero__inner">
					<div class="article-hero__image">
						<img src="<?= esc_url( $hero_image['url'] ) ?>" alt="<?= esc_attr( $hero_image['alt'] ) ?>">
					</div>
				</div>
			</section>
		<?php } ?>

		<section class="section section--article-intro">
			<div class="section__inner article-intro__inner">
				<aside class="article-intro__meta">
					<ul class="article-meta-block">
						<li class="article-meta-block__label"><?= esc_html__( 'Published', 'aetherfield' ) ?></li>
						<li class="article-meta-block__value"><?= esc_html( $published ) ?></li>
					</ul>
					<ul class="article-meta-block">
						<li class="article-meta-block__label"><?= esc_html__( 'Author', 'aetherfield' ) ?></li>
						<li class="article-meta-block__value"><?= esc_html( $author ) ?></li>
					</ul>
				</aside>
				<div class="article-intro__content">
					<?php if ( $intro_text ) { ?>
						<p class="p-lg article-intro__text"><?= esc_html( $intro_text ) ?></p>
					<?php } ?>
					<div class="article-intro__divider" aria-hidden="true"></div>
				</div>
			</div>
		</section>

		<section class="section section--article-body">
			<div class="section__inner article-body__inner">
				<div class="article-body cms-rich-text">
					<?php the_content(); ?>
				</div>
			</div>
		</section>

		<?php
		$related = new WP_Query( array(
			'post_type'      => 'blog',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		if ( $related->have_posts() ) {
			?>
			<section class="section section--related" aria-labelledby="related-title">
				<div class="section__inner related__inner">
					<div class="related__header">
						<h2 id="related-title" class="h-display-2 related__title">
							<?= esc_html__( 'Recent articles', 'aetherfield' ) ?>
						</h2>
						<a class="related__link" href="<?= esc_url( get_post_type_archive_link( 'blog' ) ) ?>">
							<?= esc_html__( 'View all articles', 'aetherfield' ) ?>
						</a>
					</div>
					<div class="related__grid">
						<?php while ( $related->have_posts() ) {
							$related->the_post();
							get_template_part( 'template-parts/blog/card', 'medium' );
						} ?>
					</div>
				</div>
			</section>
			<?php
			wp_reset_postdata();
		}
		?>

	</main>

	<?php
}

get_footer();
?>
