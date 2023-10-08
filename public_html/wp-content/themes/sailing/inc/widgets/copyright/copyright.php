<?php

/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 05/23/2018
 * Time: 5:30 PM
 */
class Copyright_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'copyright',
			esc_attr__( 'Thim: Copyright', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Copyright', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'first_text' => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'First Text', 'sailing' ),
					'default' => '&copy;'
				),
				'year'       => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Year', 'sailing' ),
					'default' => '2018'
				),
				'site_name'  => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Site Name', 'sailing' ),
					'default' => 'ThimPress'
				),
				'link_site'  => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Link Site', 'sailing' ),
					'default' => 'https://thimpress.com/'
				),
				'last_text'  => array(
					'type'                  => 'text',
					'label'                 => esc_attr__( 'Last Text', 'sailing' ),
					'default'               => 'All rights reserved. Powered by WordPress.',
					'allow_html_formatting' => true
				),
			),
			TP_THEME_DIR . 'inc/widgets/copyright/'
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

function thim_copyright_widget() {
	register_widget( 'Copyright_Widget' );
}

add_action( 'widgets_init', 'thim_copyright_widget' );