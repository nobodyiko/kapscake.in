<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_blog_settings',
		'title'    => esc_html__( 'Setting', 'sailing' ),
		'panel'    => 'blog',
		'priority' => 1,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_blog_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Blog page layout setting.', 'sailing' ),
		'section' => 'display_blog_settings',
		'choices' => array(
			'layout-1'  => TP_THEME_URI . 'assets/images/admin/layout/blog-layout-1.jpg',
			'layout-2'  => TP_THEME_URI . 'assets/images/admin/layout/blog-layout-2.jpg',
		),
		'default' => 'layout-1',
		'priority' => 10,
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-2'
		)
	)
);

//Number Column
thim_customizer()->add_field(
	array(
		'id' => 'thim_archive_column_grid',
		'type' => 'select',
		'label'     => esc_html__('Grid Columns', 'sailing'),
		'tooltip'  => esc_html__('Allow to select a column grid.', 'sailing'),
		'priority' => 15,
		'default'   => '3',
		'section' => 'display_blog_settings',
		'choices'  => array(
			'2' => esc_html('2'),
			'3' => esc_html('3'),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_blog_layout',
				'operator' => '==',
				'value'    => 'layout-2',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_single_show_category',
		'type'    => 'switch',
		'section' => 'display_blog_settings',
		'label'   => esc_html__( 'Show Category', 'sailing' ),
		'tooltip' => esc_html__( 'Show category setting.', 'sailing' ),
		'default' => true,
		'priority' => 20,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_single_show_date',
		'type'    => 'switch',
		'section' => 'display_blog_settings',
		'label'   => esc_html__( 'Show Date', 'sailing' ),
		'tooltip' => esc_html__( 'Show date setting.', 'sailing' ),
		'default' => true,
		'priority' => 25,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_single_show_author',
		'type'    => 'switch',
		'section' => 'display_blog_settings',
		'label'   => esc_html__( 'Show Author', 'sailing' ),
		'tooltip' => esc_html__( 'Show author setting.', 'sailing' ),
		'default' => true,
		'priority' => 30,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_single_show_comment',
		'type'    => 'switch',
		'section' => 'display_blog_settings',
		'label'   => esc_html__( 'Show Comment', 'sailing' ),
		'tooltip' => esc_html__( 'Show comment setting.', 'sailing' ),
		'default' => true,
		'priority' => 35,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);
