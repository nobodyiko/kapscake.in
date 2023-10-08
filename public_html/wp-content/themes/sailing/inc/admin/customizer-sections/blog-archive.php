<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_archive',
		'title'    => esc_html__( 'Archive', 'sailing' ),
		'panel'    => 'blog',
		'priority' => 3,
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_cate_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Archive Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Archive layout select.', 'sailing' ),
		'section' => 'display_archive',
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
		'id'      => 'thim_archive_cate_hide_title',
		'type'    => 'switch',
		'label'   => esc_html__( 'Archive Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Archive hiden title setting.', 'sailing' ),
		'section' => 'display_archive',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_cate_top_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Archive Top Image', 'sailing' ),
		'tooltip' => esc_html__( 'Select archive top image.', 'sailing' ),
		'section' => 'display_archive',
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
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_archive_cate_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Archive Heading Background Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting archive heading background color.', 'sailing' ),
		'section'   => 'display_archive',
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
		'id'        => 'thim_archive_cate_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Archive Heading Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting archive heading text color.', 'sailing' ),
		'section'   => 'display_archive',
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
		'id'      => 'thim_archive_cate_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Archive Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Archive sub title setting.', 'sailing' ),
		'default' => '',
		'section' => 'display_archive',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_excerpt_length',
		'type'    => 'number',
		'label'   => esc_html__( 'Archive Excerpt Length', 'sailing' ),
		'tooltip' => esc_html__( 'Enter the number of words you want to cut from the content to be the excerpt of archive page.', 'sailing' ),
		'default' => '20',
		'section' => 'display_archive',
		'choices' => array(
			'max'  => 100,
			'min'  => 10,
			'step' => 10
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_show_read_more',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Read More', 'sailing' ),
		'tooltip' => esc_html__( 'Show read more setting.', 'sailing' ),
		'section' => 'display_archive',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);
