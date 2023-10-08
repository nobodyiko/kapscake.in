<?php
wp_enqueue_script('magnific-popup');
$bg_img           = wp_get_attachment_image_src( $instance['background_img'], 'full' );
$title_background = $instance['background-title'];
$link_post_video  = $instance['external_video'];
if ( preg_match( '#src=\\"([^ ]*)\\"#', $link_post_video, $matches ) === 1 ) {
	$video_embed     = $matches[1];
	$link_post_video = preg_replace( '/embed\//', 'watch?v=', $video_embed );
}
?>
<div class="thim-sc-video-box layout-4" style="background-image: url(<?php echo esc_url( $bg_img[0] ); ?>)">
	<div class="box-inner">
		<div class="logo-image">
			<?php
			echo wp_get_attachment_image( $instance['logo'] );
			?>
		</div>
		<div class="background-title">
			<?php echo ent2ncr( $title_background ); ?>
		</div>
		<?php if ( $instance['title'] ) :
			$title = str_replace( '``', '"', $instance['title'] );
			?>
			<h3 class="title"><?php echo ent2ncr( $title ); ?></h3>
		<?php endif; ?>
		<div class="video-button">
			<a class="video-popup" href="<?php echo esc_url( $link_post_video ); ?>">
				<i class="ion-ios-play-outline"></i>
				<?php echo ent2ncr( $instance['button02_title'] ); ?>
			</a>
		</div>
	</div>
</div>
