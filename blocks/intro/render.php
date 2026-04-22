<?php
/**
 * Intro block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$heading_1 = get_field( 'intro_heading_1' );
$heading_2 = get_field( 'intro_heading_2' );
$subheading = get_field( 'intro_subheading' );
$button_1 = get_field( 'intro_button_1' );
$button_2 = get_field( 'intro_button_2' );
$image = get_field( 'intro_image' );
?>
<section class="section section--intro" aria-labelledby="intro-title">
	<div class="section__inner">
		<div class="intro__content">
			<div class="intro__top">
				<div class="intro__heading">
					<h1 id="intro-title" class="h-display-1"><?= esc_html( $heading_1 ) ?></h1>
					<span class="h-display-2"><?= esc_html( $heading_2 ) ?></span>
				</div>
				<p class="p-lg intro__subheading">
					<?= esc_html( $subheading ) ?>
				</p>
			</div>
			<div class="intro__buttons">
				<?php if ( $button_1 ) { ?>
					<a class="btn btn--primary" href="<?= esc_url( $button_1['url'] ) ?>"<?= ! empty( $button_1['target'] ) ? ' target="' . esc_attr( $button_1['target'] ) . '"' : '' ?>><?= esc_html( $button_1['title'] ) ?></a>
				<?php } ?>
				<?php if ( $button_2 ) { ?>
					<a class="btn btn--primary" href="<?= esc_url( $button_2['url'] ) ?>"<?= ! empty( $button_2['target'] ) ? ' target="' . esc_attr( $button_2['target'] ) . '"' : '' ?>><?= esc_html( $button_2['title'] ) ?></a>
				<?php } ?>
			</div>
		</div>
		<?php if ( $image ) { ?>
			<div class="intro__image">
				<img decoding="async" fetchpriority="high" src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
			</div>
		<?php } ?>
	</div>
</section>
