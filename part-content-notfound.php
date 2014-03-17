
<section class="errorpage-container ">
	<h2 class="errorpage-title">
		<?php _e( "These are not the droids you're looking for", 'silkforesttextdomain' ) ?>
	</h2>
	<p>
		<?php
		_e( 'Terribly sorry, but I can&rsquo;t seem to find anything matching that search. perhaps
			one of these other ways of finding it will help?', 'silkforesttextdomain' );
		?>
	</p>
	<div class="widget-area">
		<?php
		if ( !dynamic_sidebar( 'error-1' ) ) {
			echo "<aside class='widget'>";
			get_search_form();
			echo "</aside>";
		}
		?>
	</div><!-- .widget-area -->
</section><!-- errorpage-container -->

