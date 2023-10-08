<?php

class Heading_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'heading',
			esc_attr__( 'Thim: Heading', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Add heading text', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(

				'style'               => array(
					"type"          => "select",
					"label"         => esc_attr__( "Style heading", "sailing" ),
					"default"       => "base",
					"options"       => array(
						"base"      => esc_attr__( "Style Old", "sailing" ),
						"style_new" => esc_attr__( "Style New", "sailing" )
					),
					"description"   => esc_attr__( "Select style heading.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					)
				),
				'small_title'         => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Small Heading Text', 'sailing' ),
					'default'       => esc_attr__( "Default value", "sailing" ),
					'state_handler' => array(
						'style[base]'      => array( 'hide' ),
						'style[style_new]' => array( 'show' ),
					),
				),
				'title'               => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Heading Text', 'sailing' ),
					'default' => esc_attr__( "Default value", "sailing" )
				),
				'line'                => array(
					'type'          => 'checkbox',
					'label'         => esc_attr__( 'Show Separator', 'sailing' ),
					'state_handler' => array(
						'style[base]'      => array( 'show' ),
						'style[style_new]' => array( 'hide' ),
					),
				),
				'textcolor'           => array(
					'type'          => 'color',
					'label'         => esc_attr__( 'Text Heading color', 'sailing' ),
					'default'       => '',
					'state_handler' => array(
						'style[base]'      => array( 'show' ),
						'style[style_new]' => array( 'hide' ),
					),
				),
				'size'                => array(
					"type"    => "select",
					"label"   => esc_attr__( "Size Heading", "sailing" ),
					"options" => array(
						"h2" => esc_attr__( "h2", "sailing" ),
						"h3" => esc_attr__( "h3", "sailing" ),
						"h4" => esc_attr__( "h4", "sailing" ),
						"h5" => esc_attr__( "h5", "sailing" ),
						"h6" => esc_attr__( "h6", "sailing" )
					),
					"default" => "h3"
				),
				'font_heading'        => array(
					"type"          => "select",
					"label"         => esc_attr__( "Font Heading", "sailing" ),
					"default"       => "default",
					"options"       => array(
						"default" => esc_attr__( "Default", "sailing" ),
						"custom"  => esc_attr__( "Custom", "sailing" )
					),
					"description"   => esc_attr__( "Select Font heading.", "sailing" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'font_heading_type' )
					)
				),
				'custom_font_heading' => array(
					'type'          => 'section',
					'label'         => esc_attr__( 'Custom Font Heading', 'sailing' ),
					'hide'          => true,
					'state_handler' => array(
						'font_heading_type[custom]'  => array( 'show' ),
						'font_heading_type[default]' => array( 'hide' ),
					),
					'fields'        => array(
						'custom_font_size'   => array(
							"type"        => "number",
							"label"       => esc_attr__( "Font Size", "sailing" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => esc_attr__( "custom font size", "sailing" ),
							"class"       => "color-mini",
						),
						'custom_font_weight' => array(
							"type"        => "select",
							"label"       => esc_attr__( "Custom Font Weight", "sailing" ),
							"options"     => array(
								"normal" => esc_attr__( "Normal", "sailing" ),
								"bold"   => esc_attr__( "Bold", "sailing" ),
								"100"    => esc_attr__( "100", "sailing" ),
								"200"    => esc_attr__( "200", "sailing" ),
								"300"    => esc_attr__( "300", "sailing" ),
								"400"    => esc_attr__( "400", "sailing" ),
								"500"    => esc_attr__( "500", "sailing" ),
								"600"    => esc_attr__( "600", "sailing" ),
								"700"    => esc_attr__( "700", "sailing" ),
								"800"    => esc_attr__( "800", "sailing" ),
								"900"    => esc_attr__( "900", "sailing" )
							),
							"description" => esc_attr__( "Select Custom Font Weight", "sailing" ),
							"class"       => "color-mini",
						),
						'custom_font_style'  => array(
							"type"        => "select",
							"label"       => esc_attr__( "Custom Font Style", "sailing" ),
							"options"     => array(
								"inherit" => esc_attr__( "inherit", "sailing" ),
								"initial" => esc_attr__( "initial", "sailing" ),
								"italic"  => esc_attr__( "italic", "sailing" ),
								"normal"  => esc_attr__( "normal", "sailing" ),
								"oblique" => esc_attr__( "oblique", "sailing" )
							),
							"description" => esc_attr__( "Select Custom Font Style", "sailing" ),
							"class"       => "color-mini",
						),
					),
				),
				'sub-title'           => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Sub Heading', 'sailing' ),
					'default'       => '',
					'state_handler' => array(
						'style[base]'      => array( 'show' ),
						'style[style_new]' => array( 'hide' ),
					),
				),
				'background_title'    => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Background Heading', 'sailing' ),
					'default'       => 'Default',
					'state_handler' => array(
						'style[base]'      => array( 'hide' ),
						'style[style_new]' => array( 'show' ),
					),
				),
				'description'         => array(
					'type'                  => 'textarea',
					'label'                 => esc_attr__( 'Description Text', 'sailing' ),
					'default'               => esc_attr__( "Default value", "sailing" ),
					'allow_html_formatting' => true,
					'state_handler'         => array(
						'style[base]'      => array( 'hide' ),
						'style[style_new]' => array( 'show' ),
					),
				),
				'show_button_heading' => array(
					"type"          => "select",
					"label"         => esc_attr__( "Show button heading", "sailing" ),
					"default"       => "no",
					"options"       => array(
						"yes" => esc_attr__( "Yes", "sailing" ),
						"no"  => esc_attr__( "No", "sailing" )
					),
					"description"   => esc_attr__( "Show button for heading.", "sailing" ),
					'state_handler'         => array(
						'style[base]'      => array( 'hide' ),
						'style[style_new]' => array( 'show' ),
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'show_button_heading' )
					)
				),
				'title_button'        => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Title Button Heading', 'sailing' ),
					'default'       => 'Button',
					'state_handler' => array(
						'show_button_heading[yes]' => array( 'show' ),
						'show_button_heading[no]'  => array( 'hide' ),
					),
				),
				'link_button'         => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Link Button Heading', 'sailing' ),
					'default'       => '#',
					'state_handler' => array(
						'show_button_heading[yes]' => array( 'show' ),
						'show_button_heading[no]'  => array( 'hide' ),
					),
				),
				'link_target'         => array(
					'type'          => 'select',
					'label'         => esc_attr__( 'Link Target Button', 'sailing' ),
					'options'       => array(
						'_self'  => esc_attr__( 'Same window', 'sailing' ),
						'_blank' => esc_attr__( 'New window', 'sailing' ),
					),
					'state_handler' => array(
						'show_button_heading[yes]' => array( 'show' ),
						'show_button_heading[no]'  => array( 'hide' ),
					),
				),
				'css_animation'       => array(
					"type"    => "select",
					"label"   => esc_attr__( "CSS Animation", "sailing" ),
					"options" => array(
						""              => esc_attr__( "No", "sailing" ),
						"top-to-bottom" => esc_attr__( "Top to bottom", "sailing" ),
						"bottom-to-top" => esc_attr__( "Bottom to top", "sailing" ),
						"left-to-right" => esc_attr__( "Left to right", "sailing" ),
						"right-to-left" => esc_attr__( "Right to left", "sailing" ),
						"appear"        => esc_attr__( "Appear from center", "sailing" )
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/heading/'
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

function thim_heading_register_widget() {
	register_widget( 'Heading_Widget' );
}

add_action( 'widgets_init', 'thim_heading_register_widget' );