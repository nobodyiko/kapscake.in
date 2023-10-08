<?php

class Shortcode_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'shortcode',
			esc_attr__( 'Thim: Shortcode', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add Shortcode', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(

				'title'     => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Title', 'sailing' ),
					'default' => esc_attr__( "Default value", "sailing" )
				),
				'shortcode' => array(
					'type'    => 'textarea',
					'label'   => esc_attr__( 'Shortcode', 'sailing' ),
					'default' => esc_attr__( '', 'sailing' )
				)
			),
			TP_THEME_DIR . 'inc/widgets/shortcode/'
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

function thim_shortcode_register_widget() {
	register_widget( 'Shortcode_Widget' );
}

add_action( 'widgets_init', 'thim_shortcode_register_widget' );