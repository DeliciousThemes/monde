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
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->	
					<div class="menu-button" id="open-button">
						<span></span>
						<span></span>
						<span></span>
					</div>					
				</div>

				<div class="four columns">
					<div class="searchform-wrapper">
						<div class="searchform-switch">
							<i class="fa fa-search"></i>
							<i class="fa fa-times-circle"></i>
						</div>

						<?php get_search_form(); ?>							
					</div>

					<ul id="social-nav">
					<?php
						$monde_social_links = array('rss','facebook','twitter','pinterest','instagram', 'heart' , 'youtube', 'flickr', 'google', 'dribbble', 'linkedin', 'github-alt', 'vimeo', 'tumblr', 'behance', 'vk', 'xing', 'soundcloud', 'codepen', 'yelp', 'slideshare', '500px', 'houzz',);

						foreach($monde_social_links as $monde_social_link) {
							if(!empty(get_theme_mod( $monde_social_link, '' ))) { echo '<li><a href="'. esc_url(get_theme_mod( $monde_social_link, '' )) .'" title="'. esc_attr($monde_social_link) .'" class="'.esc_attr($monde_social_link).'"  target="_blank"><i class="fa fa-'.esc_attr($monde_social_link).'"></i></a></li>';
							}								
						}
						if(!empty(get_theme_mod('skype'))) { echo '<li><a href="skype:'. esc_attr(get_theme_mod('skype')) .'?call" title="'. esc_attr(get_theme_mod('skype')) .'" class="'.esc_attr(get_theme_mod('skype')).'"  target="_blank"><i class="fa fa-skype"></i></a></li>';
						}													
					?>
					</ul> 
				</div>
				
			</div>
		</div>

			<div class="site-branding">
				<div class="container">
					<?php 
					$monde_logo_image = get_theme_mod( 'monde_logo_image', '' ); 
					$monde_logo_image_width = get_theme_mod( 'monde_logo_image_width', '' ); 
					$monde_logo_image_height = get_theme_mod( 'monde_logo_image_height', '' ); 
					if($monde_logo_image != '') {
						echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url($monde_logo_image).'" width="'.esc_attr($monde_logo_image_width).'" height="'.esc_attr($monde_logo_image_height).'"/></a>';
					} else { 
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div>
			</div><!-- .site-branding -->

		</header><!-- #masthead -->

		<div id="content" class="site-content">
