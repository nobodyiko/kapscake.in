
<?php
wp_enqueue_script('magnific-popup');
?>
<div class="beauty thim-sc-video-box" style="position: relative;">
	<div class="video-container content-asset">
		<div class="hideClick beauty-intro">
			<?php
			if ( ! empty( $instance['title'] ) ) {
				echo '<h2>' . $instance['title'] . '</h2>';
			}
			if ( ! empty( $instance['desc'] ) ) {
				echo '<p>' . $instance['desc'] . '</p>';
			}
			?>
			<a class="video-popup" href="<?php echo esc_url( $instance['external_video'] ); ?>">
				<div class="btn-player"><i class="fa fa-play-circle"></i></div>
				<p class="watch"><?php echo esc_attr__( 'Watch the video', 'sailing' ) ?></p>
			</a>
		</div>
		<?php
		$src_poster = wp_get_attachment_image_src( $instance['self_poster'], 'full' );
		if ( $src_poster ) {
			echo ' <img src="' . $src_poster[0] . '">';
		}
		?>
	</div>
</div>
