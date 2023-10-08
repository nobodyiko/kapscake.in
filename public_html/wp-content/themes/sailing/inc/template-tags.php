<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package thim
 */
if ( !function_exists( 'thim_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_paging_nav() {
		global $wp_query, $wp_rewrite;

		$total        = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );

		$query_args = array();
		$url_parts  = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $wp_rewrite->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $total,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="tk tk-arrow-left"></i>' . esc_html__( 'Prev', 'sailing' ),
			'next_text' => esc_html__( 'Next', 'sailing' ) . '<i class="tk tk-arrow-right"></i>',
			'type'      => 'list'
		) );

		if ( $links ) :
			?>
			<div class="pagination loop-pagination">
				<?php //echo '<span> Page </span>'
				?>
				<?php echo ent2ncr( $links ); ?>
			</div>
			<!-- .pagination -->
		<?php
		endif;
	}
endif;

if ( !function_exists( 'thim_post_nav' ) ) :

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function thim_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( !$next && !$previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_attr_e( 'Post navigation', 'sailing' ); ?></h1>

			<div class="nav-links">
				<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'sailing' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'sailing' ) );
				?>
			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}

endif;

if ( !function_exists( 'thim_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thim_entry_meta() {
		?>
		<ul class="entry-meta">
			<?php
			if ( get_theme_mod( 'thim_single_show_date' ) == true && get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2') {
				?>
				<li class="date-meta">
				<i aria-hidden="true" class="tk tk-calendar-check"></i>
					<?php echo thim_get_time_link() ?>
				</li>
				<?php
			}
			if ( get_theme_mod( 'thim_single_show_comment' ) == 1 && get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2') {
				if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
					?>
					<li class="comment-total">
					<i aria-hidden="true" class="tk tk-comment-dots"></i>
					<?php comments_popup_link( esc_html__( '0 Comment', 'sailing' ), esc_html__( '1 Comment', 'sailing' ), esc_html__( '% comments', 'sailing' ) ); ?>
					</li>
					<?php
				endif;
			}
			if ( get_theme_mod( 'thim_single_show_author' ) == 1 ) {
				?>
				<li class="author">
					<?php if(get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2'): ?>
						<i aria-hidden="true" class="tk tk-users"></i>
						<span><?php echo esc_html__( 'By', 'sailing' ); ?></span>
					<?php else: ?>
					<span><?php echo esc_html__( 'Post by', 'sailing' ); ?></span>
					<?php endif; ?>
					<?php printf( ' <a href="%1$s">%2$s</a>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_html( get_the_author() )
					); ?>
				</li>
				<?php
			}
			if ( get_theme_mod( 'thim_single_show_category' ) == 1 && get_the_category() && get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-1') {
				?>
				<li>
					<span><?php echo esc_attr_e( 'on', 'sailing' ); ?></span> <?php the_category( ', ', '' ); ?>
				</li>
				<?php
			}

			if ( get_theme_mod( 'thim_single_show_comment' ) == 1 && get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-1') {
				?>
				<?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
					?>
					<li class="comment-total">
						<?php comments_popup_link( esc_html__( '0 comment', 'sailing' ), esc_html__( '1 comment', 'sailing' ), esc_html__( '% comments', 'sailing' ) ); ?>
					</li>
				<?php
				endif;
			}
			?>

		</ul>
		<?php
	}
endif;

/**
 * Get tags meta
 *
 * @return string
 */
if ( !function_exists( 'thim_get_entry_meta_tags' ) ) :
	function thim_get_entry_meta_tags() {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			return sprintf( $tags_list );
		}

		return '';
	}
endif;

add_action( 'thim_post_footer', 'thim_single_post_related', 10 );

if ( ! function_exists( 'thim_single_post_related' ) ) {
	function thim_single_post_related() {
		get_template_part( 'related' , 'single' );
	}
}

/**
 * Get related posts
 *
 * @return WP_Query
 */
if ( ! function_exists( 'thim_get_related_posts' ) ) {
	function thim_get_related_posts() {
		global $post;
		$number_posts  = (int) get_theme_mod( 'thim_archive_single_related_post_column', 2 );
		$categories    = wp_get_post_categories($post->ID);
		$related_query = new WP_Query();

		if( isset( $categories[0] )){

			$related_args  = array(
				'category__in'        => $categories,
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => $number_posts,
				'ignore_sticky_posts' => 1,
			);
			$related_query = new WP_Query( $related_args );

		}

		return $related_query;
	}
}

if ( ! function_exists( 'thim_get_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function thim_get_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
		/* translators: %s: post date */
			__( '%s Posted on %s %s', 'sailing' ),
			'<span class="screen-reader-text">',
			'</span>',
			trim( $time_string )
		);
	}
endif;

if ( !function_exists( 'thim_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thim_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( 'Posted on %s', 'post date', 'sailing' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'by %s', 'post author', 'sailing' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;

if ( !function_exists( 'thim_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function thim_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'sailing' ) );
			if ( $categories_list && thim_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'sailing' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'sailing' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'sailing' ) . '</span>', $tags_list );
			}
		}

		if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'sailing' ), esc_html__( '1 Comment', 'sailing' ), esc_html__( '% Comments', 'sailing' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'sailing' ), '<span class="edit-link">', '</span>' );
	}

