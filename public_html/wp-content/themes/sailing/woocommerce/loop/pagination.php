<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

if( get_theme_mod( 'thim_woo_cate_style_pagination') == 'load-more' ){
	?>
	<button id="loadmore-product" class="loadmore-product load-more" data-query="<?php echo esc_attr( json_encode($wp_query->query_vars) ); ?>" data-maxpage="<?php echo esc_attr($wp_query->max_num_pages); ?>"><?php esc_html_e('Load More', 'sailing') ?></button>
	<?php
} else {
?>
<nav class="pagination loop-pagination pagination-center">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text' => esc_html__( 'Prev', 'sailing' ),
			'next_text' => esc_html__( 'Next', 'sailing' ),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</nav>
<?php } 
