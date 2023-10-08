<?php
	wp_enqueue_script('flexslider');

	//Columns
	$class = '';
	if( get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2' ){
		$column = get_theme_mod( 'thim_archive_column_grid', 2 );
		if ( isset( $_GET['column'] ) ) {
			$column = $_GET['column'];
		}
		$class = 'column-' . $column . ' col-md-' . ( 12 / $column );
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<?php if( get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-1' ) : ?>
	<div class="share-post">
		<?php
		if ( get_theme_mod( 'thim_single_show_date' ) == true ) {
			?>
			<div class="date-meta"><?php echo get_the_date( "d\<\i\>\ M\<\/\i\>\ " ) ?></div>
			<?php
		}
		?>
		<?php do_action( 'thim_social_share' ); ?>
	</div>
	<?php endif; ?>
	<div class="content-inner">
		<?php
		do_action( 'thim_entry_top', 'full' ); ?>
		<div class="entry-content">
			<?php if( get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2' ) : 
				if ( get_theme_mod( 'thim_single_show_category' ) == 1 && get_the_category() ) {
					?>
					<div class="category">
						<?php the_category( ', ', '' ); ?>
					</div>
					<?php
				} 
			endif;
			if ( has_post_format( 'link' ) && thim_meta( 'thim_url' ) && thim_meta( 'thim_text' ) ) {
				$url  = thim_meta( 'thim_url' );
				$text = thim_meta( 'thim_text' );
				if ( $url && $text ) { ?>
					<header class="entry-header">
						<h3 class="blog_title">
							<a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
							<h3>
					</header>

					<?php
				}
				?>
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
			<?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote' ) && thim_meta( 'thim_author_url' ) ) {
				$quote      = thim_meta( 'thim_quote' );
				$author     = thim_meta( 'thim_author' );
				$author_url = thim_meta( 'thim_author_url' );
				if ( $author_url ) {
					$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
				}
				if ( $quote && $author ) {
					?>
					<header class="entry-header">
						<div class="box-header box-quote">
							<blockquote><?php echo esc_html( $quote ); ?><cite><?php echo esc_html( $author ); ?></cite>
							</blockquote>
						</div>
					</header>
					<?php
				}
			} elseif ( has_post_format( 'audio' ) ) {
				?>

				<?php the_title( sprintf( '<header class="entry-header"><h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></header>' ); ?>
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
				<?php
			} else {
				?>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php thim_entry_meta(); ?>
				</header>
				<!-- .entry-header -->
				<div class="entry-summary">
					<?php
					if ( get_theme_mod( 'thim_archive_excerpt_length' ) ) {
						$length = get_theme_mod( 'thim_archive_excerpt_length' );
					} else {
						$length = '20';
					}
					echo thim_excerpt( $length );
					?>
					<?php if ( get_theme_mod( 'thim_show_read_more' ) == true ) { ?>
						<p class="learn-more"><a
								href="<?php echo esc_url( get_permalink() ) ?>"><?php echo esc_html__( 'Read More', 'sailing' ) ?></a>
						</p>
					<?php } ?>
				</div><!-- .entry-summary -->
			<?php }; ?>
		</div>
	</div>
</article><!-- #post-## -->