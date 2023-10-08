<?php
function thim_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}

function thim_getExtraClass( $el_class ) {
	$output = '';
	if ( $el_class != '' ) {
		$output = " " . str_replace( ".", "", $el_class );
	}

	return $output;
}

function thim_getCSSAnimation( $css_animation ) {
	$output = '';
	wp_enqueue_script( 'waypoints' );
	if ( $css_animation != '' ) {
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}
	return $output;
}

function thim_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = strip_tags( preg_replace( '`\[[^\]]*\]`', '', $excerpt ) );

	return '<p>' . $excerpt . '</p>';
}

/************ List Comment ***************/
if ( ! function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		//extract( $args, EXTR_SKIP );
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
        <<?php echo ent2ncr( $tag . ' ' ) ?><?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
        <div class="wrapper-comment">
			<?php
			if ( $args['avatar_size'] != 0 ) {
				echo '<div class="avatar">';
				echo get_avatar( $comment, $args['avatar_size'] );
				echo '</div>';
			}
			?>
            <div class="comment-right">
				<?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sailing' ) ?></em>
				<?php endif; ?>

                <div class="comment-extra-info">
                    <div
                            class="author"><span class="author-name"><?php echo get_comment_author_link(); ?></span>
                    </div>
                    <div class="date" itemprop="commentTime">
						<?php printf( get_comment_date(), get_comment_time() ) ?></div>
					<?php edit_comment_link( esc_html__( 'Edit', 'sailing' ), '', '' ); ?>

					<?php comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply', 'sailing' ),
						'after'      => '',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) ); ?>
                </div>

                <div class="content-comment">
					<?php comment_text() ?>
                </div>
            </div>
        </div>
		<?php
	}
}
/************end list comment************/
/********************************************************************
 * Get image attach
 ********************************************************************/

function thim_feature_image( $attachment_id, $width = null, $height = null, $alt = null, $title = null ) {
 	$style = '';
	if ( $width && $height ) {
		$src   = wp_get_attachment_image_src( $attachment_id, array( $width, $height ) );
		$style = ' width="' . $width . '" height="' . $height . '"';
	} else {
		$src = wp_get_attachment_image_src( $attachment_id, 'full' );
		if ( ! empty( $src[1] ) && ! empty( $src[2] ) ) {
			$style = ' width="' . $src[1] . '" height="' . $src[2] . '"';
		}
	}

	if ( ! $src ) {
		$query_args    = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'meta_query'  => array(
				array(
					'key'     => '_wp_attached_file',
					'compare' => 'LIKE',
					'value'   => 'demo_image.jpg'
				)
			)
		);
		$attachment_id = get_posts( $query_args );
		if ( $attachment_id[0] ) {
			$attachment_id = $attachment_id[0]->ID;
			$src           = wp_get_attachment_image_src( $attachment_id, 'full' );
		}
	}

	if ( ! $alt ) {
		$alt = get_the_title( $attachment_id );
	}

	if ( ! $title ) {
		$title = get_the_title( $attachment_id );
	}

	return '<img src="' . esc_url( $src[0] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';

}

#remove field in Display settings
require TP_THEME_DIR . 'inc/wrapper-before-after.php';

add_filter( 'thim_mtb_setting_after_created', 'thim_mtb_setting_after_created', 10, 2 );
function thim_mtb_setting_after_created( $mtb_setting ) {
	$mtb_setting->removeOption( array( 6, 11 ) );

	$settings = array(
		'name' => esc_html__( 'No Padding Content', 'sailing' ),
		'id'   => 'mtb_no_padding',
		'type' => 'checkbox',
		'desc' => ' ',
	);

	$mtb_setting->insertOptionBefore( $settings, 15 );

	return $mtb_setting;
}

function thim_wp_new_excerpt( $text ) {
	if ( $text == '' ) {
		$text           = get_the_content( '' );
		$text           = strip_shortcodes( $text );
		$text           = apply_filters( 'the_content', $text );
		$text           = str_replace( ']]>', ']]>', $text );
		$text           = strip_tags( $text );
		$text           = nl2br( $text );
		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$words          = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}
	}

	return $text;
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'thim_wp_new_excerpt' );

