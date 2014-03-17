<?php
/*
 * 
 * @package silkforest
 */



/* ===================================================== */
/* Theme Setup 						 */
/* ===================================================== */

/** 
 * Add text domain and theme support for features.
 *
 * Removes the filter that adds formatting to the 
 * term_description, because my theme formats it; Loads the 
 * translation text domain; Adds theme support for automatic
 * feed links, post thumbnails, and post formats; registers one nav-menu.
 *
 * @since 0.1.0
 * @return void
 *
 */
function silkforest_setup() {

	// don't automatically apply markup to the descriptions! I'll do that myself when I call them.
	remove_filter('term_description','wpautop'); 

	load_theme_textdomain( 'silkforesttextdomain', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array( 
		'primary' => __( 'Primary Menu', 'silkforesttextdomain' ) 
	) );
	add_theme_support( 
		'post-formats', 
		 array( 'aside', 'image', 'video', 'quote', 'link', 'chat', 'gallery', 'status', 'audio' ) 
	 );

	add_theme_support( 'custom-background' );

}
add_action( 'after_setup_theme', 'silkforest_setup' );



/* ===================================================== */
/* Widgets 						 */
/* ===================================================== */

/** 
 * Registers widget areas.
 *
 * The theme provides three widget
 * areas: a sidebar, a footer, and the file-not-found 
 * page, to which helpful navigation widgets
 * can be added.
 *
 * @since 0.1.0
 * @return void
 *
 */
function silkforest_widgets_init() {

	$icon_hook = "<span class='icon-hook icon-widget-title'></span>";

	$base_array = array (
		'before_widget' => '<aside id="%1$s" class="widget %2$s collapsible-container">',
		'before_title' => "<h3 class='widget-title collapse-trigger'>$icon_hook",
		'after_title' => "</h3>",
		'after_widget' => "</aside>"
	);
	register_sidebar( array_merge( 
		$base_array,
		array(
			'name' => __( 'Sidebar', 'silkforesttextdomain' ),
			'id' => 'sidebar-1'
		)
	) );

	register_sidebar( array_merge(
		$base_array,
		array(
			'name' => __( 'Footer', 'silkforesttextdomain' ),
			'id' => 'footer-1'
		)
	) );

	register_sidebar( array_merge(
		$base_array,
		array(
			'name' => __('Error page', 'silkforesttextdomain' ),
			'id' => 'error-1'
		)
	) );

}
add_action( 'widgets_init', 'silkforest_widgets_init' );


/* ===================================================== */
/* Enqueue scripts					 */
/* ===================================================== */

/** 
 * Enqueues javascript programs used by the theme.
 *
 * Enqueues the javascript files to use Modernizr to check browser
 * capatibility, and a custom script to collapse items on the 
 * smallest screen sizes.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_enqueue() {

	$template_directory = get_template_directory_uri();
	wp_enqueue_style( 'silkforest-style', get_stylesheet_uri() );

	wp_enqueue_script (
		'modernizr',
		/*		"$template_directory/inc/js/moderinzr.custom.47217.js",*/
		"$template_directory/inc/js/modernizr-latest.js",
		false,
		true
	);

	wp_enqueue_script (
		'small_screen_toggles',
		"$template_directory/inc/js/small-screen-toggles.js",
		array( 'hoverIntent' ),
		false,
		true
	);


}
add_action( 'wp_enqueue_scripts', 'silkforest_enqueue' );

/* ===================================================== */
/* Required PHP files */
/* ===================================================== */

/**
 * Template tags and their helpers.
 */
require get_template_directory() . '/template_tags.php';


/* ==================================================================== */
/* Multiple categories check (borrowed from underscores)		*/
/* ==================================================================== */
/* Checking to see if the block has multiple categories every time we need
 * to would be too expensive. So we check once, and then store that value
 * as a transient that will remain until the number of categories changes. */

/**
 * Checks number of categories and stores value.
 *
 * Stores the number of categories in a transient, for checking whether
 * the blog has multiple categories. 
 *
 * @author underscores
 * @since 0.1.0
 * @return type bool; "does the blog have more than one category?".
 */

function silkforest_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category 
		return true;
	} else {
		// This blog has only 1 category 
		return false;
	}
}

/**
 * Flush out the transients used in underscores_categorized_blog.
 *
 * @author underscores
 * @return void
 */
function silkforest_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'silkforest_category_transient_flusher' );
add_action( 'save_post',     'silkforest_category_transient_flusher' );


/* ===================================================== */
/* Page Title  */
/* ===================================================== */
/**
 * Filters the wp_title.
 *
 * Filters wp_title to print a neat <title> tag based on what is 
 * being viewed; borrowed from underscores.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 * @author underscores
 */
function silkforest_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'silkforesttextdomain' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'silkforest_wp_title', 10, 2 );


/* ===================================================== */
/* User Settings  */
/* ===================================================== */
?>
