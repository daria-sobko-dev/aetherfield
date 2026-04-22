<?php
/**
 * The template for displaying the Blog archive.
 *
 * @package Aetherfield
 */

$hero_image  = get_field( 'blog_archive_hero_image', 'option' );
$cta_title   = get_field( 'blog_archive_cta_title', 'option' );
$cta_form    = get_field( 'blog_archive_cta_form', 'option' );
$cta_button  = get_field( 'blog_archive_cta_button', 'option' );

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( $hero_image ) { ?>
			<section class="section section--blog-hero" aria-hidden="true">
				<div class="section__inner blog-hero__inner">
					<div class="blog-hero__image">
						<img src="<?= esc_url( $hero_image['url'] ) ?>" alt="<?= esc_attr( $hero_image['alt'] ) ?>">
					</div>
				</div>
			</section>
		<?php } ?>

		<section class="section section--blog-archive" aria-labelledby="blog-archive-title">
			<div class="section__inner">
				<h1 id="blog-archive-title" class="h-section blog-archive__title">
					<?= esc_html__( 'Latest articles', 'aetherfield' ) ?>
				</h1>
				<?php if ( have_posts() ) { ?>
					<div class="blog-grid">
						<?php while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/blog/card', 'large' );
						} ?>
					</div>
					<?php
					the_posts_pagination( array(
						'mid_size'  => 1,
						'prev_text' => __( 'Previous', 'aetherfield' ),
						'next_text' => __( 'Next', 'aetherfield' ),
					) );
					?>
				<?php } else { ?>
					<p><?= esc_html__( 'No articles yet.', 'aetherfield' ) ?></p>
				<?php } ?>
			</div>
		</section>

		<?php get_template_part( 'template-parts/cta', null, array(
			'title'    => $cta_title,
			'form_id'  => $cta_form,
			'button'   => $cta_button,
			'title_id' => 'blog-archive-cta-title',
		) ); ?>

	</main>

<?php get_footer(); ?>
