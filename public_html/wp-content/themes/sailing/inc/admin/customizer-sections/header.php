<?php
/**
 * Panel Header
 *
 * @package Sailing
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'header',
		'priority' => 20,
		'title'    => esc_html__( 'Header Settings', 'sailing' )
	)
);