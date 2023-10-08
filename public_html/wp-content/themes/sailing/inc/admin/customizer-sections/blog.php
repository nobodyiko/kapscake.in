<?php
/**
 * Panel Blog
 *
 * @package Sailing
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'blog',
		'priority' => 25,
		'title'    => esc_html__( 'Blog Setting', 'sailing' )
	)
);