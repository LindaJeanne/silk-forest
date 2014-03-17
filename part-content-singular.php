
<header class="article-header">
	<h1 class="title-main"><?php the_title(); ?></h1>
	<div byline-bar>
		<?php
		silkforest_authorlink();
		silkforest_datelink();
		silkforest_editlink();
		?>
	</div><!-- byline-bar -->
</header><!-- .article-header -->

<div class="article-body">
	<?php 
	the_content( __( 'Continue reading...', 'silkforesttextdomain' ) );
	?>
</div><!-- .article-body -->

<footer class="article-footer">
	<?php
	silkforest_navigation_multipage_post();
	silkforest_categories();
	silkforest_tags();
	?>

	<div class="postnav-bar">
		<?php silkforest_singlepost_nav(); ?>
	</div><!-- .postnav-bar -->
</footer><!-- .article-footer -->

