<?php
/**
 * The template for displaying content archive room.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/content-room.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit(); ?>

<?php
/**
 * hotel_booking_before_loop_room hook
 *
 */
do_action( 'hotel_booking_before_loop_room' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

$column = get_option( 'tp_hotel_booking_catalog_number_column' );
if ( $column == '' || $column == 0 ) {
	$column = 4;
} else {
	$column = get_option( 'tp_hotel_booking_catalog_number_column' );
}

$class_column = 12 / $column;

if ( $class_column == '2.4' ) {
	$class_column = "col-5";
}
// Extra post classes
$classes   = array();
$classes[] = 'col-md-' . $class_column . ' col-sm-6 col-xs-6';
?>

<li id="room-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php
	/**
	 * hotel_booking_before_loop_room_summary hook
	 *
	 * @hooked hotel_booking_show_room_sale_flash - 10
	 * @hooked hotel_booking_show_room_images - 20
	 */
	do_action( 'hotel_booking_before_loop_room_item' );
	?>

	<div class="summary entry-summary">

		<?php
		/**
		 * hotel_booking_loop_room_thumbnail hook
		 */
		do_action( 'hotel_booking_loop_room_thumbnail' );
		?>
		<div class="content-room">
			<div class="title-room">
				<?php
				/**
				 * hotel_booking_loop_room_title hook
				 */
				do_action( 'hotel_booking_loop_room_title' );

				?>
			</div>
			<?php
			/**
			 * rooms description
			 */
			if ( get_theme_mod( 'thim_show_info_room' ) == true ) {
				echo '<div class="description">';
				if ( has_excerpt() ) {
					echo get_the_excerpt();
				}
				echo '</div>';
			}
			if ( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ) {
				/**
				 * hotel_booking_rooms_guests hook
				 */
				do_action( 'hotel_booking_rooms_guests' );
			}else {
				/**
				 * hotel_booking_loop_room_price hook
				 */
				do_action( 'hotel_booking_loop_room_price' );
			}

			/**
			 * hotel_booking_loop_room_price hook
			 */
			do_action( 'hotel_booking_loop_room_rating' );
			?>
		</div>

		
	</div><!-- .summary -->

	<?php
	/**
	 * hotel_booking_after_loop_room_item hook
	 *
	 * @hooked hotel_booking_show_room_sale_flash - 10
	 * @hooked hotel_booking_show_room_images - 20
	 */
	do_action( 'hotel_booking_after_loop_room_item' );
	?>

</li>

<?php do_action( 'hotel_booking_after_loop_room' ); ?>