function thim_post_share() {
	$icon_fb = 	'<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M22 11C22 8.82441 21.3549 6.69767 20.1462 4.88873C18.9375 3.07979 17.2195 1.66989 15.2095 0.83733C13.1995 0.00476594 10.9878 -0.21307 8.85401 0.211367C6.72022 0.635804 4.76021 1.68345 3.22183 3.22183C1.68345 4.76021 0.635804 6.72022 0.211367 8.85401C-0.21307 10.9878 0.00476594 13.1995 0.83733 15.2095C1.66989 17.2195 3.07979 18.9375 4.88873 20.1462C6.69767 21.3549 8.82441 22 11 22C13.9165 21.9971 16.7127 20.8373 18.775 18.775C20.8373 16.7127 21.9971 13.9165 22 11ZM11.6471 20.6843V13.3726H14.451C14.6226 13.3726 14.7872 13.3044 14.9085 13.183C15.0299 13.0617 15.098 12.8971 15.098 12.7255C15.098 12.5539 15.0299 12.3893 14.9085 12.268C14.7872 12.1466 14.6226 12.0784 14.451 12.0784H11.6471V9.27451C11.6499 8.76055 11.8553 8.26845 12.2187 7.90502C12.5822 7.54159 13.0743 7.33617 13.5882 7.33334H15.3137C15.4853 7.33334 15.6499 7.26516 15.7713 7.14382C15.8926 7.02247 15.9608 6.85789 15.9608 6.68628C15.9608 6.51467 15.8926 6.35009 15.7713 6.22874C15.6499 6.10739 15.4853 6.03922 15.3137 6.03922H13.5882C12.7311 6.04206 11.9098 6.38384 11.3037 6.98996C10.6976 7.59608 10.3558 8.41733 10.3529 9.27451V12.0784H7.54902C7.37741 12.0784 7.21283 12.1466 7.09148 12.268C6.97014 12.3893 6.90196 12.5539 6.90196 12.7255C6.90196 12.8971 6.97014 13.0617 7.09148 13.183C7.21283 13.3044 7.37741 13.3726 7.54902 13.3726H10.3529V20.6843C7.84044 20.5164 5.49152 19.3787 3.80223 17.5113C2.11295 15.6439 1.21554 13.193 1.29952 10.6763C1.38351 8.15961 2.44231 5.77405 4.25233 4.02342C6.06235 2.2728 8.48189 1.29415 11 1.29415C13.5181 1.29415 15.9377 2.2728 17.7477 4.02342C19.5577 5.77405 20.6165 8.15961 20.7005 10.6763C20.7845 13.193 19.8871 15.6439 18.1978 17.5113C16.5085 19.3787 14.1596 20.5164 11.6471 20.6843Z" fill="#909090"/>
			</svg>';
	$icon_tw = '<svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>';
	$icon_gg = '<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.49824 19C7.93593 18.9994 6.39785 18.6137 5.02022 17.8769C3.6426 17.1402 2.46792 16.0752 1.60022 14.7762C0.732515 13.4773 0.198559 11.9844 0.0456321 10.4299C-0.107295 8.87538 0.125525 7.30713 0.723477 5.86403C1.32143 4.42094 2.26606 3.14752 3.47373 2.15655C4.68139 1.16558 6.11482 0.487629 7.64709 0.182733C9.17936 -0.122163 10.7632 -0.0445965 12.2583 0.408564C13.7534 0.861725 15.1137 1.6765 16.2188 2.78073C16.3668 2.92914 16.45 3.13021 16.45 3.33984C16.45 3.54947 16.3668 3.75055 16.2188 3.89896C16.1459 3.97346 16.0589 4.03267 15.9629 4.07309C15.8669 4.1135 15.7637 4.13433 15.6595 4.13433C15.5553 4.13433 15.4522 4.1135 15.3562 4.07309C15.2601 4.03267 15.1731 3.97346 15.1003 3.89896C13.8297 2.62741 12.164 1.82604 10.3773 1.62663C8.59064 1.42723 6.78927 1.84165 5.26944 2.80176C3.74961 3.76187 2.60181 5.2105 2.01478 6.90944C1.42776 8.60837 1.43646 10.4565 2.03946 12.1498C2.64246 13.8431 3.80386 15.2809 5.33266 16.2266C6.86147 17.1724 8.66666 17.5698 10.4514 17.3536C12.2361 17.1374 13.8941 16.3204 15.1528 15.0369C16.4114 13.7535 17.1957 12.08 17.3768 10.2917H9.49824C9.28824 10.2917 9.08684 10.2083 8.93835 10.0598C8.78985 9.91133 8.70643 9.70996 8.70643 9.5C8.70643 9.29004 8.78985 9.08867 8.93835 8.94021C9.08684 8.79174 9.28824 8.70833 9.49824 8.70833H18.2082C18.4182 8.70833 18.6196 8.79174 18.7681 8.94021C18.9166 9.08867 19 9.29004 19 9.5C18.9948 12.018 17.992 14.4313 16.2112 16.2117C14.4304 17.9922 12.0167 18.9948 9.49824 19Z" fill="#909090"/>
				</svg>';
	$icon_pr = '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 8.42826C18 10.589 17.1944 12.5633 15.7317 13.9876C14.3712 15.3124 12.528 16.0723 10.6748 16.0723C8.64232 16.0723 7.37348 15.379 6.63259 14.7359L5.4257 19.5389C5.40775 19.615 5.37384 19.6869 5.32595 19.7506C5.27805 19.8143 5.21713 19.8684 5.14671 19.9099C5.0763 19.9513 4.99779 19.9792 4.91576 19.992C4.83372 20.0048 4.74979 20.0022 4.66884 19.9844C4.58788 19.9665 4.51152 19.9338 4.44418 19.8881C4.37684 19.8424 4.31986 19.7846 4.27656 19.7181C4.23326 19.6516 4.2045 19.5777 4.19195 19.5008C4.1794 19.4238 4.1833 19.3452 4.20343 19.2696L7.55211 5.9416C7.57007 5.86555 7.60398 5.7936 7.65187 5.72993C7.69976 5.66626 7.76069 5.61213 7.8311 5.57069C7.90152 5.52925 7.98002 5.50132 8.06206 5.48853C8.14409 5.47574 8.22803 5.47834 8.30898 5.49617C8.38994 5.51401 8.4663 5.54673 8.53364 5.59243C8.60098 5.63814 8.65796 5.69592 8.70125 5.76241C8.74455 5.82891 8.77331 5.90279 8.78587 5.97979C8.79842 6.05678 8.79452 6.13534 8.77438 6.2109L6.98566 13.3305C7.2793 13.7551 8.29039 14.8963 10.6748 14.8963C13.6582 14.8963 16.7442 12.4768 16.7442 8.42826C16.744 7.29551 16.4604 6.17856 15.9162 5.16694C15.372 4.15532 14.5823 3.27715 13.6104 2.60281C12.6385 1.92847 11.5115 1.47672 10.3196 1.28375C9.1277 1.09079 7.90411 1.16198 6.74689 1.49162C5.58967 1.82126 4.531 2.40018 3.65572 3.182C2.78044 3.96381 2.11289 4.92676 1.70658 5.99369C1.30026 7.06062 1.16648 8.20185 1.31594 9.32591C1.46541 10.45 1.89398 11.5256 2.56729 12.4667C2.65857 12.5961 2.69152 12.7541 2.65896 12.9062C2.62639 13.0584 2.53095 13.1923 2.39344 13.2788C2.25592 13.3653 2.08746 13.3974 1.92478 13.3681C1.7621 13.3388 1.61837 13.2505 1.52491 13.1224C0.741892 12.0288 0.243356 10.7786 0.0692633 9.47206C-0.104829 8.16551 0.050364 6.83893 0.522403 5.59868C0.994441 4.35842 1.7702 3.23899 2.78748 2.33011C3.80476 1.42123 5.03527 0.748186 6.38036 0.364939C7.72546 -0.018309 9.14773 -0.101103 10.5331 0.123194C11.9186 0.34749 13.2286 0.872638 14.3583 1.65654C15.4879 2.44044 16.4057 3.46129 17.0381 4.63725C17.6705 5.81321 18 7.11158 18 8.42826Z" fill="#909090"/>
				</svg>';

	if ( ( get_theme_mod( 'thim_archive_sharing_facebook' ) == 1 ) ||
	     ( get_theme_mod( 'thim_archive_sharing_twitter' ) == 1 ) ||
	     ( get_theme_mod( 'thim_archive_sharing_pinterest' ) ) == 1 ||
	     ( get_theme_mod( 'thim_archive_sharing_google' ) ) == 1
	) {
		echo '<ul class="social-share">';
		if ( get_theme_mod( 'thim_archive_sharing_facebook' ) == 1 ) {
			//echo '<li><a target="_blank" class="facebook" href="' . esc_url( 'https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . get_the_title() . '&amp;p[url]=' . urlencode( get_permalink() ) . '&amp;p[images][0]=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) ) . '" title="' . esc_html__( 'Facebook', 'sailing' ) . '"><i class="fa fa-facebook"></i></a></li>';
			echo '<li><a target="_blank" class="facebook"  href="https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" title="' . esc_attr__( 'Facebook', 'sailing' ) . '">'. $icon_fb .'</a></li>';
		}
		if ( get_theme_mod( 'thim_archive_sharing_twitter' ) == 1 ) {
			echo '<li><a target="_blank" class="twitter" href="' . esc_url( 'https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Twitter', 'sailing' ) . '">'. $icon_tw .'</a></li>';
		}
		if ( get_theme_mod( 'thim_archive_sharing_google' ) == 1 ) {
			echo '<li><a target="_blank" class="googleplus" href="' . esc_url( 'https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Google Plus', 'sailing' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'>'. $icon_gg .'</a></li>';
		}
		if ( get_theme_mod( 'thim_archive_sharing_pinterest' ) == 1 ) {
			echo '<li><a target="_blank" class="pinterest" href="' . esc_url( 'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . get_the_excerpt() . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) ) . '" onclick="window.open(this.href); return false;" title="' . esc_html__( 'Pinterest', 'sailing' ) . '">'. $icon_pr .'</a></li>';
		}

		echo '</ul>';
	}

}

add_action( 'thim_social_share', 'thim_post_share' );

add_filter( 'wp_nav_menu_args', 'thim_select_main_menu' );
function thim_select_main_menu( $args ) {
	global $post;
	if ( $post ) {
		if ( get_post_meta( $post->ID, 'thim_select_menu_one_page', true ) != 'default' && ( $args['theme_location'] == 'primary' ) ) {
			$menu         = get_post_meta( $post->ID, 'thim_select_menu_one_page', true );
			$args['menu'] = $menu;
		}
	}

	return $args;
}

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

/**
 * Get google font
 *
 * @param $query
 *
 * @return string
 */
function thim_google_font_family( $query ) {
	$font_url = add_query_arg( 'family', urlencode( $query ), "//fonts.googleapis.com/css" );

	return $font_url;
}


function thim_ssl_secure_url( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		if ( stripos( $sources, 'http://' ) === 0 ) {
			$sources = 'https' . substr( $sources, 4 );
		}

		return $sources;
	}

	return $sources;
}

function thim_ssl_secure_image_srcset( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		foreach ( $sources as &$source ) {
			if ( stripos( $source['url'], 'http://' ) === 0 ) {
				$source['url'] = 'https' . substr( $source['url'], 4 );
			}
		}

		return $sources;
	}

	return $sources;
}

