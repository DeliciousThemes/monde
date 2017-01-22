<?php
/**
 * Delicious Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Delicious Theme
 */

if ( ! function_exists( 'delicious_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function delicious_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Delicious Theme, use a find and replace
	 * to change 'delicious' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'delicious', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'delicious' ),
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
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'delicious_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // delicious_setup
add_action( 'after_setup_theme', 'delicious_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function delicious_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'delicious_content_width', 640 );
}
add_action( 'after_setup_theme', 'delicious_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function delicious_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'delicious' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'delicious_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/*	Set different thumbnail dimensions
/*-----------------------------------------------------------------------------------*/

if( !function_exists('delicious_image_sizes') ) {	
	function delicious_image_sizes() {
		add_image_size( 'dt-blog-thumbnail', 1120, 9999, false ); 	// Blog thumbnails
		add_image_size( 'dt-full-size',  9999, 9999, false ); 		// Full Size
	}

	add_action( 'init', 'delicious_image_sizes' );
}



/**
 * Enqueue scripts and styles.
 */

function delicious_load_fonts() {
	wp_register_style('delicious-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700');
	wp_enqueue_style( 'delicious-google-fonts');
}
add_action('wp_print_styles', 'delicious_load_fonts');

function delicious_scripts() {
	wp_enqueue_style( 'delicious-style', get_stylesheet_uri() );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css' );		

	wp_enqueue_script( 'delicious-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'delicious-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_register_script( 'delicious-social-sharer', get_template_directory_uri() . '/js/custom-social.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'delicious_scripts' );


//wrap "Read more" button 
if(!function_exists('delicious_wrap_readmore')) { 
	function delicious_wrap_readmore($more_link)
	{
		return '<div class="post-read-more">'.$more_link.'</div>';
	}
	add_filter('the_content_more_link', 'delicious_wrap_readmore', 10, 1);
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
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

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


