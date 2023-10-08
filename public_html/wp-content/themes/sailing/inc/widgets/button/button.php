<?php

class Thim_Button_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'button',
			esc_html__( 'Thim: Button', 'sailing' ),
			array(
				'description'   => esc_html__( 'Button', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'text'          => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text', 'sailing' ),
					'default' => esc_html__( 'Button Text', 'sailing' )
				),
				'link'          => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Link', 'sailing' ),
					'default' => esc_html__( '#', 'sailing' )
				),
				'link_target'   => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Link Target', 'sailing' ),
					'default' => '_self',
					'options' => array(
						'_blank' => esc_html__( 'New Window', 'sailing' ),
						'_self'  => esc_html__( 'This Window', 'sailing' )
					)
				),
				'image_icon'    => array(
					'type'        => 'media',
					'label'       => esc_attr__( 'Image Icon', 'sailing' ),
					'description' => esc_attr__( 'Select image from media library.', 'sailing' )
				),
				'button_option' => array(
					'type'   => 'section',
					'label'  => esc_html__( 'Custom Style', 'sailing' ),
					'hide'   => true,
					'fields' => array(
						'custom'             => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Custom Style', 'sailing' ),
							'default' => 'no',
							'options' => array(
								'no'  => esc_html__( 'No', 'sailing' ),
								'yes' => esc_html__( 'Yes', 'sailing' )
							)
						),
						'button_color'       => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Button Color', 'sailing' ),
							'default' => '#c19b76'
						),
						'text_color'         => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Text Color', 'sailing' ),
							'default' => '#FFF'
						),
						'button_hover_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Button Hover Color', 'sailing' ),
							'default' => '#c19b76'
						),
						'text_hover_color'   => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Text Hover Color', 'sailing' ),
							'default' => '#FFF'
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/button/'
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

function thim_button_register_widget() {
	register_widget( 'Thim_Button_Widget' );
}

add_action( 'widgets_init', 'thim_button_register_widget' );