<?php
/**
 * Panel Footer
 *
 * @package Sailing
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'footer',
		'priority' => 50,
		'title'    => esc_html__( 'Footer Setting', 'sailing' )
	)
);
