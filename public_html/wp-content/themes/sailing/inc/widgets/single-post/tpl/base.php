<?php
$post_id = $instance['post_id'];
$position_content = $instance['position_content'];
$style = '';
if ( $instance['style'] <> '' ) {
	$style = $instance['style'];
}
if($instance['show_bg_color'] == 'yes'){
	$bg_color = 'bg-color';
}else{
	$bg_color = '';
}
$query_args = array(
	'post_type'      => 'post',
	'post_status' => 'publish',
);

$query_args['post__in'] = explode(',', $post_id);

$posts_display = new WP_Query( $query_args );
echo '<div class="single-post-swapper base">';
	if ( $posts_display->have_posts() ) {
		if ( $instance['title'] ) {
			echo '<div class = "post-title container title-'. $instance['position_title'] .'">';
			echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			if($instance['show_text_link'] == 'yes'){
				if(!empty($instance['text_link']) && !empty($instance['link'])){
					echo '<a class="view-link" href="'.esc_url($instance['link']).'">'.esc_html($instance['text_link']).'<i class="las la-arrow-right"></i></a>';
				}
			}

			echo '</div>';
		}
		echo '<div class="thim-single-post ' . $style . ' '. esc_attr($position_content) .' '.esc_attr($bg_color).'">';
		while ( $posts_display->have_posts() ) {
			$posts_display->the_post();
			global $post;
			echo '<div class="post-item container">';
				
				if ( has_post_thumbnail() ) {
					echo '<div class="article-image">';
					echo '<a href="'.get_the_permalink().'">';
					the_post_thumbnail( array(670,400) );
					echo '<i class="las la-image"></i>';
					echo '</a>';
					echo '</div>';
				}
				
				echo '<div class="post-info">';
				echo '<h3 class="title"><a href="'. get_the_permalink().'">' . get_the_title() . '</a></h3>';
				echo '<div class="post-extra">';
				echo ' <span class="date"><i class="las la-clock"></i> ' .get_the_date('F j, Y'). '</span>';
				echo ' <span class="author"><i class="las la-user"></i>'. esc_html__('By ','sailing') . esc_html(get_the_author()) .'</span>';
				echo '</div>';
				echo '<div class="des">' . thim_excerpt( '15' ) . '</div>';
				if($instance['show_post_link'] == 'yes'){
					if(!empty($instance['post_text_link'])){
						echo '<a class="post-link" href="'.get_the_permalink().'">'.esc_html($instance['post_text_link']).'</a>';
					}
				}
				echo '</div>';
			echo '</div>';	
		}
		echo '</div>';
		wp_reset_postdata();
	}
echo '</div>'	
?>