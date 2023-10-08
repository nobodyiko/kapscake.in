<?php

class Thim_Main_Slider_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'main-slider',
			esc_html__( 'Thim: Main SLider', 'sailing' ),
			array(
				'description'   => esc_html__( 'Show main slider widget.', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'background_img' => array(
					'type'          => 'multimedia',
					'label'         => esc_html__( 'Select background image', 'sailing' ),
					'default'       => '',
					'library'       => 'image',
				),
				'title'          => array(
					'type'  => 'textarea',
					'label' => esc_html__( 'Title', 'sailing' ),
					'allow_html_formatting' => true,
				),
				'desc'           => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Description', 'sailing' ),
				),
				'text_link'           => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Text Link', 'sailing' ),
					'default'       => esc_html__('Explorer','sailing')
				),
				'link'           => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Link', 'sailing' ),
					'default'       => '#',
				),
				'enable_autoplay'           => array(
					'type'          => 'checkbox',
					'label'         => esc_html__( 'Auto Play', 'sailing' ),
				),

				'autoplay_speed'           => array(
					'type'          => 'number',
					'label'         => esc_html__( ' Auto Speed', 'sailing' ),
					'default'       => 3000,
				),
			)
		);
	}

	function get_template_name( $instance ) {
		return isset( $instance['style'] ) ? $instance['style'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_main_slider_register_widget() {
	register_widget( 'Thim_Main_Slider_Widget' );
}

add_action( 'widgets_init', 'thim_main_slider_register_widget' );