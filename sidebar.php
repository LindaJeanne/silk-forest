<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package newtheme
 */
?>
	<div id="secondary" class="widget-area secondary" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( !dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
