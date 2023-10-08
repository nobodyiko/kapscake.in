<?php
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
    $number_posts = $instance['number_posts'];
}
$style = '';
if ( $instance['style'] <> '' ) {
    $style = $instance['style'];
}
$order      = isset( $instance['order'] ) ? $instance['order'] : 'desc';
$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $number_posts,
    'order'          => $order,
);
$bg_title = isset($instance['bg_title']) ? $instance['bg_title'] : '';
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
echo '<div class="thim-slider-posts ' . $style . '">';
    if ( $instance['title'] ) {
        echo '<div class = "title-'. $instance['position_title'] .'">';
        echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
        echo '</div>';
    }
    echo '<h2 class="bg-title">'. esc_html($bg_title) .'</h2>';
    echo '<div class="slider-post-swapper "><div class="slider-post container">';
        if ( $posts_display->have_posts() ) {
            echo '<div class="thim-slider-image ">';
            while ( $posts_display->have_posts() ) {
            $posts_display->the_post();
            if ( has_post_thumbnail() ) {
                echo '<div class="article-image">';
                echo '<a href="'.get_the_permalink().'">';
                the_post_thumbnail( array(670,490) );
                echo '</a>';
                echo '</div>';
            }
            }
            wp_reset_postdata();
            echo '</div>'; 
        }

        if ( $posts_display->have_posts() ) {
            echo '<div class="thim-slider-info ">';
            while ( $posts_display->have_posts() ) {
            $posts_display->the_post();
            ?>
                <div class="item">
                    <h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <div class="post-extra">
                        <span class="date"><i class="las la-clock"></i><?php the_date('F j, Y') ?></span>
                        <span class="author"><i class="las la-user"></i><?php echo esc_html__('By ','sailing') . esc_html(get_the_author()) ?></span>
                    </div>
                    
                    <?php
                        if ( $instance['show_description'] && $instance['show_description'] <> 'no' ) {
                            if ( get_theme_mod( 'thim_archive_excerpt_length' ) ) {
                                $length = get_theme_mod( 'thim_archive_excerpt_length' );
                            } else {
                                $length = '20';
                            }
                            echo thim_excerpt( $length );
                        }
                    ?>
                </div>
                
            <?php    
            }
            wp_reset_postdata();
            echo '</div>'; 
        }
    echo '</div></div>';    
echo '</div>';

