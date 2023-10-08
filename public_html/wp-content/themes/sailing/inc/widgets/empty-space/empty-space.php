<?php
class Empty_Space_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'empty-space',
			__( 'Thim: Empty Space', 'sailing' ),
			array(
				'description' => esc_attr__( 'Add space width custom height', 'sailing' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'height' => array(
					'type'  => 'number',
					'label' => esc_attr__( 'Height', 'sailing' ),
					'default'=>'30',
					'desc'  => esc_attr__( "Enter empty space height.", "sailing" ),
					'suffix'     => 'px',
				)
  			),
			TP_THEME_DIR . 'inc/widgets/empty-space/'
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
function thim_empty_space_register_widget() {
	register_widget( 'Empty_Space_Widget' );
}

add_action( 'widgets_init', 'thim_empty_space_register_widget' );