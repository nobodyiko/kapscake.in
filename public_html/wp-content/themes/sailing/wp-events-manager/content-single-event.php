<article id="tp_event-<?php the_ID(); ?>" <?php post_class( 'tp_single_event' ); ?>>
	<?php
	wp_enqueue_script('theia-sticky-sidebar');
	/**
	 * tp_event_before_single_event hook
	 *
	 */
	do_action( 'tp_event_before_single_event' );
	?>

	<div class="bl-event-detail">
		<div class="detail-event">
			<?php

			/**
			 * tp_event_single_event_thumbnail hook
			 */
			do_action( 'tp_event_single_event_thumbnail' ); 

			/**
			 * tp_event_single_event_title hook
			 */
			do_action( 'tp_event_single_event_title' );
			?>

			<div class="row">
				<div class="col-md-8">
					<div class="content-event">
						<?php
						/**
						 * tp_event_single_event_content hook
						 */
						do_action( 'tp_event_single_event_content' );
						?>
					</div>
				</div>

				<div class="col-md-4 event-info">
					<?php
					$time_format = get_option( 'time_format' );
					$date_format = get_option( 'date_format' );
					$time_from   = get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ? strtotime( get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ) : time();
					$time_finish = get_post_meta( get_the_ID(), 'tp_event_date_end', true ) ? strtotime( get_post_meta( get_the_ID(), 'tp_event_date_end', true ) ) : time();
					$time_start  = wpems_event_start( $time_format );
					$time_end    = wpems_event_end( $time_format );
		
					$location = get_post_meta( get_the_ID(), 'tp_event_location', true ) ? get_post_meta( get_the_ID(), 'tp_event_location', true ) : '';
					?>
					<div class="tp-event-info">
						<h5><?php echo esc_html__('start event', 'sailing' ); ?></h5>
						<div class="tp-info-box">
							<p class="heading">
								<i aria-hidden="true" class="tk tk-clock"></i><?php esc_html_e( 'Start Time', 'sailing' ); ?>
							</p>
		
							<p><?php echo esc_html( $time_start ); ?></p>
		
							<p><?php echo date_i18n( $date_format, $time_from ); ?></p>
						</div>
						<div class="tp-info-box">
							<p class="heading">
								<i aria-hidden="true" class="tk tk-flag-checkered"></i><?php esc_html_e( 'Finish Time', 'sailing' ); ?>
							</p>
		
							<p><?php echo esc_html( $time_end ); ?></p>
		
							<p><?php echo date_i18n( $date_format, $time_finish ); ?></p>
						</div>
						<?php if ( $location ) { ?>
							<div class="tp-info-box">
								<p class="heading">
									<i aria-hidden="true" class="tk tk-map-marker"></i><?php esc_html_e( 'Address', 'sailing' ); ?>
								</p>
		
								<p><?php echo esc_html( $location ); ?></p>
								<?php
								/**
								 * tp_event_loop_event_location hook
								 */
								do_action( 'tp_event_loop_event_location' );
								?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="share-event">
				<?php echo esc_html__( 'Share', 'sailing' ). ':' ;?>
				<?php do_action( 'thim_social_share' ); ?>
			</div>
		</div>

		<?php
		/**
		 * thim_event_loop_event_contact hook
		 */
		do_action( 'thim_event_author' );
		?>
	</div>
	<?php
	/**
	 * thim_event_loop_event_contact hook
	 */
	do_action( 'thim_event_loop_event_contact' );
	?>
	<?php
	//  If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

</article><!-- #product-<?php the_ID(); ?> -->