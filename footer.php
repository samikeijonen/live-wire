<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Live Wire
 * @subpackage Template
 * @since 0.1.0
 */
?>		
			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

			<?php do_atomic( 'close_main' ); // live-wire_close_main ?>

			</div><!-- .wrap -->

		</div><!-- #main -->
		
		<?php do_atomic( 'after_main' ); // live-wire_after_main ?>
		
		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
		
		<?php do_atomic( 'before_footer' ); // live-wire_before_footer ?>

		<div id="footer">
		
			<?php do_atomic( 'open_footer' ); // live-wire_open_footer ?>

			<div class="wrap">
			
				<div id="footer-info">
				
					<div class="footer-content">
						<?php hybrid_footer_content(); ?>
					</div>
					
					<?php do_atomic( 'footer' ); // live-wire_footer ?>
				
				</div><!-- #footer-info -->
				
			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>
				
			</div><!-- .wrap -->
			
			<?php do_atomic( 'close_footer' ); // live-wire_close_footer ?>

		</div><!-- #footer -->
		
		<?php do_atomic( 'after_footer' ); // live-wire_after_footer ?>

</div><!-- #container -->

<?php do_atomic( 'close_body' ); // live-wire_close_body ?>

<?php wp_footer(); // wp_footer ?>

</body>
</html>