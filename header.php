<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package newtheme
 */
?><!DOCTYPE html>
<html <?php language_attributes();  ?> class="no-js">


<head>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	// The "hfeed" class tells machines that this is 
	// syndicated content (e.g. a blog)
	// http://microformats.org/wiki/hatom
?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="site-header" class="site-header" role="banner">
		<div id="masthead" class="masthead" >
			<a class="home-link header-link" href="<?php echo 
					esc_url( home_url( '/' ) ); ?>" rel="home">
				<h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
				<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
			</a>
		</div><!-- #masthead -->
			<?php get_template_part( 'part-nav', 'navbar' ); ?> 


	</header><!-- #masthead -->

	<div id="site-content" class="site-content">
	<a name="content"></a><!-- screenreader skiplink skips to here. -->
