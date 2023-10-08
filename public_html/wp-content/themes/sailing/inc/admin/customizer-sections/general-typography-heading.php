<?php
/**
 * Group Headings Typography
 *
 * @package Sailing
 */

// Body_Typography_Group
thim_customizer()->add_group( array(
	'id'       => 'heading_typography',
	'section'  => 'typography',
	'priority' => 10,
	'groups'   => array(
		array(
			'id'     => 'thim_heading_group',
			'label'  => esc_html__( 'Headings', 'sailing' ),
			'fields' => array(
				array(
					'id'        => 'thim_font_title',
					'label'     => esc_html__( 'Heading Font-Family', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select font-family for headings (h1, h2, h3, h4, h5, h6)', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 10,
					'default'   => array(
						'font-family' => 'Crimson Text',
						'color'       => '#2a2a2a',
						'variant'     => '600',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-family',
							'element'  => 'h1, h2, h3, h4, h5, h6, body h1 a, body h2 a, body h3 a, body h4 a, body h5 a, body h6 a',
							'property' => 'font-family',
						),
						array(
							'choice'   => 'color',
							'element'  => 'body h1, body h2, body h3, body h4, body h5, body h6,
							 body h1 a, body h2 a, body h3 a, body h4 a, body h5 a, body h6 a, article .entry-title a,
                                            .comment-edit-link:hover,
                                            .comment-reply-link:hover,
                                            .reply-title,
                                            body .sc-heading.article_heading .heading_primary,
                                            body .site-content .blog-content article .entry-title a, 
                                            body .site-content .page-content article .entry-title a',
							'property' => 'color',
						),
						array(
							'choice'   => 'variant',
							'element'  => 'h1, h2, h3, h4, h5, h6',
							'property' => 'font-weight',
						),
					)
				),
//				array(
//		            'id'        => 'thim_multiple_variants_fonts',
//		            'label'     => esc_html__( 'Select variants fonts', 'sailing' ),
//		            'tooltip'  => esc_html__( 'Allows you to select multiple variants for font body and headings', 'sailing' ),
//		            'description'  => esc_html__( 'Allows you to select multiple variants for font body and headings', 'sailing' ),
//		            'type'      => 'select',
//		            'multiple'      => 999,
//		            'priority'    => 10,
//		            'choices'     => Kirki_Fonts::get_all_variants(),
//	            ),
				// H1  Fonts
				array(
					'id'        => 'thim_font_h1',
					'label'     => esc_html__( 'Heading 1', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H1 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 10,
					'default'   => array(
						'font-size'      => '30px',
						'line-height'    => '1.3',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h1',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h1',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h1',
							'property' => 'text-transform',
						),
					),
				),
				// H2  Fonts
				array(
					'id'        => 'thim_font_h2',
					'label'     => esc_html__( 'Heading 2', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H2 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 20,
					'default'   => array(
						'font-size'      => '26px',
						'line-height'    => '1.2',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h2',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h2',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h2',
							'property' => 'text-transform',
						),
					)
				),
				// H3 Fonts
				array(
					'id'        => 'thim_font_h3',
					'label'     => esc_html__( 'Heading 3', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H3 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 30,
					'default'   => array(
						'font-size'      => '24px',
						'line-height'    => '1.2',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h3',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h3',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h3',
							'property' => 'text-transform',
						),
					)
				),
				// H4 Fonts
				array(
					'id'        => 'thim_font_h4',
					'label'     => esc_html__( 'Heading 4', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H4 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 40,
					'default'   => array(
						'font-size'      => '20px',
						'line-height'    => '1.2',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h4',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h4',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h4',
							'property' => 'text-transform',
						),
					)
				),
				// H5 Fonts
				array(
					'id'        => 'thim_font_h5',
					'label'     => esc_html__( 'Heading 5', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H5 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 50,
					'default'   => array(
						'font-size'      => '20px',
						'line-height'    => '1.2',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h5',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h5',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h5',
							'property' => 'text-transform',
						),
					)
				),
				// H6 Fonts
				array(
					'id'        => 'thim_font_h6',
					'label'     => esc_html__( 'Heading 6', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of H6 tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 60,
					'default'   => array(
						'font-size'      => '18px',
						'line-height'    => '1.2',
						'text-transform' => 'capitalize',
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-size',
							'element'  => 'body h6',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body h6',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'text-transform',
							'element'  => 'body h6',
							'property' => 'text-transform',
						),
					)
				),
			),
		),
	)
) );
