<?php

thim_customizer()->add_section(
	array(
		'id'       => 'styling_pattern',
		'title'    => esc_html__( 'Pattern', 'sailing' ),
		'panel'    => 'general',
		'priority' => 8,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_user_bg_pattern',
		'type'    => 'switch',
		'section' => 'styling_pattern',
		'label'   => esc_html__( 'Use Background Pattern', 'sailing' ),
		'tooltip' => esc_html__( 'Use background pattern if you want.', 'sailing' ),
		'default' => false,
		'priority' => 1,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_bg_pattern',
		'type'     => 'radio-image',
		'label'    => esc_html__( 'Select Pattern', 'sailing' ),
		'tooltip'  => esc_html__( 'Allows you to choose a pattern for site.', 'sailing' ),
		'section'  => 'styling_pattern',
		'default'  => TP_THEME_URI . 'assets/images/patterns/pattern1.png',
		'priority' => 6,
		'choices'  => array(
			TP_THEME_URI . 'assets/images/patterns/pattern1.png'  => TP_THEME_URI . 'assets/images/patterns/pattern1_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern2.png'  => TP_THEME_URI . 'assets/images/patterns/pattern2_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern3.png'  => TP_THEME_URI . 'assets/images/patterns/pattern3_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern4.png'  => TP_THEME_URI . 'assets/images/patterns/pattern4_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern5.png'  => TP_THEME_URI . 'assets/images/patterns/pattern5_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern6.png'  => TP_THEME_URI . 'assets/images/patterns/pattern6_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern7.png'  => TP_THEME_URI . 'assets/images/patterns/pattern7_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern8.png'  => TP_THEME_URI . 'assets/images/patterns/pattern8_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern9.png'  => TP_THEME_URI . 'assets/images/patterns/pattern9_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern10.png' => TP_THEME_URI . 'assets/images/patterns/pattern10_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern11.png' => TP_THEME_URI . 'assets/images/patterns/pattern11_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern12.png' => TP_THEME_URI . 'assets/images/patterns/pattern12_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern13.png' => TP_THEME_URI . 'assets/images/patterns/pattern13_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern14.png' => TP_THEME_URI . 'assets/images/patterns/pattern14_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern15.png' => TP_THEME_URI . 'assets/images/patterns/pattern15_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern16.png' => TP_THEME_URI . 'assets/images/patterns/pattern16_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern17.png' => TP_THEME_URI . 'assets/images/patterns/pattern17_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern18.png' => TP_THEME_URI . 'assets/images/patterns/pattern18_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern19.png' => TP_THEME_URI . 'assets/images/patterns/pattern19_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern20.png' => TP_THEME_URI . 'assets/images/patterns/pattern20_icon.png',
			TP_THEME_URI . 'assets/images/patterns/pattern21.png' => TP_THEME_URI . 'assets/images/patterns/pattern21_icon.png',
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_bg_pattern_upload',
		'type'     => 'image',
		'label'    => esc_html__( 'Background Image', 'sailing' ),
		'tooltip'  => esc_html__( 'Select Image for background site.', 'sailing' ),
		'section'  => 'styling_pattern',
		'priority' => 7,
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_bg_repeat',
		'label'    => esc_html__( 'Background Repeat', 'sailing' ),
		'tooltip'  => esc_html__( 'Select background repeat.', 'sailing' ),
		'default'  => 'repeat',
		'priority' => 8,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'repeat'    => esc_html__( 'repeat', 'sailing' ),
			'repeat-x'  => esc_html__( 'repeat-x', 'sailing' ),
			'repeat-y'  => esc_html__( 'repeat-y', 'sailing' ),
			'no-repeat' => esc_html__( 'no-repeat', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_bg_position',
		'label'    => esc_html__( 'Background Position', 'sailing' ),
		'tooltip'  => esc_html__( 'Select type background position.', 'sailing' ),
		'default'  => 'center center',
		'priority' => 9,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'left top'      => esc_html__( 'Left Top', 'sailing' ),
			'left center'   => esc_html__( 'Left Center', 'sailing' ),
			'left bottom'   => esc_html__( 'Left Bottom', 'sailing' ),
			'right top'     => esc_html__( 'Right Top', 'sailing' ),
			'right center'  => esc_html__( 'Right Center', 'sailing' ),
			'right bottom'  => esc_html__( 'Right Bottom', 'sailing' ),
			'center top'    => esc_html__( 'Center Top', 'sailing' ),
			'center center' => esc_html__( 'Center Center', 'sailing' ),
			'center bottom' => esc_html__( 'Center Bottom', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_bg_attachment',
		'label'    => esc_html__( 'Background Attachment', 'sailing' ),
		'tooltip'  => esc_html__( 'Select background attachment for site.', 'sailing' ),
		'default'  => 'inherit',
		'priority' => 10,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'scroll'  => esc_html__( 'scroll', 'sailing' ),
			'fixed'   => esc_html__( 'fixed', 'sailing' ),
			'local'   => esc_html__( 'local', 'sailing' ),
			'initial' => esc_html__( 'initial', 'sailing' ),
			'inherit' => esc_html__( 'inherit', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_bg_size',
		'label'    => esc_html__( 'Background Size', 'sailing' ),
		'tooltip'  => esc_html__( 'Select background size for site.', 'sailing' ),
		'default'  => 'cover',
		'priority' => 11,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'100% 100%' => esc_html__( '100% 100%', 'sailing' ),
			'contain'   => esc_html__( 'contain', 'sailing' ),
			'cover'     => esc_html__( 'cover', 'sailing' ),
			'inherit'   => esc_html__( 'inherit', 'sailing' ),
			'initial'   => esc_html__( 'initial', 'sailing' ),
		),
	)
);