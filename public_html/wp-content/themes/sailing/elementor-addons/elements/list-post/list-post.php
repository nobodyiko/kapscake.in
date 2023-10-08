<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_List_Post_Element extends Widget_Base {

	public function get_name() {
		return 'thim-list-post';
	}

	public function get_title() {
		return esc_html__( 'Thim: List Post', 'sailing' );
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

	public function get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$sizes[$_size]['width']  = get_option( $_size . '_size_w' );
				$sizes[$_size]['height'] = get_option( $_size . '_size_h' );
				$sizes[$_size]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
				$sizes[$_size] = array(
					'width'  => $_wp_additional_image_sizes[$_size]['width'],
					'height' => $_wp_additional_image_sizes[$_size]['height'],
					'crop'   => $_wp_additional_image_sizes[$_size]['crop']
				);
			}
		}
		// Get only 1 size if found
		if ( $size ) {
			if ( isset( $sizes[$size] ) ) {
				return $sizes[$size];
			} else {
				return false;
			}
		}

		return $sizes;
	}

	public function image_sizes() {
		$list_image_size    = $this->get_image_sizes();
		$image_size         = array();
		$image_size['none'] = esc_attr__( 'No Image', 'sailing' );
		if ( is_array( $list_image_size ) && !empty( $list_image_size ) ) {
			foreach ( $list_image_size as $key => $value ) {
				if ( $value['width'] && $value['height'] ) {
					$image_size[$key] = $value['width'] . 'x' . $value['height'];
				} else {
					$image_size[$key] = $key;
				}
			}
		}

		return $image_size;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'list_post_settings',
			[
				'label' => esc_html__( 'List Post Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''         => esc_attr__( 'No Style', 'sailing' ),
					'homepage' => esc_attr__( 'Home Page', 'sailing' ),
					'sidebar'  => esc_attr__( 'Sidebar', 'sailing' ),
					'slider-1'  	=> esc_html__( 'Slider 1', 'sailing' ),
					'slider-2'  	=> esc_html__( 'Slider 2', 'sailing' ),
				],
				'default' => 'sidebar',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'From Blog'
			]
		);
		$this->add_control(
			'position_title',
			[
				'label'   => esc_html__( 'Position Title', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left' 	=> esc_html__( 'Left', 'sailing' ),
						'right'  	=> esc_html__( 'Right', 'sailing' ),
						'center'  	=> esc_html__( 'Center', 'sailing' ),
				],
				'default' => 'left',
			]
		);
		$this->add_control(
			'bg_title',
			[
				'label'       => esc_html__( 'Background Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Background Title', 'sailing' ),
				'default'     => esc_html__('Lastes Post'),
				'condition' => [
					'style' => [ 'slider-1' ]
				]

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
			'image_size',
			[
				'label'    => esc_html__( 'Select Size Image', 'sailing' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => false,
				'options'  => $this->image_sizes(),
				'default'  => 'none',
				'condition' => [
					'style' => [ '','homepage','sidebar' ]
				]
			]
		);

		$this->add_control(
			'show_description',
			[
				'label'   => esc_html__( 'Show Description', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'number_posts',
			[
				'label'   => esc_html__( 'Number Post', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4
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

		$this->add_control(
			'text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Text Link', 'sailing' ),
				'condition' => [
					'style' => [ '','homepage','sidebar' ]
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link All Post', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => false,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
				'condition' => [
					'style' => [ '','homepage','sidebar' ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'title'            => $settings['title'],
			'position_title'   => $settings['position_title'],
			'bg_title'         => $settings['bg_title'],
			'cat_id'           => $settings['cat_id'],
			'image_size'       => $settings['image_size'],
			'show_description' => $settings['show_description'],
			'number_posts'     => $settings['number_posts'],
			'orderby'          => $settings['orderby'],
			'order'            => $settings['order'],
			'link'             => isset($settings['link']['url']) ? $settings['link']['url'] :'',
			'text_link'        => isset($settings['text_link']) ? $settings['text_link'] : '',
			'style'            => $settings['style']
		);

		$args                 = array();
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title']  = '</h3>';
		$style = '';
		if($instance['style'] == '' || $instance['style'] == 'homepage' || $instance['style'] == 'sidebar'){
			$style = 'base';
		}else{
			$style =  $instance['style'];
		}
		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance, 'args' => $args ),$style );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_List_Post_Element() );
