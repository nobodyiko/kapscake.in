<?php
add_action( 'thim_wrapper_loop_start', 'thim_heading_top', 5 );
if ( ! function_exists( 'thim_heading_top' ) ) :
	function thim_heading_top() {
		global $wp_query;
		/***********custom Top Images*************/
		$bg_header        = $class_full = $text_color_header =
		$bg_image = $thim_custom_heading = $cate_top_image_src = $front_title = '';
		$hide_breadcrumbs = $hide_title = 0;
		// color theme options

		$cat_obj = $wp_query->get_queried_object();

		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		} else {
			$cat_ID = "";
		}
		$text_color = get_theme_mod( 'thim_page_title_heading_text_color', '' );
		$bg_color   = get_theme_mod( 'thim_page_title_heading_bg_color', '' );
		if ( get_theme_mod( 'thim_page_title_top_image' ) <> '' ) {
			$cate_top_image     = get_theme_mod( 'thim_page_title_top_image' );
			$cate_top_image_src = $cate_top_image;
		}

		if ( get_post_type() == "product" ) {
			$prefix = 'thim_woo';
		} else {
			if ( get_post_type() == "hb_room" ) {
				$prefix = 'thim_hb';
			} else {
				if ( is_front_page() || is_home() ) {
					$prefix = 'thim_';
				} else {
					$prefix = 'thim_archive';
				}
			}
		}

		// single and archive
		if ( is_page() || is_single() ) {
			$prefix_inner = '_single_';
		} else {
			if ( is_front_page() || is_home() ) {
				$prefix_inner = 'front_page_';
			} else {
				$prefix_inner = '_cate_';
			}
		}

		// get data for theme customizer
		$custom_title = get_theme_mod( $prefix . $prefix_inner . 'custom_title', '' );
		$text_color   = get_theme_mod( $prefix . $prefix_inner . 'heading_text_color', '' );
		$bg_color     = get_theme_mod( $prefix . $prefix_inner . 'heading_bg_color', '' );
		$subtitle     = get_theme_mod( $prefix . $prefix_inner . 'sub_title', '' );

		//		if ( get_theme_mod( $prefix . $prefix_inner . 'title' ) <> '' ) {
		//			$custom_title = get_theme_mod( $prefix . $prefix_inner . 'title' );
		//		}

		if ( get_theme_mod( $prefix . $prefix_inner . 'top_image' ) <> '' ) {
			$cate_top_image     = get_theme_mod( $prefix . $prefix_inner . 'top_image' );
			$cate_top_image_src = $cate_top_image;
		}

		if ( get_theme_mod( $prefix . $prefix_inner . 'hide_title' ) == 1 ) {
			$hide_title = get_theme_mod( $prefix . $prefix_inner . 'hide_title' );
		}

		$hide_breadcrumbs = get_theme_mod( 'disable_breadcrumb' );
		// Get style from metabox
		if ( is_page() || is_single() || is_front_page() || is_home() ) {
			if ( is_front_page() || is_home() ) {
				$postid = get_option( 'page_for_posts' );
			} elseif ( is_post_type_archive( 'product' ) ) {
				$postid = get_option( 'woocommerce_shop_page_id' );
			} else {
				$postid = get_the_ID();
			}

			$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );

			if ( $using_custom_heading ) {
				if ( get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true ) ) {
					$hide_title = get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true );
				}
				if ( get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true ) ) {
					$hide_breadcrumbs = get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true );
				}
				if ( get_post_meta( $postid, 'thim_mtb_custom_title', true ) ) {
					$custom_title = get_post_meta( $postid, 'thim_mtb_custom_title', true );
				}
				if ( get_post_meta( $postid, 'thim_subtitle', true ) ) {
					$subtitle = get_post_meta( $postid, 'thim_subtitle', true );
				}
				if ( get_post_meta( $postid, 'thim_mtb_text_color', true ) ) {
					$text_color_1 = get_post_meta( $postid, 'thim_mtb_text_color', true );
					if ( $text_color_1 <> '' ) {
						$text_color = $text_color_1;
					}
				}
				if ( get_post_meta( $postid, 'thim_mtb_color_sub_title', true ) ) {
					$sub_color_1 = get_post_meta( $postid, 'thim_mtb_color_sub_title', true );
					if ( $sub_color_1 <> '' ) {
						$sub_color = $sub_color_1;
					}
				}
				$bg_color_1 = '';
				if ( get_post_meta( $postid, 'thim_mtb_bg_color', true ) ) {
					$bg_color_1 = get_post_meta( $postid, 'thim_mtb_bg_color', true );
				}
				if ( $bg_color_1 <> '' ) {
					$bg_color = $bg_color_1;
				}
				if ( get_post_meta( $postid, 'thim_mtb_top_image', true ) ) {
					$thim_heading_top_img = get_post_meta( $postid, 'thim_mtb_top_image', true );
					$thim_heading_top_src = $thim_heading_top_img;

					if ( is_numeric( $thim_heading_top_src ) ) {
						$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
						$cate_top_image_src          = $thim_heading_top_attachment[0];
					}
				}
			}
		}

