<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Filter_Gallery_Element extends Widget_Base {

	public function get_name() {
		return 'thim-gallery';
	}

	public function get_title() {
		return esc_html__( 'Thim: Filter Gallery', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-courses-searching';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	//Get list post categories
	public function thim_get_post_categories() {
		$args         = array(
			'orderby' => 'id',
			'parent'  => 0
		);
		$items        = array();
		$items['all'] = esc_html__( 'Select Category', 'sailing' );
		$categories   = get_categories( $args );
		if ( isset( $categories ) ) {
			foreach ( $categories as $key => $cat ) {
				$items[$cat->cat_ID] = $cat->cat_name;
				$childrens           = get_term_children( $cat->term_id, $cat->taxonomy );
				if ( $childrens ) {
					foreach ( $childrens as $key => $children ) {
						$child                  = get_term_by( 'id', $children, $cat->taxonomy );
						$items[$child->term_id] = '--' . $child->name;

					}
				}
			}
		}

		return $items;
	}

	protected function register_controls() {

		wp_enqueue_style( 'thim-fancybox', TP_THEME_URI . 'inc/widgets/gallery/css/jquery.fancybox.css' );

		$this->start_controls_section(
			'gallery_settings',
			[
				'label' => esc_html__( 'Gallery Settings', 'sailing' )
			]
		);

		$this->add_control(
			'cat',
			[
				'label'    => esc_html__( 'Select Category', 'sailing' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => false,
				'options'  => $this->thim_get_post_categories(),
				'default'  => 'all'
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Limit Post', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 2,
				'step'    => 1
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'cat'   	=> $settings['cat'],
			'limit' 	=> $settings['limit'],
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Filter_Gallery_Element() );
