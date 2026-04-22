<?php
/**
 * Team block render template.
 *
 * @package Aetherfield
 */

defined( 'ABSPATH' ) || exit;

$heading = get_field( 'team_heading' );
$members = get_field( 'team_members' );
?>
<section class="section section--team" aria-labelledby="team-title">
	<div class="section__inner team__inner">
		<?php if ( $heading ) { ?>
			<h2 id="team-title" class="team__title"><?= esc_html( $heading ) ?></h2>
		<?php } ?>
		<?php if ( $members ) { ?>
			<div class="team__table">
				<div class="team__labels" aria-hidden="true">
					<span class="team__label"><?= esc_html__( 'Name', 'aetherfield' ) ?></span>
					<span class="team__label"><?= esc_html__( 'Title', 'aetherfield' ) ?></span>
					<span class="team__label team__label--right"><?= esc_html__( 'Contact', 'aetherfield' ) ?></span>
				</div>
				<ul class="team__list">
					<?php foreach ( $members as $m ) {
						$m_name = $m['name'];
						$m_title = $m['title'];
						$m_email = $m['email'];
						?>
						<li class="team-row">
							<span class="team-row__name"><?= esc_html( $m_name ) ?></span>
							<span class="team-row__title"><?= esc_html( $m_title ) ?></span>
							<?php if ( $m_email ) { ?>
								<a class="team-row__email" href="mailto:<?= esc_attr( $m_email ) ?>"><?= esc_html( $m_email ) ?></a>
							<?php } else { ?>
								<span class="team-row__email"></span>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</section>
