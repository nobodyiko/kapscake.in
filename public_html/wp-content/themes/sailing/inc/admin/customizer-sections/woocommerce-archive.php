<?php
//thim_customizer()->add_section(
//	array(
//		'id'       => 'woo_archive',
//		'title'    => esc_html__( 'Category Products', 'sailing' ),
//		'panel'    => 'woocommerce',
//		'priority' => 3,
//	)
//);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_cate_layout',
		'label'   => esc_html__( 'Archive Layout', 'sailing' ),
		'section' => 'woocommerce_product_catalog',
		'type'    => 'radio-image',
		'choices' => array(
			'full-content'  => TP_THEME_URI . 'assets/images/admin/layout/body-full.png',
			'sidebar-left'  => TP_THEME_URI . 'assets/images/admin/layout/sidebar-left.png',
			'sidebar-right' => TP_THEME_URI . 'assets/images/admin/layout/sidebar-right.png'
		),
		'default' => 'full-content',
		'priority' => 1,
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-3'
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_cate_hide_title',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show title.', 'sailing' ),
		'section' => 'woocommerce_product_catalog',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_cate_top_image',
		'type'     => 'image',
		'label'    => esc_html__( 'Top Image', 'sailing' ),
		'tooltip'  => esc_html__( 'Select Image top header for shop page.', 'sailing' ),
		'section'  => 'woocommerce_product_catalog',
		'default'  => TP_THEME_URI . 'assets/images/bg-blog.jpg',
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
		'id'        => 'thim_woo_cate_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Top Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for heading.', 'sailing' ),
		'section'   => 'woocommerce_product_catalog',
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
		'id'        => 'thim_woo_cate_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color Heading', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for heading.', 'sailing' ),
		'section'   => 'woocommerce_product_catalog',
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
		'id'      => 'thim_woo_cate_style_pagination',
		'type'    => 'select',
		'label'   => esc_html__( 'Type Pagination', 'sailing' ),
		'tooltip' => esc_html__( 'Select Type Pagination.', 'sailing' ),
		'section' => 'woocommerce_product_catalog',
		'default' => 'base',
		'choices' => array(
			'base'  	=> esc_html__( 'Default', 'sailing' ),
			'load-more' => esc_html__( 'Load More', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_cate_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Product Title', 'sailing' ),
		'tooltip' => esc_html__( 'Product Title', 'sailing' ),
		'section' => 'woocommerce_product_catalog',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_cate_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Product Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Product sub title', 'sailing' ),
		'section' => 'woocommerce_product_catalog',
		'default' => '',
	)
);
