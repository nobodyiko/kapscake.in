<?php
thim_customizer()->add_section(
	array(
		'id'       => 'styling_color',
		'title'    => esc_html__( 'Color Site', 'sailing' ),
		'panel'    => 'general',
		'priority' => 6,
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_body_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Site Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting background site setting.', 'sailing' ),
		'section'   => 'styling_color',
		'default'   => '#ffffff',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_body_primary_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Primary Color Your Site', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting primary color your site.', 'sailing' ),
		'section'   => 'styling_color',
		'default'   => '#2eb0d1',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
                    a,
                    .archive-content .share-post .social-share li a:hover,
                    .archive-content .content-inner .blog_title a:hover,
                    .archive-content .content-inner .entry-meta li a:hover,
                    .comments-area .comment-list-inner li .comment-extra-info a:hover,
                    .thim-widget-event .item-event .content-item h3 a:hover,
                    footer#colophon a:hover,
                    footer#colophon a .fa:hover,
                    input[type="checkbox"]:checked:before,
                    .widget-area aside ul li:hover,
                    .widget-area aside ul li:hover a,
                    .widget-area aside a:hover,
                    .icon-box-title span,
                    .owl-carousel .testimonial-footer .title-regency h6,
                    .owl-carousel .testimonial-footer .title-regency h6 a,
                    .owl-carousel .owl-buttons .owl-prev:hover span,
                    .owl-carousel .owl-buttons owl-next:hover span,
                    .thim-list-posts.homepage .link_read_more a,
                    .thim-social a:hover,
                    .widget_recent_entries ul li a:hover,
                    .quickview .product-info .right .product_meta a:hover,
                    .product-grid .product__title a:hover,
                    .quickview .product-info .right .cart a:hover,
                    .quickview .quick-view-detail:hover,
                    .woocommerce div.product .woocommerce-review-link:hover, 
                    .woocommerce-page div.product .woocommerce-review-link:hover,
                    .woocommerce div.product .product_meta a:hover, 
                    .woocommerce-page div.product .product_meta a:hover,
                    .woocommerce-page div.product .woocommerce-tabs .entry-content #reviews #comments .commentlist li .comment-text .meta strong,
                    .woocommerce div.product .woocommerce-tabs .entry-content #reviews #comments .commentlist li .comment-text .meta strong,
                    .woocommerce .star-rating span::before,
                    .woocommerce-page .star-rating span::before,
                    .woocommerce .star-rating,
                    .woocommerce-page .star-rating,
                    .woocommerce .star-rating:before,
                    .woocommerce-page .star-rating:before,
                    .woocommerce .comment-form-rating a,
                    .woocommerce-page .comment-form-rating a,
                    .woocommerce .comment-form-rating a:hover,
                    .woocommerce-page .comment-form-rating a:hover,
                    .woocommerce .woocommerce-shipping-calculator a,
                    .woocommerce-page .woocommerce-shipping-calculator a,
                    .woocommerce div.woocommerce-message:before,
                    .woocommerce-page div.woocommerce-message:before,
                    .woocommerce div.woocommerce-info:before,
                    .woocommerce-page div.woocommerce-info:before,
                    .list-check li:before,
                    .article-title-wrapper h5 a:hover,
                    .wrapper-box-icon.has_custom_image .sc-heading .heading__primary a:hover,
                    .hb_room_carousel_container .title a:hover,
                    .thim-color,
                    body .rooms .hb_room .title h4 a:hover,
                    body .hb_single_room .price,
                    body .hb_room_carousel_container .item .title h4 a:hover,
                    body .hb_room_carousel_container .text_link a:hover,
                    button.ui-datepicker-trigger i:hover,
                    .thim-title-color:hover,
                    #masthead.header_v3 .navigation .tm-flex .header-left li p span,
                    #masthead.header_v3 .navigation .tm-flex .header-right .thim-search-wrapper .thim-search-form .search-form .search-notice,
                    .wpcf7-form .contact-form-new button:hover,
                    .thim-widget-gallery-images .thim-gallery-images-column .text_wellcome h3
                    ',
				'property' => 'color',
			),
			array(
				'choice'   => 'background-color',
				'element'  => 'body .main-top .overlay-top-header,
                               body .mc4wp-form input[type=submit]:hover,
                               body #back-to-top,
                               body .thim-testimonial-slider:after,
                               body.woocommerce .product span.onsale',
				'property' => 'background-color',
			),
			array(
				'choice'   => 'border-color',
				'element'  => 'body .widget-area aside.widget.newsletter .newsletter-content form input[type="email"]:focus,
                               body .site-content .blog-content article .content-inner .entry-content .readmore a:before,
                               body .thim-search-box .form-search-wrapper .search-form .search-field',
				'property' => 'border-color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_body_border_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Border Site Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting border site setting.', 'sailing' ),
		'section'   => 'styling_color',
		'default'   => '#eeeeee',
		'alpha'     => true,
		'transport' => 'postMessage',
	)
);
