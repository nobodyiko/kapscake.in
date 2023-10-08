<?php
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}

$order      = isset( $instance['order'] ) ? $instance['order'] : 'desc';
$query_args = array(
	'posts_per_page' => $number_posts,
	'order'          => $order,
);

$column = 12 / $instance['column'];

$class = 'col-md-' . $column;

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
$i             = 0;
if ( $posts_display->have_posts() ) {
	echo '<ul class="thim-column-posts">';
	while ( $posts_display->have_posts() ) {
		$posts_display->the_post();
		echo '<div class="post-item ' . $class . '">';
		global $post;
		$i = $i + 1;
		if ( $i % 2 == 0 ) {
			?>
			<li <?php post_class(); ?>>
				<?php
				if ( has_post_thumbnail() ) {
					echo '<div class="article-image">';
					echo thim_get_thumbnail( get_the_ID(), '434x419', 'post', false );
					echo '</div>';
				}
				echo '<div class="article-title-wrapper">';
				echo '<div class="category">';
				$category = get_the_category();
				echo $category[0]->cat_name;
				echo '</div>';
				echo '<h5><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a></h5>';
				if ( get_theme_mod( 'thim_archive_excerpt_length' ) ) {
					$length = get_theme_mod( 'thim_archive_excerpt_length' );
				} else {
					$length = '20';
				}
				echo thim_excerpt( $length );
				echo '<div class="button_read_more"><a href="' . esc_url( get_permalink() ) . '">' . esc_attr__( 'Read More', 'sailing' ) . '</a></div>';
				echo '</div>';
				?>
			</li>
			<?php
		} else {
			?>
			<li <?php post_class(); ?>>
				<?php
				echo '<div class="article-title-wrapper">';
				echo '<div class="category">';
				$category = get_the_category();
				echo $category[0]->cat_name;
				echo '</div>';
				echo '<h5><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a></h5>';
				if ( get_theme_mod( 'thim_archive_excerpt_length' ) ) {
					$length = get_theme_mod( 'thim_archive_excerpt_length' );
				} else {
					$length = '30';
				}
				echo thim_excerpt( $length );
				echo '<div class="button_read_more"><a href="' . esc_url( get_permalink() ) . '">' . esc_attr__( 'Read More', 'sailing' ) . '</a></div>';
				echo '</div>';
				if ( has_post_thumbnail() ) {
					echo '<div class="article-image">';
					echo thim_get_thumbnail( get_the_ID(), '434x419', 'post', false );
					echo '</div>';
				}
				?>
			</li>
		<?php }
		echo '</div>';
	}
	echo '</ul>';
	wp_reset_postdata();
}
?>