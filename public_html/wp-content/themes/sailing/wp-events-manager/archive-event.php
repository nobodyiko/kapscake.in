<?php
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-event/templates/archive-event.php
 *
 * @author        ThimPress
 * @package       tp-event/template
 * @version       1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $get_id_upcoming;

$default_tab_title = array(
	'happening' => esc_html__( 'Happening', 'sailing' ),
	'upcoming'  => esc_html__( 'Upcoming', 'sailing' ),
	'expired'   => esc_html__( 'Expired', 'sailing' )
);

?>
<?php
/**
 * tp_event_before_main_content hook
 *
 * @hooked tp_event_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked tp_event_breadcrumb - 20
 */
do_action( 'tp_event_before_main_content' );
?>

<?php
/**
 * tp_event_archive_description hook
 *
 * @hooked tp_event_taxonomy_archive_description - 10
 * @hooked tp_event_room_archive_description - 10
 */
do_action( 'tp_event_archive_description' );
?>
<div class="event-list--events-page">
	<?php if( get_theme_mod('thim_event_layout_style') == 'layout-tab' ) :?>
	<ul class="list-tab-event">
		<?php
		foreach ( $default_tab_title as $k => $v ) {
			echo '<li><a href="#tab-' . ( $k ) . '" data-toggle="tab">' . ( $v ) . '</a></li>';
			?>
			<?php
		}
		?>
	</ul>
	<div class="tabs-content thim-list-event">

		<?php
		$query_args = array(
			'post_type'           => 'tp_event',
			'posts_per_page'      => - 1,
			'meta_query'          => array(
				array(
					'key'     => 'tp_event_status',
					'value'   => array( 'happening', 'upcoming', 'expired' ),
					'compare' => 'IN',
				),
			),
			'ignore_sticky_posts' => true
		);
		$events     = new WP_Query( $query_args );

		$happening = $expired = $upcoming = '';
		if ( $events->have_posts() ) {
			while ( $events->have_posts() ) {
				$events->the_post();
				$event_status = get_post_meta( get_the_ID(), 'tp_event_status', true );
				ob_start();
				get_template_part( 'wp-events-manager/content', 'event-tab' );
				switch ( $event_status ) {
					case 'happening':
						$happening .= ob_get_contents();
						ob_end_clean();
						break;
					case 'expired':
						$expired .= ob_get_contents();
						ob_end_clean();
						break;
					case 'upcoming':
						$upcoming .= ob_get_contents();
						ob_end_clean();
						break;
				}
			}
		}
		wp_reset_postdata();
		foreach ( $default_tab_title as $type => $title ) :
			echo '<div class="tab-content" id="tab-' . $type . '">';
			if ( ${$type} != '' ) {
				echo ent2ncr( ${$type} );
			}
			echo '</div>';
		endforeach;
		?>
	</div>
	<?php else:  ?>
	<?php if ( have_posts() ) : ?>
		<div class="event-list">
			<?php
			/**
			 * tp_event_before_event_loop hook
			 *
			 * @hooked tp_event_result_count - 20
			 * @hooked tp_event_catalog_ordering - 30
			 */
			do_action( 'tp_event_before_event_loop' );
			?>

			<?php
			$_upcoming_query = thim_get_upcoming_events( 3 );

			if ( $_upcoming_query->have_posts() ) {
				?>
				<div class="feature-event">
					<div class="image-event">
						<div class="slide-image js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]" data-middlearrow=".item-slick>a>img">
							<div class="wrap-arrow-slick">
								<div class="arow-slick prev-slick">
									<i class="ion ion-ios-arrow-left"></i>
								</div>

								<div class="arow-slick next-slick">
									<i class="ion ion-ios-arrow-right"></i>
								</div>
							</div>

							<div class="slide-slick">
								<?php
								while ( $_upcoming_query->have_posts() ) :
									$_upcoming_query->the_post();
									$get_id_upcoming[] = $post->ID;
									?>
									<div class="item-slick" id="<?php echo get_the_ID(); ?>">
										<a href="<?php the_permalink(); ?>">
											<?php echo thim_get_thumbnail( get_the_ID(), '1162x473', 'post', false ); ?>
										</a>
										<div class="text-event">
											<?php
											$time = wpems_get_time( 'Y-m-d H:i', null, false );
											$date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) );
											?>
											<div class="tp_event_counter" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>">
												<div class="countdown-row">
													<div class="countdown-section">
														<div class="background"></div>
														<span class="countdown-amount"><?php echo esc_attr( $date->format( 'd' ) ) ?></span>
														<span class="countdown-period"><?php echo esc_html__( 'Days', 'sailing' ); ?></span>
													</div>

													<div class="countdown-section">
														<span class="countdown-amount"><?php echo esc_attr( $date->format( 'H' ) ) ?></span>

														<span class="countdown-period">
                                                <?php echo esc_html__( 'Hours', 'sailing' ) ?>
                                            </span>
													</div>

													<div class="countdown-section">
														<span class="countdown-amount"><?php echo esc_attr( $date->format( 'i' ) ); ?></span>

														<span class="countdown-period">
                                                <?php echo esc_html__( 'Minutes', 'sailing' ) ?>
                                            </span>
													</div>

													<div class="countdown-section">
														<span class="countdown-amount"><?php echo esc_attr( $date->format( 's' ) ); ?></span>

														<span class="countdown-period">
                                                <?php echo esc_html__( 'Seconds', 'sailing' ) ?>
                                            </span>
													</div>
												</div>
											</div>

											<h3 class="title-event">
												<a href="<?php the_permalink() ?>">
													<?php the_title(); ?>
												</a>
											</h3>

											<div class="info-event">
                                    <span>
                                        <i class="ion ion-android-alarm-clock"></i>
                                        <?php echo wpems_event_start( 'h a', null, false ); ?> -  <?php echo wpems_event_end( 'h a', null, false ); ?>
                                    </span>

												<span>
                                        <i class="ion ion-android-calendar"></i>
                                                    <?php echo wpems_event_start( 'M d, Y', null ); ?>
                                    </span>

												<span>
                                        <i class="ion ion-android-pin"></i>
                                                    <?php echo wpems_event_location(); ?>
                                    </span>
											</div>
										</div>
									</div>

								<?php endwhile; ?>
							</div>
						</div>
					</div>

				</div>
			<?php } ?>
			<?php wp_reset_postdata(); ?>

			<div class="row events-group">
				<?php
				$args = array(
					'post_type'           => 'tp_event',
					'post_status'         => 'publish',
					'order_by'            => 'DESC',
					'posts_per_page'      => 6,
					'ignore_sticky_posts' => true,
					'post__not_in'        => $get_id_upcoming,

				);

				$wp_query = new WP_Query( $args );

				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


					<?php wpems_get_template_part( 'content', 'event' ); ?>

				<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>
			</div>

			<?php
			/**
			 * tp_event_after_event_loop hook
			 *
			 * @hooked tp_event_pagination - 10
			 */
			do_action( 'tp_event_after_event_loop' );
			?>

			<?php
			/**
			 * tp_event_after_main_content hook
			 *
			 * @hooked tp_event_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'tp_event_after_main_content' );
			?>
		</div>
	<?php endif; ?>
	<?php endif; ?>			

</div>