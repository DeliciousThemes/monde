<?php
/**
 * Template part for displaying posts.
 *
 * @package Monde Theme
 */

?>

<?php

	$dt_thumb_id = get_post_thumbnail_id($post->ID);
	$dt_alt = get_post_meta($dt_thumb_id, '_wp_attachment_image_alt', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php monde_categories_list(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
				
		<?php if(is_single()) { ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php } else { ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php } ?>
		
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta-secondary">
			<?php monde_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->	
	
	<?php if(is_single()) { ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('dtblog-thumbnail', array('alt'   => $dt_alt)); ?>
		</div><!--end post-thumbnail-->		
	<?php } else { ?>	
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('dtblog-thumbnail', array('alt'   => $dt_alt)); ?>
			</a>
		</div><!--end post-thumbnail-->		
	<?php } ?>

	<div class="entry-content">
		<?php

			global $more; 
			if(!is_single()) { $more = 0; }
			the_content(esc_html__('Read More', 'monde'));
		
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'monde' ),
				'after'  => '</div>',
			) );
		?>

		<?php 
		if(is_single()) {
			monde_entry_tags(); 
		}
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php monde_entry_footer(); ?>
		<?php monde_social_sharer(); ?>
	</footer><!-- .entry-footer -->

	<?php if(is_single()) { monde_author(); } ?>
	
</article><!-- #post-## -->
