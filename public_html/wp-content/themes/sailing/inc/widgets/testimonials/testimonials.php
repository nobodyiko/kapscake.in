<?php
if ( class_exists( 'THIM_Testimonials' ) ) {
	class Testimonials_Widget extends Thim_Widget {
		function __construct() {
			parent::__construct(
				'testimonials',
				esc_attr__( 'Thim: Testimonials', 'sailing' ),
				array(
					'description'   => esc_attr__( 'Testimonial ThimPress.', 'sailing' ),
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' ),
					'panels_icon'   => 'dashicons dashicons-welcome-learn-more'
				),
				array(),
				array(
					'style'         => array(
						"type"          => "select",
						"label"         => esc_attr__( "Style testimonial", "sailing" ),
						"default"       => "base",
						"options"       => array(
							"base"    => esc_attr__( "Style Old", "sailing" ),
							"default" => esc_attr__( "Style New", "sailing" ),
							"style-1" => esc_attr__( "Style 1", "sailing" ),
							"style-2" => esc_attr__( "Style 2", "sailing" ),
							"style-3" => esc_attr__( "Style 3", "sailing" ),
							"style-4" => esc_attr__( "Style 4", "sailing" )
						),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array( 'style' )
						)
					),
					'title' => array(
						'type'                  => 'text',
						'label'                 => esc_attr__( 'Heading Text', 'sailing' ),
						'default'               => esc_attr__( 'Testimonials', 'sailing' ),
						'allow_html_formatting' => true,
						'state_handler' => array(
							'style[base]'    => array( 'show' ),
							'style[default]' => array( 'hide' ),
							'style[style-1]' => array( 'show' ),
							'style[style-2]' => array( 'show' ),
							'style[style-3]' => array( 'hide' ),
							'style[style-4]' => array( 'show' ),
						),
					),

					'des' => array(
						'type'                  => 'textarea',
						'label'                 => esc_attr__( 'Description ', 'sailing' ),
						'default'               => esc_attr__( 'Lorem ipsum dolor sit amet', 'sailing' ),
						'allow_html_formatting' => true,
						'state_handler' => array(
							'style[base]'    => array( 'hide' ),
							'style[default]' => array( 'hide' ),
							'style[style-1]' => array( 'show' ),
							'style[style-2]' => array( 'hide' ),
							'style[style-3]' => array( 'hide' ),
							'style[style-4]' => array( 'hide' ),
						),
					),
					'bg_title' => array(
						'type'                  => 'textarea',
						'label'                 => esc_attr__( 'Background Title ', 'sailing' ),
						'default'               => esc_attr__( 'testimonial', 'sailing' ),
						'allow_html_formatting' => true,
						'state_handler' => array(
							'style[base]'    => array( 'hide' ),
							'style[default]' => array( 'hide' ),
							'style[style-1]' => array( 'hide' ),
							'style[style-2]' => array( 'hide' ),
							'style[style-3]' => array( 'show' ),
							'style[style-4]' => array( 'hide' ),
						),
					),
					'number' => array(
						'type'    => 'number',
						'label'   => esc_attr__( 'Number Posts', 'sailing' ),
						'default' => '4',
					),
					'number_column' => array(
						'type'    => 'number',
						'label'   => esc_attr__( 'Number Colums', 'sailing' ),
						'default' => '1',
						'state_handler' => array(
							'style[base]'    => array( 'show' ),
							'style[default]' => array( 'show' ),
							'style[style-1]' => array( 'show' ),
							'style[style-2]' => array( 'hide' ),
							'style[style-3]' => array( 'show' ),
							'style[style-4]' => array( 'show' ),
						),
						
					),
					'time'   => array(
						'type'    => 'number',
						'label'   => esc_attr__( 'Autoplay Timeout', 'sailing' ),
						'default' => '10000',
						'state_handler' => array(
							'style[base]'    => array( 'show' ),
							'style[default]' => array( 'show' ),
							'style[style-1]' => array( 'show' ),
							'style[style-2]' => array( 'hide' ),
							'style[style-3]' => array( 'show' ),
							'style[style-4]' => array( 'show' ),
						),
					),

				),
				TP_THEME_DIR . 'inc/widgets/testimonials/'
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

	function thim_testimonials_register_widget() {
		register_widget( 'Testimonials_Widget' );
	}

	add_action( 'widgets_init', 'thim_testimonials_register_widget' );
}