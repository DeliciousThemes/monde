<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Monde Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'monde' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="topbar">
			<div class="container">
				<div class="eight columns">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="close-button" id="close-button">Close Menu</button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->	
					<a class="menu-button" id="open-button">Open Menu</a>					
				</div>

				<div class="four columns">
					<ul id="social-nav">
						<li><a href="#" title="" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" title="" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" title="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#" title="" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#" title="" target="_blank"><i class="fa fa-vimeo"></i></a></li>
					</ul> 
				</div>
				
			</div>
		</div>

		<div class="site-branding">
			<div class="container">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">
