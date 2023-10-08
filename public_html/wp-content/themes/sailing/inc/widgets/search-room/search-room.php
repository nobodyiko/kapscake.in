<?php

class Thim_Search_Room_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'search-room',
			esc_attr__( 'Thim: Search Room', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Show search room widget', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),

			),
			array(),
			array(
				'style'            => array(
					"type"          => "select",
					"label"         => esc_attr__( "Style Search Form", "sailing" ),
					"default"       => "base",
					"options"       => array(
						"base"    => esc_attr__( "Style Old", "sailing" ),
						"default" => esc_attr__( "Style New", "sailing" )
					),
					"description"   => esc_attr__( "Select style search form.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),
				'title'            => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Title', 'sailing' ),
					'default'       => esc_attr__( 'Your Reservation', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
					),
				),
				'background_color' => array(
					'type'          => 'color',
					'label'         => esc_attr__( 'Background color', 'sailing' ),
					'default'       => '#2eb0d1',
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
					),
				),
				'background_image' => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Background Image', 'sailing' ),
					'description'   => esc_attr__( 'Select background image for widget', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
					),
				),

				'show_child' => array(
					'type'          => 'checkbox',
					'label'         => esc_attr__( 'Show Child On Search New Demo 8', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[default]' => array( 'show' ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/search-room/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return isset( $instance['style'] ) ? $instance['style'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_search_room_register_widget() {
	register_widget( 'Thim_Search_Room_Widget' );
}

add_action( 'widgets_init', 'thim_search_room_register_widget' );