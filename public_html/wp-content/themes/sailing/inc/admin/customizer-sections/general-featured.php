<?php
thim_customizer()->add_section(
	array(
		'id'       => 'styling_rtl',
		'title'    => esc_html__( 'Featured', 'sailing' ),
		'panel'    => 'general',
		'priority' => 5,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_rtl_support',
		'type'    => 'switch',
		'label'   => esc_html__( 'RTL Support', 'sailing' ),
		'tooltip' => esc_html__( 'Enable/Disable setting.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'thim_disable_style_blocks_woo',
		'label'    => esc_html__( 'Disable Styles for WooCommerce blocks', 'sailing' ),
		'tooltip'  => esc_html__( 'disable block editor styles for WooCommerce blocks', 'sailing' ),
		'section'  => 'styling_rtl',
		'default'  => true,
		// 'priority' => 50,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload',
		'type'    => 'select',
		'label'   => esc_html__( 'Preload Type', 'sailing' ),
		'tooltip' => esc_html__( 'Preload type select.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => 'image',
		'choices' => array(
			true    => esc_html__( 'CSS 3', 'sailing' ),
			'image' => esc_html__( 'Image', 'sailing' ),
			false   => esc_html__( 'No', 'sailing' ),
		)
	)
);
thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload_circle',
		'type'    => 'switch',
		'label'   => esc_html__( 'Preload Type Css Circle', 'sailing' ),
		'tooltip' => esc_html__( 'Select Preload Type Css Circle.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_preload',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Preload Image', 'sailing' ),
		'tooltip' => esc_html__( 'Preload image setting.', 'sailing' ),
		'section' => 'styling_rtl',
		'js_vars' => array(
			array(
				'element'  => '.main-top',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'default' => TP_THEME_URI . 'assets/images/preload.gif',
	)
);


thim_customizer()->add_field(
	array(
		'id'        => 'thim_preload_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Preload Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Preload background color setting.', 'sailing' ),
		'section'   => 'styling_rtl',
		'default'   => '#ffffff',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'preload',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_google_analytics',
		'type'    => 'text',
		'label'   => esc_html__( 'Enter your ID Google Analytics', 'sailing' ),
		'tooltip' => esc_html__( 'Enter your ID Google Analytics.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => '',
	)
);
