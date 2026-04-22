<?php
/**
 * CTA block render template.
 *
 * @package Aetherfield
 */

get_template_part( 'template-parts/cta', null, array(
	'title'   => get_field( 'cta_title' ),
	'form_id' => get_field( 'cta_form' ),
	'button'  => get_field( 'cta_button' ),
) );
