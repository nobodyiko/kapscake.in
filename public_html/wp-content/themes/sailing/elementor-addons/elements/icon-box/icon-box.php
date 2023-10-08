<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Icon_Box_Element extends Widget_Base {

	public function get_name() {
		return 'thim-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Thim: Icon Box', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-icon-box';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'icon_box_settings',
			[
				'label' => esc_html__( 'Icon Box Settings', 'sailing' )
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Default value',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label'   => esc_html__( 'Color Title', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => esc_html__( 'Size Heading', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h2' => esc_html__( 'H2', 'sailing' ),
					'h3' => esc_html__( 'H3', 'sailing' ),
					'h4' => esc_html__( 'H4', 'sailing' ),
					'h5' => esc_html__( 'H5', 'sailing' ),
					'h6' => esc_html__( 'H6', 'sailing' )
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'font_heading',
			[
				'label'   => esc_html__( 'Style Heading', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'sailing' ),
					'custom'  => esc_html__( 'Custom', 'sailing' )
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'line_after_title',
			[
				'label'   => esc_html__( 'Show Separator', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'widget_background',
			[
				'label'   => esc_html__( 'Widget Background', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'     => esc_html__( 'None', 'sailing' ),
					'bg_video' => esc_html__( 'Video Background', 'sailing' )
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'self_video',
			[
				'label'       => esc_html__( 'Video', 'sailing' ),
				'description' => esc_html__( 'Select an uploaded video in mp4 format. Other formats, such as webm and ogv will work in some browsers. You can use an online service such as \'http://video.online-convert.com/convert-to-mp4\' to convert your videos to mp4.', 'sailing' ),
				'type'        => Controls_Manager::MEDIA,
				'media_type'  => 'video',
				'condition'   => [
					'widget_background' => [ 'bg_video' ]
				]
			]
		);

		$this->add_control(
			'self_poster',
			[
				'label'     => esc_html__( 'Cover Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'widget_background' => [ 'bg_video' ]
				]
			]
		);

		$this->add_control(
			'css_animation',
			[
				'label'   => esc_html__( 'CSS Animation', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''              => esc_attr__( 'No', 'sailing' ),
					'top-to-bottom' => esc_attr__( 'Top to bottom', 'sailing' ),
					'bottom-to-top' => esc_attr__( 'Bottom to top', 'sailing' ),
					'left-to-right' => esc_attr__( 'Left to right', 'sailing' ),
					'right-to-left' => esc_attr__( 'Right to left', 'sailing' ),
					'appear'        => esc_attr__( 'Appear from center', 'sailing' )
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'custom_heading_settings',
			[
				'label'     => esc_html__( 'Custom Heading Settings', 'sailing' ),
				'condition' => [
					'font_heading' => [ 'custom' ]
				]
			]
		);

		$this->add_control(
			'custom_font_size',
			[
				'label'   => esc_html__( 'Font Size', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '14'
			]
		);

		$this->add_control(
			'custom_font_weight',
			[
				'label'   => esc_html__( 'Custom Font Weight', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__( 'Normal', 'sailing' ),
					'bold'   => esc_html__( 'Bold', 'sailing' ),
					'100'    => esc_html__( '100', 'sailing' ),
					'200'    => esc_html__( '200', 'sailing' ),
					'300'    => esc_html__( '300', 'sailing' ),
					'400'    => esc_html__( '400', 'sailing' ),
					'500'    => esc_html__( '500', 'sailing' ),
					'600'    => esc_html__( '600', 'sailing' ),
					'700'    => esc_html__( '700', 'sailing' ),
					'800'    => esc_html__( '800', 'sailing' ),
					'900'    => esc_html__( '900', 'sailing' ),
				],
				'default' => '300',
			]
		);

		$this->add_control(
			'custom_mg_bt',
			[
				'label'   => esc_html__( 'Margin Bottom', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'desc_group_settings',
			[
				'label' => esc_html__( 'Description Settings', 'sailing' )
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Add description', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Add description', 'sailing' ),
				'default'     => 'Write a short description, that will describe the title or something informational and useful.',
			]
		);

		$this->add_control(
			'custom_font_size_des',
			[
				'label'   => esc_html__( 'Custom Font Size', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '14'
			]
		);

		$this->add_control(
			'custom_font_weight_des',
			[
				'label'   => esc_html__( 'Custom Font Weight', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__( 'Normal', 'sailing' ),
					'bold'   => esc_html__( 'Bold', 'sailing' ),
					'100'    => esc_html__( '100', 'sailing' ),
					'200'    => esc_html__( '200', 'sailing' ),
					'300'    => esc_html__( '300', 'sailing' ),
					'400'    => esc_html__( '400', 'sailing' ),
					'500'    => esc_html__( '500', 'sailing' ),
					'600'    => esc_html__( '600', 'sailing' ),
					'700'    => esc_html__( '700', 'sailing' ),
					'800'    => esc_html__( '800', 'sailing' ),
					'900'    => esc_html__( '900', 'sailing' ),
				],
				'default' => '300',
			]
		);

		$this->add_control(
			'color_description',
			[
				'label'   => esc_html__( 'Color Description', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_group_settings',
			[
				'label' => esc_html__( 'Read More Settings', 'sailing' )
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => false,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'read_more',
			[
				'label'   => esc_html__( 'Apply Link To', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'complete_box' => esc_html__( 'Complete Box', 'sailing' ),
					'title'        => esc_html__( 'Box Title', 'sailing' ),
					'more'         => esc_html__( 'Display Read More', 'sailing' )
				],
				'default' => 'complete_box',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_read_more_group_settings',
			[
				'label'     => esc_html__( 'Button Read More Settings', 'sailing' ),
				'condition' => [
					'read_more' => [ 'more' ]
				]
			]
		);

		$this->add_control(
			'read_text',
			[
				'label'       => esc_html__( 'Read More Text', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Read More Text', 'sailing' ),
				'default'     => 'Read More'
			]
		);

		$this->add_control(
			'read_more_text_color',
			[
				'label'   => esc_html__( 'Text Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'border_read_more_text_color',
			[
				'label'   => esc_html__( 'Border Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'bg_read_more_text_color',
			[
				'label'   => esc_html__( 'Background Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'read_more_text_color_hover',
			[
				'label'   => esc_html__( 'Color Hover', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'bg_read_more_text_hover_color',
			[
				'label'   => esc_html__( 'Background Color Hover', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_type_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'sailing' )
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Apply Link To', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'font-awesome'  => esc_html__( 'Font Awesome Icon', 'sailing' ),
					'font-7-stroke' => esc_html__( 'Font 7 stroke Icon', 'sailing' ),
					'custom'        => esc_html__( 'Custom Image Icon', 'sailing' )
				],
				'default' => 'font-awesome',
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => esc_html__( 'Select Icon:', 'sailing' ),
				'type'        => Controls_Manager::ICON,
				'placeholder' => esc_html__( 'Choose...', 'sailing' ),
				'condition'   => [
					'icon_type' => [ 'font-awesome' ]
				]
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'     => __( 'Icon Font Size (px)', 'sailing' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 14,
				'min'       => 0,
				'step'      => 1,
				'condition' => [
					'icon_type' => [ 'font-awesome' ]
				]
			]
		);

		$this->add_control(
			'stroke_icon',
			[
				'label'       => esc_html__( 'Select Icon:', 'sailing' ),
				'type'        => Controls_Manager::ICON,
				'placeholder' => esc_html__( 'Choose...', 'sailing' ),
				'options'     => \Thim_Elementor_Extend_Icons::get_font_7_stroke(),
				'exclude'     => array_keys( Control_Icon::get_icons() ),
				'condition'   => [
					'icon_type' => [ 'font-7-stroke' ]
				]
			]
		);

		$this->add_control(
			'stroke_icon_size',
			[
				'label'     => __( 'Icon Font Size (px)', 'sailing' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 14,
				'min'       => 0,
				'step'      => 1,
				'condition' => [
					'icon_type' => [ 'font-7-stroke' ]
				]
			]
		);

		$this->add_control(
			'icon_img',
			[
				'label'     => esc_html__( 'Choose Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'custom' ]
				]
			]
		);

		$this->add_control(
			'width_icon_box',
			[
				'label'   => __( 'Width Box Icon', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 100,
				'min'     => 0,
				'step'    => 1
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color_group_settings',
			[
				'label' => esc_html__( 'Color Settings', 'sailing' ),
				'condition' => [
					'icon_type' => [ 'font-7-stroke','font-awesome' ]
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'   => esc_html__( 'Icon Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'   => esc_html__( 'Border Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'   => esc_html__( 'Background Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'   => esc_html__( 'Hover Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label'   => esc_html__( 'Boder Hover Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->add_control(
			'icon_bg_color_hover',
			[
				'label'   => esc_html__( 'Background Hover Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_group_settings',
			[
				'label' => esc_html__( 'Layout Settings', 'sailing' )
			]
		);

		$this->add_control(
			'box_icon_style',
			[
				'label'   => esc_html__( 'Size Heading', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => esc_html__( 'None', 'sailing' ),
					'circle' => esc_html__( 'Circle', 'sailing' )
				],
				'default' => '',
			]
		);

		$this->add_control(
			'pos',
			[
				'label'   => esc_html__( 'Icon Position', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'sailing' ),
					'right' => esc_html__( 'Right', 'sailing' ),
					'top'   => esc_html__( 'Top', 'sailing' )
				],
				'default' => 'top',
			]
		);

		$this->add_control(
			'text_align_sc',
			[
				'label'   => esc_html__( 'Text Align', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'text-left'   => esc_html__( 'Left', 'sailing' ),
					'text-right'  => esc_html__( 'Right', 'sailing' ),
					'text-center' => esc_html__( 'Center', 'sailing' )
				],
				'default' => 'text-center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_group_settings',
			[
				'label'     => esc_html__( 'Video Settings', 'sailing' ),
				'condition' => [
					'widget_background' => [ 'bg_video' ]
				]
			]
		);

		$this->add_control(
			'auto_play',
			[
				'label'   => esc_html__( 'Auto Play', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'auto_hidden',
			[
				'label'   => esc_html__( 'Auto Hiden', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'muted',
			[
				'label'   => esc_html__( 'Muted', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'sailing' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'icon_type'         => $settings['icon_type'],
			'width_icon_box'    => $settings['width_icon_box'],
			'widget_background' => $settings['widget_background'],
			'self_video'        => isset( $settings['self_video']['id'] ) ? $settings['self_video']['id'] : '',
			'self_poster'       => isset( $settings['self_poster']['id'] ) ? $settings['self_poster']['id'] : '',
			'css_animation'     => $settings['css_animation']
		);

		$instance['title_group'] = array(
			'title'            => $settings['title'],
			'color_title'      => $settings['color_title'],
			'size'             => $settings['size'],
			'font_heading'     => $settings['font_heading'],
			'line_after_title' => $settings['line_after_title'],
			'custom_heading'   => array(
				'custom_font_size'   => $settings['custom_font_size'],
				'custom_font_weight' => $settings['custom_font_weight'],
				'custom_mg_bt'       => $settings['custom_mg_bt'],
			)
		);

		$instance['desc_group'] = array(
			'content'              => $settings['content'],
			'custom_font_size_des' => $settings['custom_font_size_des'],
			'custom_font_weight'   => $settings['custom_font_weight_des'],
			'color_description'    => $settings['color_description']
		);

		$instance['read_more_group'] = array(
			'link'                   => $settings['link']['url'],
			'read_more'              => $settings['read_more'],
			'button_read_more_group' => array(
				'read_text'                  => $settings['read_text'],
				'read_more_text_color'       => $settings['read_more_text_color'],
				'border_read_more_text'      => $settings['border_read_more_text_color'],
				'bg_read_more_text'          => $settings['bg_read_more_text_color'],
				'read_more_text_color_hover' => $settings['read_more_text_color_hover'],
				'bg_read_more_text_hover'    => $settings['bg_read_more_text_hover_color']
			)
		);

		$instance['font_7_stroke_group'] = array(
			'icon'      => $settings['stroke_icon'],
			'icon_size' => $settings['stroke_icon_size'],
		);

		$instance['font_awesome_group'] = array(
			'icon'      => $settings['icon'],
			'icon_size' => $settings['icon_size']
		);

		$instance['font_image_group']['icon_img'] = isset( $settings['icon_img']['id'] ) ? $settings['icon_img']['id'] : '';

		$instance['color_group'] = array(
			'icon_color'              => $settings['icon_color'],
			'icon_border_color'       => $settings['icon_border_color'],
			'icon_bg_color'           => $settings['icon_bg_color'],
			'icon_hover_color'        => $settings['icon_hover_color'],
			'icon_border_color_hover' => $settings['icon_border_color_hover'],
			'icon_bg_color_hover'     => $settings['icon_bg_color_hover']
		);

		$instance['layout_group'] = array(
			'box_icon_style' => $settings['box_icon_style'],
			'pos'            => $settings['pos'],
			'text_align_sc'  => $settings['text_align_sc'],
		);

		$instance['video_group'] = array(
			'auto_play'   => $settings['auto_play'],
			'auto_hidden' => $settings['auto_hidden'],
			'muted'       => $settings['muted'],
			'loop'        => $settings['loop']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Icon_Box_Element() );
