<?php
wp_enqueue_script('owl-carousel');
$link_before = $after_link = $image  = $style_width = '';
if ( $instance['image'] ) {
	if ( $instance['link_target'] ) {
		
		$t = 'target="' . $instance['link_target'] . '"';
	} else {
		$t = '';
	}

	if ( !is_array( $instance['image'] ) ) {
		$img_id = explode( ",", $instance['image'] );
	} else {
		$img_id = $instance['image'];
	}

	if ( $instance['image_link'] ) {
		$img_url = explode( ",", $instance['image_link'] );
	}

	echo '<div class="thim-gallery-images-column gallery-img">';
	echo '<div class="list_image">';
	$i = 0;
	foreach ( $img_id as $id ) {
		$src = wp_get_attachment_image_src( $id, $instance['image_size'] );
		if ( $src ) {
			$img_size = '';
			$src_size = @getimagesize( $src['0'] );
			$image    = '<img src ="' . esc_url( $src['0'] ) . '" ' . $src_size[3] . ' alt= "' . get_the_title() . '" />';
		}
		if ( $instance['image_link'] ) {
			$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[$i] ) . '">';
			$after_link  = "</a>";
		}
		echo '<div class="item-image"' . $style_width . '>' . $link_before . $image . $after_link . "</div>";
		$i ++;
	}
	echo "</div>";
	echo '<div class="text_wellcome"><h3>' . $instance['text_show'] . '</h3></div>';
	echo "</div>";
}