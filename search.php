<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package my_s
 */

get_header(); 

$search_title = sprintf( 
	__( 'Search results for: %s', 'silkforesttextdomain'), 
	'<span class="title-keyphrase">' . get_search_query() . '</span>' );

?>

<main class='main-container entry-list' role='main'>
	<header class='entry-page-header'>
		<h1 classs="title-main"><?php echo $search_title; ?></h1>
	</header>

	<?php silkforest_entrylist_loop();?>

	<footer id='entrypage-footer' class='entrypage-footer'>
		<?php silkforest_resultspage_nav(); ?>
	</footer>
</main>

<?php

get_sidebar();
get_footer();

?>
