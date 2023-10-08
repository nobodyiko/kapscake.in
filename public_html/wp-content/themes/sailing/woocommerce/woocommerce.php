<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'thim_jk_dequeue_styles' );
function thim_jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation

	return $enqueue_styles;
}

// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );

add_filter( 'loop_shop_per_page', 'thim_loop_shop_per_page' );
function thim_loop_shop_per_page() {
	parse_str( $_SERVER['QUERY_STRING'], $params );
	if ( get_theme_mod( 'thim_woo_product_per_page' ) ) {
		$per_page = get_theme_mod( 'thim_woo_product_per_page' );
	} else {
		$per_page = 12;
	}
	$pc = ! empty( $params['product_count'] ) ? $params['product_count'] : $per_page;

	return $pc;
}

/*****************quick view*****************/
//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary_quick', 'thim_woocommerce_template_loop_add_to_cart_quick_view', 20 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 30 );
//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 7 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50 );
//overwrite content product.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title_rating', 'woocommerce_template_loop_rating', 5 );

if ( ! function_exists( 'thim_woocommerce_template_loop_add_to_cart_quick_view' ) ) {
	function thim_woocommerce_template_loop_add_to_cart_quick_view() {
		global $product;
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' );
	}
}

/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'thim_lazy_ajax', 0, 0 );
function thim_lazy_ajax() {
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
		/* ]]> */
	</script>
	<?php
}