add_filter( 'wp_calculate_image_srcset', 'thim_ssl_secure_image_srcset' );
add_filter( 'wp_get_attachment_url', 'thim_ssl_secure_url', 1000 );
add_filter( 'image_widget_image_url', 'thim_ssl_secure_url' );


/**
 * Change default comment fields
 *
 * @param $field
 *
 * @return string
 */
function thim_new_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? 'aria-required=true' : '' );

	$fields = array(
		'author' => '<p class="comment-form-author"><label for="comment">' . esc_attr__( 'Name', 'sailing' ) . '<span class="required">' . ( $req ? ' *' : '' ) . '</span></label>' . '<input placeholder="' . esc_attr__( 'Name', 'sailing' ) . ( $req ? ' *' : '' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="comment">' . esc_attr__( 'Email', 'sailing' ) . '<span class="required">' . ( $req ? ' *' : '' ) . '</span></label>' . '<input placeholder="' . esc_attr__( 'Email', 'sailing' ) . ( $req ? ' *' : '' ) . '" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="comment">' . esc_attr__( 'Website', 'sailing' ) . '</label>' . '<input placeholder="' . esc_attr__( 'Website', 'sailing' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	return $fields;
}

add_filter( 'comment_form_default_fields', 'thim_new_comment_fields', 1 );


// Custom loading image for contact form 7
add_filter( 'wpcf7_ajax_loader', 'thim_wpcf7_ajax_loader' );
function thim_wpcf7_ajax_loader() {
	return TP_THEME_URI . 'assets/images/loading.gif';
}

/**
 * Add google analytics & facebook pixel code
 */
if ( ! function_exists( 'thim_add_marketing_code' ) ) {
	function thim_add_marketing_code() {
		if ( get_theme_mod( 'thim_google_analytics' ) ) {
			?>
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                ga('create', '<?php echo get_theme_mod( 'thim_google_analytics' ); ?>', 'auto');
                ga('send', 'pageview');
            </script>
			<?php
		}
	}
}
add_action( 'wp_footer', 'thim_add_marketing_code' );

/**
 * Check a plugin active
 *
 * @param $plugin_dir
 * @param $plugin_file
 *
 * @return bool
 */
function thim_plugin_active( $plugin_dir, $plugin_file = null ) {
	$plugin_file            = $plugin_file ? $plugin_file : ( $plugin_dir . '.php' );
	$plugin                 = $plugin_dir . '/' . $plugin_file;
	$active_plugins_network = get_site_option( 'active_sitewide_plugins' );

	if ( isset( $active_plugins_network[ $plugin ] ) ) {
		return true;
	}

	$active_plugins = get_option( 'active_plugins' );

	if ( in_array( $plugin, $active_plugins ) ) {
		return true;
	}

	return false;
}

//pannel Widget Group
function thim_widget_group( $tabs ) {
	$tabs[] = array(
		'title'  => esc_html__( 'Thim Widget', 'sailing' ),
		'filter' => array(
			'groups' => array( 'thim_widget_group' )
		)
	);

	return $tabs;
}

add_filter( 'siteorigin_panels_widget_dialog_tabs', 'thim_widget_group', 19 );

//remove
function thim_row_style_fields( $fields ) {
	$fields['parallax'] = array(
		'name'        => esc_html__( 'Parallax', 'sailing' ),
		'type'        => 'checkbox',
		'group'       => 'design',
		'description' => esc_html__( 'If enabled, the background image will have a parallax effect.', 'sailing' ),
		'priority'    => 8,
	);

	return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'thim_row_style_fields' );

function thim_row_style_attributes( $attributes, $args ) {
	if ( ! empty( $args['parallax'] ) ) {
		array_push( $attributes['class'], 'article__parallax' );
	}

	if ( ! empty( $args['row_stretch'] ) && $args['row_stretch'] == 'full-stretched' ) {
		array_push( $attributes['class'], 'thim-fix-stretched' );
	}

	return $attributes;
}

add_filter( 'siteorigin_panels_row_style_attributes', 'thim_row_style_attributes', 10, 2 );


add_action( 'init', 'thim_add_excerpts_to_pages' );
function thim_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'hotel_booking_before_single_room_infomation', 'thim_hb_single_share' );
function thim_hb_single_share() {
	$html = '';
	if ( get_theme_mod( 'thim_hb_share_facebook' ) == 1 ||
	     get_theme_mod( 'thim_hb_share_twitter' ) == 1 ||
	     get_theme_mod( 'thim_hb_share_pinterest' ) == 1 ||
	     get_theme_mod( 'thim_hb_share_google' ) == 1
	) {
		$html .= '<div class="hb-share">'; 
		$html .= '<ul class="share_show">';
		if ( get_theme_mod( 'thim_hb_share_facebook' ) == 1 ) {
			$html .= '<li><a target="_blank" class="facebook" href="' . esc_url( 'https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) ) . '&amp;t=' . esc_attr( get_the_title() ) . '" title="' . esc_html__( 'Facebook', 'sailing' ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( get_theme_mod( 'thim_hb_share_twitter' ) == 1 ) {
			$html .= '<li><a target="_blank" class="twitter" href="' . esc_url( 'https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Twitter', 'sailing' ) . '"><i class="fa fa-x-twitter"></i></a></li>';
		}
		if ( get_theme_mod( 'thim_hb_share_pinterest' ) == 1 ) {
			$html .= '<li><a target="_blank" class="pinterest" href="' . esc_url( 'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . get_the_excerpt() . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) ) . '" onclick="window.open(this.href); return false;" title="' . esc_html__( 'Pinterest', 'sailing' ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( get_theme_mod( 'thim_hb_share_google' ) == 1 ) {
			$html .= '<li><a target="_blank" class="googleplus" href="' . esc_url( 'https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . esc_attr( get_the_title() ) ) . '" title="' . esc_html__( 'Google Plus', 'sailing' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
	}
	echo ent2ncr( $html );
}

//over thank you
add_action( 'template_include', 'thim_wphb_booking_received_template' );

if ( ! function_exists( 'thim_wphb_booking_received_template' ) ) {
	function thim_wphb_booking_received_template( $template ) {

		if ( false !== get_query_var( 'thank-you', false ) ) {
			return TP_THEME_DIR . '/wp-hotel-booking/checkout/thank-you.php';
		}

		return $template;
	}
}

add_filter( 'hotel_booking_add_to_cart_results', 'thim_filter_callback_hotel_booking_add_to_cart_results', 10, 2 );
function thim_filter_callback_hotel_booking_add_to_cart_results( $results, $room ) {
	$results['name'] = sprintf( '%s', $room->name );

	return $results;
}

/**
 * Show room type
 *
 * @return string
 */
add_action( 'hotel_booking_loop_room_title', 'thim_bh_show_room_types' );
function thim_bh_show_room_types() {
	the_terms( get_the_ID(), 'hb_room_type', '<div class="room-types">', '<span class="sep"></span>', '</div>' );
}

/**
 * Waring do not re-activate Thim Framework.
 */
function thim_notify_do_not_re_active_thim_framework() {
	if ( class_exists( 'Thim_Notification' ) ) {
		$detect_upgraded = get_option( 'thim_auto_updated_theme_mods_20', false );

		if ( ! $detect_upgraded ) {
			return;
		}

		$link_delete = network_admin_url( 'plugins.php?plugin_status=inactive' );

		Thim_Notification::add_notification(
			array(
				'id'          => 'do_not_support_thim_framework',
				'type'        => 'warning',
				'content'     => sprintf( __( 'Thim Core plugin is the newest upgrade version of Thim Framework. <strong>Do not re-activate Thim Framework and <a href="%s" title="Delete Thim Framework plugin">better delete this plugin</a></strong>.', 'sailing' ), $link_delete ),
				'dismissible' => true,
				'global'      => true,
			)
		);
	}
}

//add_action( 'admin_init', 'thim_notify_do_not_re_active_thim_framework' );

add_action( 'init', 'thim_add_excerpts_to_room' );
function thim_add_excerpts_to_room() {
	add_post_type_support( 'hb_room', 'excerpt' );
}

//Filter image all-demo tp-chameleon
if ( ! function_exists( 'thim_override_demo_image_tp_chameleon' ) ) {
	function thim_override_demo_image_tp_chameleon() {
		return TP_THEME_URI . 'assets/images/all-demo-sailing.png';
	}
}
add_filter( 'tp_chameleon_get_image_sprite_demos', 'thim_override_demo_image_tp_chameleon' );

/**
 * Filter demos path
 */
function thim_filter_site_demos( $demo_datas ) {
	$demo_data_file_path = get_template_directory() . '/inc/data/demos.php';
	if ( is_file( $demo_data_file_path ) ) {
		require $demo_data_file_path;
	}

	return $demo_datas;
}

add_filter( 'tp_chameleon_get_site_demos', 'thim_filter_site_demos' );

/**
 * @param $id
 * @param $size
 * @param $type : default is post
 *
 * @return string
 */
if ( ! function_exists( 'thim_get_thumbnail' ) ) {
	function thim_get_thumbnail( $id, $size = 'thumbnail', $type = 'post', $link = true, $classes = '' ) {
		$width         = 0;
		$height        = 0;
		$attachment_id = $id;
		$img_src       = '';
		if ( $type === 'post' ) {
			$attachment_id = get_post_thumbnail_id( $id );
		}
		if ( ! in_array( $size, get_intermediate_image_sizes() ) ) {
			$thumbnail_size = explode( 'x', $size );
			$width          = $thumbnail_size[0];
			$height         = $thumbnail_size[1];
			$src            = wp_get_attachment_image_src( $attachment_id, array( $width, $height ) );
			$img_src        = $src[0];
		} else {
			$src     = wp_get_attachment_image_src( $attachment_id, $size );
			$img_src = $src[0];
		}

		if ( ! $src ) {
			$query_args    = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'meta_query'  => array(
					array(
						'key'     => '_wp_attached_file',
						'compare' => 'LIKE',
						'value'   => 'demo_image.jpg'
					)
				)
			);
			$attachment_id = get_posts( $query_args );
			if ( $attachment_id[0] ) {
				$attachment_id = $attachment_id[0]->ID;
				$src           = wp_get_attachment_image_src( $attachment_id, 'full' );
				$img_src       = $src[0];
			}
		}


		$html = '';
		if ( $link ) {
			$html .= '<a href="' . esc_url( get_permalink( $id ) ) . '" class="img-link" target="_self">';
		}
		$html .= '<img ' . image_hwstring( $width, $height ) . ' src="' . esc_attr( $img_src ) . '" alt="' . get_the_title( $id ) . '" class="' . $classes . '">';
		if ( $link ) {
			$html .= '</a>';
		}

		return $html;
	}
}

/**
 * @param      $id
 * @param      $size
 */
if ( ! function_exists( 'thim_thumbnail' ) ) {
	function thim_thumbnail( $id, $size, $type = 'post', $link = true, $classes = '' ) {
		echo thim_get_thumbnail( $id, $size, $type, $link, $classes );
	}
}

/**
 * Add button on single room
 *
 * @return string
 * minhpd edit : 11-5-2022
 */
function thim_single_add_button() {
	if ( is_singular( 'hb_room' ) ) {
		if ( class_exists( 'WP_Hotel_Booking' ) ) {
			if ( class_exists( 'WP_Hotel_Booking_Room_Extension' ) ) {
				get_template_part( 'wp-hotel-booking-room/single-search', 'button' );
			}
		}
	}
}

add_action( 'thim_sidebar_before', 'thim_single_add_button', 10 );

/* Removing the action that adds the "Book this room" button to the single room page. */
if ( class_exists( 'WP_Hotel_Booking_Room_Extension' ) ) {
	remove_action(
		'hotel_booking_single_room_title',
		array(
			WP_Hotel_Booking_Room_Extension::instance(),
			'single_add_button',
		),
		9
	);
}

/**
 * todo: minhpd - rewrite
 */
// if ( class_exists( 'TP_Hotel_Booking_Room' ) ) {
// 	remove_action( 'hotel_booking_single_room_title', array(
// 		TP_Hotel_Booking_Room()->booking,
// 		'single_add_button'
// 	), 9 );
// }

// remove <br> tags from text widget content, from 4.8 version WP adds these tags
remove_filter( 'widget_text_content', 'wpautop' );

/**
 * Check import demo data page-builder
 */
add_action( 'wp_ajax_thim_update_theme_mods', 'thim_import_demo_page_builder' );
if ( ! function_exists( 'thim_import_demo_page_builder' ) ) {
	function thim_import_demo_page_builder() {
		$thim_key   = sanitize_text_field( $_POST["thim_key"] );
		$thim_value = sanitize_text_field( $_POST["thim_value"] );
		if ( ! is_multisite() ) {
			$active_plugins = get_option( 'active_plugins' );

			if ( $thim_value == 'visual_composer' ) {
				if ( ( $key = array_search( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}
				if ( ( $key = array_search( 'elementor/elementor.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}
				if ( ( $key = array_search( 'anywhere-elementor/anywhere-elementor.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}

			} else if ( $thim_value == 'site_origin' ) {
				if ( ( $key = array_search( 'elementor/elementor.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}
				if ( ( $key = array_search( 'anywhere-elementor/anywhere-elementor.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}
				if ( ! in_array( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) {
					$active_plugins[] = 'siteorigin-panels/siteorigin-panels.php';
				}

			} else if ( $thim_value == 'elementor' ) {
				if ( ( $key = array_search( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) !== false ) {
					unset( $active_plugins[ $key ] );
				}
				if ( ! in_array( 'elementor/elementor.php', $active_plugins ) ) {
					$active_plugins[] = 'elementor/elementor.php';
				}
				if ( ! in_array( 'anywhere-elementor/anywhere-elementor.php', $active_plugins ) ) {
					$active_plugins[] = 'anywhere-elementor/anywhere-elementor.php';
				}

			}
			update_option( 'active_plugins', $active_plugins );
		}

		if ( empty( $thim_key ) || empty( $thim_value ) ) {
			$output = 'update fail';
		} else {
			set_theme_mod( $thim_key, $thim_value );
			$output = 'update success';
		}

		echo ent2ncr( $output );
		die();
	}
}

/**
 * Get Event Upcoming
 */
//Filter post_status tp_event
if ( ! function_exists( 'thim_get_upcoming_events' ) ) {
	function thim_get_upcoming_events( $limit = 1, $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			$args = wp_parse_args(
				$args,
				array(
					'post_type'      => 'tp_event',
					'posts_per_page' => $limit,
					'meta_query'     => array(
						array(
							'key'     => 'tp_event_status',
							'value'   => 'upcoming',
							'compare' => '=',
						),
					),
					'tax_query'      => array(
						array(
							'taxonomy' => 'tp_event_category',
							'field'    => 'slug',
							'terms'    => get_query_var( 'term' ),
						)
					),
				)
			);
		} else {
			$args = wp_parse_args(
				$args,
				array(
					'post_type'      => 'tp_event',
					'posts_per_page' => $limit,
					'meta_query'     => array(
						array(
							'key'     => 'tp_event_status',
							'value'   => 'upcoming',
							'compare' => '=',
						),
					),
				)
			);
		}

		return new WP_Query( $args );
	}
}

/* breadcrumbs */

/**
 * Get breadcrumb for page
 *
 * @return string
 */
function thim_get_breadcrumb_items_other() {
	global $author;
	$userdata   = get_userdata( $author );
	$categories = get_the_category();
	if ( is_front_page() ) { // Do not display on the homepage
		return;
	}
	if ( is_home() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_attr( get_the_title( get_option( 'page_for_posts', true ) ) ) . '</span></li>';
	} else {
		if ( is_category() ) {
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $categories[0]->cat_name ) . '</span></li>';
		} else {
			if ( is_tag() ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( single_term_title( '', false ) ) . '">' . esc_html( single_term_title( '', false ) ) . '</span></li>';
			} else {
				if ( is_year() ) {
					echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></li>';
				} else {
					if ( is_author() ) {
						echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( $userdata->display_name ) . '">' . esc_html__( 'Author', 'hotel-wp' ) . ' ' . esc_html( $userdata->display_name ) . '</span></li>';
					} else {
						if ( get_query_var( 'paged' ) ) {
							echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Page', 'hotel-wp' ) . ' ' . get_query_var( 'paged' ) . '">' . esc_html__( 'Page', 'hotel-wp' ) . ' ' . esc_html( get_query_var( 'paged' ) ) . '</span></li>';
						} else {
							if ( is_search() ) {
								echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Search results for:', 'hotel-wp' ) . ' ' . esc_attr( get_search_query() ) . '">' . esc_html__( 'Search results for:', 'hotel-wp' ) . ' ' . esc_html( get_search_query() ) . '</span></li>';
							} elseif ( is_404() ) {
								echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( '404 Error', 'hotel-wp' ) . '">' . esc_html__( '404 Error', 'hotel-wp' ) . '</span></li>';
							} elseif ( is_post_type_archive() ) {
								echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . post_type_archive_title( '', false ) . '">' . post_type_archive_title( '', false ) . '</span></li>';
							} elseif ( is_tax() ) {
								echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . single_term_title( '', false ) . '">' . single_term_title( '', false ) . '</span></li>';
							}
						}
					}
				}
			}
		}
	}
}

/**
 * Get content breadcrumbs
 *
 * @return string
 */
if ( !function_exists( 'thim_breadcrumbs' ) ) {
	function thim_breadcrumbs() {
		global $post;
		$categories   = get_the_category();
		$thim_options = get_theme_mods();
		$icon         = '<i class="las la-angle-right"></i>';
		if ( isset( $thim_options['breadcrumb_icon'] ) ) {
			$icon = html_entity_decode( get_theme_mod( 'breadcrumb_icon' ) );
		}
		// Build the breadcrums
		echo '<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">';
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr__( 'Home', 'hotel-wp' ) . '"><span itemprop="name">' . esc_html__( 'Home', 'hotel-wp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
		if ( is_single() ) { // Single post (Only display the first category)
			if ( isset( $categories[0] ) ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" title="' . esc_attr( $categories[0]->cat_name ) . '"><span itemprop="name">' . esc_html( $categories[0]->cat_name ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
			} elseif ( $terms = get_the_terms( get_the_ID(), 'hb_room_type' ) ) {
				if ( !is_wp_error( $terms ) ) {
					echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $terms[0]->term_id, 'hb_room_type' ) ) . '" title="' . esc_attr( $terms[0]->name ) . '"><span itemprop="name">' . esc_html( $terms[0]->name ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
				}
			}
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';
		} else {
			if ( is_page() ) {
				// Standard page
				if ( $post->post_parent ) {
					$anc = get_post_ancestors( $post->ID );
					$anc = array_reverse( $anc );
					// Parent page loop
					foreach ( $anc as $ancestor ) {
						echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '"><span itemprop="name">' . esc_html( get_the_title( $ancestor ) ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
					}
				}
				// Current page
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';
			} elseif ( is_day() ) {// Day archive
				// Year link
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
				// Month link
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
				// Day display
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'jS' ) ) . '"> ' . esc_html( get_the_time( 'jS' ) ) . ' ' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></li>';

			} else {
				if ( is_month() ) {
					// Year link
					echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
					echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'hotel-wp' ) . '</span></li>';
				}
			}
		}
		thim_get_breadcrumb_items_other();
		echo '</ul>';
	}
}

function thim_breadcrumb_delimiter( $defaults ) {
  	$icon = html_entity_decode( get_theme_mod( 'breadcrumb_icon', '<i class="las la-angle-right"></i>' ) );
	if(get_theme_mod('thim_top_site_main_layout')== 'layout-2'){
		$icon = '<i class="las la-square-full"></i>';
	}
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<li><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';

	return $defaults;
}

add_filter( 'thim_breadcrumb_defaults', 'thim_breadcrumb_delimiter' );

add_action( 'thim_before_body', 'thim_remove_preload' , 15 );
add_action( 'thim_ekit/header_footer/template/before_header', 'thim_remove_preload' , 10 );
function thim_remove_preload() {
	if ( get_theme_mod( 'thim_preload', true )) {
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		setTimeout(function () {
			var preload = document.getElementById('preload');
			if(preload){
				preload.remove();
			}
		}, 1500);
		/* ]]> */
	</script>
	<?php 
	}
}