<?php
/**
 * Search Template
 *
 * This is the search template.  It is used when visitor use the search form.
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
						
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Published on [entry-published]', 'live-wire' ) . '</div>' ); ?>

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