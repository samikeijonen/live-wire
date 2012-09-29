<?php
/**
 * Attachment Template
 *
 * This is the template for image attachment.
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

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // live-wire_before_entry ?>
					
					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // live-wire_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<div class="entry-content">
						
							<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
							
							<?php $gallery = do_shortcode( sprintf( '[gallery id="%1$s" exclude="%2$s" columns="8"]', $post->post_parent, get_the_ID() ) ); ?>
						
							<?php if ( !empty( $gallery ) ) { ?>
								<div class="image-gallery">
									<h3><?php _e( 'Gallery', 'live-wire' ); ?></h3>
									<?php echo $gallery; ?>
								</div>
							<?php } ?>
							
						</div><!-- .entry-content -->
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Published on [entry-published] [entry-edit-link before="| "]', 'live-wire' ) . '</div>' ); ?>
						
						<?php do_atomic( 'close_entry' ); // live-wire_close_entry ?>

					</div><!-- .hentry -->
					
					<?php do_atomic( 'after_entry' ); // live-wire_after_entry ?>
						
					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // live-wire_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // live-wire_close_content ?>
			
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->
			
	<?php do_atomic( 'after_content' ); // live-wire_after_content ?>
		
<?php get_footer(); // Loads the footer.php template. ?>