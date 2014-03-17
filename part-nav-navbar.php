
		
<nav 
	id="primary-navigation"  
	class="primary-navigation collapsible-container" 
	role="navigation">

<!-- Menu Toggle which will appear only on very 
     small screens, with the navbar hidden behind it. -->

<h2 class='menu-toggle collapse-trigger'>
	<span class='icon-hook icon-menu-toggle'></span>
	<?php _e( 'Site Menu', 'silkforesttextdomain' ) ?>
</h2>

<!-- screen reader link to skip navigation -->
<a class='skip-link screen-reader-text' href='#content'>
	<?php _e( 'Skip to content', 'silkforesttextdomain' ); ?>
</a>

<!-- the navbar -->
<?php
	$icon_hook = "<span class='icon-hook icon-menu-item'></span>";
	$args = array( 
		'theme_location' => 'primary' ,
		'menu_class' => 'mainmenu collapsing-item', 
		'link-before' => $icon_hook, /* for a menu that's set in Admin */
		'link_before' => $icon_hook  /* for page_menu fallback */
	); 

	wp_nav_menu( $args ); 
?>
</nav><!-- #site-navigation -->
