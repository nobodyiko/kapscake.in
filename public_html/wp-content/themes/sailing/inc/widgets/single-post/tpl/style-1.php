<?php
$post_id = $instance['post_id'];
$position_content = $instance['position_content'];
$style = '';
if ( $instance['style'] <> '' ) {
	$style = $instance['style'];
}

$query_args = array(
	'post_type'      => 'post',
	'post_status' => 'publish',
);

$query_args['post__in'] = explode(',', $post_id);

$posts_display = new WP_Query( $query_args );
echo '<div class="single-post-swapper">';
	if ( $posts_display->have_posts() ) {
		if ( $instance['title'] ) {
			echo '<div class = "title-'. $instance['position_title'] .'">';
			echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			echo '</div>';
		}
		echo '<div class="thim-single-post ' . $style . ' '. $position_content .'">';
		while ( $posts_display->have_posts() ) {
			$posts_display->the_post();
			global $post;
			echo '<div class="post-item">';
				
				if ( has_post_thumbnail() ) {
					echo '<div class="article-image">';
					echo '<a href="'.get_the_permalink().'">';
					the_post_thumbnail( array(890,500) );
					echo '</a>';
                    echo '<div class="post-info">';
                    echo '<h3 class="title">' . get_the_title() . '</h3>';
                    echo '<div class="des">' . thim_excerpt('8') . '</div>';
                    if($instance['show_post_link'] == 'yes' && !empty($instance['post_text_link'])){
                        echo '<a class="link" href="'.get_the_permalink().'">'.esc_html($instance['post_text_link']).'</a>';
                    }
                    echo '</div>';
					echo '</div>';
				}
				
				
			echo '</div>';	
		}
		echo '</div>';
		wp_reset_postdata();
	}
echo '</div>'	
?>