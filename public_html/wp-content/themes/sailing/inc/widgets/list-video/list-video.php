<?php

class Thim_List_Video_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'list-video',
			esc_html__( 'Thim: List Video', 'sailing' ),
			array(
				'description'   => esc_html__( 'List video player widget.', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'style'          => array(
					"type"          => "select",
					"label"         => esc_html__( "Layout Video", "sailing" ),
					"default"       => "base",
					"options"       => array(
						"base"    => esc_html__( "Style Default", "sailing" ),
						"style-1" => esc_html__( "Style 1", "sailing" ),
						"style-2" => esc_html__( "Style 2", "sailing" ),
					),
					"description"   => esc_html__( "Select layout video.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),
				'bg_image' => array(
					'type'        => 'media',
					'label'       => esc_html__( 'Image', 'sailing' ),
					'description' => esc_html__( 'Select image from media library.', 'sailing' ),
				),
				'bg_title'   => array(
					"type"    => "text",
					"label"   => esc_html__( "Background Title", "sailing" ),
					"default" => esc_html__( 'Amazing Video', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'show' ),
						'style[style-2]' => array( 'hide' ),
					),
				),
				'video_title'   => array(
					"type"    => "text",
					"label"   => esc_html__( " Title", "sailing" ),
					"default" => esc_html__( 'Video rooms', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'show' ),
						'style[style-2]' => array( 'show' ),
					),
				),

				'video_text_link'   => array(
					"type"    => "text",
					"label"   => esc_html__( "Text Link", "sailing" ),
					"default" => esc_html__( 'All video room', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'hide' ),
						'style[style-2]' => array( 'show' ),
					),
				),
				'video_link'   => array(
					"type"    => "text",
					"label"   => esc_html__( " Link", "sailing" ),
					"default" => esc_html__( '#', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'hide' ),
						'style[style-2]' => array( 'show' ),
					),
				),

				'list-video' => array(
					'type'      => 'repeater',
					'label'     => esc_html__( 'Text', 'sailing' ),
					'item_name' => esc_html__( 'Text', 'sailing' ),
					'fields'    => array(	
						'title'   => array(
							"type"    => "text",
							"label"   => esc_html__( " Title", "sailing" ),
							"default" => esc_html__( 'Video Tour', 'sailing' ),
						),
						'description'   => array(
							"type"    => "textarea",
							"label"   => esc_html__( "Content", "sailing" ),
							"default" => esc_html__( 'Duis aute irure dolor ', 'sailing' ),
						),
						'text_link'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Text Link", "sailing" ),
							"default" => esc_html__( 'Play now', 'sailing' ),
						),
						'link'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Link", "sailing" ),
							"default" => esc_html__( '#', 'sailing' ),
						),
					),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style-1]' => array( 'hide' ),
						'style[style-2]' => array( 'hide' ),
					),
				),
				'list-video2' => array(
					'type'      => 'repeater',
					'label'     => esc_html__( 'Text', 'sailing' ),
					'item_name' => esc_html__( 'Text', 'sailing' ),
					'fields'    => array(	
						'image_2' => array(
							'type'        => 'media',
							'label'       => esc_html__( 'Image Video', 'sailing' ),
							'description' => esc_html__( 'Select image from media library.', 'sailing' )
						),
						
						'image_size'          => array(
							"type"          => "select",
							"label"         => esc_html__( "Layout Video", "sailing" ),
							"default"       => "500x255",
							"options"       => array(
								"500x255"    => esc_html__( "500 x  255", "sailing" ),
								"650x340" => esc_html__( "650 x 340", "sailing" ),
								"600x310" => esc_html__( "600 x 310", "sailing" ),
							),
						),
						
						'link_2'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Link", "sailing" ),
							"default" => esc_html__( '#', 'sailing' ),
						),
					),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'show' ),
						'style[style-2]' => array( 'hide' ),
					),
				),
				'list-video3' => array(
					'type'      => 'repeater',
					'label'     => esc_html__( 'Text', 'sailing' ),
					'item_name' => esc_html__( 'Text', 'sailing' ),
					'fields'    => array(	
						'image_3' => array(
							'type'        => 'media',
							'label'       => esc_html__( 'Image Video', 'sailing' ),
							'description' => esc_html__( 'Select image from media library.', 'sailing' )
						),
						
						'image_size3'          => array(
							"type"          => "select",
							"label"         => esc_html__( "Layout Video", "sailing" ),
							"default"       => "400x230",
							"options"       => array(
								"400x230"    => esc_html__( "400 x  230", "sailing" ),
								"490x280" => esc_html__( "490 x 280", "sailing" ),
								"660x380" => esc_html__( "680 x 380", "sailing" ),
							),
						),
						
						'link_3'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Link", "sailing" ),
							"default" => esc_html__( '#', 'sailing' ),
						),
					),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[style-1]' => array( 'hide' ),
						'style[style-2]' => array( 'show' ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/list-video/'
		);
	}

	function get_template_name( $instance ) {
		return isset( $instance['style'] ) ? $instance['style'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_list_video_register_widget() {
	register_widget( 'Thim_List_Video_Widget' );
}

add_action( 'widgets_init', 'thim_list_video_register_widget' );