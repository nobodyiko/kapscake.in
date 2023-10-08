<?php
/**
 * The template for displaying event content in the single-event.php template
 *
 * Override this template by copying it to yourtheme/tp-event/templates/content-event.php
 *
 * @author        ThimPress
 * @package       tp-event
 * @version       1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$event     = new WPEMS_Event( get_the_ID() );
$user      = get_user_by( 'id', $event->post->post_author );
$user_meta = get_user_meta( $event->post->post_author );
$avatar    = get_avatar( $event->post->post_author, 87, '', '', array( 'gravatar' => false ) );
?>

<?php
/**
 * tp_event_before_loop_event hook
 *
 */
do_action( 'tp_event_before_loop_event' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
?>

<div id="event-<?php the_ID(); ?>" class="col-md-6 col-lg-4">

	<div class="item-event">
		<?php
		/**
		 * tp_event_before_loop_event_summary hook
		 *
		 * @hooked tp_event_show_event_sale_flash - 10
		 * @hooked tp_event_show_event_images - 20
		 */
		do_action( 'tp_event_before_loop_event_item' );
		?>


		<?php
		/**
		 * tp_event_single_event_thumbnail hook
		 */
		do_action( 'tp_event_single_event_thumbnail' );
		?>

		<div class="date-event">
			<div class="icon-background">
				<div class="flower">
					<span class="petal"></span>
					<span class="petal"></span>
					<span class="petal"></span>
					<span class="petal"></span>
					<span class="petal"></span>
				</div>
			</div>

			<span class="number-date"><?php echo wpems_event_start( 'd', null ); ?></span> <?php echo wpems_event_start( 'M', null ); ?>
		</div>

		<div class="text-event">
			<h3 class="title-event">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>

			<div class="info-event">
                <span>
                    <i class="ion ion-android-alarm-clock"></i>
                    <?php echo wpems_event_start( 'h a', null, false ); ?> -  <?php echo wpems_event_end( 'h a', null, false ); ?>
                </span>

				<span>
                    <i class="ion ion-ios-location-outline"></i>
                    <?php echo wpems_event_location(); ?>
                </span>
			</div>

		</div>

		<?php
		/**
		 * tp_event_after_loop_event_item hook
		 *
		 * @hooked tp_event_show_event_sale_flash - 10
		 * @hooked tp_event_show_event_images - 20
		 */
		do_action( 'tp_event_after_loop_event_item' );
		?>

	</div>

</div>

<?php do_action( 'tp_event_after_loop_event' ); ?>
