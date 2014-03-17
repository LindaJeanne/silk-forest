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
	<h1 class='title-main'><?php _e( 'Archive', 'silkforestextdomain' ); ?></h1>
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
