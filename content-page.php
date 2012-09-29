<?php
/**
 * Page Content Template
 *
 * Template used for 'page' post type.
 *
 * @package Live Wire
 * @subpackage Template
 * @since 0.1.0
 */

do_atomic( 'before_entry' ); // live-wire_before_entry ?>

<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // live-wire_open_entry ?>

	<?php if ( is_singular() ) { ?>

		<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

	<?php } else { ?>

		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'live-wire-thumbnail' ) ); ?>

		<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->

	<?php } ?>

	<?php do_atomic( 'close_entry' ); // live-wire_close_entry ?>

</div><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // live-wire_after_entry ?>