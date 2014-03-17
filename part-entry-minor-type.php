<article
	id='post-<?php get_the_id(); ?>'
	<?php post_class( 'entry-item entry-minor' ); ?>
>
	<div class='entry-body'>
		<div class='minor-item-icon'>
			<span class=
				'icon-hook 
				 icon-<?php echo esc_attr( get_post_format() ); ?>'
			></span>
		</div><!-- .minor-item-icon -->
		<?php the_content(); ?>
	</div><!-- .entry-body -->
	<footer class='minor-entry-footer'>
		<?php
			silkforest_authorlink();
			silkforest_datelink();
		?>
	</footer>
</article>

