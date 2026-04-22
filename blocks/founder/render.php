<?php
/**
 * Founder block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$image = get_field( 'founder_image' );
$caption = get_field( 'founder_caption' );
$name = get_field( 'founder_name' );
$bio = get_field( 'founder_bio' );
$sticker_path = get_template_directory() . '/blocks/founder/sticker.svg';
$sticker_url = get_template_directory_uri() . '/blocks/founder/sticker.svg';
?>
<section class="section section--founder" aria-labelledby="founder-title">
	<div class="section__inner founder__inner">
		<?php if ( file_exists( $sticker_path ) ) { ?>
			<div class="founder__sticker" aria-hidden="true">
				<img loading="lazy" decoding="async" src="<?= esc_url( $sticker_url ) ?>" alt="">
			</div>
		<?php } ?>
		<?php if ( $image ) { ?>
			<div class="founder__image">
				<img loading="lazy" decoding="async" src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
			</div>
		<?php } ?>
		<div class="founder__quote">
			<div class="founder__title">
				<?php if ( $caption ) { ?>
					<p class="p-lg founder__caption"><?= esc_html( $caption ) ?></p>
				<?php } ?>
				<?php if ( $name ) { ?>
					<h2 id="founder-title" class="founder__name"><?= esc_html( $name ) ?></h2>
				<?php } ?>
			</div>
			<?php if ( $bio ) { ?>
				<p class="p-lg founder__bio"><?= esc_html( $bio ) ?></p>
			<?php } ?>
		</div>
	</div>
</section>
