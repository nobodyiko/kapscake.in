<?php
$number         = 6;
if ( $instance['number'] <> '' ) {
	$number = $instance['number'];
}
$testomonial_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $number
);
$lop_testimonial = new WP_Query( $testomonial_args );
echo '<div class="testimonials-style-2">';
    if ( $instance['title'] <> '' ) {
        echo '<div class="widget-box-title">';
        echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
        echo '</div>';
    }

    if ( $lop_testimonial->have_posts() ) {
        echo '<div class="sc-testimonials-img">';
        while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
        if ( has_post_thumbnail() ) {
            echo '<div class="avatar-testimonial">';
            echo thim_feature_image( get_post_thumbnail_id(), 160, 160 );
            echo '</div>';
        }
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    }
    if ( $lop_testimonial->have_posts() ) {
        echo '<div class="sc-testimonials-content ">';
        while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
            echo '<div class="item_testimonial">';
            $web_link        = get_post_meta( get_the_ID(), 'website_url', true );
            $before_web_link = $after_web_link = '';
            if ( $web_link <> '' ) {
                $before_web_link = '<a href="' . $web_link . '">';
                $after_web_link  = "</a>";
            }
            $regency = get_post_meta( get_the_ID(), 'regency', true );
            echo '<div class="title-regency">';
            echo '<h6> ' . $before_web_link . the_title( ' ', ' ', false ) . $after_web_link . ' </h6>';
            
            echo '</div>';

            echo '<div class="testimonial_content">';
            echo get_the_content();
            echo '</div>';

            if ( $regency <> '' ) {
                echo '<div class="regency">' . $regency . '</div>';
            }
            echo '</div>';
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    }
    
echo '</div>';
?>