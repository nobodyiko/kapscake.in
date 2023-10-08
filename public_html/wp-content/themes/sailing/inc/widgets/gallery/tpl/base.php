<?php
wp_enqueue_script('fancybox');
wp_enqueue_script('isotope');

$cats_id       = $instance['cat'];
$limit         = isset( $instance['limit'] ) ? $instance['limit'] : 5;
$query_args    = array(
	'cat'            => $instance['cat'],
	'posts_per_page' => $limit,
);
$posts_display = new WP_Query( $query_args );

if ( $posts_display->have_posts() ) :
	?>
	<div class="wrapper-filter-controls">
		<div class="filter-controls">
			<a class="filter active" data-filter="*" href="javascript:;"><?php esc_html_e( 'All', 'sailing' ); ?></a>
			<?php
			while ( $posts_display->have_posts() ) : $posts_display->the_post();
				echo '<a class="filter" href="javascript:;" data-filter=".filter-gallery-' . get_the_ID() . '">' . get_the_title( get_the_ID() ) . '</a>';
			endwhile;
			?>
		</div>
	</div>
	<div class="wrapper-gallery-filter grid row" itemscope itemtype="http://schema.org/ItemList">
		<?php
		while ( $posts_display->have_posts() ) : $posts_display->the_post();
 			$images = thim_meta( 'thim_gallery', "type=image&single=false&size=full" );
		//var_dump($images);
			if ( $images ):
				foreach ( $images as $image ) {

					if ( $image['url'] ) {
						$image_id  = attachment_url_to_postid( $image['url'] );
						$image_crop = wp_get_attachment_image_url( $image_id, array( 380, 310 ) );

						echo '<div class="item-photo element col-sm-4 filter-gallery-' . get_the_ID() . '">';
						echo '<div class="inner">';
						echo '<a class="fancybox" data-fancybox-group="gallery" href="' . esc_url( $image['url'] ) . '"><img src="' . esc_url( $image_crop ) . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" /></a>';
						echo '</div>';
						echo '</div>';
					}
				}
			endif;
		endwhile;
		?>
	</div>
<?php
endif;
wp_reset_postdata();
