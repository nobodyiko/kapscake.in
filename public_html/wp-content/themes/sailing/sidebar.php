<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
$classes = get_body_class();
wp_enqueue_script('theia-sticky-sidebar');
if ( ( get_post_type() == 'hb_room' && is_singular('hb_room') ) ||
	in_array( 'wp-hotel-booking-cart', $classes ) ||
	in_array( 'wp-hotel-booking-account', $classes ) ) {
	if ( !is_active_sidebar( 'sidebar_hotel' ) ) {
		return;
	}
	?>
	<div id="sidebar" class="widget-area sticky-sidebar col-sm-3" role="complementary">
		<?php do_action( 'thim_sidebar_before' ); ?>
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar_hotel' ); ?>
		</div>
		<?php do_action( 'thim_sidebar_after' ); ?>
	</div>

	<div class="clear"></div>
	<!-- #secondary -->
<?php } elseif ( in_array( 'wp-hotel-booking-search-rooms', $classes ) || get_post_type() == 'hb_room' || in_array( 'post-type-archive-hb_room', $classes ) || in_array( 'wp-hotel-booking-rooms', $classes )) {
	if ( !is_active_sidebar( 'search_sidebar_hotel' ) ) {
		return;
	}
	?>
	<div id="sidebar" class="widget-area sticky-sidebar col-sm-3" role="complementary">
		<?php do_action( 'thim_sidebar_before' ); ?>
		<div class="sidebar">
			<?php dynamic_sidebar( 'search_sidebar_hotel' ); ?>
		</div>
		<?php do_action( 'thim_sidebar_after' ); ?>
	</div>

	<div class="clear"></div>
	<!-- #secondary -->
<?php } elseif ( get_post_type() == 'tp_event' ){ ?>
	<div id="sidebar" class="widget-area sticky-sidebar col-sm-3" role="complementary">
		<?php do_action( 'thim_sidebar_before' ); ?>
		<div class="sidebar">
			<?php 
			if(is_singular('tp_event')) {
				echo '<div class="widget_book-event">';
				if ( defined( 'WPEMS_VER' ) ) {
					if ( version_compare( WPEMS_VER, '2.0', '>=' ) ) {
						wpems_get_template( 'loop/booking-form.php', array( 'event_id' => get_the_ID() ) );
					}else{
						if ( version_compare( get_option( 'event_auth_version' ), '1.0.4', '>=' ) ) {
							tpe_auth_addon_get_template( 'form-book-event.php', array( 'event_id' => get_the_ID() ) );
						} else {
							WPEMS_Authentication()->loader->load_module( '\WPEMS_Auth\Events\Event' )->book_event_template();
						}
					}
				} else if ( defined( 'TP_EVENT_VER' ) ) {
					if ( version_compare( TP_EVENT_VER, '2.0', '>=' ) ) {
						tp_event_get_template( 'loop/booking-form.php', array( 'event_id' => get_the_ID() ) );
					}else{
						if ( version_compare( get_option( 'event_auth_version' ), '1.0.4', '>=' ) ) {
							tpe_auth_addon_get_template( 'form-book-event.php', array( 'event_id' => get_the_ID() ) );
						} else {
							TP_Event_Authentication()->loader->load_module( '\TP_Event_Auth\Events\Event' )->book_event_template();
						}
					}
				}else{
					return;
				}
				echo '</div>';
			}
			?>
			<?php dynamic_sidebar( 'sidebar_events' ); ?>
		</div>
		<?php do_action( 'thim_sidebar_after' ); ?>
	</div>

	<div class="clear"></div>
	<!-- #secondary -->
<?php } else {
	if ( !is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
	?>
	<div id="sidebar" class="widget-area sticky-sidebar col-sm-3" role="complementary">
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>

	<div class="clear"></div>
	<!-- #secondary -->

<?php } ?>


