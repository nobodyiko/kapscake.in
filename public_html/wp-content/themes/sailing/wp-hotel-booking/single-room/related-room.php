<?php
/**
 * The template for displaying related room in single room page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/related-room.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
global $hb_settings;

$room    = WPHB_Room::instance( get_the_ID() );
$related = $room->get_related_rooms();
wp_enqueue_script('owl-carousel');
/**
 * @var $related WP_Query
 */
?>

<?php if ( $related->posts ): ?>
	<?php
	$items = count( $related->posts );
	if ( $items < 3 ) {
		$item = 2;
	} else {
		$item = 3;
	}
	?>
	<div class="hb_related_other_room has_slider" data-item = "<?php echo esc_attr($item) ?>">
		<h3 class="title"><?php esc_html_e( 'Other Rooms', 'sailing' ); ?></h3>
		<?php if ( count( $related->posts ) > 3 ) : ?>
			<div class="navigation">
				<div class="prev"><span class="pe-7s-angle-left"></span></div>
				<div class="next"><span class="pe-7s-angle-right"></span></div>
			</div>
		<?php endif; ?>

		<?php //hotel_booking_room_loop_start(); ?>

		<ul class="rooms owl-carousel tp-hotel-booking hb-catalog-column-<?php echo esc_attr( $hb_settings->get( 'catalog_number_column', 4 ) ) ?>">
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>

				<li id="room-<?php the_ID(); ?>" <?php post_class(); ?>>

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

								/**
								 * hotel_booking_loop_room_price hook
								 */
								do_action( 'hotel_booking_loop_room_rating' ); ?>
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
							?>
						</div>

						<?php
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
						?>
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

			<?php endwhile; // end of the loop. ?>
		</ul>

		<?php wp_reset_postdata(); ?>

		<?php //hotel_booking_room_loop_end(); ?>
	</div>	
<?php endif; ?>
