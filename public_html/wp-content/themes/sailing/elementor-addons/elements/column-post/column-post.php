<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Column_Post_Element extends Widget_Base {

	public function get_name() {
		return 'thim-column-post';
	}

	public function get_title() {
		return esc_html__( 'Thim: Column Post', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-list-post';
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
		$items['all'] = esc_html__( 'All', 'sailing' );
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
		$this->start_controls_section(
			'column_post_settings',
			[
				'label' => esc_html__( 'Column Post Settings', 'sailing' )
			]
		);

		$this->add_control(
			'cat_id',
			[
				'label'    => esc_html__( 'Select Category', 'sailing' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => false,
				'options'  => $this->thim_get_post_categories(),
				'default'  => 'all'
			]
		);

		$this->add_control(
			'number_posts',
			[
				'label'   => esc_html__( 'Number Post', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3
			]
		);

		$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Column Post', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'2' => esc_attr__( '2', 'sailing' ),
					'3' => esc_attr__( '3', 'sailing' ),
					'4' => esc_attr__( '4', 'sailing' ),
				],
				'default' => '3',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Oder By', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'popular' => esc_attr__( 'Popular', 'sailing' ),
					'recent'  => esc_attr__( 'Recent', 'sailing' ),
					'title'   => esc_attr__( 'Title', 'sailing' ),
					'random'  => esc_attr__( 'Random', 'sailing' ),
				],
				'default' => 'recent',
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Sort By', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'asc'  => esc_attr__( 'ASC', 'sailing' ),
					'desc' => esc_attr__( 'DESC', 'sailing' )
				],
				'default' => 'asc',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'cat_id'       => $settings['cat_id'],
			'number_posts' => $settings['number_posts'],
			'column'       => $settings['column'],
			'orderby'      => $settings['orderby'],
			'order'        => $settings['order']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Column_Post_Element() );
