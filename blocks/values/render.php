<?php
/**
 * Values block render template.
 *
 * @package Aetherfield
 */

$bg = get_field( 'values_bg' );
$heading_1 = get_field( 'values_heading_1' );
$heading_2 = get_field( 'values_heading_2' );
$items = get_field( 'values_items' );
?>
<section class="section section--values" aria-labelledby="values-title">
	<?php if ( $bg ) { ?>
		<div class="values__bg" aria-hidden="true">
			<img src="<?= esc_url( $bg['url'] ) ?>" alt="">
		</div>
	<?php } ?>
	<div class="section__inner">
		<div class="values__heading">
			<h2 id="values-title" class="h-display-1"><?= esc_html( $heading_1 ) ?></h2>
			<span class="h-display-2"><?= esc_html( $heading_2 ) ?></span>
		</div>
		<?php if ( $items ) { ?>
			<div class="section__content values__grid">
				<?php foreach ( $items as $v ) {
					$v_icon = $v['icon'];
					$v_title = $v['title'];
					$v_description = $v['description'];
					?>
					<article class="value-card">
						<?php if ( $v_icon ) { ?>
							<div class="value-card__icon" aria-hidden="true">
								<img src="<?= esc_url( $v_icon['url'] ) ?>" alt="">
							</div>
						<?php } ?>
						<div class="value-card__content">
							<h3 class="h-card"><?= esc_html( $v_title ) ?></h3>
							<p class="p-lg"><?= esc_html( $v_description ) ?></p>
						</div>
					</article>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>
