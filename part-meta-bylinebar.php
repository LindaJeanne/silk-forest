
<?php
	$multi_class='';
	if ( is_singular() == '' ) {
		$multi_class = ' collapsing-item';
	}
?>
<div class="byline-bar<?php echo $multi_class; ?>">
<?php
	silkforest_authorlink();
	silkforest_datelink();
?>

		<span class='edit-link meta-link'>
			<?php edit_post_link( __( 'Edit', 'silkforesttextdomain' ) ); ?>
		</span>

		<!-- TODO: Share link -->


</div><!-- byline-bar -->
