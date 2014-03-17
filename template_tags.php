<?php 
/* ----------------------------------------------------- */
/* 'Continue Reading' link				 */
/* ----------------------------------------------------- */
/**
 * Returns the 'continue reading...' link.
 *
 * Returns the html markup for the 'continue reading'
 * link, which incldes the title of the article.
 *
 * @since 0.1.0
 * @return type string 'continue reading' link markup.
 */
function silkforest_continue_reading() {

	return sprintf (
		__( 
			'Continue reading "%s"', 
			'silkforestextdomain'
		), 
		get_the_title() 
	);
}


/* ----------------------------------------------------- */
/* Helper function: translated delimiter */
/* ----------------------------------------------------- */
/**
 * returns the delimiter.
 *
 * Returns the translated delimiter to separate items in
 * an inline list.
 *
 * @since 0.1.0
 * @return string the list delimiter.
 */
function silkforest_delimiter()
{
	return  _x( 
		', ', 
		'Separator between items in a list', 
		'silkforesttextdomain' 
	);
}
/* ----------------------------------------------------- */
/* Entrylist Loop	 */
/* ----------------------------------------------------- */

/**
 * The loop function for archive, index, and search templates.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_entrylist_loop() 
{
	if ( have_posts() ) {
		echo "<div class='entry-list'>";
		while ( have_posts() ) {
			the_post();
			get_template_part( 'part-entry', silkforest_get_format_type() );
		}
		echo "</div><!-- .entry-list -->";
	}
	else {
		get_template_part( 'part-content', 'notfound' );
	}
}
/* ----------------------------------------------------- */
/* Divides the post-formats into four broad types	 */
/* ----------------------------------------------------- */

/**
 * Divides the post-formats into four types.
 *
 * Divides the post-formats into four broad types, based on
 * how the theme formats and displays earch.
 *
 * @since 0.1.0
 * @return type string one of four post-type categories
 */
function silkforest_get_format_type() 
{
	$format = get_post_format();

	switch ( $format ) {
	case 'aside':
	case 'chat':
	case 'status':
	case 'link':
	case 'quote':
		return 'minor-type';
		break;
	case 'gallery':
		return 'gallery-type';
		break;
	case 'image':
	case 'audio':
	case 'video': 
		return 'media-type';
		break;
	default:
		return 'standard-type';
		break;
	}
}

/*--------------------------------------------------------------------- */
/* Show featured image							*/
/*--------------------------------------------------------------------- */
/**
 * Displays the featured image.
 *
 * Displays (or opts not to display) the featured image setting the 
 * class based on the type.
 *
 * @since 0.1.0
 * @return void
 */


/*--------------------------------------------------------------------- */
/* Gallery Excerpt							*/
/*--------------------------------------------------------------------- */
/**
 * Displays the first three attatchments to the post.
 *
 * Shamelessly stolen from the Stack Exchange answer at:
 * http://wordpress.stackexchange.com/questions/69780/first-three-images-in-post-excerpt .
 *
 * @since 0.1.0
 * @return void
 * @author Brian Fegter
 */
//Code to display first three images of a gallery in the excerpt 'borrowed' from:
//http://wordpress.stackexchange.com/questions/69780/first-three-images-in-post-excerpt

function silkforest_gallery_excerpt()
{
	# Get the first three attachments using the posts_per_page parameter
	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'posts_per_page' => 3,
		'post_parent' => get_the_ID()
	);
	$attachments = get_children( $args );

	# If any attachments are returned, proceed
	if( $attachments ){

		# Spin cycle to collate attachment IDs
		foreach( $attachments as $attachment )
			$includes[] = $attachment->ID;

		# Format our IDs in a comma-delimited string
		$includes = implode(',', $includes);

		# Inject your include argument
		$shortcode = str_replace('[gallery', "[gallery include='$includes' ", get_the_content());

		# Render the Gallery using the standard editorial input syntax
		echo do_shortcode($shortcode);

		# Add a View More link
		echo '<a href="' . get_permalink() . '">' . __('View more', 'domain') . '</a>';
	}
	else {
		the_post_thumbnail( 
			'thumbnail',
			array ( 'class' => 'excerpt-thumb' )
		);
		the_excerpt();
	}
}
/* ===================================================== */
/* Post navigation */
/* ===================================================== */

/* ----------------------------------------------------- */
/* Resluts Page navigation */
/* ----------------------------------------------------- */
/**
 * Displays result/index/archive page navigation links.
 *
 * @since 0.1.0
 * @global $wp_query
 * @return void
 */
