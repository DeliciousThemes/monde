<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Delicious Theme
 */

?>


<?php

	$monde_thumb_id = get_post_thumbnail_id($post->ID);
	$monde_alt = get_post_meta($monde_thumb_id, '_wp_attachment_image_alt', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-thumbnail">
		<?php the_post_thumbnail('dtblog-thumbnail', array('alt'   => $monde_alt)); ?>
	</div><!--end post-thumbnail-->		

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php delicious_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'delicious' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php delicious_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

