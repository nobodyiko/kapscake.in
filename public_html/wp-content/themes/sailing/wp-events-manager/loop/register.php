<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( wpems_get_option( 'allow_register_event' ) == 'no' ) {
	return;
}

$event    = new WPEMS_Event( get_the_ID() );
$user_reg = $event->booked_quantity( get_current_user_id() );

if ( absint( $event->qty ) == 0 ) {
	return;
}
?>
<div class="info-event">
	<div class="item-info">
		<h6 class="name-info">
			<?php echo esc_html__( 'Date & Time:', 'sailing' ) ?>
		</h6>

		<ul class="value-info">
			<li>
				<i class="ion ion-android-alarm-clock"></i>
				<?php echo wpems_event_start( 'h a', null, false ); ?> - <?php echo wpems_event_end( 'h a', null, false ); ?>
			</li>

			<li>
				<i class="ion ion-android-calendar"></i>
				<?php echo wpems_event_start( 'M d, Y', null ); ?>
			</li>
		</ul>
	</div>

	<div class="item-info">
		<h6 class="name-info">
			<?php echo esc_html__( 'Venue:', 'sailing' ) ?>
		</h6>

		<ul class="value-info">
			<li>
				<i class="ion ion-android-pin"></i>
				<?php echo wpems_event_location(); ?>
			</li>
		</ul>
	</div>

	<div class="item-info">
		<h6 class="name-info">
			<?php echo esc_html__( 'Slot:', 'sailing' ) ?>
		</h6>

		<ul class="value-info">
			<li>
				<i class="ion ion-android-person"></i>
				<?php echo esc_html__( 'Total Slot:', 'sailing' ) ?> <?php echo esc_html( absint( $event->qty ) ) ?>
			</li>

			<li>
				<i class="ion ion-android-lock"></i>
				<?php echo esc_html__( 'Booked Slot:', 'sailing' ) ?> <?php echo esc_html( absint( $event->booked_quantity() ) ) ?>
			</li>

			<li>
				<i class="ion ion-cash"></i>
				<?php echo esc_html__( 'Cost:', 'sailing' ) ?> <?php printf( '%s', $event->is_free() ? esc_html__( 'Free', 'sailing' ) : wpems_format_price( $event->get_price() ) ) ?>
			</li>
		</ul>
	</div>

</div>
