<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_front_page',
		'title'    => esc_html__( 'Blog Page', 'sailing' ),
		'panel'    => 'blog',
		'priority' => 2,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_front_page_cate_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Blog page layout setting.', 'sailing' ),
		'section' => 'display_front_page',
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
		'id'      => 'thim_front_page_hide_title',
		'type'    => 'switch',
		'section' => 'display_front_page',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide title blog page setting.', 'sailing' ),
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);


thim_customizer()->add_field( array(
	'id'      => 'thim_front_page_top_image',
	'type'    => 'image',
	'label'   => esc_html__( 'Top Image', 'sailing' ),
	'tooltip' => esc_html__( 'Select top image for blog page.', 'sailing' ),
	'section' => 'display_front_page',
	'js_vars' => array(
		array(
			'element'  => '.top_site_main',
			'function' => 'css',
			'property' => 'background-image',
		),
	),
	'default' => TP_THEME_URI . 'assets/images/bg-blog.jpg',
	'active_callback' => array(
		array(
			'setting'  => 'thim_top_site_main_layout',
			'operator' => '==',
			'value'    => 'layout-1',
		),
	),
) );

thim_customizer()->add_field(
	array(
		'id'        => 'thim_front_page_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Background Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting background color top heading blog page.', 'sailing' ),
		'section'   => 'display_front_page',
		'default'   => '#ffffff',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.top_site_main.images_parallax:before',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_front_page_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting color top heading blog page.', 'sailing' ),
		'section'   => 'display_front_page',
		'default'   => '#ffffff',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.top_site_main .page-title-wrapper .banner-wrapper .heading__secondary',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_front_page_custom_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Custom Title', 'sailing' ),
		'tooltip' => esc_html__( 'Enter blog page custom title.', 'sailing' ),
		'section' => 'display_front_page',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_front_page_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Enter blog page sub title.', 'sailing' ),
		'section' => 'display_front_page',
		'default' => '',
	)
);
