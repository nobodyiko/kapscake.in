<?php
/*
 * Single Hotel Booking Display Settings
 */
thim_customizer()->add_section(
	array(
		'id'       => 'hb_single',
		'title'    => esc_html__( 'Single', 'sailing' ),
		'panel'    => 'hotel-booking',
		'priority' => 2,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_layout',
		'label'   => esc_html__( 'Single Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Single Layout', 'sailing' ),
		'type'    => 'radio-image',
		'section' => 'hb_single',
		'choices' => array(
			'full-content'  => TP_THEME_URI . 'assets/images/admin/layout/body-full.png',
			'sidebar-left'  => TP_THEME_URI . 'assets/images/admin/layout/sidebar-left.png',
			'sidebar-right' => TP_THEME_URI . 'assets/images/admin/layout/sidebar-right.png'
		),
		'default' => 'sidebar-right',
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-3'
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_style',
		'label'   => esc_html__( 'Single Style Content', 'sailing' ),
		'tooltip' => esc_html__( 'Allow to choose a Style to display for all single post pages.', 'sailing' ),
		'type'    => 'radio-image',
		'section' => 'hb_single',
		'choices' => array(
			'layout-1'  => TP_THEME_URI . 'assets/images/admin/layout/single-room-layout-1.jpg',
			'layout-2'  => TP_THEME_URI . 'assets/images/admin/layout/single-room-layout-2.jpg',
		),
		'default' => 'layout-1',
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-2'
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_hide_title',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show title.', 'sailing' ),
		'section' => 'hb_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_custom_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Single Room Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hotel Booking Title', 'sailing' ),
		'section' => 'hb_single',
		'default' => 'Sailing Hotel',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Sub Title', 'sailing' ),
		'section' => 'hb_single',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_top_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Top Image', 'sailing' ),
		'tooltip' => esc_html__( 'Select Image top header for our team page.', 'sailing' ),
		'section' => 'hb_single',
		'default' => TP_THEME_URI . 'assets/images/bg-blog.jpg',
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout',
				'operator' => '==',
				'value'    => 'layout-1',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_single_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'sailing' ),
		'section'   => 'hb_single',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main',
				'property' => 'background-color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_single_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color Heading', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'sailing' ),
		'section'   => 'hb_single',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main .page-title-wrapper .banner-wrapper .heading__secondary',
				'property' => 'color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_hide_desc',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Description', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show Description.', 'sailing' ),
		'section' => 'hb_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_hide_info',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Additional Information', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show Additional Information.', 'sailing' ),
		'section' => 'hb_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_hide_reviews',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Reviews', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show Reviews.', 'sailing' ),
		'section' => 'hb_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_show_book_email',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show book email', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show book email.', 'sailing' ),
		'section' => 'hb_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_single_shortcode_book_email',
		'type'    => 'text',
		'label'   => esc_html__( 'Contact Form 7 Shortcode ID', 'sailing' ),
		'tooltip' => esc_html__( 'Contact Form 7 Shortcode ID', 'sailing' ),
		'section' => 'hb_single',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_single_top_content_bg',
		'type'      => 'color',
		'label'     => esc_html__( 'Top Content Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for content top single room.', 'sailing' ),
		'section'   => 'hb_single',
		'default'   => '#FFF4EC',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'thim_hb_single_style',
				'operator' => '==',
				'value'    => 'layout-2',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_single_top_content_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Top Content Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Color for content top single room.', 'sailing' ),
		'section'   => 'hb_single',
		'default'   => '#000000',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'thim_hb_single_style',
				'operator' => '==',
				'value'    => 'layout-2',
			),
		),
	)
);