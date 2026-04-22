<?php
/**
 * Mission block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$image_desktop = get_field( 'mission_image_desktop' );
$image_tablet = get_field( 'mission_image_tablet' );
$image_mobile = get_field( 'mission_image_mobile' );
$caption = get_field( 'mission_caption' );
$heading = get_field( 'mission_heading' );
$button = get_field( 'mission_button' );

$image_tablet_url = $image_tablet ? $image_tablet['url'] : ( $image_desktop ? $image_desktop['url'] : '' );
$image_mobile_url = $image_mobile ? $image_mobile['url'] : $image_tablet_url;
?>
<section class="section section--mission" aria-labelledby="mission-title">
	<div class="section__inner mission__inner">
		<?php if ( $image_desktop ) { ?>
			<div class="mission__image">
				<picture>
					<source media="(max-width: 768px)" srcset="<?= esc_url( $image_mobile_url ) ?>">
					<source media="(max-width: 1024px)" srcset="<?= esc_url( $image_tablet_url ) ?>">
					<img decoding="async" fetchpriority="high" src="<?= esc_url( $image_desktop['url'] ) ?>" alt="<?= esc_attr( $image_desktop['alt'] ) ?>">
				</picture>
			</div>
		<?php } ?>
		<div class="mission__content">
			<div class="mission__paragraph">
				<?php if ( $caption ) { ?>
					<p class="p-lg mission__caption"><?= esc_html( $caption ) ?></p>
				<?php } ?>
				<?php if ( $heading ) { ?>
					<h1 id="mission-title" class="h-section mission__heading"><?= esc_html( $heading ) ?></h1>
				<?php } ?>
			</div>
			<?php if ( $button ) { ?>
				<div class="mission__buttons">
					<a class="btn btn--primary mission__button" href="<?= esc_url( $button['url'] ) ?>"<?= ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '"' : '' ?>><?= esc_html( $button['title'] ) ?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
