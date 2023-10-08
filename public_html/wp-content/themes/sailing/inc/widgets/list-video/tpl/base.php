<?php
	wp_enqueue_script('magnific-popup');
	$image_id = $instance['bg_image'];
	$list_items = $instance['list-video'];
?>

<div class="thim-list-video base" style="background-image: url('<?php echo wp_get_attachment_image_url( $image_id,'full' ) ?>');">
	<div class="list-video container">
		<?php
		if(!empty($list_items)){
			foreach($list_items as $item){
		?>
			<div class="video-item">
				<div class="video-icon">
				<?php if(!empty($item['link'])){ ?>
						<a class="video-popup" href="<?php echo esc_url($item['link']) ?>">
							<i class="las la-play-circle"></i>
						</a>
					<?php }else{ ?>
						<i class="las la-play-circle"></i>
					<?php } ?>
				</div>
				<div class="video-content">
					<h3 class="title"><?php echo esc_html($item['title']) ?></h3>
					<p class="des"><?php echo esc_html($item['description']) ?></p>
					<?php if(!empty($item['text_link']) && !empty($item['link'])){ ?>
						<a class="video-popup" href="<?php echo esc_url($item['link']) ?>">
							<?php echo esc_html($item['text_link']) ?>
							<i class="las la-play"></i>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } } ?>
	</div>
</div>