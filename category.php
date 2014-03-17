<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package my_s
 */

get_header();

?>
<main class='main-container entry-list' role='main'>
	<header class='entrypage-header'>
		<h1 class='title-main'>
			<?php _e( 'Browsing category:', 'silkforesttextdomain' ); ?>
			<span class="title-keyphrase">
				<?php single_cat_title(); ?>
			</span>
		</h1>
		<p class="entrypage-description"><?php category_description();?></p>
	</header><!-- entrypage-header -->

	<?php silkforest_entrylist_loop();?>

	<footer id='entrypage-footer' class='entrypage-footer'>
		<?php silkforest_resultspage_nav(); ?>
	</footer>
</main>
<?php
get_sidebar();
get_footer();
?>
