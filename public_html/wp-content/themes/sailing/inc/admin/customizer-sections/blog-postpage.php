<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_postpage',
		'title'    =>  esc_html__( 'Post & Page', 'sailing' ),
		'panel'    => 'blog',
		'priority' => 4,
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_single_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Single & Page Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Single & Page layout setting.', 'sailing' ),
		'section' => 'display_postpage',
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
		'id'      => 'thim_archive_single_hide_title',
		'type'    => 'switch',
		'section' => 'display_postpage',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide title setting.', 'sailing' ),
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_single_top_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Top Image', 'sailing' ),
		'tooltip' => esc_html__( 'Top image for page and post setting.', 'sailing' ),
		'section' => 'display_postpage',
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
		'id'        => 'thim_archive_single_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Heading Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting heading background color post and page.', 'sailing' ),
		'section'   => 'display_postpage',
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
		'id'        => 'thim_archive_single_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting heading text color setting.', 'sailing' ),
		'section'   => 'display_postpage',
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
		'id'      => 'thim_archive_single_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Custom Title', 'sailing' ),
		'tooltip' => esc_html__( 'Enter your custom tile page and post.', 'sailing' ),
		'section' => 'display_postpage',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_single_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Custom Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Enter your custom sub tile page and post.', 'sailing' ),
		'section' => 'display_postpage',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_single_related_post',
		'type'    => 'switch',
		'section' => 'display_postpage',
		'label'   => esc_html__( 'Show Recent Blog', 'sailing' ),
		'tooltip' => esc_html__( 'Show Recent Blog.', 'sailing' ),
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id' => 'thim_archive_single_related_post_column',
		'type' => 'select',
		'label'     => esc_html__('Related Columns', 'sailing'),
		'tooltip'  => esc_html__('Allow to select column related post.', 'sailing'),
		'priority' => 15,
		'default'   => '2',
		'section' => 'display_postpage',
		'choices'  => array(
			'2' => esc_html('2'),
			'3' => esc_html('3'),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_archive_single_related_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);