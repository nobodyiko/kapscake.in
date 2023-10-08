<?php

class Tour_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'tour',
			esc_attr__( 'Thim: Tours Slider', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add Tour Slider', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'tours'       => array(
					'type'      => 'repeater',
					'label'     => esc_attr__( 'Tours', 'sailing' ),
					'item_name' => esc_attr__( 'Tours', 'sailing' ),
					'fields'    => array(
						'image'     => array(
							'type'        => 'media',
							'label'       => esc_attr__( 'Image', 'sailing' ),
							'description' => esc_attr__( 'Select image from media library.', 'sailing' )
						),
						'name'      => array(
							"type"    => "text",
							"label"   => esc_attr__( "Name", "sailing" ),
							"default" => "Name Default",
						),
						'link'      => array(
							"type"    => "text",
							"label"   => esc_attr__( "Link", "sailing" ),
							"default" => "#",
						),
						'info_sale' => array(
							"type"    => "text",
							"label"   => esc_attr__( "Info Sale", "sailing" ),
							"default" => "40% Off",
						),
						'price'     => array(
							"type"        => "text",
							"label"       => esc_attr__( "Price", "sailing" ),
							"description" => esc_attr__( "Price and Currency symbol per night", "sailing" ),
							"default"     => "$300",
						),
					),
				),
				'number_show' => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Number of items', 'sailing' ),
					'default' => '3'
				),
			),
			TP_THEME_DIR . 'inc/widgets/tour/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_tours_register_widget() {
	register_widget( 'Tour_Widget' );
}

add_action( 'widgets_init', 'thim_tours_register_widget' );