endif;

if ( !function_exists( 'thim_the_archive_title' ) ) :

	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function thim_the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( esc_html__( '%s', 'sailing' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( '%s', 'sailing' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( 'Author: %s', 'sailing' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', 'sailing' ), get_the_date( _x( 'Y', 'yearly archives date format', 'sailing' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', 'sailing' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'sailing' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', 'sailing' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'sailing' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'sailing' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'sailing' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( 'Archives: %s', 'sailing' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'sailing' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} elseif ( is_search() ) {
			$title = sprintf( esc_html__( 'Search Results for: %s', 'sailing' ), get_search_query() );
		} else {
			$title = esc_html__( 'Archives', 'sailing' );
		}
		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( !empty( $title ) ) {
			return ent2ncr( $before . $title . $after );
		}
	}
endif;

if ( !function_exists( 'the_archive_description' ) ) :

	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( !empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo ent2ncr( $before . $description . $after );
		}
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function thim_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'thim_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'thim_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so thim_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so thim_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in thim_categorized_blog.
 */
function thim_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'thim_categories' );
}

add_action( 'edit_category', 'thim_category_transient_flusher' );
add_action( 'save_post', 'thim_category_transient_flusher' );

/**
 * Display favicon
 */
function thim_favicon() {
	if ( function_exists( 'wp_site_icon' ) ) {
		if ( function_exists( 'has_site_icon' ) ) {
			if ( !has_site_icon() ) {
				// Icon default
				$thim_favicon_src = get_template_directory_uri() . "/assets/images/favicon.png";
				echo '<link rel="shortcut icon" href="' . esc_url( $thim_favicon_src ) . '" type="image/x-icon" />';

				return;
			}

			return;
		}
	}

	/**
	 * Support WordPress < 4.3
	 */
	$thim_favicon_src = '';
	if ( get_theme_mod( 'thim_favicon' ) ) {
		$thim_favicon       = get_theme_mod( 'thim_favicon' );
		$favicon_attachment = wp_get_attachment_image_src( $thim_favicon, 'full' );
		$thim_favicon_src   = $favicon_attachment[0];
	}
	if ( !$thim_favicon_src ) {
		$thim_favicon_src = get_template_directory_uri() . "/assets/images/favicon.png";
	}
	echo '<link rel="shortcut icon" href="' . esc_url( $thim_favicon_src ) . '" type="image/x-icon" />';
}

add_action( 'wp_head', 'thim_favicon' );

/**
 * Preload
 */
 function thim_preloading() {
	?>
	<?php if ( get_theme_mod( 'thim_preload' ) == 1 ) { ?>
		<div id="preload">
			<?php if ( get_theme_mod( 'thim_preload_circle' ) == true ) { ?>
				<div class="loading-circle"></div>
			<?php } else { ?>
			<div class="loading-inner">
				<div class="loading loading-1"></div>
				<div class="loading loading-2"></div>
				<div class="loading loading-3"></div>
				<div class="loading loading-4"></div>
				<div class="loading loading-5"></div>
				<div class="loading loading-6"></div>
				<div class="loading loading-7"></div>
				<div class="loading loading-8"></div>
				<div class="loading loading-9"></div>
			</div>
			<?php } ?>
		</div>
	<?php } else {
		if ( get_theme_mod( 'thim_preload' ) == "image" ) { ?>
			<div id="preload">
				<div class="loading-inner">
					<?php
					do_action( 'thim_preload_image' );
					?>
				</div>
			</div>
		<?php }
	}
}
add_action( 'thim_before_body', 'thim_preloading' , 10 );
add_action( 'thim_ekit/header_footer/template/before_header', 'thim_preloading' , 5 );

