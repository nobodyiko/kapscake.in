<?php
/**
 * Panel Hotel Booking
 *
 * @package Sailing
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'hotel-booking',
		'title'    => esc_html__( 'Hotel Booking', 'sailing' ),
		'priority' => 30
	)
);