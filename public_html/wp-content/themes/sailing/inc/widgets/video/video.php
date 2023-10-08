<?php

class Thim_Video_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'video',
			esc_attr__( 'Thim: Video', 'sailing' ),
			array(
				'description'   => esc_attr__( 'A video player widget.', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'style'          => array(
					"type"          => "select",
					"label"         => esc_attr__( "Layout Video", "sailing" ),
					"default"       => "default",
					"options"       => array(
						"base"    => esc_attr__( "Style New", "sailing" ),
						"default" => esc_attr__( "Style Old", "sailing" ),
						"style-1" => esc_attr__( "Style 1", "sailing" )
					),
					"description"   => esc_attr__( "Select layout video.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),
				'title'          => array(
					'type'  => 'text',
					'label' => esc_attr__( 'Title', 'sailing' ),
					'allow_html_formatting' => true,
				),
				'background-title'          => array(
					'type'  => 'text',
					'label' => esc_attr__( 'Background Title', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'show' ),
						'style[style-1]' => array( 'hide' ),
					),
				),
				'desc'           => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Description', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[default]' => array( 'show' ),
						'style[style-1]' => array( 'hide' ),
					),
				),
				'self_poster'    => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Select cover image', 'sailing' ),
					'default'       => '',
					'library'       => 'image',
					'state_handler' => array(
						'style[base]'    => array( 'hide' ),
						'style[default]' => array( 'show' ),
						'style[style-1]' => array( 'show' ),
					),
				),
				'button02_title'          => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Video Button', 'sailing' ),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
						'style[style-1]' => array( 'hide' ),
					),
				),
				'background_img' => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Select background image', 'sailing' ),
					'default'       => '',
					'library'       => 'image',
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
						'style[style-1]' => array( 'hide' ),
					),
				),
				'logo'           => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Select logo image', 'sailing' ),
					'default'       => '',
					'library'       => 'image',
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[default]' => array( 'hide' ),
						'style[style-1]' => array( 'show' ),
					),
				),
				'external_video' => array(
					'type'        => 'text',
					'sanitize'    => 'url',
					'label'       => esc_attr__( 'Video URL', 'sailing' ),
					"description" => esc_attr__( "Use embed link for Youtube link or Vimeo. Ex: https://www.youtube.com/embed/***, https://www.youtube.com/watch?v=***", "sailing" ),
				)
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

function thim_video_register_widget() {
	register_widget( 'Thim_Video_Widget' );
}

add_action( 'widgets_init', 'thim_video_register_widget' );