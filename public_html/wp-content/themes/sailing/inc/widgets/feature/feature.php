<?php
 class Feature_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'feature',
			__( 'Thim: Feature', 'sailing' ),
			array(
				'description' => esc_html__( 'Add Feature html', 'sailing' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'list-html' => array(
					'type'      => 'repeater',
					'label'     => esc_html__( 'Text', 'sailing' ),
					'item_name' => esc_html__( 'Text', 'sailing' ),
					'fields'    => array(
						'title'   => array(
							"type"    => "text",
							"label"   => esc_html__( "Title", "sailing" ),
							"default" => "Title",
						),
						'content' => array(
							"type"  => "textarea",
							"label" => esc_html__( "Content", "sailing" ),
							'allow_html_formatting' => true
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/feature/'
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


function thim_feature_register_widget() {
	register_widget( 'Feature_Widget' );
}

add_action( 'widgets_init', 'thim_feature_register_widget' );