<?php
/**
 * @package thim
 */
wp_enqueue_script('flexslider');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			endif; ?>
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="blog_title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
				<?php thim_entry_meta(); ?>
			</header>
			<!-- .entry-header -->
			<div class="entry-summary">
				<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sailing' ),
					'after'  => '</div>',
				) );
				?>
			</div>
			<?php
			if(!empty(get_the_tag_list())):
			?>
				<div class="entry-tag">			
					<?php echo thim_get_entry_meta_tags(); ?>
				</div>
			<?php endif; ?>
			<!-- .entry-summary -->
		</div>
	</div> <!-- .content-inner -->
</article><!-- #post-## -->
