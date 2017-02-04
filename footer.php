<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Delicious Theme
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
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
