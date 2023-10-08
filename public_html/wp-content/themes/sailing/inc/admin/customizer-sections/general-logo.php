<?php

thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_logo',
		'type'          => 'image',
		'section'  		=> 'title_tagline',
		'label'    		=> esc_html__( 'Logo', 'sailing' ),
		'tooltip'     	=> esc_html__( 'Allows you to add, remove, change logo on your site. ', 'sailing' ),
		'priority' 		=> 1,
		'default'       => TP_THEME_URI . "assets/images/logo.png",
	)
);

thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_sticky_logo',
		'type'          => 'image',
		'section'  		=> 'title_tagline',
		'label'    		=> esc_html__( 'Sticky Logo', 'sailing' ),
		'tooltip'     	=> esc_html__( 'Allows you to add, remove, change sticky logo on your site. ', 'sailing' ),
		'priority' 		=> 20,
		'default'       => TP_THEME_URI . "assets/images/sticky-logo.png",
	)
);

thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_mobile_logo',
		'type'          => 'image',
		'section'  		=> 'title_tagline',
		'label'    		=> esc_html__( 'Mobile Logo', 'sailing' ),
		'tooltip'     	=> esc_html__( 'Allows you to add, remove, change mobile logo on your site. ', 'sailing' ),
		'priority' 		=> 20,
		'default'       => TP_THEME_URI . "assets/images/sticky-logo.png",
	)
);

thim_customizer()->add_field(
	array(
		'id'          => 'thim_width_logo',
		'type'        => 'dimension',
		'label'       => esc_html__( 'Logo width', 'sailing' ),
		'tooltip'     => esc_html__( 'Allows you to assign a value for logo width. Example: 10px, 3em, 48%, 90vh etc.', 'sailing' ),
		'section'     => 'title_tagline',
		'default'     => '135px',
		'priority'    => 40,
		'choices'     => array(
			'min'  => 100,
			'max'  => 500,
			'step' => 10,
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'width',
				'element'  => 'header#masthead .width-logo',
				'property' => 'width',
			)
		)
	)
);