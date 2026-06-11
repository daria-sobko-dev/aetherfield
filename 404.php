<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Aetherfield
 */

get_header();

$blog_archive = get_post_type_archive_link( 'blog' );
$job_archive  = get_post_type_archive_link( 'job' );
$about_page   = get_page_by_path( 'about' );
?>

	<main id="primary" class="site-main" tabindex="-1">

		<section class="error-404 not-found">
			<div class="page-top">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'aetherfield' ); ?></h1>
			</div><!-- .page-top -->

			<div class="page-content">
				<p><?php esc_html_e( 'The page may have moved or no longer exists. Try a search, or head back to one of these:', 'aetherfield' ); ?></p>

				<?php get_search_form(); ?>

				<ul class="error-404__links">
					<li><a href="<?= esc_url( home_url( '/' ) ) ?>"><?= esc_html__( 'Home', 'aetherfield' ) ?></a></li>
					<?php if ( $blog_archive ) { ?>
						<li><a href="<?= esc_url( $blog_archive ) ?>"><?= esc_html__( 'Journal', 'aetherfield' ) ?></a></li>
					<?php } ?>
					<?php if ( $about_page ) { ?>
						<li><a href="<?= esc_url( get_permalink( $about_page ) ) ?>"><?= esc_html__( 'About', 'aetherfield' ) ?></a></li>
					<?php } ?>
					<?php if ( $job_archive ) { ?>
						<li><a href="<?= esc_url( $job_archive ) ?>"><?= esc_html__( 'Careers', 'aetherfield' ) ?></a></li>
					<?php } ?>
				</ul>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
