<?php
/**
 * Career item card for the archive.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$title           = get_the_title();
$employment_type = get_field( 'employment_type' );
$location        = get_field( 'location' );
$short_desc      = get_field( 'short_description' );
?>
<article class="career-card">
	<div class="career-card__text">
		<div class="career-card__top">
			<h2 class="career-card__title"><?= esc_html( $title ) ?></h2>
			<?php if ( $employment_type || $location ) { ?>
				<div class="career-card__meta">
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
			<p class="career-card__description"><?= esc_html( $short_desc ) ?></p>
		<?php } ?>
	</div>
	<a class="btn btn--secondary career-card__button" href="<?= esc_url( get_permalink() ) ?>">
		<?= esc_html__( 'View role', 'aetherfield' ) ?>
	</a>
</article>
