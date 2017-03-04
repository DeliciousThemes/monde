<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Monde Theme
 */

if ( ! function_exists( 'monde_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function monde_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);	

	$byline = sprintf(
		esc_html_x( 'posted by %s', 'post author', 'monde' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">'. $byline . esc_html(' on ', 'monde') . $time_string . '</span>'; // WPCS: XSS OK. 

}
endif;

if( ! function_exists('monde_categories_list')) :

function monde_categories_list() {
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'monde' ) );
		if ( $categories_list && monde_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'monde' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}	
}

endif;

if ( ! function_exists( 'monde_entry_tags' ) ) :

function monde_entry_tags() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'monde' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( '%1$s', 'monde' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}

endif;

if ( ! function_exists( 'monde_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function monde_entry_footer() {

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'monde' ), esc_html__( '1 Comment', 'monde' ), esc_html__( '% Comments', 'monde' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'monde' ), '<span class="edit-link">', '</span>' );
}
endif;

if(! function_exists('monde_author')) :
	function monde_author() {
		if ( 'post' === get_post_type() ) {
			echo '<div class="author-bio">';
				echo get_avatar( get_the_author_meta('user_email'), '90', '' );
				echo '<div class="author-description">';
					echo '<span>'.esc_html__('Author', 'monde').'</span>';
					echo '<h3>'. get_the_author_link().'</h3>';
					echo '<p>'.get_the_author_meta('description').'</p>';
				echo '</div>';
			echo '</div>';				

		}
	}
endif;

if ( ! function_exists( 'monde_social_sharer' ) ) :

	function monde_social_sharer() {

		global $post;

		wp_enqueue_script('monde-social-sharer');

		$monde_title = get_the_title($post->ID);
		$monde_permalink = get_the_permalink($post->ID);
		$monde_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post'); 

		wp_localize_script( 'monde-social-sharer', 'monde_social', array( 'title' => $monde_title, 'link' => $monde_permalink, 'thumbnail' => $monde_thumbnail[0]) );	
		$output = '';
		$output .= '<div class="share-options">';
			$output .= '<a href="#" class="twitter-sharer" onClick="twitterSharer()"><i class="fa fa-twitter"></i></a>';
			$output .= '<a href="#" class="facebook-sharer" onClick="facebookSharer()"><i class="fa fa-facebook"></i></a>';
			$output .= '<a href="#" class="pinterest-sharer" onClick="pinterestSharer()"><i class="fa fa-pinterest"></i></a>';
			$output .= '<a href="#" class="google-sharer" onClick="googleSharer()"><i class="fa fa-google-plus"></i></a>';
			$output .= '<a href="#" class="linkedin-sharer" onClick="linkedinSharer()"><i class="fa fa-linkedin"></i></a>';
		$output .= '</div>';
		echo $output;
	}

endif;

				

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function monde_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'monde_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'monde_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so monde_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so monde_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in monde_categorized_blog.
 */
function monde_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'monde_categories' );
}
add_action( 'edit_category', 'monde_category_transient_flusher' );
add_action( 'save_post',     'monde_category_transient_flusher' );
