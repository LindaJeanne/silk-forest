<?php

get_header(); 

$author_title = '';
if ( have_posts() ) {
	the_post();
	$author_title = sprintf ( 
		__( 'All posts by: %s', 'silkforesttextdomain'), 
		'<span class="title-keyphrase">' . get_the_author() . '</span>' 
	);
	rewind_posts();
}
?>
<main class='main-container entry-list' role='main'>
	<header class='entrypage-header'>
	<h1 class='title-main'><?php echo $author_title ?></h1>
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
