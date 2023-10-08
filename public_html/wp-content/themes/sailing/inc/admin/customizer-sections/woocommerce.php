<?php
/**
 * Panel Woocommerce
 *
 * @package mag-wp
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'woocommerce',
		'title'    => esc_html__( 'WooCommerce', 'sailing' ),
		'priority' => 40
	)
);