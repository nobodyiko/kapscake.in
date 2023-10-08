<?php
/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 05/19/2018
 * Time: 9:34 AM
 */
/**
 * Info theme into dashboard
 * @return array
 */
function config_links_guide_user() {
	return array(
		'docs'      => 'http://docspress.thimpress.com/sailing/',
		'support'   => 'https://thimpress.com/forums/forum/sailing/',
		'knowledge' => 'https://thimpress.com/knowledge-base/',
	);
}

add_filter( 'thim_theme_links_guide_user', 'config_links_guide_user', 9999 );
/**
 * List child themes.
 *
 * @return array
 */
function thim_sailing_list_child_themes() {
	return array(
		'sailing-child' => array(
			'name'       => 'Sailing Child',
			'slug'       => 'sailing-child',
			'screenshot' => 'https://thimpresswp.github.io/demo-data/sailing/child-themes/sailing-child.jpg',
			'source'     => 'https://thimpresswp.github.io/demo-data/sailing/child-themes/sailing-child.zip',
			'version'    => '1.0.0'
		),
	);
}

add_filter( 'thim_core_list_child_themes', 'thim_sailing_list_child_themes' );

add_filter( 'thim_core_installer_theme_config', function () {
	return array(
		'name'          => __( 'Sailing', 'sailing' ),
		'slug'          => 'sailing',
		'support_link'  => 'https://thimpress.com/forums/forum/sailing/',
		'installer_uri' => get_template_directory_uri() . '/inc/admin/installer'
	);
} );

