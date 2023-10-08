<?php
/**
 * Section Product Sharing
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'woo_share',
	'panel'    => 'woocommerce',
	'title'    => esc_html__( 'Sharing Product', 'sailing' ),
	'priority' => 10,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_sharing_facebook',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Facebook', 'sailing' ),
		'tooltip'  => esc_html__( 'Show the facebook sharing option in product.', 'sailing' ),
		'section'  => 'woo_share',
		'default'  => false,
		'priority' => 11,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_sharing_twitter',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Twitter', 'sailing' ),
		'tooltip'  => esc_html__( 'Show the Twitter sharing option in product.', 'sailing' ),
		'section'  => 'woo_share',
		'default'  => false,
		'priority' => 12,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_sharing_google',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Google', 'sailing' ),
		'tooltip'  => esc_html__( 'Show the Google sharing option in product.', 'sailing' ),
		'section'  => 'woo_share',
		'default'  => false,
		'priority' => 13,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_sharing_pinterest',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Pinterest', 'sailing' ),
		'tooltip'  => esc_html__( 'Show the Pinterest sharing option in product.', 'sailing' ),
		'section'  => 'woo_share',
		'default'  => false,
		'priority' => 14,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);