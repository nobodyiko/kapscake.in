<?php
/**
 * The template for displaying single room faqs.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/tabs/room-faqs.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( empty( $faqs ) ) {
	return;
}

?>
<div class="hb-room-faqs-detail">
	<?php
	foreach ( $faqs as $key => $rule ) : ?>
		<div class="room-faqs-box">			
			<label class="room-faqs-box__title">
				<?php echo esc_html( $rule[0] ); ?>
			</label>
			<div class="room-faqs-box__content">
				<div class="room-faqs-box__content-inner">
					<?php echo wp_kses_post( $rule[1] ); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
