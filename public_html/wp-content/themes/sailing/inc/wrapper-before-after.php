<?php
if ( ! function_exists( 'thim_wrapper_layout' ) ) :
	function thim_wrapper_layout() {
		global $wp_query;
		$using_custom_layout = $wrapper_layout = $cat_ID = '';
		$wrapper_class_col   = 'col-sm-9 alignright';
		if ( get_post_type() == "product" ) {
			$prefix = 'thim_woo';
		} else if ( get_post_type() == "hb_room" ) {
			$prefix = 'thim_hb';
		} else if ( get_post_type() == "tp_event" ) {
			$prefix = 'thim_event';
		} else {
			if ( is_front_page() || is_home() ) {
				$prefix = 'thim_front_page';
			} else {
				$prefix = 'thim_archive';
			}
		}

		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}
		// get layout
		if ( is_page() || is_single() ) {
			$postid = get_the_ID();
			if ( get_theme_mod( $prefix . '_single_layout' ) ) {
				$wrapper_layout = get_theme_mod( $prefix . '_single_layout' );
			}
			/***********custom layout*************/
			$using_custom_layout = get_post_meta( $postid, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_mtb_layout', true );
			}
			if ( get_option('tp_hotel_booking_search_page_id') == get_the_ID() && get_theme_mod( 'thim_hb_search_page_layout', 'full-content' ) ) {
				$wrapper_layout = get_theme_mod( 'thim_hb_search_page_layout', 'full-content' );
			}
		} else {
			if ( get_theme_mod( $prefix . '_cate_layout' ) ) {
				$wrapper_layout = get_theme_mod( $prefix . '_cate_layout' );
			}
			/***********custom layout*************/
			$using_custom_layout = get_tax_meta( $cat_ID, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout <> '' ) {
				$wrapper_layout = get_tax_meta( $cat_ID, 'thim_mtb_layout', true );
			}
		}

		if ( $wrapper_layout == 'full-content' ) {
			$wrapper_class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$wrapper_class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$wrapper_class_col = 'col-sm-9 alignright';
		}
		
		return $wrapper_class_col;
	}
endif;
//
add_action( 'thim_wrapper_loop_start', 'thim_wrapper_loop_start' );
if ( ! function_exists( 'thim_wrapper_loop_start' ) ) :
	function thim_wrapper_loop_start() {
		$class_no_padding = '';
		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_mtb_no_padding', true );
			if ( $mtb_no_padding ) {
				$class_no_padding = ' no-padding-top';
			}
		}
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '<div class="container site-content' . $class_no_padding . '"><div class="row"><main id="main" class="site-main ' . $wrapper_class_col . '" >';
	}
endif;

//
add_action( 'thim_wrapper_loop_end', 'thim_wrapper_loop_end' );

if ( ! function_exists( 'thim_wrapper_loop_end' ) ) :
	function thim_wrapper_loop_end() {
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '</main>';
		if ( $wrapper_class_col != 'col-sm-12 full-width' ) {
			if ( get_post_type() == "product" ) {
				do_action( 'woocommerce_sidebar' );
			} elseif ( is_singular('hb_room') && get_theme_mod( 'thim_hb_single_style', 'layout-1') == 'layout-2'){

			} else {
				get_sidebar();
			}
		}
		echo '</div></div>';
	}
endif;

function thim_get_theme_option( $name = '', $value_default = '' ) {
	$data = get_theme_mods();
	if ( isset( $data[$name] ) ) {
		return $data[$name];
	} else {
		return $value_default;
	}
}

function thim_before_archive_loop_function(){
	if( get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2' ){
		?>
			<div class="thim-display-mode-header">
				<div class="thim-display-mode switch-layout-container">
					<?php do_action('thim_result_on_page') ?>
					<?php do_action('thim_switch_layout') ?>
					<?php do_action('thim_sort_by') ?>
				</div>
			</div>
		<?php
	}
}
add_action( 'thim_before_archive_loop', 'thim_before_archive_loop_function' );

function thim_get_posts_orderby( $query ) {
    if ( !empty($_GET['sortby-list']) ) {
        // Safely get the orderby value
        $orderby = sanitize_key( $_GET['sortby-list'] );
		$orderby = explode('-', $orderby );

        // If orderby is set then do it
        if (isset($orderby) && is_array($orderby)){		
			$query->set( 'orderby', $orderby[0] );
			$query->set( 'order', $orderby[1] );
			return;
        }
    }
}
add_action( 'pre_get_posts', 'thim_get_posts_orderby', 1 );
