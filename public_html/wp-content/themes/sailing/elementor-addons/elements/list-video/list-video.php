<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_List_Video_Element extends Widget_Base {

	public function get_name() {
		return 'thim-list-video';
	}

	public function get_title() {
		return esc_html__( 'Thim: List Video', 'sailing' );
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

	protected function register_controls() {
		$this->start_controls_section(
			'list_video_settings',
			[
				'label' => esc_html__( 'List Video Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Layout Video', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				"default"       => "base",
				"options"       => array(
					"base"    => esc_attr__( "Style Default", "sailing" ),
					"style-1" => esc_attr__( "Style 1", "sailing" ),
					"style-2" => esc_attr__( "Style 2", "sailing" ),
				),
				"description"   => esc_attr__( "Select layout video.", "sailing" ),
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'   => esc_html__( 'Background Video', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library.', 'sailing' )
			]
		);

		$this->add_control(
			'bg_title',
			[
				'label'       => esc_html__( 'Background Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Amazing Video', 'sailing' ),
				'label_block' => true,
				'condition' => [
					'style' => [ 'style-1' ]
				]
			]
		);

		$this->add_control(
			'video_title',
			[
				'label'       => esc_html__( 'Video Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Video rooms', 'sailing' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style-1','style-2']
				]
			]
		);

		$this->add_control(
			'video_text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'All video room', 'sailing' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style-2']
				]
			]
		);
		$this->add_control(
			'video_link',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'sailing' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style-2']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Video Tour', 'sailing' ),
				'label_block' => true,
				'prevent_empty'=>false,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__( 'Content', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				"default" => esc_html__( 'Duis aute irure dolor ', 'sailing' ),
				'label_block' => true,
				'prevent_empty'=>false,
			]
		);

		$repeater->add_control(
			'text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn more', 'sailing' ),
				'label_block' => true,
				'prevent_empty'=>false,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'sailing' ),
				'label_block' => true,
				'prevent_empty'=>false,
			]
		);

		$this->add_control(
			'panel',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'separator'   => 'before',
				'prevent_empty'=>false,
				'condition' => [
					'style' => [ 'base' ]
				]
				
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image_2',
			[
				'label'   => esc_html__( 'Image Video', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library.', 'sailing' )
			]
		);

		$repeater->add_control(
			'image_size',
			[
				'label'   => esc_html__( 'Image Size', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				"default"       => "500x250",
				"options"       => array(
					"500x250"    => esc_attr__( "500 x  255", "sailing" ),
					"640x330" => esc_attr__( "650 x 340", "sailing" ),
					"600x300" => esc_attr__( "600 x 310", "sailing" ),
				),
			]
		);

		$repeater->add_control(
			'link_2',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'sailing' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'panel_2',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'separator'   => 'before',
				'prevent_empty'=>false,
				'condition' => [
					'style' => [ 'style-1' ]
				]
				
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image_3',
			[
				'label'   => esc_html__( 'Image Video', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library.', 'sailing' )
			]
		);

		$repeater->add_control(
			'image_size3',
			[
				'label'   => esc_html__( 'Image Size', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				"default"       => "400x230",
				"options"       => array(
					"400x230"    => esc_html__( "400 x  230", "sailing" ),
					"490x280" => esc_html__( "490 x 280", "sailing" ),
					"660x380" => esc_html__( "680 x 380", "sailing" ),
				),
			]
		);

		$repeater->add_control(
			'link_3',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'sailing' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'panel_3',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'separator'   => 'before',
				'prevent_empty'=>false,
				'description' => esc_html__( 'Add and display up to 3 elements only', 'sailing' ),
				'condition' => [
					'style' => [ 'style-2' ]
				]
				
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		
		$instance = array(
			'style'      => $settings['style'],
			'bg_image'   => isset($settings['bg_image']) ? $settings['bg_image']['id'] : '',
			'bg_title'  => isset($settings['bg_title']) ? $settings['bg_title'] : '',
			'video_title'=> isset($settings['video_title']) ?  $settings['video_title'] : '',
			'list-video' => isset($settings['panel']) ? $settings['panel'] : '',
			'video_text_link' => isset($settings['video_text_link']) ? $settings['video_text_link'] : '',
			'video_link'  => isset($settings['video_link']) ? $settings['video_link'] : '',  
			'list-video2' => isset($settings['panel_2']) ? $settings['panel_2'] : '',
			'list-video3' => isset($settings['panel_3']) ? $settings['panel_3'] : '',
		);

		thim_get_widget_template( $this->get_base(), array('instance' => $instance),$settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_List_Video_Element() );
