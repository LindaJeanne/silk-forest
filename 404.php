<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package my_s
 */

get_header();
echo '<div class = "main-container" >';
get_template_part( 'part-content', 'notfound' );
echo '</div><!-- .main-container -->';
get_sidebar();
get_footer();


