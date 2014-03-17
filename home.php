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

	<?php silkforest_entrylist_loop();?>

	<footer id='entrypage-footer' class='entrypage-footer'>
		<?php silkforest_resultspage_nav(); ?>
	</footer>
</main>

<?php
get_sidebar();
get_footer();
?>
