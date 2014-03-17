<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package my_s
 */

get_header();

if ( is_day() ) {
	$title = sprintf( 
		__( 'Day: %s', 'silkforesttextdomain' ), 
		'<span class="title-keyphrase" >' . get_the_date() . '</span>' 
	);
}
elseif ( is_month() ) {	
	$title = sprintf( 
		__( 'Month: %s', 'silkforesttextdomain' ), 
		'<span class="title-keyphrase" >' . get_the_date( 'F Y' ) . '</span>' 
	);
}
else {
	$title = sprintf( 
		__( 'Year: %s', 'silkforesttextdomain' ), 
		'<span class="title-keyphrase" >' . get_the_date( 'Y' ) . '</span>' 
	);	
}
?>

<main class='main-container entry-list' role='main'>
	<header class='entrypage-header'>
	<h1 class='title-main'><?php echo $title; ?></h1>
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
