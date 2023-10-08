<?php
 class Info_Sale_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'info-sale',
			esc_html__( 'Thim: Info Sale', 'sailing' ),
			array(
				'description' => esc_html__( 'Add info sale', 'sailing' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'style'         => array(
					"type"          => "select",
					"label"         => esc_attr__( "Style testimonial", "sailing" ),
					"default"       => "base",
					"options"       => array(
						"base"    => esc_attr__( "Default Style", "sailing" ),
						"style-1" => esc_attr__( "Style 1", "sailing" ),
						
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),
				'bg_image' => array(
					'type'        => 'media',
					'label'       => esc_html__( 'Background Image', 'sailing' ),
					'description' => esc_html__( 'Select image from media library.', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'show' ),
					),
				),
				'info-sale' => array(
					'type'      => 'repeater',
					'label'     => esc_html__( 'Text', 'sailing' ),
					'item_name' => esc_html__( 'Text', 'sailing' ),
					'fields'    => array(
						'image' => array(
							'type'        => 'media',
							'label'       => esc_html__( 'Image', 'sailing' ),
							'description' => esc_html__( 'Select image from media library.', 'sailing' )
						),
						'primary_title'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Primary Title", "sailing" ),
							"default" => esc_html__( 'Savings', 'sailing' ),
						),
						'second_title'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Second Title", "sailing" ),
							"default" => esc_html__( 'Red Hot Summer', 'sailing' ),
						),
						'short_content'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Short Content", "sailing" ),
							"default" => esc_html__( 'Red Hot Summer', 'sailing' ),
						),
						'text_link'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Text Link", "sailing" ),
							"default" => esc_html__( 'Learn more', 'sailing' ),
						),
						'link'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Link", "sailing" ),
							"default" => esc_html__( '#', 'sailing' ),
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/info-sale/'
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


function thim_info_sale_register_widget() {
	register_widget( 'Info_Sale_Widget' );
}

add_action( 'widgets_init', 'thim_info_sale_register_widget' );