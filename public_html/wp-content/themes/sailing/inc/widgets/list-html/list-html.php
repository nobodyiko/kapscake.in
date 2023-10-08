<?php
 class List_Html_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'list-html',
			esc_attr__( 'Thim: List Html Two Columns', 'sailing' ),
			array(
				'description' => esc_attr__( 'Add html', 'sailing' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'list-html' => array(
					'type'      => 'repeater',
					'label'     => esc_attr__( 'Text', 'sailing' ),
					'item_name' => esc_attr__( 'Text', 'sailing' ),
					'fields'    => array(
						'title'   => array(
							"type"    => "text",
							"label"   => esc_attr__( "Title", "sailing" ),
							"default" => "Title",
						),
						'content' => array(
							"type"  => "textarea",
							"label" => esc_attr__( "Content", "sailing" ),
							'allow_html_formatting' => true
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/list-html/'
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


function thim_list_html_register_widget() {
	register_widget( 'List_Html_Widget' );
}

add_action( 'widgets_init', 'thim_list_html_register_widget' );