// number result on page
add_action( 'thim_result_on_page', 'thim_result_on_page_function' ); 
function thim_result_on_page_function(){
	global $wp_query;
	$total = $wp_query->found_posts;

	if ( $total == 0 ) {
		$message = '<p class="message message-error">' . esc_html__( 'No post found!', 'sailing' ) . '</p>';
		$index   = esc_html__( 'There are no available post!', 'sailing' );
	} elseif ( $total == 1 ) {
		$index = esc_html__( 'Show only one result', 'sailing' );
	} else {
		$post_per_page_get = get_option( 'posts_per_page' );
		$post_per_page     = is_numeric( $post_per_page_get ) ? $post_per_page_get : 12;
		$paged             = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$from = 1 + ( $paged - 1 ) * $post_per_page;
		$to   = ( $paged * $post_per_page > $total ) ? $total : $paged * $post_per_page;

		if ( $from == $to ) {
			$index = sprintf(
				esc_html__( 'Show last post of %s results', 'sailing' ),
				$total
			);
		} else {
			$index = sprintf(
				esc_html__( 'Show %s - %s of %s', 'sailing' ),
				$from,
				$to,
				$total
			);
		}
	}
	?>
	<div class="post-index">
		<span><?php echo( $index ); ?></span>
   	</div>
	<?php

}

