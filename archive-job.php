<?php
/**
 * The template for displaying the Careers archive.
 *
 * @package Aetherfield
 */

get_header();

$heading_1   = get_field( 'careers_heading_1', 'option' ) ?: __( 'Careers at', 'aetherfield' );
$heading_2   = get_field( 'careers_heading_2', 'option' ) ?: __( 'Aetherfield', 'aetherfield' );
$open_title  = get_field( 'careers_open_title', 'option' );
$open_meta   = get_field( 'careers_open_meta', 'option' );
$open_desc   = get_field( 'careers_open_description', 'option' );
$open_button = get_field( 'careers_open_button', 'option' );
?>

	<main id="primary" class="site-main">

		<section class="section section--careers" aria-labelledby="careers-title">
			<div class="section__inner careers__inner">

				<h1 id="careers-title" class="careers__title">
					<span class="h-display-1 careers__title-line"><?= esc_html( $heading_1 ) ?></span>
					<span class="h-display-2 careers__title-line"><?= esc_html( $heading_2 ) ?></span>
				</h1>

				<div class="careers__list">

					<?php if ( have_posts() ) { ?>
						<div class="careers__grid">
							<?php while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/careers/card' );
							} ?>
						</div>
					<?php } ?>

					<?php if ( $open_title || $open_desc ) { ?>
						<aside class="open-application" aria-label="<?= esc_attr__( 'Open application', 'aetherfield' ) ?>">
							<div class="open-application__text">
								<div class="open-application__top">
									<?php if ( $open_title ) { ?>
										<h2 class="open-application__title"><?= esc_html( $open_title ) ?></h2>
									<?php } ?>
									<?php if ( $open_meta ) { ?>
										<p class="open-application__meta"><?= esc_html( $open_meta ) ?></p>
									<?php } ?>
								</div>
								<?php if ( $open_desc ) { ?>
									<p class="open-application__description"><?= esc_html( $open_desc ) ?></p>
								<?php } ?>
							</div>
							<?php if ( $open_button ) { ?>
								<a class="btn btn--secondary open-application__button" href="<?= esc_url( $open_button['url'] ) ?>"<?= ! empty( $open_button['target'] ) ? ' target="' . esc_attr( $open_button['target'] ) . '"' : '' ?>>
									<?= esc_html( $open_button['title'] ) ?>
								</a>
							<?php } ?>
						</aside>
					<?php } ?>

				</div>

			</div>
		</section>

	</main>

<?php get_footer(); ?>
