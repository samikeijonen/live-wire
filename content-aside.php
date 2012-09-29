<?php
/**
 * Aside Content Template
 *
 * Template used for 'aside' post format.
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

		<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[post-format-link] published on [entry-published] [entry-edit-link before="| "]', 'live-wire' ) . '</div>' ); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'live-wire' ) . '</div>' ); ?>

	<?php } else { ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'live-wire' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] published on [entry-published] [entry-permalink before="| "] [entry-comments-link before="| "] [entry-edit-link before="| "]', 'live-wire' ) . '</div>' ); ?>

	<?php } ?>

	<?php do_atomic( 'close_entry' ); // live-wire_close_entry ?>

</div><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // live-wire_after_entry ?>