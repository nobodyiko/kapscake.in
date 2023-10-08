<?php
/**
 * The template for displaying archive room.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/archive-room.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */
wp_enqueue_script('cookie');
/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php
global $post;

/**
 * hotel_booking_before_main_content hook
 *
 * @hooked hotel_booking_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked hotel_booking_breadcrumb - 20
 */
do_action( 'hotel_booking_before_main_content' );
?>

<?php
/**
 * hotel_booking_archive_description hook
 *
 * @hooked hotel_booking_taxonomy_archive_description - 10
 * @hooked hotel_booking_room_archive_description - 10
 */
do_action( 'hotel_booking_archive_description' );
?>

<?php if ( have_posts() ) : ?>

	<?php
	/**
	 * hotel_booking_before_shop_loop hook
	 *
	 * @hooked hotel_booking_result_count - 20
	 * @hooked hotel_booking_catalog_ordering - 30
	 */
	do_action( 'hotel_booking_before_shop_loop' );
	?>

	<div class="thim-room-top switch-layout-container">
		<?php do_action('thim_result_on_page') ?>
		<?php 
		if( get_theme_mod( 'thim_hb_cate_enable_sort' ) == true && get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ){
			$data = array();
			hb_get_template( 'search/v2/sort-by.php', compact( 'data' ) );
		} 
		?>
		<?php do_action('thim_switch_layout') ?>
		
	</div>

	<?php hotel_booking_room_loop_start(); ?>

	<?php hotel_booking_room_subcategories(); ?>

	<div id="thim-room-archive" class="">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php hb_get_template_part( 'content', 'room' ); ?>

		<?php endwhile; // end of the loop. ?>
	</div>

	<?php hotel_booking_room_loop_end(); ?>

	<?php
	/**
	 * hotel_booking_after_shop_loop hook
	 *
	 * @hooked hotel_booking_pagination - 10
	 */
	do_action( 'hotel_booking_after_shop_loop' );
	?>

<?php endif; ?>

<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked hotel_booking_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'hotel_booking_after_main_content' );
?>

<?php
/**
 * hotel_booking_sidebar hook
 *
 * @hooked hotel_booking_get_sidebar - 10
 */
do_action( 'hotel_booking_sidebar' );
?>


<?php
do_action( 'hotel_booking_after_room_loop' );
?>