
<?php
	if ( ! have_comments() && ! comments_open() ) {
		return;
	}
?>

<div class="comments-area">
	<header class="comments-area-header">
		<?php 
			$title_description = silkforest_comment_title_description();
		?>
		<h1 class='comments-title'>
			<?php echo $title_description[ 'title' ] ?></h1>
		<p class='comments-description'>
			<?php echo $title_description[ 'description' ] ?></p>
	</header>

	<?php silkforest_comments_nav(); ?>

	<ol class="comment-list">
		<?php wp_list_comments(
			array( 
				'avatar-size' => '64px',
				'type' => 'comment'
			) ); ?>
	</ol><!-- .comment-list -->

	<ul class="ping-list">
		<?php wp_list_comments( array( 'type' => 'pings' ) ); ?>
	</ul><!-- .ping-list -->
	
	<?php
	silkforest_comments_nav(); 

	if ( comments_open() ) {
		comment_form();
	}
	?>	

</div><!-- .comments-area -->
