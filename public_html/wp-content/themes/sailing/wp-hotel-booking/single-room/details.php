<?php
/**
 * The template for displaying single room details.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/details.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$room = WPHB_Room::instance( get_the_ID() );

ob_start();
the_content();
$content = ob_get_clean();

$tabsInfo = array();
if ( get_theme_mod( 'thim_hb_single_hide_desc' ) == false ) {
	$tabsInfo[] = array(
		'id'      => 'hb_room_description',
		'title'   => esc_html__( 'Description', 'sailing' ),
		'content' => $content
	);
}

$facilities = get_post_meta( $room->ID, '_wphb_room_facilities', true );

if ( ! empty( $facilities ) ) {
	$tabsInfo[] = array(
		'id'      => 'hb_room_facilities',
		'title'   => __( 'Facilities', 'wp-hotel-booking' ),
		'content' => $room->get_facilities(),
	);
}

if ( get_theme_mod( 'thim_hb_single_hide_info' ) == false ) {
	$tabsInfo[] = array(
		'id'      => 'hb_room_additinal',
		'title'   => esc_html__( 'Additional Information', 'sailing' ),
		'content' => $room->addition_information
	);
}
$faqs = get_post_meta( $room->ID, '_wphb_room_faq', true );
if ( ! empty( $faqs ) ) {
	$tabsInfo[] = array(
		'id'      => 'hb_room_faq',
		'title'   => __( 'FAQS', 'sailing' ),
		'content' => $room->content_faqs,
	);
}

$rules = get_post_meta( $room->ID, '_hb_wphb_rule_room', true );
if ( ! empty( $rules ) ) {
	$tabsInfo[] = array(
		'id'      => 'hb_room_rule',
		'title'   => __( 'Room Rules', 'sailing' ),
		'content' => $room->content_rules,
	);
}

if ( get_theme_mod( 'thim_hb_single_hide_reviews' ) == true ) {
	remove_filter( 'hotel_booking_single_room_infomation_tabs', array( 'WPHB_Comments', 'addTabReviews' ) );
}

$tabs = apply_filters( 'hotel_booking_single_room_infomation_tabs', $tabsInfo );
// prepend after li tabs single
do_action( 'hotel_booking_before_single_room_infomation' );
?>


<?php if ( isset( $tabs ) && count( $tabs ) ) { ?>
	<div class="hb_single_room_details">

		<ul class="hb_single_room_tabs">

			<?php

			foreach ( $tabs as $key => $tab ): ?>
				<li>
					<a href="#<?php echo esc_attr( $tab['id'] ) ?>">
						<?php do_action( 'hotel_booking_single_room_before_tabs_' . $tab['id'] ); ?>
						<?php printf( '%s', $tab['title'] ) ?>
						<?php do_action( 'hotel_booking_single_room_after_tabs_' . $tab['id'] ); ?>
					</a>
				</li>

			<?php endforeach; ?>
		</ul>

		<?php
		// append after li tabs single
		do_action( 'hotel_booking_after_single_room_infomation' ); ?>

		<div class="hb_single_room_tabs_content">

				<?php foreach ( $tabs as $key => $tab ): ?>

					<div id="<?php echo esc_attr( $tab['id'] ) ?>" class="hb_single_room_tab_details">
					<?php if( get_theme_mod( 'thim_hb_single_style', 'layout-1') == 'layout-2' ) { ?>

						<?php if ( isset( $tab['title'] ) ) {
							printf( '<h5 class="heading-title">%s</h5>', $tab['title'] );
						} ?>
						<?php do_action( 'hotel_booking_single_room_before_tabs_content_' . $tab['id'] ); ?>

						<?php if ( $tab['content'] ) {
							printf( '<div class="tab-content">%s</div>', $tab['content'] );
						} ?>
						<?php do_action( 'hotel_booking_single_room_after_tabs_content_' . $tab['id'] ); ?>

					<?php } else { ?>
						<?php do_action( 'hotel_booking_single_room_before_tabs_content_' . $tab['id'] ); ?>
						<?php printf( '%s', $tab['content'] ); ?>
						<?php do_action( 'hotel_booking_single_room_after_tabs_content_' . $tab['id'] ); ?>

					<?php } ?>
				</div>

				<?php endforeach; ?>
		</div>

	</div>

<?php } ?>