function silkforest_resultspage_nav() {

	global $wp_query;

	if ( $wp_query->max_num_pages < 2 ) {
		return;
		// If there is only one page, exit without displaying
		// navigation markup. 
	}


	echo '<nav role="navigation" class="nav-group results-navigation">';

	echo '<h2 class="screen-reader-text">';
	_e( 'Results pages navigation', 'silkforesttextdomain' );
	echo '</h2>';

	// The "next" and "Previos" look backwards because of the
	// way WordPress orders posts. (Hence, calling them 'older'
	// and 'newer', so as not to pass the previous/next 
	// confusion on to a visitor to the site. )


	$older_posts =  get_next_posts_link(
		'<span class="icon-hook icon-prev"></span>' .
		__( 'Older posts', 'silkforesttextdomain' )
	);

	if ( $older_posts ) {
		echo "<div class='nav-previous'>$older_posts</div>";
	}

	$newer_posts = get_previous_posts_link( 
		__( 'Newer posts', 'silkforesttextdomain' ) . 
		'<span class="icon-hook icon-next"></span>'
	);

	if ( $newer_posts ) {
		echo "<div class='nav-next'>$newer_posts</div>";
	}

	echo '</nav>';
}

/*--------------------------------------------------------------------- */
/* Multipage-post navigation						*/
/*--------------------------------------------------------------------- */
/**
 * Displays navigation links for multi-page posts.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_navigation_multipage_post()
{

	wp_link_pages( array(
		'before' => '<div class="page-links nav-group">' . 
		__( 'Pages:', 'silkforesttextdomain' ),
			'after' => '</div>'
		) );

}

/*--------------------------------------------------------------------- */
/* Single-post navigation						*/
/*--------------------------------------------------------------------- */
/**
 * Displays single-post navigation.
 *
 * On the single-post view, displays navigation for the previous
 * and next post.
 *
 * @since 0.1.0
 * @global $post
 * @return void
 */
function silkforest_singlepost_nav()
{
	global $post;

	$have_older = 
		( is_attachment() ) ? 
		get_post( $post->post_parent ) : 
		get_adjacent_post( false, '', true );

	$have_newer = get_adjacent_post( false, '', false );

	if ( ! $have_newer && ! $have_older ) {
		return;
		//There is nothing to navigate; return
		//without displaying markup.
	}

	echo '<nav role="navigation" class="nav-group">';
	echo '<h1 class="screen-reader-text">';
	_e( 'Post navigation', 'silkforesttextdomain' );
	echo '</h1>';

	if ( $have_older ) {
		previous_post_link (
			'<div class="nav-previous">%link</div>',
			'<span class="icon-hook icon-prev"></span>' .
			__( 'Older', 'silkforesttextdomain' ) .
			' ( %title )'
		);
	}

	if ( $have_newer ) {
		next_post_link(
			'<div class="nav-next">%link</div>"',
			'( %title ) ' .
			__( 'Newer', 'silkforesttextdomain' ) .
			'<span class="icon-hook icon-next"></span>'
		);
	}

	echo '</nav><!-- .nav-group -->';
}






/* ===================================================== */
/* Display metadata and links				 */
/* ===================================================== */
/*--------------------------------------------------------------------- */
/* show Categories							*/
/*--------------------------------------------------------------------- */
/**
 * Display a list of categories.
 *
 * Display a hyperlinked list of categories that have been applied to
 * this post.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_categories() 
{
	if ( has_category() ) {
		$empty_list = "";
		$label_text = __( 'Categories: ', 'silkforesttextdomain' );
		$cat_list = get_the_category_list( silkforest_delimiter() );
	}
	else {
		$empty_list = "empty-list";
		$label_text = __( '(no categories assigned)', 'silkforesttextdomain' );
		$cat_list = "";
	}

	echo "<span class='cat-list metadata-list $empty_list'>";
	echo "<span class='icon-hook icon-categories'></span>";
	echo $label_text;
	echo "$cat_list</span>";
}

/*--------------------------------------------------------------------- */
/* Show tags								*/
/*--------------------------------------------------------------------- */

/**
 * Display a list of tags.
 *
 * Display a hyperlinked list of tags that have been applied to
 * this post.
 *
 * @since 0.1.0
 * @return void
 */

function silkforest_tags()
{
	if ( has_tag() ) {
		$empty_list = "";
		$label_text = __( 'Tags: ', 'silkforesttextdomain' );
		$tag_list = get_the_tag_list( '', silkforest_delimiter() );
	}
	else {
		$empty_list = "empty-list";
		$label_text = __( '(no tags assigned)', 'silkforesttextdomain' );
		$tag_list = "";
	}

	echo "<span class='tag-list metadata-list $empty_list'>";
	echo "<span class='icon-hook icon-tags'></span>";
	echo $label_text;
	echo "$tag_list</span>";


}
/* ----------------------------------------------------- */
/* display hyperlinked author name			 */
/* ----------------------------------------------------- */
/**
 * Displays the author byline.
 *
 * Displays the author name, hyperlinked to the author
 * archive.
 *
 * @since 0.1.0
 * @return void
 */

