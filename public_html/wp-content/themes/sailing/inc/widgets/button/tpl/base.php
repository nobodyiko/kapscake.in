<?php
$button_css = '';

$custom      = ( isset( $instance['button_option']['custom'] ) && $instance['button_option']['custom'] === 'yes' ) ? true : false;
$id          = 'button_' . uniqid();
$image_icon  = wp_get_attachment_image_src( $instance['image_icon'], 'full' );
$images_size = @getimagesize( $image_icon['0'] );
$link_target = $instance['link_target'];
?>

	<div id="<?php echo esc_attr( $id ) ?>" class="thim-sc-button">
		<a target="<?php echo $link_target; ?>"
		   href="<?php echo esc_attr( $instance['link'] ); ?>"
		   class="thim-button">
			<?php if ( $image_icon ) { ?>
				<img src="<?php echo $image_icon['0']; ?>" <?php echo $image_icon['3']; ?> alt="<?php echo get_the_title(); ?>" />
			<?php } ?>
			<span class="inner-text">
			<?php echo esc_attr( $instance['text'] ); ?>
		</span>
		</a>
	</div>

<?php if ( $custom ) : ?>
	<style>
		#<?php echo esc_html($id) ?>.thim-sc-button {
			background: <?php echo esc_html($instance['button_option']['button_color']) ?>;
		}

		#<?php echo esc_html($id) ?>.thim-sc-button a span.inner-text {
			color: <?php echo esc_html($instance['button_option']['text_color']) ?>;
		}

		#<?php echo esc_html($id) ?>.thim-sc-button:hover {
			background: <?php echo esc_html($instance['button_option']['button_hover_color']) ?>;
		}

		#<?php echo esc_html($id) ?>.thim-sc-button:hover a span.inner-text {
			color: <?php echo esc_html($instance['button_option']['text_hover_color']) ?> !important;
		}
	</style>
<?php endif; ?>