
<article
	id='post-<?php get_the_id() ?>'
	<?php post_class( 'entry-item entry-gallery' ); ?>
>

	<header class="entry-header collapse-trigger">
		<h2 class='entry-title'>
			<a href='<?php echo esc_url( get_permalink() ); ?>' class='header-link'>
				<span class='icon-hook icon-entry-title'></span>
				<?php the_title(); ?>
			</a>
		</h2>
		<div byline-bar collapsing-item>
			<?php
			silkforest_authorlink();
			silkforest_datelink();
			silkforest_editlink();
			?>
		</div><!-- byline-bar -->
	</header><!-- entry-header -->

	<div class="entry-body collapsing-item">
		<?php silkforest_gallery_excerpt(); ?> 

	</div><!-- .entry-body -->

	<footer class="entry-footer collapsing-item">
		<?php
			silkforest_navigation_multipage_post();
			silkforest_categories();
			silkforest_tags();
			silkforest_commentlink();
		?>
	</footer><!-- .entry-footer -->

</article><!-- .entry-search -->

