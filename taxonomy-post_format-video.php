<?php
/**
 * Archive Template for Video
 *
 * This template displays video archive
 *
 * @package Live Wire
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

<?php do_atomic( 'before_content' ); // live-wire_before_content ?>

	<div id="content">
	
	<?php do_atomic( 'open_content' ); // live-wire_open_content ?>
			
		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php do_atomic( 'before_entry' ); // live-wire_before_entry ?>
					
					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

					<?php do_atomic( 'open_entry' ); // live-wire_open_entry ?>
					
						<div class="video-gallery">
						
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'live-wire-thumbnail', 'default_image' => (THEME_URI) . '/images/default_video_image.png' ) ); ?>
						
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[post-format-link] published on [entry-published] [entry-comments-link before=" | "] [entry-views before=" | " after=" views "] [entry-edit-link before=" | "]', 'live-wire' ) . '</div>' ); ?>
						
						<div class="entry-summary">
						<?php the_excerpt(); ?>
						<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="category" before="Posted in "] [entry-terms before=" | Tagged "]', 'live-wire' ) . '</div>' ); ?>
					
						</div><!-- .video-gallery -->
						
						<?php do_atomic( 'close_entry' ); // live-wire_close_entry ?>

					</div><!-- .hentry -->
					
					<?php do_atomic( 'after_entry' ); // live-wire_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // live-wire_close_content ?>
			
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->
			
	<?php do_atomic( 'after_content' ); // live-wire_after_content ?>
		
<?php get_footer(); // Loads the footer.php template. ?>