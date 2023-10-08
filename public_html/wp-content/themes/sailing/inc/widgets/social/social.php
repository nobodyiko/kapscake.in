<?php

class Thim_Social_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'social',
			esc_attr__( 'Thim: Social Links', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Social Links', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(

				'title' => array(
					'type'  => 'text',
					'label' => esc_attr__( 'Title', 'sailing' )
				),

				'version' => array(
					'type'          => 'select',
					'label'         => esc_attr__( 'Version', 'sailing' ),
					'options'       => array(
						'base' => esc_attr__( 'old', 'sailing' ),
						'new'  => esc_attr__( 'New', 'sailing' ),
					),
					'default'       => 'base',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'version' )
					)
				),

				'link_face' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Facebook Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_twitter' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Twitter Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_google' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Google Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_dribble' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Dribble Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_linkedin' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Linked in Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_pinterest' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Pinterest Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_digg' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Digg Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_youtube' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Youtube Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'link_instagram' => array(
					'type'          => 'text',
					'label'         => esc_attr__( 'Instagram Url', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'show' ),
						'version[new]'  => array( 'hide' ),
					),
				),

				'new_version' => array(
					'type'          => 'repeater',
					'label'         => esc_html__( 'Social List', 'sailing' ),
					'item_name'     => esc_html__( 'Social', 'sailing' ),
					'state_handler' => array(
						'version[base]' => array( 'hide' ),
						'version[new]'  => array( 'show' ),
					),
					'fields'        => array(

						'social_name' => array(
							'type'    => 'select',
							'label'   => esc_attr__( 'Social Name', 'sailing' ),
							'options' => array(
								'foursquare'  => esc_attr__( 'Foursquare', 'sailing' ),
								'tripadvisor' => esc_attr__( 'Tripadvisor', 'sailing' ),
								'yelp'        => esc_attr__( 'Yelp', 'sailing' ),
								'facebook'    => esc_attr__( 'Facebook', 'sailing' ),
								'x-twitter'     => esc_attr__( 'Twitter', 'sailing' ),
								'instagram'   => esc_attr__( 'Instagram', 'sailing' ),
								'google-plus' => esc_attr__( 'Google Plus', 'sailing' ),
								'pinterest'   => esc_attr__( 'Pinterest', 'sailing' ),
								'youtube'     => esc_attr__( 'Youtube', 'sailing' ),
								'flickr'      => esc_attr__( 'Flickr', 'sailing' ),
								'digg'        => esc_attr__( 'Digg', 'sailing' ),
								'skype'       => esc_attr__( 'Skype', 'sailing' ),
								'vimeo'       => esc_attr__( 'Vimeo', 'sailing' ),
								'tumblr'      => esc_attr__( 'Tumblr', 'sailing' ),
								'linkedin'    => esc_attr__( 'Linkedin', 'sailing' ),
								'dribble'     => esc_attr__( 'Dribble', 'sailing' ),
								'map-marker'  => esc_attr__( 'Map Marker', 'sailing' ),
							),
						),

						'social_url' => array(
							"type"  => "text",
							"label" => esc_attr__( "Social URL", "sailing" ),
						),
					),
				),

				'link_target' => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Link Target', 'sailing' ),
					'options' => array(
						'_self'  => esc_attr__( 'Same window', 'sailing' ),
						'_blank' => esc_attr__( 'New window', 'sailing' ),
					),
				),

				'ref' => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'rel Attribute', 'sailing' ),
					'options' => array(
						''         => esc_attr__( 'Default', 'sailing' ),
						'nofollow' => esc_attr__( 'nofollow', 'sailing' ),
					),
					'default' => ''
				),


			),
			TP_THEME_DIR . 'inc/widgets/social/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		return isset( $instance['version'] ) ? $instance['version'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_social_register_widget() {
	register_widget( 'Thim_Social_Widget' );
}

add_action( 'widgets_init', 'thim_social_register_widget' );