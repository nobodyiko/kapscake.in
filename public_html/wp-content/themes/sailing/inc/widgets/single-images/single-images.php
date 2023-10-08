<?php

class Single_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'single-images',
			esc_attr__( 'Thim: Single Images', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add heading text', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'image' => array(
					'type'        => 'media',
					'label'       => esc_attr__( 'Image', 'sailing' ),
					'description' => esc_attr__( 'Select image from media library.', 'sailing' )
				),

				'image_size'      => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Image size', 'sailing' ),
					'description' => esc_attr__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'sailing' )
				),
				'image_link'      => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Image Link', 'sailing' ),
					'description' => esc_attr__( 'Enter URL if you want this image to have a link.', 'sailing' )
				),
				'link_target'     => array(
					'type'    => 'select',
					'label'   => esc_attr__( "Link Target", 'sailing' ),
					'options' => array(
						'_self'  => esc_attr__( 'Same window', 'sailing' ),
						'_blank' => esc_attr__( 'New window', 'sailing' ),
					),
				),
				'image_alignment' => array(
					'type'        => 'select',
					'label'       => esc_attr__( 'Image alignment', 'sailing' ),
					'description' => 'Select image alignment.',
					'options'     => array(
						'left'   => esc_attr__( 'Align Left', 'sailing' ),
						'right'  => esc_attr__( 'Align Right', 'sailing' ),
						'center' => esc_attr__( 'Align Center', 'sailing' )
					),
				),
				'css_animation'   => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'CSS Animation', 'sailing' ),
					'options' => array(
						''              => esc_attr__( 'No', 'sailing' ),
						'top-to-bottom' => esc_attr__( 'Top to bottom', 'sailing' ),
						'bottom-to-top' => esc_attr__( 'Bottom to top', 'sailing' ),
						'left-to-right' => esc_attr__( 'Left to right', 'sailing' ),
						'right-to-left' => esc_attr__( 'Right to left', 'sailing' ),
						'appear'        => esc_attr__( 'Appear from center', 'sailing' )
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/single-images/'
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

function thim_single_images_register_widget() {
	register_widget( 'Single_Images_Widget' );
}

add_action( 'widgets_init', 'thim_single_images_register_widget' );