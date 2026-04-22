<?php
/**
 * The template for displaying a single Job.
 *
 * @package Aetherfield
 */

get_header();

while ( have_posts() ) {
	the_post();

	$employment_type = get_field( 'employment_type' );
	$location        = get_field( 'location' );
	$short_desc      = get_field( 'short_description' );
	$apply_link      = get_field( 'apply_link' );
	$archive_url     = get_post_type_archive_link( 'job' );
	$sticker_path    = get_template_directory() . '/assets/images/sticker-careers.svg';
	$sticker_url     = get_template_directory_uri() . '/assets/images/sticker-careers.svg';
	?>

	<main id="primary" class="site-main">

		<section class="section section--job" aria-labelledby="job-title">
			<div class="section__inner job__inner">

				<?php if ( $archive_url ) { ?>
					<a class="job__back" href="<?= esc_url( $archive_url ) ?>">
						<?= esc_html__( '← Back to Careers', 'aetherfield' ) ?>
					</a>
				<?php } ?>

				<article class="job__content">

					<div class="job__top">
						<div class="job__top-text">
							<div class="job__role">
								<h1 id="job-title" class="job__title"><?= esc_html( get_the_title() ) ?></h1>
								<?php if ( $employment_type || $location ) { ?>
									<div class="job__meta">
										<?php if ( $employment_type ) { ?>
											<span><?= esc_html( $employment_type ) ?></span>
										<?php } ?>
										<?php if ( $employment_type && $location ) { ?>
											<span>·</span>
										<?php } ?>
										<?php if ( $location ) { ?>
											<span><?= esc_html( $location ) ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
							<?php if ( $short_desc ) { ?>
								<p class="job__short"><?= esc_html( $short_desc ) ?></p>
							<?php } ?>
						</div>
						<?php if ( $apply_link ) { ?>
							<a class="btn btn--secondary job__apply" href="<?= esc_url( $apply_link['url'] ) ?>"<?= ! empty( $apply_link['target'] ) ? ' target="' . esc_attr( $apply_link['target'] ) . '"' : '' ?>>
								<?= esc_html__( 'Apply now', 'aetherfield' ) ?>
							</a>
						<?php } ?>
					</div>

					<div class="job__divider" aria-hidden="true"></div>

					<div class="job__body cms-rich-text">
						<?php the_content(); ?>
					</div>

					<div class="job__divider" aria-hidden="true"></div>

					<div class="job__cta">
						<?php if ( file_exists( $sticker_path ) ) { ?>
							<div class="job__sticker" aria-hidden="true">
								<img loading="lazy" decoding="async" src="<?= esc_url( $sticker_url ) ?>" alt="">
							</div>
						<?php } ?>
						<h2 class="job__cta-heading">
							<?= esc_html__( 'Ready to help build the future of climate intelligence?', 'aetherfield' ) ?>
						</h2>
						<?php if ( $apply_link ) { ?>
							<a class="btn btn--primary job__cta-button" href="<?= esc_url( $apply_link['url'] ) ?>"<?= ! empty( $apply_link['target'] ) ? ' target="' . esc_attr( $apply_link['target'] ) . '"' : '' ?>>
								<?= esc_html__( 'Apply now', 'aetherfield' ) ?>
							</a>
						<?php } ?>
					</div>

				</article>

			</div>
		</section>

	</main>

	<?php
}

get_footer();
?>
