<?php
/**
 * The template for displaying loop room thumbnail in archive room page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/loop/thumbnail.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $hb_room;
/**
 * @var $hb_room WPHB_Room
 */
?>

<div class="media">
	<?php $hb_room->getImage( 'catalog' ); ?>
	<?php	
		do_action( 'hotel_booking_loop_room_rating' );
	?>
	<div class="actions">
		<div class="action-btn">
			<a href="<?php the_permalink(); ?>" class="button readmore">
				<i class="las la-external-link-square-alt"></i>
			</a>
		</div>
	</div>
</div>