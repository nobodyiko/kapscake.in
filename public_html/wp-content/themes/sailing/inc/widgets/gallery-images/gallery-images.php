<?php

class Gallery_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'gallery-images',
			esc_attr__( 'Thim: Gallery Images', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add gallery image', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'style' => array(
					"type"          => "select",
					"label"         => esc_attr__( "Style image gallery", "sailing" ),
					"default"       => "base",
					"options"       => array(
						"base"    => esc_attr__( "Gallery Slider", "sailing" ),
						"style_2" => esc_attr__( "Gallery Column", "sailing" )
					),
					"description"   => esc_attr__( "Select style Box image.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),

				'image' => array(
					'type'        => 'multimedia',
					'label'       => esc_attr__( 'Image', 'sailing' ),
					'description' => esc_attr__( 'Select image from media library.', 'sailing' )
				),

				'image_size'    => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Image size', 'sailing' ),
					'description' => esc_attr__( 'Enter image size. Example: "thumbnail", "medium", "large", "full"', 'sailing' )
				),
				'image_link'    => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Image Link', 'sailing' ),
					'description' => esc_attr__( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'sailing' )
				),
				'link_target'   => array(
					"type"    => "select",
					"label"   => esc_attr__( "Link Target", "sailing" ),
					"options" => array(
						"_self"  => esc_attr__( "Same window", "sailing" ),
						"_blank" => esc_attr__( "New window", "sailing" ),
					),
				),
				'text_show'     => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Text show', 'sailing' ),
					'default'       => esc_attr__( " Voted \"Top 100 Hotels in the World 2017\" by Travel & Leisure", "sailing" ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style_2]' => array( 'show' ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/gallery-images/'
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


function thim_gallery_images_widget() {
	register_widget( 'Gallery_Images_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_images_widget' );