//		if ( is_front_page() || is_home() ) {
//			$hide_breadcrumbs = 1;
//		}

		//custom in category and room type
		$thim_custom_heading = get_term_meta( $cat_ID, 'thim_custom_heading', true );
		if ( $thim_custom_heading == 'custom' || $thim_custom_heading == 'on' ) {
			$queried_object = get_queried_object();
			if ( $queried_object->taxonomy == "hb_room_type" ) {
				$top_image = get_term_meta( $cat_ID, 'thim_hb_room_top_image', true );
			} elseif ( $queried_object->taxonomy == 'product_cat' ) {
				$top_image = get_term_meta( $cat_ID, 'thim_woo_top_image', true );
			}

			if ( ! empty( $top_image ) ) {
				$cate_top_image_src = $top_image['url'];
			}
		}

		$cate_top_image_src = thim_ssl_secure_url( $cate_top_image_src );
		$hide_title         = ( $hide_title == 1 ) ? true : false;
		// css
		$c_css_style = '';
		$c_css_style .= ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
		$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
		$c_css_style .= ( $cate_top_image_src != '' ) ? 'background-image: url(' . $cate_top_image_src . ');' : '';
		//css background and color
		$c_css = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';
		// show title and category
		if ( get_post_type() == 'hb_room' ) {
			//Custom title for page hotel-booking
			$custom_title = ( get_theme_mod( 'thim_hb_cate_custom_title' ) == true ) ? get_theme_mod( 'thim_hb_cate_custom_title' ) : esc_html__( 'Hotel Booking', 'sailing' );
			//Custom title for single room page hotel-booking
			if ( is_single() ) {
				$custom_title = ( get_theme_mod( 'thim_hb_single_custom_title' ) == true ) ? get_theme_mod( 'thim_hb_single_custom_title' ) : esc_html__( 'Single Room Title', 'sailing' );
			}
		}

		if ( is_page() ) {
			$typography = 'h1';
		} else {
			$typography = 'h2';
		}

		if ( $cate_top_image_src == '' ) {
			$class_parallax = ' top-site-no-image';
			if ( $hide_title == true && ( get_theme_mod( 'thim_header_position' ) ) ) {
				$class_parallax = ' top-site-no-image-custom';
			} elseif ( $hide_title == true && ( get_theme_mod( 'thim_header_position' ) != true ) ) {
				$class_parallax = ' no_top_site_main';
			}
		} else {
			$class_parallax = ' images_parallax';
			$c_css          .= ' data-parallax_images="scroll"';
			$c_css          .= ' data-image-src="' . esc_url( $cate_top_image_src ) . '"';
		}
		$class_parallax .= ' ' . get_theme_mod( 'thim_top_site_main_layout' );
		if ( $hide_title == false || $hide_breadcrumbs != '1' || get_theme_mod( 'thim_header_position' ) ) {
			?>
			<div class="top_site_main<?php echo esc_attr( $class_parallax ); ?>" <?php echo ent2ncr( $c_css ); ?>>
				<div class="page-title-wrapper">
					<div class="banner-wrapper container article_heading">
						<?php
						if ( get_theme_mod( 'thim_top_site_main_layout', 'layout-1' ) == 'layout-1' ) {
							if ( $hide_title == false ) {
								echo '<' . $typography . ' class="heading__secondary">' . thim_get_page_title( $custom_title, '' ) . '</' . $typography . '>';
							}
							echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
						}
						if ( $hide_breadcrumbs != '1' ) {
							if ( defined( 'THIM_CORE_VERSION' ) && version_compare( THIM_CORE_VERSION, '2.1.3', '<' ) ) {
								thim_breadcrumbs();
							} else {
								do_action( 'thim_breadcrumbs' );
							}
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		if ( get_theme_mod( 'thim_top_site_main_layout', 'layout-1' ) == 'layout-2' ) {
			echo '<div class="thim-article-heading"><div class="container">';
			if ( $hide_title == false || ($using_custom_heading == true && get_post_meta( $postid, 'thim_mtb_custom_title', true ) != '') ) {
				echo '<' . $typography . ' class="heading__secondary">' . thim_get_page_title( $custom_title, '' ) . '</' . $typography . '>';
			}
			echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
			echo '</div></div>';
		}
	}
endif;

/**
 * Get page title
 */
if ( ! function_exists( 'thim_get_page_title' ) ) {
	function thim_get_page_title( $custom_title, $front_title ) {
		$heading_title = esc_html__( 'Page title', 'sailing' );
		if ( is_post_type_archive() ) {
			$heading_title = ! empty( $custom_title ) ? $custom_title : post_type_archive_title( '', false );
		} elseif ( get_post_type() == 'product' ) {
			$heading_title = ! empty( $custom_title ) ? $custom_title : woocommerce_page_title( false );
		} elseif ( is_category() || is_archive() || is_search() || is_404() ) {
			$heading_title = thim_the_archive_title();
		} elseif ( is_single() ) {
			$single_title = '';
			if ( get_post_type() == 'post' ) {
				$category = get_the_category();
				if ( $category ) {
					$single_title = $category[0]->cat_name;
				}
			} elseif ( get_post_type() == 'hb_room' ) {
				$room_cat = get_the_terms( get_the_ID(), 'hb_room_type' );
				if ( ! empty( $room_cat ) ) {
					$single_title = $room_cat[0]->name;
				}
			} else {
				$post_type = get_post_type_object( get_post_type() );
				if ( $post_type ) {
					$single_title = $post_type->labels->name;
				}
			}

			$heading_title = ! empty( $custom_title ) ? $custom_title : $single_title;
		} elseif ( is_page() ) {
			$heading_title = ! empty( $custom_title ) ? $custom_title : get_the_title();
		} elseif ( ! is_front_page() && is_home() ) {
			$heading_title = ! empty( $custom_title ) ? $custom_title : esc_html__( 'Blog', 'sailing' );;
		}

		return $heading_title;
	}
}
