<?php
wp_enqueue_script('owl-carousel');
$thim_animation = $html = $layout = '';
$number         = 4;
$number_column = !empty($instance['number_column']) ? $instance['number_column'] : 1;
if ( $instance['number'] <> '' ) {
	$number = $instance['number'];
}

$testomonial_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $number
);

$lop_testimonial = new WP_Query( $testomonial_args );
$css             = $content_css = $title_css = $regency_css = '';

$html .= '<div class="testimonial_style_new">';
if ( $lop_testimonial->have_posts() ) {
	$html .= '<div class="sc-testimonials owl-carousel" data-column="'.esc_attr($number_column).'" data-time="' . $instance['time'] . '">';
	while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
		$html            .= '<div class="item_testimonial">';
		$html            .= '<div class="avatar-testimonial">';
		$html            .= thim_get_thumbnail( get_the_ID(), '480x456', 'post', false );
		$html            .= '</div>';
		$web_link        = get_post_meta( get_the_ID(), 'website_url', true );
		$before_web_link = $after_web_link = '';
		if ( $web_link <> '' ) {
			$before_web_link = '<a href="' . $web_link . '">';
			$after_web_link  = "</a>";
		}
		$regency = get_post_meta( get_the_ID(), 'regency', true );
		$html    .= '<div class="testimonial_content">';
		$html    .= '<div class="title-regency">';
		$html    .= '<h6> ' . $before_web_link . the_title( ' ', ' ', false ) . $after_web_link . ' </h6>';
		if ( $regency <> '' ) {
			$html .= '<div class="regency">' . $regency . '</div>';
		}
		$html .= '</div>';
		$html .= '<p class="content-text">';
		$html .= get_the_content();
		$html .= '</p>';
		$html .= '</div>';
		$html .= '</div>';
	endwhile;
	$html .= '</div>';
}
$html .= '</div>';

wp_reset_postdata();
echo ent2ncr( $html );