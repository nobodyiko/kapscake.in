<?php
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}
$style = '';
if ( $instance['style'] <> '' ) {
	$style = $instance['style'];
}
$image_size = 'none';
if ( $instance['image_size'] && $instance['image_size'] <> 'none' ) {
	$image_size = $instance['image_size'];
}

$order      = isset( $instance['order'] ) ? $instance['order'] : 'desc';
$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => $number_posts,
	'order'          => $order,
);

if ( $instance['cat_id'] && $instance['cat_id'] != 'all' ) {
	$query_args['cat'] = $instance['cat_id'];
}
switch ( $instance['orderby'] ) {
	case 'recent' :
		$query_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$query_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$query_args['orderby'] = 'comment_count';
		break;
	default : //random
		$query_args['orderby'] = 'rand';
}

$posts_display = new WP_Query( $query_args );
if ( $posts_display->have_posts() ) {
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	echo '<div class="thim-list-posts ' . $style . '">';
	while ( $posts_display->have_posts() ) {
		$posts_display->the_post();
		global $post;
		$class = 'item-post';
		?>
		<div <?php post_class( $class ); ?>>
			<?php
			if ( $image_size <> 'none' && has_post_thumbnail() ) {
				echo '<div class="article-image">';
				echo the_post_thumbnail( $image_size, '' );
				echo '</div>';
			}
			echo '<div class="article-title-wrapper">';
			echo '<h5><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a></h5>';
			?>
			<div class="post-extra">
				<?php
					if ( comments_open() ) { ?>
						<span class="comment-total"><i class="las la-comments"></i>
							<?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post' ); ?>
						</span>
						<?php
					}
				?>
				<span class="author"><i class="las la-user"></i><?php echo esc_html__('By ') . esc_html(get_the_author()) ?></span>
			</div>
			<?php
			echo '</div>';
			echo '<div class="article-date"><span class="day">' . get_the_date( 'd' ) . '</span><span class="month">' . get_the_date( 'M' ) . '</span><span class="year">' . get_the_date( 'Y' ) . '</span></div>';
			?>
		</div>
		<?php
	}
	if ( $instance['link'] <> '' ) {
		echo '<div class="link_read_more"><a href="' . esc_url( $instance['link'] ) . '">' . esc_attr( $instance['text_link'] ) . '</a></div>';
	}
	echo '</div>';
	wp_reset_postdata();
}
?>