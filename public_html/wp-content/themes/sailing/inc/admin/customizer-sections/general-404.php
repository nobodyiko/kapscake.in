<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_page_404',
		'title'    => esc_html__( '404', 'sailing' ),
		'panel'    => 'general',
		'priority' => 12,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_404_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Image 404', 'sailing' ),
		'tooltip' => esc_html__( 'Select image file for 404.', 'sailing' ),
		'section' => 'display_page_404',
		'default' => TP_THEME_URI . "assets/images/404.png",
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_404_custom_text',
		'type'    => 'text',
		'label'   => esc_html__( 'Custom Text', 'sailing' ),
		'tooltip' => esc_html__( 'Enter custom text for 404.', 'sailing' ),
		'section' => 'display_page_404',
		'default' => esc_html__( 'Sorry, we couldn\'t find the page you\'re looking for.', 'sailing' ),
	)
);