<?php
/**
 * Sidebar Header Template
 *
 * Displays widgets for the Header dynamic sidebar if there are any.
 *
 * @package Live Wire
 * @subpackage Template
 * @since 0.1.0
 */

if ( is_active_sidebar( 'header' ) ) : ?>

	<div id="sidebar-header" class="sidebar">

		<?php dynamic_sidebar( 'header' ); ?>

	</div><!-- #sidebar-header -->

<?php endif; ?>