<?php

class Thim_Mini_Cart_Room_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'mini-cart-room',
			esc_attr__( 'Thim: Mini Cart Room', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Show mini cart room widget', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),

			),
			array(),
			array(
				'title'        => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Title', 'sailing' ),
					'default' => esc_attr__( 'Your Book', 'sailing' )
				),
			),
			TP_THEME_DIR . 'inc/widgets/mini-cart-room/'
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

function thim_mini_cart_room_register_widget() {
	register_widget( 'Thim_Mini_Cart_Room_Widget' );
}

add_action( 'widgets_init', 'thim_mini_cart_room_register_widget' );