add_action( 'wp_ajax_jck_quickview', 'thim_jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'thim_jck_quickview' );
/** The Quickview Ajax Output **/
function thim_jck_quickview() {
	global $post, $product;
	$prod_id = $_POST["product"];
	$post    = get_post( $prod_id );
	$product = wc_get_product( $prod_id );
	// Get category permalink
	ob_start();
	?>
	<?php wc_get_template( 'content-single-product-lightbox.php' ); ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo ent2ncr( $output );
	die();
}

/* End PRODUCT QUICK VIEW */


/* Share Product */
add_action( 'woocommerce_share', 'thim_wooshare' );
function thim_wooshare() {
	
	$icon_fb = 	'<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M22 11C22 8.82441 21.3549 6.69767 20.1462 4.88873C18.9375 3.07979 17.2195 1.66989 15.2095 0.83733C13.1995 0.00476594 10.9878 -0.21307 8.85401 0.211367C6.72022 0.635804 4.76021 1.68345 3.22183 3.22183C1.68345 4.76021 0.635804 6.72022 0.211367 8.85401C-0.21307 10.9878 0.00476594 13.1995 0.83733 15.2095C1.66989 17.2195 3.07979 18.9375 4.88873 20.1462C6.69767 21.3549 8.82441 22 11 22C13.9165 21.9971 16.7127 20.8373 18.775 18.775C20.8373 16.7127 21.9971 13.9165 22 11ZM11.6471 20.6843V13.3726H14.451C14.6226 13.3726 14.7872 13.3044 14.9085 13.183C15.0299 13.0617 15.098 12.8971 15.098 12.7255C15.098 12.5539 15.0299 12.3893 14.9085 12.268C14.7872 12.1466 14.6226 12.0784 14.451 12.0784H11.6471V9.27451C11.6499 8.76055 11.8553 8.26845 12.2187 7.90502C12.5822 7.54159 13.0743 7.33617 13.5882 7.33334H15.3137C15.4853 7.33334 15.6499 7.26516 15.7713 7.14382C15.8926 7.02247 15.9608 6.85789 15.9608 6.68628C15.9608 6.51467 15.8926 6.35009 15.7713 6.22874C15.6499 6.10739 15.4853 6.03922 15.3137 6.03922H13.5882C12.7311 6.04206 11.9098 6.38384 11.3037 6.98996C10.6976 7.59608 10.3558 8.41733 10.3529 9.27451V12.0784H7.54902C7.37741 12.0784 7.21283 12.1466 7.09148 12.268C6.97014 12.3893 6.90196 12.5539 6.90196 12.7255C6.90196 12.8971 6.97014 13.0617 7.09148 13.183C7.21283 13.3044 7.37741 13.3726 7.54902 13.3726H10.3529V20.6843C7.84044 20.5164 5.49152 19.3787 3.80223 17.5113C2.11295 15.6439 1.21554 13.193 1.29952 10.6763C1.38351 8.15961 2.44231 5.77405 4.25233 4.02342C6.06235 2.2728 8.48189 1.29415 11 1.29415C13.5181 1.29415 15.9377 2.2728 17.7477 4.02342C19.5577 5.77405 20.6165 8.15961 20.7005 10.6763C20.7845 13.193 19.8871 15.6439 18.1978 17.5113C16.5085 19.3787 14.1596 20.5164 11.6471 20.6843Z" fill="#909090"/>
				</svg>';
				$icon_tw = '<svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>';
	$icon_gg = '<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.49824 19C7.93593 18.9994 6.39785 18.6137 5.02022 17.8769C3.6426 17.1402 2.46792 16.0752 1.60022 14.7762C0.732515 13.4773 0.198559 11.9844 0.0456321 10.4299C-0.107295 8.87538 0.125525 7.30713 0.723477 5.86403C1.32143 4.42094 2.26606 3.14752 3.47373 2.15655C4.68139 1.16558 6.11482 0.487629 7.64709 0.182733C9.17936 -0.122163 10.7632 -0.0445965 12.2583 0.408564C13.7534 0.861725 15.1137 1.6765 16.2188 2.78073C16.3668 2.92914 16.45 3.13021 16.45 3.33984C16.45 3.54947 16.3668 3.75055 16.2188 3.89896C16.1459 3.97346 16.0589 4.03267 15.9629 4.07309C15.8669 4.1135 15.7637 4.13433 15.6595 4.13433C15.5553 4.13433 15.4522 4.1135 15.3562 4.07309C15.2601 4.03267 15.1731 3.97346 15.1003 3.89896C13.8297 2.62741 12.164 1.82604 10.3773 1.62663C8.59064 1.42723 6.78927 1.84165 5.26944 2.80176C3.74961 3.76187 2.60181 5.2105 2.01478 6.90944C1.42776 8.60837 1.43646 10.4565 2.03946 12.1498C2.64246 13.8431 3.80386 15.2809 5.33266 16.2266C6.86147 17.1724 8.66666 17.5698 10.4514 17.3536C12.2361 17.1374 13.8941 16.3204 15.1528 15.0369C16.4114 13.7535 17.1957 12.08 17.3768 10.2917H9.49824C9.28824 10.2917 9.08684 10.2083 8.93835 10.0598C8.78985 9.91133 8.70643 9.70996 8.70643 9.5C8.70643 9.29004 8.78985 9.08867 8.93835 8.94021C9.08684 8.79174 9.28824 8.70833 9.49824 8.70833H18.2082C18.4182 8.70833 18.6196 8.79174 18.7681 8.94021C18.9166 9.08867 19 9.29004 19 9.5C18.9948 12.018 17.992 14.4313 16.2112 16.2117C14.4304 17.9922 12.0167 18.9948 9.49824 19Z" fill="#909090"/>
				</svg>';
	$icon_pr = '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 8.42826C18 10.589 17.1944 12.5633 15.7317 13.9876C14.3712 15.3124 12.528 16.0723 10.6748 16.0723C8.64232 16.0723 7.37348 15.379 6.63259 14.7359L5.4257 19.5389C5.40775 19.615 5.37384 19.6869 5.32595 19.7506C5.27805 19.8143 5.21713 19.8684 5.14671 19.9099C5.0763 19.9513 4.99779 19.9792 4.91576 19.992C4.83372 20.0048 4.74979 20.0022 4.66884 19.9844C4.58788 19.9665 4.51152 19.9338 4.44418 19.8881C4.37684 19.8424 4.31986 19.7846 4.27656 19.7181C4.23326 19.6516 4.2045 19.5777 4.19195 19.5008C4.1794 19.4238 4.1833 19.3452 4.20343 19.2696L7.55211 5.9416C7.57007 5.86555 7.60398 5.7936 7.65187 5.72993C7.69976 5.66626 7.76069 5.61213 7.8311 5.57069C7.90152 5.52925 7.98002 5.50132 8.06206 5.48853C8.14409 5.47574 8.22803 5.47834 8.30898 5.49617C8.38994 5.51401 8.4663 5.54673 8.53364 5.59243C8.60098 5.63814 8.65796 5.69592 8.70125 5.76241C8.74455 5.82891 8.77331 5.90279 8.78587 5.97979C8.79842 6.05678 8.79452 6.13534 8.77438 6.2109L6.98566 13.3305C7.2793 13.7551 8.29039 14.8963 10.6748 14.8963C13.6582 14.8963 16.7442 12.4768 16.7442 8.42826C16.744 7.29551 16.4604 6.17856 15.9162 5.16694C15.372 4.15532 14.5823 3.27715 13.6104 2.60281C12.6385 1.92847 11.5115 1.47672 10.3196 1.28375C9.1277 1.09079 7.90411 1.16198 6.74689 1.49162C5.58967 1.82126 4.531 2.40018 3.65572 3.182C2.78044 3.96381 2.11289 4.92676 1.70658 5.99369C1.30026 7.06062 1.16648 8.20185 1.31594 9.32591C1.46541 10.45 1.89398 11.5256 2.56729 12.4667C2.65857 12.5961 2.69152 12.7541 2.65896 12.9062C2.62639 13.0584 2.53095 13.1923 2.39344 13.2788C2.25592 13.3653 2.08746 13.3974 1.92478 13.3681C1.7621 13.3388 1.61837 13.2505 1.52491 13.1224C0.741892 12.0288 0.243356 10.7786 0.0692633 9.47206C-0.104829 8.16551 0.050364 6.83893 0.522403 5.59868C0.994441 4.35842 1.7702 3.23899 2.78748 2.33011C3.80476 1.42123 5.03527 0.748186 6.38036 0.364939C7.72546 -0.018309 9.14773 -0.101103 10.5331 0.123194C11.9186 0.34749 13.2286 0.872638 14.3583 1.65654C15.4879 2.44044 16.4057 3.46129 17.0381 4.63725C17.6705 5.81321 18 7.11158 18 8.42826Z" fill="#909090"/>
				</svg>';
	$html = '';
	if ( get_theme_mod( 'thim_woo_sharing_facebook' ) == 1 ||
	     get_theme_mod( 'thim_woo_sharing_twitter' ) == 1 ||
	     get_theme_mod( 'thim_woo_sharing_pinterest' ) == 1 ||
	     get_theme_mod( 'thim_woo_sharing_google' ) == 1
	) {
		$html .= '<div class="woo-share">'; 
		$html .= esc_html__( 'Share', 'sailing' ). ':';
		$html .= '<ul class="share_show">';
		if ( get_theme_mod( 'thim_woo_sharing_facebook' ) == 1 ) {
			$html .= '<li><a target="_blank" class="facebook" href="' . esc_url( 'https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . get_the_title() . '&amp;p[url]=' . urlencode( get_permalink() ) . '&amp;p[images][0]=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) ) . '" title="' . esc_html__( 'Facebook', 'sailing' ) . '">'. $icon_fb .'</a></li>';
		}
		if ( get_theme_mod( 'thim_woo_sharing_twitter' ) == 1 ) {
			$html .= '<li><a target="_blank" class="twitter" href="' . esc_url( 'https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Twitter', 'sailing' ) . '">'. $icon_tw .'</a></li>';
		}
		if ( get_theme_mod( 'thim_woo_sharing_pinterest' ) == 1 ) {
			$html .= '<li><a target="_blank" class="pinterest" href="' . esc_url( 'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . get_the_excerpt() . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) ) . '" onclick="window.open(this.href); return false;" title="' . esc_html__( 'Pinterest', 'sailing' ) . '">'. $icon_pr .'</a></li>';
		}
		if ( get_theme_mod( 'thim_woo_sharing_google' ) == 1 ) {
			$html .= '<li><a target="_blank" class="googleplus" href="' . esc_url( 'https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Google Plus', 'sailing' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'>'. $icon_gg .'</a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
	}
	echo ent2ncr( $html );
}

/* custom WC_Widget_Cart */
function thim_get_current_cart_info() {
	global $woocommerce;
	$items = '';
	if(!is_admin()){
		$items = count( $woocommerce->cart->get_cart() );
	}

	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}

add_filter( 'woocommerce_add_to_cart_fragments', 'thim_add_to_cart_success_ajax' );
function thim_add_to_cart_success_ajax( $count_cat_product ) {
	list( $cart_items ) = thim_get_current_cart_info();
	if ( $cart_items < 0 ) {
		$cart_items = '0';
	} else {
		$cart_items = $cart_items;
	}
	$count_cat_product['#header-mini-cart .cart-items-number .items-number'] = '<span class="items-number">' . $cart_items . '</span>';

	return $count_cat_product;
}

// Override WooCommerce Widgets
add_action( 'widgets_init', 'thim_override_woocommerce_widgets', 15 );
function thim_override_woocommerce_widgets() {
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' );
		include_once( 'widgets/class-wc-widget-cart.php' );
		register_widget( 'Custom_WC_Widget_Cart' );
	}
}

// load more product ajax
function thim_loadmore_product(){

	$post_per_page 	= isset($_POST['query']['posts_per_page']) ? $_POST['query']['posts_per_page'] : '';
	$orderby 		= isset($_POST['query']['orderby']) ? $_POST['query']['orderby'] : '';
	$order 			= isset($_POST['query']['order']) ? $_POST['query']['order'] : '';
	$term 			= isset($_POST['query']['term']) ? $_POST['query']['term'] : '';
	$taxonomy 		= isset($_POST['query']['taxonomy']) ? $_POST['query']['taxonomy'] : '';
	$paged 			= isset($_POST['page']) ? $_POST['page'] : 1;

	$args = array(
        'post_type' 		=> 'product',
		'post_status' 		=> 'publish',
		'paged'				=> (int) $paged + 1,
		'posts_per_page' 	=> $post_per_page,
		'orderby' 			=> $orderby,
		'order' 			=> $order,
		'taxonomy'			=> $taxonomy,
		'term'				=> $term
    );

	query_posts( $args );

    if( have_posts() ) :
        while( have_posts() ): the_post();
			wc_get_template_part( 'content', 'product' );
        endwhile;
    endif;
	
	wp_reset_postdata();
	die();
}

add_action('wp_ajax_loadmore-product', 'thim_loadmore_product');
add_action('wp_ajax_nopriv_loadmore-product', 'thim_loadmore_product');