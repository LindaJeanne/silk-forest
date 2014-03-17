<?php
/**
 * The Template for displaying all single posts.
 *
 * @package my_s
 */
get_header();
?>
	<div class="main-container page-container">
	<main role="main">
		<?php
		while ( have_posts() ) {	
			the_post();
?>
			<article id="post<? get_the_id(); ?>" 
			<?php silkforest_article_classes( 'page-single' ); ?>>
			<?php get_template_part( 'part-content', 'singular' ); ?>
			</article><!-- .page-single -->
		<?php } ?>
	</main>
		<?php
		if ( ! post_password_required() ) }
			comments_template();
		}
		?>
	</div><!-- .page-container -->

<?php
get_sidebar();
get_footer();
?>