// swich layout
add_action( 'thim_switch_layout', 'thim_switch_layout_function' ); 
function thim_switch_layout_function(){
	wp_enqueue_script('cookie');
	$cookie = $data_active = '';
	$icon_list = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.4406 3.35646H9.37122C9.22286 3.35646 9.08057 3.29752 8.97566 3.19261C8.87075 3.0877 8.81181 2.94541 8.81181 2.79705C8.81181 2.64868 8.87075 2.50639 8.97566 2.40149C9.08057 2.29658 9.22286 2.23764 9.37122 2.23764H19.4406C19.589 2.23764 19.7312 2.29658 19.8362 2.40149C19.9411 2.50639 20 2.64868 20 2.79705C20 2.94541 19.9411 3.0877 19.8362 3.19261C19.7312 3.29752 19.589 3.35646 19.4406 3.35646ZM19.4406 10.5594H9.37122C9.22286 10.5594 9.08057 10.5005 8.97566 10.3956C8.87075 10.2907 8.81181 10.1484 8.81181 10C8.81181 9.85163 8.87075 9.70935 8.97566 9.60444C9.08057 9.49953 9.22286 9.44059 9.37122 9.44059H19.4406C19.589 9.44059 19.7312 9.49953 19.8362 9.60444C19.9411 9.70935 20 9.85163 20 10C20 10.1484 19.9411 10.2907 19.8362 10.3956C19.7312 10.5005 19.589 10.5594 19.4406 10.5594ZM19.4406 17.759H9.37122C9.22286 17.759 9.08057 17.7001 8.97566 17.5952C8.87075 17.4902 8.81181 17.348 8.81181 17.1996C8.81181 17.0512 8.87075 16.9089 8.97566 16.804C9.08057 16.6991 9.22286 16.6402 9.37122 16.6402H19.4406C19.589 16.6402 19.7312 16.6991 19.8362 16.804C19.9411 16.9089 20 17.0512 20 17.1996C20 17.348 19.9411 17.4902 19.8362 17.5952C19.7312 17.7001 19.589 17.759 19.4406 17.759ZM2.79705 5.59409C2.24384 5.59409 1.70306 5.43005 1.24309 5.12271C0.78312 4.81536 0.424616 4.37852 0.212914 3.86743C0.00121192 3.35634 -0.0541789 2.79394 0.0537457 2.25137C0.16167 1.7088 0.428063 1.21041 0.819237 0.819237C1.21041 0.428063 1.7088 0.16167 2.25137 0.0537457C2.79394 -0.0541789 3.35634 0.00121192 3.86743 0.212914C4.37852 0.424616 4.81536 0.78312 5.12271 1.24309C5.43005 1.70306 5.59409 2.24384 5.59409 2.79705C5.59409 3.16436 5.52175 3.52808 5.38118 3.86743C5.24062 4.20678 5.03459 4.51513 4.77486 4.77486C4.51513 5.03459 4.20678 5.24062 3.86743 5.38118C3.52808 5.52175 3.16436 5.59409 2.79705 5.59409ZM2.79705 1.11882C2.46513 1.11882 2.14066 1.21725 1.86467 1.40165C1.58869 1.58606 1.37359 1.84816 1.24657 2.15482C1.11955 2.46147 1.08631 2.79891 1.15107 3.12445C1.21582 3.45 1.37566 3.74903 1.61036 3.98373C1.84507 4.21844 2.1441 4.37827 2.46964 4.44303C2.79519 4.50778 3.13262 4.47455 3.43928 4.34753C3.74593 4.22051 4.00804 4.0054 4.19244 3.72942C4.37685 3.45344 4.47527 3.12897 4.47527 2.79705C4.47527 2.35195 4.29846 1.92509 3.98373 1.61036C3.669 1.29563 3.24214 1.11882 2.79705 1.11882ZM2.79705 12.797C2.24384 12.797 1.70306 12.633 1.24309 12.3257C0.78312 12.0183 0.424616 11.5815 0.212914 11.0704C0.00121192 10.5593 -0.0541789 9.9969 0.0537457 9.45432C0.16167 8.91175 0.428063 8.41336 0.819237 8.02219C1.21041 7.63102 1.7088 7.36462 2.25137 7.2567C2.79394 7.14877 3.35634 7.20416 3.86743 7.41587C4.37852 7.62757 4.81536 7.98607 5.12271 8.44604C5.43005 8.90602 5.59409 9.4468 5.59409 10C5.59409 10.7418 5.29941 11.4533 4.77486 11.9778C4.25031 12.5024 3.53887 12.797 2.79705 12.797ZM2.79705 8.32177C2.46513 8.32177 2.14066 8.4202 1.86467 8.6046C1.58869 8.78901 1.37359 9.05111 1.24657 9.35777C1.11955 9.66443 1.08631 10.0019 1.15107 10.3274C1.21582 10.653 1.37566 10.952 1.61036 11.1867C1.84507 11.4214 2.1441 11.5812 2.46964 11.646C2.79519 11.7107 3.13262 11.6775 3.43928 11.5505C3.74593 11.4235 4.00804 11.2084 4.19244 10.9324C4.37685 10.6564 4.47527 10.3319 4.47527 10C4.47527 9.55491 4.29846 9.12804 3.98373 8.81331C3.669 8.49858 3.24214 8.32177 2.79705 8.32177ZM2.79705 20C2.24384 20 1.70306 19.836 1.24309 19.5286C0.78312 19.2213 0.424616 18.7844 0.212914 18.2733C0.00121192 17.7622 -0.0541789 17.1998 0.0537457 16.6573C0.16167 16.1147 0.428063 15.6163 0.819237 15.2251C1.21041 14.834 1.7088 14.5676 2.25137 14.4597C2.79394 14.3517 3.35634 14.4071 3.86743 14.6188C4.37852 14.8305 4.81536 15.189 5.12271 15.649C5.43005 16.109 5.59409 16.6497 5.59409 17.203C5.59409 17.9448 5.29941 18.6562 4.77486 19.1808C4.25031 19.7053 3.53887 20 2.79705 20ZM2.79705 15.5247C2.46513 15.5247 2.14066 15.6232 1.86467 15.8076C1.58869 15.992 1.37359 16.2541 1.24657 16.5607C1.11955 16.8674 1.08631 17.2048 1.15107 17.5304C1.21582 17.8559 1.37566 18.1549 1.61036 18.3896C1.84507 18.6243 2.1441 18.7842 2.46964 18.8489C2.79519 18.9137 3.13262 18.8805 3.43928 18.7534C3.74593 18.6264 4.00804 18.4113 4.19244 18.1353C4.37685 17.8593 4.47527 17.5349 4.47527 17.203C4.47527 16.7579 4.29846 16.331 3.98373 16.0163C3.669 15.7015 3.24214 15.5247 2.79705 15.5247Z" fill="#7C7C7C"/></svg>';
	$icon_grid = '<svg width="18" height="19" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path  d="M1.5 13C1.89782 13 2.27936 13.158 2.56066 13.4393C2.84196 13.7206 3 14.1022 3 14.5C3 14.8978 2.84196 15.2794 2.56066 15.5607C2.27936 15.842 1.89782 16 1.5 16C1.10218 16 0.720644 15.842 0.43934 15.5607C0.158035 15.2794 0 14.8978 0 14.5C0 14.1022 0.158035 13.7206 0.43934 13.4393C0.720644 13.158 1.10218 13 1.5 13ZM8 13C8.39782 13 8.77936 13.158 9.06066 13.4393C9.34196 13.7206 9.5 14.1022 9.5 14.5C9.5 14.8978 9.34196 15.2794 9.06066 15.5607C8.77936 15.842 8.39782 16 8 16C7.60218 16 7.22064 15.842 6.93934 15.5607C6.65804 15.2794 6.5 14.8978 6.5 14.5C6.5 14.1022 6.65804 13.7206 6.93934 13.4393C7.22064 13.158 7.60218 13 8 13ZM14.5 13C14.8978 13 15.2794 13.158 15.5607 13.4393C15.842 13.7206 16 14.1022 16 14.5C16 14.8978 15.842 15.2794 15.5607 15.5607C15.2794 15.842 14.8978 16 14.5 16C14.1022 16 13.7206 15.842 13.4393 15.5607C13.158 15.2794 13 14.8978 13 14.5C13 14.1022 13.158 13.7206 13.4393 13.4393C13.7206 13.158 14.1022 13 14.5 13ZM1.5 6.5C1.89782 6.5 2.27936 6.65804 2.56066 6.93934C2.84196 7.22064 3 7.60218 3 8C3 8.39782 2.84196 8.77936 2.56066 9.06066C2.27936 9.34196 1.89782 9.5 1.5 9.5C1.10218 9.5 0.720644 9.34196 0.43934 9.06066C0.158035 8.77936 0 8.39782 0 8C0 7.60218 0.158035 7.22064 0.43934 6.93934C0.720644 6.65804 1.10218 6.5 1.5 6.5ZM8 6.5C8.39782 6.5 8.77936 6.65804 9.06066 6.93934C9.34196 7.22064 9.5 7.60218 9.5 8C9.5 8.39782 9.34196 8.77936 9.06066 9.06066C8.77936 9.34196 8.39782 9.5 8 9.5C7.60218 9.5 7.22064 9.34196 6.93934 9.06066C6.65804 8.77936 6.5 8.39782 6.5 8C6.5 7.60218 6.65804 7.22064 6.93934 6.93934C7.22064 6.65804 7.60218 6.5 8 6.5ZM14.5 6.5C14.8978 6.5 15.2794 6.65804 15.5607 6.93934C15.842 7.22064 16 7.60218 16 8C16 8.39782 15.842 8.77936 15.5607 9.06066C15.2794 9.34196 14.8978 9.5 14.5 9.5C14.1022 9.5 13.7206 9.34196 13.4393 9.06066C13.158 8.77936 13 8.39782 13 8C13 7.60218 13.158 7.22064 13.4393 6.93934C13.7206 6.65804 14.1022 6.5 14.5 6.5ZM1.5 0C1.69698 -4.1511e-09 1.89204 0.0387985 2.07403 0.114181C2.25601 0.189563 2.42137 0.300052 2.56066 0.43934C2.69995 0.578628 2.81044 0.743986 2.88582 0.925975C2.9612 1.10796 3 1.30302 3 1.5C3 1.69698 2.9612 1.89204 2.88582 2.07403C2.81044 2.25601 2.69995 2.42137 2.56066 2.56066C2.42137 2.69995 2.25601 2.81044 2.07403 2.88582C1.89204 2.9612 1.69698 3 1.5 3C1.10218 3 0.720644 2.84196 0.43934 2.56066C0.158035 2.27936 0 1.89782 0 1.5C0 1.10218 0.158035 0.720644 0.43934 0.43934C0.720644 0.158035 1.10218 8.38353e-09 1.5 0ZM8 0C8.19698 -4.1511e-09 8.39204 0.0387985 8.57403 0.114181C8.75601 0.189563 8.92137 0.300052 9.06066 0.43934C9.19995 0.578628 9.31044 0.743986 9.38582 0.925975C9.4612 1.10796 9.5 1.30302 9.5 1.5C9.5 1.69698 9.4612 1.89204 9.38582 2.07403C9.31044 2.25601 9.19995 2.42137 9.06066 2.56066C8.92137 2.69995 8.75601 2.81044 8.57403 2.88582C8.39204 2.9612 8.19698 3 8 3C7.60218 3 7.22064 2.84196 6.93934 2.56066C6.65804 2.27936 6.5 1.89782 6.5 1.5C6.5 1.10218 6.65804 0.720644 6.93934 0.43934C7.22064 0.158035 7.60218 8.38353e-09 8 0ZM14.5 0C14.697 -4.1511e-09 14.892 0.0387985 15.074 0.114181C15.256 0.189563 15.4214 0.300052 15.5607 0.43934C15.6999 0.578628 15.8104 0.743986 15.8858 0.925975C15.9612 1.10796 16 1.30302 16 1.5C16 1.69698 15.9612 1.89204 15.8858 2.07403C15.8104 2.25601 15.6999 2.42137 15.5607 2.56066C15.4214 2.69995 15.256 2.81044 15.074 2.88582C14.892 2.9612 14.697 3 14.5 3C14.1022 3 13.7206 2.84196 13.4393 2.56066C13.158 2.27936 13 1.89782 13 1.5C13 1.10218 13.158 0.720644 13.4393 0.43934C13.7206 0.158035 14.1022 8.38353e-09 14.5 0Z" fill="#7C7C7C"/></svg>';

	if( get_post_type() == 'post' ) {
		$cookie = 'post';
		$data_active = '.archive-content';
	}
	elseif ( get_post_type() == 'hb_room' ){
		$cookie = 'thim-room';
		$data_active = '#thim-room-archive';
		if ( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'base' ) {
			$icon_grid = '<i class="las la-border-all"></i>';
			$icon_list = '<i class="las la-list"></i>';
		}
	} 

	?>
	<div class="thim-switch-layout switch-layout" data-cookie="<?php echo $cookie; ?>" data-active="<?php echo $data_active; ?>">
		<div class="switchToList">
			<?php echo $icon_list ?>
		</div>
		<div class="switchToGrid switch-active">
			<?php echo $icon_grid ?>
		</div>
	</div>
	<?php
}

