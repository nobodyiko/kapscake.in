<?php
/**
 * The template for displaying single room gallery.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/gallery.php.
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
$galleries = $hb_room->get_galleries( false );
wp_enqueue_script( 'flexslider' );
?>
<div id="hb_room_images"> 
	<?php if ( $galleries ) : ?>
		<div class="hb_room_gallery flexslider" id="slider">
			<ul class="slides">
				<?php
				if ( $hb_room->is_preview ) :
					$preview = get_post_meta( $hb_room->ID, '_hb_room_preview_url', true );
					?>
					<span class="room-preview" data-preview="<?php echo ! empty( $preview ) ? esc_attr( $preview ) : ''; ?>">
						<i class="fa fa-play-circle-o" aria-hidden="true"></i>
					</span>
				<?php endif; ?>
				<?php foreach ( $galleries as $key => $gallery ) : ?>
					<li><img src="<?php echo esc_url( $gallery['src'] ); ?>"></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="hb_room_gallery flexslider" id="carousel">
			<ul class="slides">
				<?php foreach ( $galleries as $key => $gallery ) : ?>
					<li><img src="<?php echo esc_url( $gallery['src'] ); ?>"></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
