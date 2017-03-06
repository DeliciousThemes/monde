<?php
/**
 * Monde Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Monde Theme
 */

if ( ! function_exists( 'monde_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function monde_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Monde Theme, use a find and replace
	 * to change 'monde' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'monde', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'monde' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside',
	// 	'image',
	// 	'video',
	// 	'quote',
	// 	'link',
	// ) );

}
endif; // monde_setup
add_action( 'after_setup_theme', 'monde_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monde_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monde_content_width', 640 );
}
add_action( 'after_setup_theme', 'monde_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monde_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'monde' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'monde' ),
		'id'            => 'sidebar-footer-instagram',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );	
}
add_action( 'widgets_init', 'monde_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/*	Set different thumbnail dimensions
/*-----------------------------------------------------------------------------------*/

if( !function_exists('monde_image_sizes') ) {	
	function monde_image_sizes() {
		add_image_size( 'dt-blog-thumbnail', 1120, 9999, false ); 	// Blog thumbnails
		add_image_size( 'dt-blog-thumbnail-slider', 1120, 640, false ); 	// Blog thumbnails
		add_image_size( 'dt-full-size',  9999, 9999, false ); 		// Full Size
	}

	add_action( 'init', 'monde_image_sizes' );
}



/**
 * Enqueue scripts and styles.
 */

function monde_load_fonts() {
	wp_register_style('monde-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700');
	wp_enqueue_style( 'monde-google-fonts');
}
add_action('wp_print_styles', 'monde_load_fonts');

function monde_scripts() {
	wp_enqueue_style( 'monde-style', get_stylesheet_uri() );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css' );		
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );		

	wp_enqueue_script( 'monde-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.jquery.min.js', array('jquery'), '3.4.1', true );
	wp_enqueue_script( 'monde-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'monde-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_register_script( 'monde-social-sharer', get_template_directory_uri() . '/assets/js/custom-social.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$monde_output_scheme = '';

	$monde_body_bg = get_theme_mod( 'monde_body_bg_color', '#ffffff' );
	$monde_footer_bg = get_theme_mod( 'monde_footer_bg_color', '#ffffff' );
	$monde_topbar_bg = get_theme_mod( 'monde_topbar_bg_color', '#ffffff' );
	$monde_header_bg = get_theme_mod( 'monde_header_bg_color', '#ffffff' );

	$monde_output_scheme .= 'body {background: '.$monde_body_bg.';} .site-footer {background: '.$monde_footer_bg.';} .topbar {background: '.$monde_topbar_bg.';} .site-branding {background: '.$monde_header_bg.';}';

	// custom color scheme
	$monde_color_scheme = get_theme_mod( 'monde_main_color_scheme', '#b38870' );

	$monde_output_scheme .= 'button, .post-read-more a, .dt-button:hover, button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, .dt-button.button-primary:hover, button.button-primary:hover, input[type="submit"].button-primary:hover, input[type="reset"].button-primary:hover, input[type="button"].button-primary:hover, .dt-button.button-primary:focus, button.button-primary:focus, .main-navigation ul ul li a:hover, html .mc4wp-form .form-wrapper input[type="submit"]:hover, .pagenav a:hover, .pagenav span.current, html .swiper-pagination-bullet-active { background-color: '.$monde_color_scheme.'; }';

	$monde_output_scheme .= '.dt-button:hover, button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, .dt-button.button-primary:hover, button.button-primary:hover, input[type="submit"].button-primary:hover, input[type="reset"].button-primary:hover, input[type="button"].button-primary:hover, .dt-button.button-primary:focus, button.button-primary:focus, html #comments .bodycomment a, .pagenav a:hover, .main-navigation ul.menu li a:hover { border-color: '.$monde_color_scheme.'; }';

	$monde_output_scheme .= 'a, .main-navigation a:hover, #comments .commentwrap .metacomment .comment-author-name a:hover, #social-nav li a:hover, .entry-header h2.entry-title a:hover, .entry-header h1.entry-title a:hover, .entry-footer a:hover, .tags-links a:hover, .nav-links a:hover, .author-bio .author-description h3 a:hover, .widget-area a:hover, .widget li span a { color: '.$monde_color_scheme.'; }';

	wp_add_inline_style( 'monde-style', $monde_output_scheme );	

}
add_action( 'wp_enqueue_scripts', 'monde_scripts' );


//wrap "Read more" button 
if(!function_exists('monde_wrap_readmore')) { 
	function monde_wrap_readmore($more_link)
	{
		return '<div class="post-read-more">'.$more_link.'</div>';
	}
	add_filter('the_content_more_link', 'monde_wrap_readmore', 10, 1);
}

// Sets how comments are displayed
if(!function_exists('monde_comment')) { 
	function monde_comment($monde_comment, $monde_args, $monde_depth) {
		$GLOBALS['comment'] = $monde_comment; ?>
		<li class="comment" <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="commentwrap">
				<div class="avatar">
					<?php echo get_avatar($monde_comment,$size='60'); ?>
				</div><!--end avatar-->
				
				<div class="metacomment">
					<span class="comment-author-name"><?php echo get_comment_author_link() ?></span>
					<span class="comment-time"><?php echo get_comment_date(); ?></a><?php edit_comment_link(esc_html__('Edit', 'monde'),'  ','') ?></span>
				</div><!--end metacomment-->
			
				<div class="bodycomment">
					<?php if ($monde_comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.', 'monde') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div><!--end bodycomment-->

				<div class="replycomment">
					<?php comment_reply_link(array_merge( $monde_args, array('depth' => $monde_depth, 'max_depth' => $monde_args['max_depth']))) ?> 
				</div>
			</div><!--end commentwrap-->
		
	<?php }
}

/**
 * TGMPA
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

	add_action( 'tgmpa_register', 'monde_register_required_plugins' );
	function monde_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$monde_plugins = array(	

			array(
				'name' 		=> esc_html__('Kirki', 'monde'),
				'slug' 		=> 'kirki',
				'version'	=> '',
				'required' 	=> true,
			),	

			array(
				'name' 		=> esc_html__('Meta Box', 'monde'),
				'slug' 		=> 'meta-box',
				'version'	=> '',
				'required' 	=> true,
			),	

			array(
				'name' 		=> esc_html__('Contact Form 7', 'monde'),
				'slug' 		=> 'contact-form-7',
				'version'	=> '',
				'required' 	=> false,
			),	

			array(
				'name' 		=> esc_html__('Wp Instagram Widget', 'monde'),
				'slug' 		=> 'wp-instagram-widget', 
				'version'	=> '',
				'required' 	=> false,
			),		

			array(
				'name' 		=> esc_html__('Mailchimp for Wp', 'monde'),
				'slug' 		=> 'mailchimp-for-wp',
				'version'	=> '',
				'required' 	=> false,
			),													

		);

		$theme_text_domain = 'monde';

		$monde_tgmpa_config = array(
			'id'           => 'monde',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'parent_slug'  => 'themes.php',            
			'capability'   => 'edit_theme_options',    
			'has_notices'  => true,                   
			'dismissable'  => true,                   
			'dismiss_msg'  => '',                      
			'is_automatic' => false,                   
			'message'      => '',                   
		);

		tgmpa( $monde_plugins, $monde_tgmpa_config );

	}


/**
 * Implement Kirki & Metabox.
 */
require_once get_template_directory() . '/inc/monde-kirki.php';
require_once get_template_directory() . '/inc/monde-metabox.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Navigation for this theme.
 */
require get_template_directory() . '/inc/navigation.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Social widget file.
 */
require get_template_directory() . '/inc/widgets/widget-social.php';
require get_template_directory() . '/inc/widgets/widget-author.php';