function thim_sailing_register_meta_boxes_commingsoon( $meta_boxes ) {
	$prefix       = 'thim_';
	$link         = 'http://video.online-convert.com/convert-to-mp4';
	$copy_right   = 'http://www.thimpress.com';
	$meta_boxes[] = array(
		'id'         => 'coming-soon-mode-options',
		'title'      => __( 'Coming Soon Mode Options', 'sailing' ),
		'post_types' => 'page',
		'fields'     => array(
			array(
				'name' => esc_html__( 'Logo Page', 'sailing' ),
				'id'   => $prefix . 'coming_soon_logo',
				'type' => 'image_advanced',
				'desc' => esc_html__( 'Upload your logo', 'sailing' )
			),
			array(
				'name'    => esc_html__( 'Cover Color', 'sailing' ),
				'id'      => $prefix . 'cover_color',
				'type'    => 'select',
				'options' => array(
					'black'  => esc_html__( 'Black', 'sailing' ),
					'blue'   => esc_html__( 'Blue', 'sailing' ),
					'green'  => esc_html__( 'Green', 'sailing' ),
					'orange' => esc_html__( 'Orange', 'sailing' ),
					'red'    => esc_html__( 'Red', 'sailing' ),
				),
				'default' => 'black',
			),
			array(
				'name' => 'link video ogg/webm',
				'id'   => $prefix . 'link_ogg',
				'type' => 'text',
			),
			array(
				'name' => 'link video mp4',
				'id'   => $prefix . 'link_mp4',
				'type' => 'text',
				'desc' => esc_html__( "Select an uploaded video in mp4 format. Other formats, such as webm and ogv will work in some browsers. You can use an online service such as <a href='http://video.online-convert.com/convert-to-mp4' target='_blank'>online-convert.com</a> to convert your videos to mp4.", "sailing" ),
			),
			array(
				'name' => esc_html__( 'Text Color', 'sailing' ),
				'id'   => $prefix . 'text_color',
				'type' => 'color',
			),
			array(
				'name'    => esc_html__( 'Date Option', 'sailing' ),
				'id'      => $prefix . 'coming_soon_date',
				'type'    => 'text',
				'desc'    => esc_html__( 'Choose a date', 'sailing' ),
				'default' => '',
			),
			array(
				'name'    => esc_html__( 'Title From', 'sailing' ),
				'id'      => $prefix . 'title_form',
				'type'    => 'text',
				'default' => esc_html__( 'Register now and be among the first to know more.', 'sailing' )
			),
			array(
				'name' => esc_html__( 'ShortCode Form', 'sailing' ),
				'id'   => $prefix . 'form_mail_letter',
				'type' => 'text',
			),
			array(
				'name'    => esc_html__( 'Copyright Text', 'sailing' ),
				'id'      => $prefix . 'text_copyright',
				'type'    => 'text',
				'default' => 'Powered By <a href="' . $copy_right . '">ThimPress</a>adot &copy; 2015',
			)
		)
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'thim_sailing_register_meta_boxes_commingsoon' );

function thim_sailing_register_meta_boxes_event( $meta_boxes ) {
	$prefix       = 'thim_';
	$meta_boxes[] = array(
		'id'         => 'event-options',
		'title'      => __( 'Event Options', 'sailing' ),
		'post_types' => 'post',
		'fields'     => array(
			array(
				'name' => esc_html__( 'Use Page Event', 'sailing' ),
				'id'   => $prefix . 'use_event',
				'type' => 'checkbox',
				'desc' => ' '
			),
			array(
				'name'    => esc_html__( 'Desc', 'sailing' ),
				'id'      => $prefix . 'desc',
				'type'    => 'text',
				'default' => '',
			),
			array(
				'name'    => esc_html__( 'Start Date', 'sailing' ),
				'id'      => $prefix . 'start_date',
				'type'    => 'date',
				'desc'    => esc_html__( 'Choose a date', 'sailing' ),
				'default' => '',
			),
			array(
				'name'    => esc_html__( 'End Date', 'sailing' ),
				'id'      => $prefix . 'end_date',
				'type'    => 'date',
				'desc'    => esc_html__( 'Choose a date', 'sailing' ),
				'default' => '',
			)
		)
	);

	return $meta_boxes;
}

//add_filter( 'rwmb_meta_boxes', 'thim_sailing_register_meta_boxes_event' );

//Filter meta-box
add_filter( 'thim_metabox_display_settings', 'thim_add_metabox_settings', 100, 2 );
if ( ! function_exists( 'thim_add_metabox_settings' ) ) {

	function thim_add_metabox_settings( $meta_box, $prefix ) {
		if ( defined( 'THIM_CORE_VERSION' ) && version_compare( THIM_CORE_VERSION, '1.0.3', '>' ) ) {
			if ( isset( $_GET['post'] ) ) {
				if ( $_GET['post'] == get_option( 'page_on_front' ) || $_GET['post'] == get_option( 'page_for_posts' ) ) {
					return false;
				}
			}
		}

		$meta_box['post_types'] = array(
			'page',
			'post',
			'our_team',
			'testimonials',
			'product',
			'hb_room',
		);

		$prefix = 'thim_mtb_';

		$meta_box['fields'] = array(
			/**
			 * Custom Title and Subtitle.
			 */
			array(
				'name' => __( 'Custom Title and Subtitle', 'sailing' ),
				'id'   => $prefix . 'using_custom_heading',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'title',
			),
			array(
				'name'   => __( 'Hide Title and Subtitle', 'sailing' ),
				'id'     => $prefix . 'hide_title_and_subtitle',
				'type'   => 'checkbox',
				'std'    => false,
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Custom Title', 'sailing' ),
				'id'     => $prefix . 'custom_title',
				'type'   => 'text',
				'desc'   => __( 'Leave empty to use post title', 'sailing' ),
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Color Title', 'sailing' ),
				'id'     => $prefix . 'text_color',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Subtitle', 'sailing' ),
				'id'     => 'thim_subtitle',
				'type'   => 'text',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Color Subtitle', 'sailing' ),
				'id'     => $prefix . 'color_sub_title',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Hide Breadcrumbs', 'sailing' ),
				'id'     => $prefix . 'hide_breadcrumbs',
				'type'   => 'checkbox',
				'std'    => false,
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'             => __( 'Background Image', 'sailing' ),
				'id'               => $prefix . 'top_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'tab'              => 'title',
				'hidden'           => array( $prefix . 'using_custom_heading', '!=', true ),
			),
			array(
				'name'   => __( 'Background color', 'sailing' ),
				'id'     => $prefix . 'bg_color',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),

			/**
			 * Custom layout
			 */
			array(
				'name' => __( 'Use Custom Layout', 'sailing' ),
				'id'   => $prefix . 'custom_layout',
				'type' => 'checkbox',
				'tab'  => 'layout',
				'std'  => false,
			),
			array(
				'name'    => __( 'Select Layout', 'sailing' ),
				'id'      => $prefix . 'layout',
				'type'    => 'image_select',
				'options' => array(
					'sidebar-left'  => TP_THEME_URI . 'assets/images/admin/layout/sidebar-left.png',
					'full-content'  => TP_THEME_URI . 'assets/images/admin/layout/body-full.png',
					'sidebar-right' => TP_THEME_URI . 'assets/images/admin/layout/sidebar-right.png',
				),
				'default' => 'sidebar-right',
				'tab'     => 'layout',
				'hidden'  => array( $prefix . 'custom_layout', '=', false ),
			),
			array(
				'name' => __( 'No Padding Content', 'sailing' ),
				'id'   => $prefix . 'no_padding',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'layout',
			),
		);

		return $meta_box;
	}
}

//Add font
function my_custom_fonts( $standard_fonts ) {
	$fonts['serif']      = array(
		'label' => 'Serif',
		'stack' => 'Georgia,Times,"Times New Roman",serif',
	);
	$fonts['sans-serif'] = array(
		'label' => 'Sans Serif',
		'stack' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
	);
	$fonts['monospace']  = array(
		'label' => 'Monospace',
		'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
	);
	$fonts['arial']      = array(
		'label' => 'Arial',
		'stack' => 'Arial',
	);

	return $fonts;
}

add_filter( 'kirki/fonts/standard_fonts', 'my_custom_fonts' );

/**
 * @param $settings
 *
 * @return array
 */
if ( ! function_exists( 'thim_import_add_page_id_settings' ) ) {
	function thim_import_add_page_id_settings( $settings ) {
		$settings[] = 'elementor_active_kit';

		return $settings;
	}
}
add_filter( 'thim_importer_page_id_settings', 'thim_import_add_page_id_settings' );
