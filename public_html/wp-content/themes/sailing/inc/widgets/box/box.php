<?php

class Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'box',
			esc_attr__( 'Thim: Box Image', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add image to box', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'style' => array(
					"type"          => "select",
					"label"         => esc_attr__( "Style box image", "sailing" ),
					"default"       => "default",
					"options"       => array(
						"base"    => esc_attr__( "Style Two Image", "sailing" ),
						"style_2" => esc_attr__( "Style One Image", "sailing" )
					),
					"description"   => esc_attr__( "Select style Box image.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),

				'image_left'       => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Image Left', 'sailing' ),
					'description'   => esc_attr__( 'Select image from media library.', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style_2]' => array( 'hide' ),
					),
				),
				'image_right'      => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Image Right', 'sailing' ),
					'description'   => esc_attr__( 'Select image from media library.', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style_2]' => array( 'hide' ),
					),
				),
				'image_icon'       => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Image Icon', 'sailing' ),
					'description'   => esc_attr__( 'Select image from media library.', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style_2]' => array( 'show' ),
					),
				),
				'small_title'      => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Small Text Box Image', 'sailing' ),
					'default'       => esc_attr__( "Default value", "sailing" ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style_2]' => array( 'show' ),
					),
				),
				'title'            => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Heading Text Box Image', 'sailing' ),
					'default'       => esc_attr__( "Default value", "sailing" ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style_2]' => array( 'show' ),
					),
				),
				'image_background' => array(
					'type'        => 'media',
					'label'       => esc_attr__( 'Image Background', 'sailing' ),
					'description' => esc_attr__( 'Select image from media library.', 'sailing' ),
				),
				'image_size'         => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Image size', 'sailing' ),
					'description'    => esc_attr__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'sailing' )
				),
				'image_link'         => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Image Link', 'sailing' ),
					'description'    => esc_attr__( 'Enter URL if you want this image to have a link.', 'sailing' )
				),
				'link_target'       => array(
					'type'    	=> 'select',
					'label'   	=> esc_attr__( "Link Target", 'sailing' ),
					'options' 	=> array(
						'_self'              => esc_attr__( 'Same window', 'sailing' ),
						'_blank' => esc_attr__( 'New window', 'sailing' ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/box/'
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

function thim_box_register_widget() {
	register_widget( 'Box_Widget' );
}

add_action( 'widgets_init', 'thim_box_register_widget' );