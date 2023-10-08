<?php
/**
 * Panel Event
 * 
 * @package Sailing
 */

thim_customizer()->add_panel(
    array(
        'id'       => 'event',
        'priority' => 45,
        'title'    => esc_html__( 'Events', 'sailing' ),
        'icon'     => 'dashicons-calendar',
    )
);