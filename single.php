<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Monde Theme
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area percent-blog sidebar-right">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php 
			 	the_post_navigation(
				array(
					'prev_text' => '<span>'. esc_html__('Previous Article', 'monde').'</span>%title',
					'next_text' => '<span>'. esc_html__('Next Article', 'monde').'</span>%title'
				));
			 ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
