<?php
/**
 * The Template for displaying all single posts.
 *
 * @package my_s
 */
get_header();
?>
<div class="main-container post-container">
	<main role="main">
		<?php
		while ( have_posts() ) {	
			the_post();
?>
			<article
				id='post-<?php get_the_id() ?>'
				<?php post_class( 'single-article' ); ?>
			>
<?php 
				if ( 'minor-type' == silkforest_get_format_type() ) {
					get_template_part( 'part-content', 'minor' );
				}
				else {
					get_template_part( 'part-content', 'singular' );
				}
?>
			</article><!-- .article-single -->
	<?php } ?>
		</main>
		<?php
		// we can't call have_comments until we've called the comments_template.		
		if ( ! post_password_required() /* && ( have_comments() || comments_open() ) */ ) {
			comments_template();
		}
		?>
	</div><!-- .post-container -->

<?php
get_sidebar();
get_footer();
?>