// sort by
add_action( 'thim_sort_by', 'thim_sort_by_function' ); 
function thim_sort_by_function(){
	if ( !empty($_GET['sortby-list']) ) {
		$orderby = sanitize_key( $_GET['sortby-list'] );
	}
	?>
	<div class="sort-by">
		<span><?php echo esc_html__('Sort by', 'sailing'). ': ' ?></span>
		<form method="get" action="?sort=SELECTEDVALUEHERE">
			<select id="sortby-list" class="sortby-list" name="sortby-list" onchange="this.form.submit()">
				<option <?php if(isset($orderby) && $orderby =='date-desc') echo 'selected';?> value="date-desc"><?php echo esc_html__('Default (Newest)', 'sailing') ?></option>
				<option <?php if(isset($orderby) && $orderby =='date-asc') echo 'selected';?> value="date-asc"><?php echo esc_html__('Oldest', 'sailing') ?></option>
				<option <?php if(isset($orderby) && $orderby =='title-asc') echo 'selected';?> value="title-asc"><?php echo esc_html__('A to Z', 'sailing') ?></option>
				<option <?php if(isset($orderby) && $orderby =='title-desc') echo 'selected';?> value="title-desc"><?php echo esc_html__('Z to A', 'sailing') ?></option>
			</select>
		</form>
	</div>
	<?php
}