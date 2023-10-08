<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Social_Element extends Widget_Base {

	public function get_name() {
		return 'thim-social';
	}

	public function get_title() {
		return esc_html__( 'Thim: Social', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-social';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'social_settings',
			[
				'label' => esc_html__( 'Social Settings', 'sailing' )
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'version',
			[
				'label'   => esc_html__( 'Version', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base' => esc_html__( 'Old', 'sailing' ),
					'new'  => esc_html__( 'New', 'sailing' ),
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'link_face',
			[
				'label'       => esc_html__( 'Enter Link Facebook', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Facebook', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_twitter',
			[
				'label'       => esc_html__( 'Enter Link Twitter', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Twitter', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_google',
			[
				'label'       => esc_html__( 'Enter Link Google', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Google', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_dribble',
			[
				'label'       => esc_html__( 'Enter Link Dribble', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Dribble', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_linkedin',
			[
				'label'       => esc_html__( 'Enter Link Linkedin', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Linkedin', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_pinterest',
			[
				'label'       => esc_html__( 'Enter Link Pinterest', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Pinterest', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_digg',
			[
				'label'       => esc_html__( 'Enter Link Digg', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Digg', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_youtube',
			[
				'label'       => esc_html__( 'Enter Link Youtube', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Youtube', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_instagram',
			[
				'label'       => esc_html__( 'Enter Link Instagram', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Link Instagram', 'sailing' ),
				'label_block' => true,
				'condition'   => [
					'version' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'   => esc_html__( 'Link Target', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'_self'  => esc_html__( 'Same window', 'sailing' ),
					'_blank' => esc_html__( 'New window', 'sailing' ),
				],
				'default' => '_self',
			]
		);

		$this->add_control(
			'ref',
			[
				'label'   => esc_html__( 'Rel Attribute', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''         => esc_html__( 'Default', 'sailing' ),
					'nofollow' => esc_html__( 'Nofollow', 'sailing' ),
				],
				'default' => '',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_name',
			[
				'label'   => esc_html__( 'Social Name', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'foursquare'  => esc_attr__( 'Foursquare', 'sailing' ),
					'tripadvisor' => esc_attr__( 'Tripadvisor', 'sailing' ),
					'yelp'        => esc_attr__( 'Yelp', 'sailing' ),
					'facebook'    => esc_attr__( 'Facebook', 'sailing' ),
					'twitter'     => esc_attr__( 'Twitter', 'sailing' ),
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
				],
				'default' => 'facebook',
			]
		);

		$repeater->add_control(
			'social_url',
			[
				'label'       => esc_html__( 'Social URL', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Social URL', 'sailing' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'panel',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ social_name }}}',
				'separator'   => 'before',
				'condition'   => [
					'version' => [ 'new' ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'title'          => $settings['title'],
			'link_face'      => $settings['link_face'],
			'link_twitter'   => $settings['link_twitter'],
			'link_google'    => $settings['link_google'],
			'link_dribble'   => $settings['link_dribble'],
			'link_linkedin'  => $settings['link_linkedin'],
			'link_pinterest' => $settings['link_pinterest'],
			'link_digg'      => $settings['link_digg'],
			'link_youtube'   => $settings['link_youtube'],
			'link_instagram' => $settings['link_instagram'],
			'version'        => $settings['version'],
			'link_target'    => $settings['link_target'],
			'ref'            => $settings['ref'],
			'new_version'    => $settings['panel']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['version'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Social_Element() );
