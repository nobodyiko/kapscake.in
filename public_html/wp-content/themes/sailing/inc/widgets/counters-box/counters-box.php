<?php
class Counters_Box_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'counters-box',
			esc_attr__( 'Thim: Counters Box', 'sailing' ),
			array(
				'description' => esc_attr__( 'Counters Box', 'sailing' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(

				'counters_label'   => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Counters label', 'sailing' ),
				),

				'counters_value'   => array(
					'type'    => 'number',
					'label'   => esc_attr__( 'Counters Value', 'sailing' ),
					'default' => '20',
				),

				'icon'   => array(
					'type'    => 'icon',
					'label'   => esc_attr__( 'Icon', 'sailing' ),
				),
				'border_color'   => array(
					'type'    => 'color',
					'label'   => esc_attr__( 'Border Color Icon', 'sailing' ),
				),

				'counter_color'   => array(
					'type'    => 'color',
					'label'   => esc_attr__( 'Counters Box Icon', 'sailing' ),
				),


 				'css_animation' => array(
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
				)
			),
			TP_THEME_DIR . 'inc/widgets/counters-box/'
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
	function enqueue_frontend_scripts(){
		wp_enqueue_script('thim-counters-box', TP_THEME_URI .'inc/widgets/counters-box/js/counters-box.js', array( 'jquery' ), '', true  );
 	}
}

function thim_counters_box_widget() {
	register_widget( 'Counters_Box_Widget' );
}

add_action( 'widgets_init', 'thim_counters_box_widget' );