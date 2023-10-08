<?php

class Icon_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'icon-box',
			esc_attr__( 'Thim: Icon Box',  'sailing' ),
			array(
				'description'   => esc_attr__( 'Add icon box',  'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
 			),
			array(),
			array(
 				'title_group'         => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Title Options',  'sailing' ),
					'hide'   => true,
					'fields' => array(
						'title'            => array(
							'type'                  => 'text',
							'label'                 => esc_attr__( 'Title',  'sailing' ),
							"default"               => "This is an icon box.",
							"description"           => esc_attr__( "Provide the title for this icon box.", "sailing" ),
							'allow_html_formatting' => true
						),
						'color_title'      => array(
							'type'  => 'color',
							'label' => esc_attr__( 'Color Title',  'sailing' ),
						),
						'size'             => array(
							"type"        => "select",
							"label"       => esc_attr__( "Size Heading", "sailing" ),
							"default"     => "h3",
							"options"     => array(
								"h2" => esc_attr__( "h2", "sailing" ),
								"h3" => esc_attr__( "h3", "sailing" ),
								"h4" => esc_attr__( "h4", "sailing" ),
								"h5" => esc_attr__( "h5", "sailing" ),
								"h6" => esc_attr__( "h6", "sailing" )
							),
							"description" => esc_attr__( "Select size heading.", "sailing" )
						),
						'font_heading'     => array(
							"type"          => "select",
							"label"         => esc_attr__( "Font Heading", "sailing" ),
							"options"       => array(
								"default" => esc_attr__( "Default", "sailing" ),
								"custom"  => esc_attr__( "Custom", "sailing" )
							),
							"description"   => esc_attr__( "Select Font heading.", "sailing" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'custom_font_heading' )
							)
						),
						'custom_heading'   => array(
							'type'          => 'section',
							'label'         => esc_attr__( 'Custom Heading Option',  'sailing' ),
							'hide'          => true,
							'state_handler' => array(
								'custom_font_heading[custom]'  => array( 'show' ),
								'custom_font_heading[default]' => array( 'hide' ),
							),
							'fields'        => array(
								'custom_font_size'   => array(
									"type"        => "number",
									"label"       => esc_attr__( "Font Size", "sailing" ),
									"suffix"      => "px",
									"default"     => "14",
									"description" => esc_attr__( "custom font size", "sailing" ),
									"class"       => "color-mini"
								),
								'custom_font_weight' => array(
									"type"        => "select",
									"label"       => esc_attr__( "Custom Font Weight", "sailing" ),
									"class"       => "color-mini",
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
								),
								'custom_mg_bt'       => array(
									"type"   => "number",
									"class"  => "color-mini",
									"label"  => esc_attr__( "Margin Bottom Value", "sailing" ),
									"value"  => 0,
									"suffix" => "px",
								),
							)
						),
						'line_after_title' => array(
							'type'  => 'checkbox',
							'label' => esc_attr__( 'Show Separator',  'sailing' ),
						),
					),
				),
				'desc_group'          => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Description',  'sailing' ),
					'hide'   => true,
					'fields' => array(
						'content'              => array(
							"type"                  => "textarea",
							"label"                 => esc_attr__( "Add description", "sailing" ),
							"default"               => "Write a short description, that will describe the title or something informational and useful.",
							"description"           => esc_attr__( "Provide the description for this icon box.", "sailing" ),
							'allow_html_formatting' => true
						),
						'custom_font_size_des' => array(
							"type"        => "number",
							"label"       => esc_attr__( "Custom Font Size", "sailing" ),
							"suffix"      => "px",
							"default"     => "",
							"description" => esc_attr__( "custom font size", "sailing" ),
							"class"       => "color-mini",
						),
						'custom_font_weight'   => array(
							"type"        => "select",
							"label"       => esc_attr__( "Custom Font Weight", "sailing" ),
							"class"       => "color-mini",
							"options"     => array(
								""     => esc_attr__( "Normal", "sailing" ),
								"bold" => esc_attr__( "Bold", "sailing" ),
								"100"  => esc_attr__( "100", "sailing" ),
								"200"  => esc_attr__( "200", "sailing" ),
								"300"  => esc_attr__( "300", "sailing" ),
								"400"  => esc_attr__( "400", "sailing" ),
								"500"  => esc_attr__( "500", "sailing" ),
								"600"  => esc_attr__( "600", "sailing" ),
								"700"  => esc_attr__( "700", "sailing" ),
								"800"  => esc_attr__( "800", "sailing" ),
								"900"  => esc_attr__( "900", "sailing" )
							),
							"description" => esc_attr__( "Select Custom Font Weight", "sailing" ),
						),
						'color_description'    => array(
							"type"  => "color",
							"label" => esc_attr__( "Color Description", "sailing" ),
							"class" => "color-mini",
						),
					),
				),
				'read_more_group'     => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Link Icon Box',  'sailing' ),
					'hide'   => true,
					'fields' => array(
						// Add link to existing content or to another resource
						'link'                   => array(
							"type"        => "text",
							"label"       => esc_attr__( "Add Link", "sailing" ),
							"description" => esc_attr__( "Provide the link that will be applied to this icon box.", "sailing" )
						),
						// Select link option - to box or with read more text
						'read_more'              => array(
							"type"          => "select",
							"label"         => esc_attr__( "Apply link to:", "sailing" ),
							"options"       => array(
								"complete_box" => "Complete Box",
								"title"        => "Box Title",
								"more"         => "Display Read More"
							),
							"description"   => esc_attr__( "Select whether to use color for icon or not.", "sailing" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'read_more_op' )
							)
						),
						// Link to traditional read more
						'button_read_more_group' => array(
							'type'          => 'section',
							'label'         => esc_attr__( 'Option Button Read More',  'sailing' ),
							'hide'          => true,
							'state_handler' => array(
								'read_more_op[more]'         => array( 'show' ),
								'read_more_op[complete_box]' => array( 'hide' ),
								'read_more_op[title]'        => array( 'hide' ),
							),
							'fields'        => array(
								'read_text'                  => array(
									"type"        => "text",
									"label"       => esc_attr__( "Read More Text", "sailing" ),
									"default"     => "Read More",
									"description" => esc_attr__( "Customize the read more text.", "sailing" ),
								),
								'read_more_text_color'       => array(
									"type"        => "color",
									"class"       => "",
									"label"       => esc_attr__( "Text Color Read More", "sailing" ),
									"description" => esc_attr__( "Select whether to use text color for Read More Text or default.", "sailing" ),
									"class"       => "color-mini",
								),
								'border_read_more_text'      => array(
									"type"        => "color",
									"label"       => esc_attr__( "Border Color Read More Text:", "sailing" ),
									"description" => esc_attr__( "Select whether to use border color for Read More Text or none.", "sailing" ),
									"class"       => "color-mini",
								),
								'bg_read_more_text'          => array(
									"type"        => "color",
									"class"       => "mini",
									"label"       => esc_attr__( "Background Color Read More Text:", "sailing" ),
									"description" => esc_attr__( "Select whether to use background color for Read More Text or default.", "sailing" ),
									"class"       => "color-mini",
								),
								'read_more_text_color_hover' => array(
									"type"        => "color",
									"class"       => "",
									"label"       => esc_attr__( "Text Hover Color Read More", "sailing" ),
									"description" => esc_attr__( "Select whether to use text color for Read More Text or default.", "sailing" ),
									"class"       => "color-mini",
								),

								'bg_read_more_text_hover'    => array(
									"type"        => "color",
									"label"       => esc_attr__( "Background Hover Color Read More Text:", "sailing" ),
									"description" => esc_attr__( "Select whether to use background color when hover Read More Text or default.", "sailing" ),
									"class"       => "color-mini",
								),

							)
						),
					),
				),
				// Play with icon selector
				'icon_type'           => array(
					"type"          => "select",
					"class"         => "",
					"label"         => esc_attr__( "Icon to display:", "sailing" ),
					"default"       => "font-awesome",
					"options"       => array(
						"font-awesome"  => "Font Awesome Icon",
						"font-7-stroke" => "Font 7 stroke Icon",
						"custom"        => "Custom Image Icon",
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'icon_type_op' )
					)
				),
				'font_7_stroke_group' => array(
					'type'          => 'section',
					'label'         => esc_attr__( 'Font 7 Stroke Icon',  'sailing' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'show' ),
					),
					'fields'        => array(
						'icon'      => array(
							"type"        => "icon-7-stroke",
							"class"       => "",
							"label"       => esc_attr__( "Select Icon:", "sailing" ),
							"description" => esc_attr__( "Select the icon from the list.", "sailing" ),
							"class_name"  => 'font-7-stroke',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => esc_attr__( "Icon Font Size ", "sailing" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => esc_attr__( "Select the icon font size.", "sailing" ),
							"class_name"  => 'font-7-stroke'
						),
					),
				),
				'font_awesome_group'  => array(
					'type'          => 'section',
					'label'         => esc_attr__( 'Font Awesome Icon',  'sailing' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'show' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
						'icon'      => array(
							"type"        => "icon",
							"class"       => "",
							"label"       => esc_attr__( "Select Icon:", "sailing" ),
							"description" => esc_attr__( "Select the icon from the list.", "sailing" ),
							"class_name"  => 'font-awesome',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => esc_attr__( "Icon Font Size ", "sailing" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => esc_attr__( "Select the icon font size.", "sailing" ),
							"class_name"  => 'font-awesome'
						),
					),
				),
				'font_image_group'    => array(
					'type'          => 'section',
					'label'         => esc_attr__( 'Custom Image Icon',  'sailing' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'show' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
						// Play with icon selector
						'icon_img' => array(
							"type"        => "media",
							"label"       => esc_attr__( "Upload Image Icon:", "sailing" ),
							"description" => esc_attr__( "Upload the custom image icon.", "sailing" ),
							"class_name"  => 'custom',
						),
					),
				),
				// // Resize the icon
				'width_icon_box'      => array(
					"type"    => "number",
					"class"   => "",
					"default" => "100",
					"label"   => esc_attr__( "Width Box Icon", "sailing" ),
					"suffix"  => "px",
				),
				'color_group'         => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Color Options',  'sailing' ),
					'hide'   => true,
					'fields' => array(
						// Customize Icon Color
						'icon_color'              => array(
							"type"        => "color",
							"class"       => "color-mini",
							"label"       => esc_attr__( "Select Icon Color:", "sailing" ),
							"description" => esc_attr__( "Select the icon color.", "sailing" ),
						),
						'icon_border_color'       => array(
							"type"        => "color",
							"label"       => esc_attr__( "Icon Border Color:", "sailing" ),
							"description" => esc_attr__( "Select the color for icon border.", "sailing" ),
							"class"       => "color-mini",
						),
						'icon_bg_color'           => array(
							"type"        => "color",
							"label"       => esc_attr__( "Icon Background Color:", "sailing" ),
							"description" => esc_attr__( "Select the color for icon background.", "sailing" ),
							"class"       => "color-mini",
						),
						'icon_hover_color'        => array(
							"type"        => "color",
							"label"       => esc_attr__( "Hover Icon Color:", "sailing" ),
							"description" => esc_attr__( "Select the color hover for icon.", "sailing" ),
							"class"       => "color-mini",
						),
						'icon_border_color_hover' => array(
							"type"        => "color",
							"label"       => esc_attr__( "Hover Icon Border Color:", "sailing" ),
							"description" => esc_attr__( "Select the color hover for icon border.", "sailing" ),
							"class"       => "color-mini",
						),
						// Give some background to icon
						'icon_bg_color_hover'     => array(
							"type"        => "color",
							"label"       => esc_attr__( "Hover Icon Background Color:", "sailing" ),
							"description" => esc_attr__( "Select the color hover for icon background .", "sailing" ),
							"class"       => "color-mini",
						),
					)
				),
				'layout_group'        => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Layout Options',  'sailing' ),
					'hide'   => true,
					'fields' => array(
						'box_icon_style' => array(
							"type"    => "select",
							"class"   => "",
							"label"   => esc_attr__( "Icon Shape", "sailing" ),
							"options" => array(
								""       => esc_attr__( "None", "sailing" ),
								"circle" => esc_attr__( "Circle", "sailing" ),
							),
							"std"     => "circle",
						),
						'pos'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => esc_attr__( "Box Style:", "sailing" ),
							"default"     => "top",
							"options"     => array(
								"left"  => "Icon at Left",
								"right" => "Icon at Right",
								"top"   => "Icon at Top"
							),
							"description" => esc_attr__( "Select icon position. Icon box style will be changed according to the icon position.", "sailing" ),
						),
						'text_align_sc'  => array(
							"type"    => "select",
							"class"   => "",
							"label"   => esc_attr__( "Text Align Shortcode:", "sailing" ),
							"options" => array(
								"text-left"   => "Text Left",
								"text-right"  => "Text Right",
								"text-center" => "Text Center"
							)
						),
					),
				),

				'widget_background'   => array(
					"type"          => "select",
					"label"         => esc_attr__( "Widget Background", "sailing" ),
					"default"       => "none",
					"options"       => array(
						"none"     => "None",
						"bg_video" => "Video Background",
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'bg_video_style' )
					)
				),
				'self_video'          => array(
					'type'          => 'media',
					'fallback'      => true,
					'label'         => esc_html__( 'Select video',  'sailing' ),
					'description'   => esc_html__( "Select an uploaded video in mp4 format. Other formats, such as webm and ogv will work in some browsers. You can use an online service such as <a href='http://video.online-convert.com/convert-to-mp4' target='_blank'>online-convert.com</a> to convert your videos to mp4.", "sailing" ),
					'default'       => '',
					'library'       => 'video',
					'state_handler' => array(
						'bg_video_style[bg_video]' => array( 'show' ),
						'bg_video_style[none]'     => array( 'hide' ),
					)
				),
				'self_poster'         => array(
					'type'          => 'media',
					'label'         => esc_attr__( 'Select cover image',  'sailing' ),
					'default'       => '',
					'library'       => 'image',
					'state_handler' => array(
						'bg_video_style[bg_video]' => array( 'show' ),
						'bg_video_style[none]'     => array( 'hide' ),
					)
				),

				'video_group'        => array(
					'type'   => 'section',
					'label'  => esc_attr__( 'Video Background Options',  'sailing' ),
					'hide'   => true,
					'state_handler' => array(
						'bg_video_style[bg_video]' => array( 'show' ),
						'bg_video_style[none]'     => array( 'hide' ),
					),
					'fields' => array(
						'auto_play'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => esc_attr__( "Auto Play", "sailing" ),
							"default"     => "true",
							"options"     => array(
								"true"  => "Yes",
								"false" => "No",
							),
						),
						'auto_hidden' => array(
							"type"    => "select",
							"class"   => "",
							"label"   => esc_attr__( "Auto Hidden", "sailing" ),
							"options" => array(
								"false"       		=> esc_attr__( "No", "sailing" ),
								"true" 	=> esc_attr__( "Yes", "sailing" ),
							),
							"default"     => "false",
						),
						'muted'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => esc_attr__( "Muted", "sailing" ),
							"default"     => "true",
							"options"     => array(
								"true"  => "Yes",
								"false" => "No",
							),
						),
						'loop'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => esc_attr__( "Loop", "sailing" ),
							"default"     => "true",
							"options"     => array(
								"true"  => "Yes",
								"false" => "No",
							),
						),
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
				)
			),
			TP_THEME_DIR . 'inc/widgets/icon-box/'
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

function thim_icon_box_register_widget() {
	register_widget( 'Icon_Box_Widget' );
}

add_action( 'widgets_init', 'thim_icon_box_register_widget' );