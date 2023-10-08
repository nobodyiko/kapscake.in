<?php
	wp_enqueue_script('magnific-popup');
	$image_id = $instance['bg_image'];
	$bg_title = $instance['bg_title'];
	$video_title = $instance['video_title'];
	$list_items = $instance['list-video2'];

?>
<div class="thim-list-video style-1" style="background-image: url('<?php echo wp_get_attachment_image_url( $image_id,'full' ) ?>');">
	<h2 class="bg_title">
		<?php echo esc_html($bg_title) ?>
	</h2>
	<div class="video_title">
		<i class="las la-tv"></i>
		<h4 class="text"><?php echo esc_html($video_title) ?></h4>
	</div>
	<?php
		$i = 0;
		foreach($list_items as $item){
	?>		
		<div class="video-item item-<?php echo esc_attr($i) ?>">
			<div class="thumb">
				<?php
					$image_size = $item['image_size'];
					$size = explode('x',$image_size);
					

					if(!empty($item['image_2']['id'])){
						$img_id = $item['image_2']['id'];
					}else{
						$img_id = $item['image_2'];
					}
					$image_url = wp_get_attachment_image_url($img_id,array($size[0],$size[1]));
				?>
				<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr('IMG','sailing') ?>">
				<a class="video-popup" href="<?php echo esc_url($item['link_2']) ?>"><i class="las la-play"></i></a>
			</div>
		</div>
	<?php		
			if(++$i >=3) break;
		}
	?>
</div>