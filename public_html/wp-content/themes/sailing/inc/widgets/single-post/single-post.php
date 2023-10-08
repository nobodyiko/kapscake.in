<?php

class Thim_Single_Post_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'single-post',
			esc_html__( 'Thim: Single Post', 'sailing' ),
			array(
				'description'   => esc_html__( 'Show Single Post', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),

			),
			array(),
			array(
				'style'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Style', 'sailing' ),
					'options' => array(
						'base'			=> esc_html__( 'Default', 'sailing' ),
						'style-1' 	=> esc_html__( 'Style 1', 'sailing' ),
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style' )
					),
				),
				'title'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'sailing' ),
					'default' => esc_html__( 'From Blog', 'sailing' )
				),
				'show_bg_color'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Show  Background Color', 'sailing' ),
					'default' => 'yes',
					'options' => array(
						'yes' 	=> esc_html__( 'Yes', 'sailing' ),
						'no'  	=> esc_html__( 'No', 'sailing' ),
					),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style-1]' => array( 'hide' ),
					),
					
				),
				'show_text_link'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Show  Text Link', 'sailing' ),
					'default' => 'no',
					'options' => array(
						'yes' 	=> esc_html__( 'Yes', 'sailing' ),
						'no'  	=> esc_html__( 'No', 'sailing' ),
					),'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'show_text_link' )
					),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style-1]' => array( 'hide' ),
					),
					
				),
				'link'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Link', 'sailing' ),
					'default' => esc_html__('#','sailing'),
					'state_handler' => array(
						'show_text_link[yes]'    => array( 'show' ),
						'show_text_link[no]' => array( 'hide' ),
						
					),
					
 				),
				'text_link'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text Link', 'sailing' ),
					'default' => esc_html__('Discover now','sailing'),
					'state_handler' => array(
						'show_text_link[yes]'    => array( 'show' ),
						'show_text_link[no]' => array( 'hide' ),
						
					),
					
 				),
				'position_title'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Position title', 'sailing' ),
					'default' => 'left',
					'options' => array(
						'left' 	=> esc_html__( 'Left', 'sailing' ),
						'right'  	=> esc_html__( 'Right', 'sailing' ),
						'center'  	=> esc_html__( 'Center', 'sailing' ),
					),
					
				),

				'post_id' => array(
					'type' 		=> 'text',
					'label'		=> esc_html__('Post ID', 'sailing'),
				),
				'position_content'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Content position', 'sailing' ),
					'default' => 'right',
					'options' => array(
						'left' 	=> esc_html__( 'Left', 'sailing' ),
						'right'  	=> esc_html__( 'Right', 'sailing' ),
					),
					
				),
				
				'show_post_link'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Show  Post Link', 'sailing' ),
					'default' => 'no',
					'options' => array(
						'yes' 	=> esc_html__( 'Yes', 'sailing' ),
						'no'  	=> esc_html__( 'No', 'sailing' ),
					),'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'show_post_link' )
					),
					'state_handler' => array(
						'style[base]'    => array( 'show' ),
						'style[style-1]' => array( 'show' ),
					),
					
				),
				
				'post_text_link'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text Link', 'sailing' ),
					'default' => esc_html__('Discover now','sailing'),
					'state_handler' => array(
						'show_post_link[yes]'    => array( 'show' ),
						'show_post_link[no]' => array( 'hide' ),
						
					),
					
 				),
 				
			),
			TP_THEME_DIR . 'inc/widgets/list-post/'
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

function thim_single_post_register_widget() {
	register_widget( 'Thim_Single_Post_Widget' );
}

add_action( 'widgets_init', 'thim_single_post_register_widget' );