function silkforest_authorlink() {

	$author_link =  esc_url( 
		get_author_posts_url( get_the_author_meta( 'ID' ) ) 
	);
	echo '<span class="author vcard meta-link">';
	echo "<a class='url fn n' href='$author_link'>";
	echo get_the_author();
	echo '</a></span><!-- .vcard -->';
}
/* ----------------------------------------------------- */
/* Display permalinked post date			 */
/* ----------------------------------------------------- */
/**
 * Display permalinked post date.
 *
 * Display the post date, hyperlinked to the posts permalink.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_datelink() {

	$date_string =  sprintf( 
		'<time class="published" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	echo '<span class="entry-date meta-link">';
	echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
	echo $date_string;
	echo '</a></span><!-- .entry-date -->';
}
/* ----------------------------------------------------- */
/* Display edit link					 */
/* ----------------------------------------------------- */
/**
 * Display 'edit post' link.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_editlink() {
	echo '<span class="edit-link meta-link">';
	edit_post_link(
		__( 'Edit', 'silkforesttextdomain' )
	);
	echo '</span>';
}

/* ===================================================== */
/* =Comments Area and Comments Link			 */
/* ===================================================== */

/* ----------------------------------------------------- */
/* Comment Link						 */
/* ----------------------------------------------------- */
/**
 * Display comments link.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_commentlink()
{
	if ( post_password_required() ) {
		return;
	}

	if ( ! comments_open() && get_comments_number() == 0 ) {
		return;
	}


	echo
		'<span class="label comments-link">
		<span class="icon-hook icon-comments"></span>' .
		__( 'Comments:', 'silkforesttextdomain' ) .
		' ';

	if ( comments_open() ) {
		comments_popup_link(
			__( 'Start a conversation!', 'silkforesttextdomain' ),
			__( 'Continue the conversation!', 'silkforesttextdomain' ),
			__( 'Join the conversation!', 'silkforesttextdomain' )
		);
	}
	else {
		comments_popup_link(
			sprintf(
				__( '%d comments', 'silkforesttextdomain' ),
				get_comments_number()
			)
		);
	}

	echo '</span><!-- .comments-link -->';
}
/* ----------------------------------------------------- */
/* Comment list title and subtitle */
/* ----------------------------------------------------- */
/**
 * Returns the Comments section title and subtitle.
 *
 * Returns the heading giving the comments section title,
 * along with additional text.
 *
 * @since 0.1.0
 * @return type string the markup for the heading and subheading.
 */
function silkforest_comment_title_description()
{
	$title='';
	$text='';

	if ( comments_open() ) {
		if ( have_comments() ) {
			$title = __( 'Join the conversation!', 'silkforesttextdomain' ); 
			$text = __( 'Always room for one more.', 'silkforesttextdomain' );
		}
		else {
			$title = __( 'Start a conversation!', 'silkforesttextdomain' );
			$text = __( 'This post looks bare without your input.', 
				'silkforesttextdomain' ); 
		}
	}
	elseif ( have_comments() ) {
		$title = __( 'Sorry, comments for this item are no longer open.', 'silkforesttextdomain' );
	}

	return ( array (
		'title' => $title,
		'description' => $text
	) );

}

/* ----------------------------------------------------- */
/* Comment Navigation */
/* ----------------------------------------------------- */
/**
 * Displays comment navigation.
 *
 * Displays the 'older comments' and 'newer comments' links as
 * appropriate when there are multiple pages of comments.
 *
 * @since 0.1.0
 * @return void
 */
function silkforest_comments_nav() 
{

	if ( get_comment_pages_count() < 2 || ! get_option( 'page_comments' ) ) {
		return;
	}


	echo "<h1 class='screen-reader-text'>";
	_e( 'Comment navigation', 'silkforesttextdomain' );
	echo "</h1>";

	echo "<nav class='comment-navigation nav-group' role='navigation'>";

	$older_comments = get_previous_comments_link(
		'<span class="icon-hook icon-prev"></span>' .
		__( 'Older comments', 'silkforesttextdomain' )
	);
	if ( $older_comments ) {
		echo "<div class='nav-previous'>$older_comments</div>";
	}


	$newer_comments = get_next_comments_link(
		__( 'Newer comments', 'silkforesttextdomain' ) .
		'<span class="icon-hook icon-next"></span>'
	);
	if ( $newer_comments ) {
		echo "<div class='nav-next'>$newer_comments</div>";
	}

	echo '</nav>';
}
?>
