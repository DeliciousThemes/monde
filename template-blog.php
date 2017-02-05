<?php
/*

Template Name: Blog Template

 */

?>

<?php get_header(); ?>

	<?php
		$monde_slider_args = array(
			'post_type'=> 'post',
			'meta_key'     => '_thumbnail_id',
			'posts_per_page' => 5
		);	
		$monde_slider_blog_query = new WP_Query($monde_slider_args);
	?>	

	<div class="swiper-container">
	    <div class="swiper-wrapper">
		<?php 
		if ($monde_slider_blog_query->have_posts()) :  while ($monde_slider_blog_query->have_posts()) : $monde_slider_blog_query->the_post(); 
				$monde_slider_thumbnail = get_the_post_thumbnail_url($monde_slider_blog_query->ID, 'dt-blog-thumbnail-slider');	
		?>
		    <div class="swiper-slide">
		    	<div class="background-img" style='background-image:url("<?php echo $monde_slider_thumbnail; ?>")'>
					<div class="monde-slider-ov">
						<div class="monde-slider-overlay">
							<header class="entry-header">

								<div class="entry-meta">
									<?php monde_categories_list(); ?>
								</div><!-- .entry-meta -->
									
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
								<div class="post-read-more">
									<a href="#">READ MORE</a>
								</div>

							</header><!-- .entry-header -->	
						</div>
					</div>
		    	</div>
		    </div>
	<?php
			endwhile;
		endif;  
		wp_reset_postdata();
	?>				 
	    </div>
	</div>	

	<div class="space"></div>

	<?php
		if (have_posts()) : 
			while (have_posts()) : the_post();
				the_content();	
			endwhile;
		endif;
	 ?>

<div class="container">
	<div id="primary" class="content-area percent-blog sidebar-right">
		<main id="main" class="site-main" role="main">
		<?php
			$monde_args = array(
				'post_type'=> 'post',
				'paged'=>$paged
			);	
			$monde_blog_query = new WP_Query($monde_args);
		?>	

		<?php 
			if ($monde_blog_query->have_posts()) :  while ($monde_blog_query->have_posts()) : $monde_blog_query->the_post(); 
					get_template_part( 'template-parts/content', get_post_format() );	
				endwhile;
			endif;  

			monde_navigation();  
			wp_reset_postdata(); ?>	
			<div class="space"></div>					 
		</main>

	</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer();
