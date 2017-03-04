<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Monde Theme
 */

?>

	</div><!-- #content -->

	<div class="footer-for-widgets">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-instagram' ) ) { 
				dynamic_sidebar( 'sidebar-footer-instagram' ); 
				}		
		?>	
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">
			<div class="site-info">
				<p>
				<?php 
				if( (null !== get_theme_mod('monde_copyright_text')) && (get_theme_mod('monde_copyright_text') !='')) { 
					echo wp_kses_post(get_theme_mod('monde_copyright_text'));
				 		} else {  
				 	esc_html_e('Copyright - Monde | All Rights Reserved', 'monde'); 
				 }
				?>
			</p>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

	<a class="upbtn" href="#">
		<svg class="arrow-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="25 25 50 50" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M42.8,47.5c0.4,0.4,1,0.4,1.4,0l4.8-4.8v21.9c0,0.6,0.4,1,1,1s1-0.4,1-1V42.7l4.8,4.8c0.4,0.4,1,0.4,1.4,0   c0.4-0.4,0.4-1,0-1.4L50,38.9l-7.2,7.2C42.4,46.5,42.4,47.1,42.8,47.5z"/></g></svg>
	</a>
		
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
