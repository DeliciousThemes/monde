<?php
/**
 * Delicious Theme Theme Customizer.
 *
 * @package Delicious Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function delicious_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'delicious_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function delicious_customize_preview_js() {
	wp_enqueue_script( 'delicious_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'delicious_customize_preview_js' );


/**
 * Add the theme configuration
 */
Monde_Kirki::add_config( 'monde_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add the Logo section
 */
Monde_Kirki::add_section( 'logo', array(
	'title'      => esc_attr__( 'Logo', 'monde' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );

Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'image',
	'settings'    => 'monde_logo_image',
	'label'       => esc_attr__( 'Main Logo', 'monde' ),
	'description' => esc_attr__( 'Set a logo for your site.', 'monde' ),
	'help'        => esc_attr__( 'Best to use a landscape oriented logo.', 'monde' ),
	'section'     => 'logo',
	'default'     => '',
	'priority'    => 10,
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'number',
	'settings'    => 'monde_logo_image_width',
	'label'       => esc_attr__( 'Logo Width', 'monde' ),
	'description' => esc_attr__( 'Set the width of the logo image.', 'monde' ),
	'section'     => 'logo',
	'default'     => 200,
	'choices'     => array(
		'min'  => 1,
		'max'  => 1200,
		'step' => 1,
	),
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'number',
	'settings'    => 'monde_logo_image_height',
	'label'       => esc_attr__( 'Logo Height', 'monde' ),
	'description' => esc_attr__( 'Set the height of the logo image.', 'monde' ),
	'section'     => 'logo',
	'default'     => 100,
	'choices'     => array(
		'min'  => 1,
		'max'  => 600,
		'step' => 1,
	),
) );

/**
 * Add the Styling section
 */
Monde_Kirki::add_section( 'styling', array(
	'title'      => esc_attr__( 'Styling', 'monde' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );

Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'color',
	'settings'    => 'monde_main_color_scheme',
	'label'       => esc_attr__( 'Color Scheme', 'monde' ),
	'description' => esc_attr__( 'Set a color scheme for the website.', 'monde' ),
	'section'     => 'styling',
	'default'     => '#b38870',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'color',
	'settings'    => 'monde_body_bg_color',
	'label'       => esc_attr__( 'Body Background Color', 'monde' ),
	'description' => esc_attr__( 'Set the background color for body.', 'monde' ),
	'section'     => 'styling',
	'default'     => '#ffffff',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'color',
	'settings'    => 'monde_footer_bg_color',
	'label'       => esc_attr__( 'Footer Background Color', 'monde' ),
	'description' => esc_attr__( 'Set the background color for footer.', 'monde' ),
	'section'     => 'styling',
	'default'     => '#ffffff',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'color',
	'settings'    => 'monde_selected_text_background_color',
	'label'       => esc_attr__( 'Selected Text Background Color', 'monde' ),
	'description' => esc_attr__( 'Set the background color for selected text.', 'monde' ),
	'section'     => 'styling',
	'default'     => '#323232',
) );

/**
 * Add the typography section
 */
Monde_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'monde' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'typography',
	'settings'    => 'primary_typography',
	'label'       => esc_attr__( 'Primary Typography', 'monde' ),
	'description' => esc_attr__( 'Select the primary typography options for your site.', 'monde' ),
	'help'        => esc_attr__( 'The typography options you set here apply to headings and links.', 'monde' ),
	'section'     => 'typography',
	'default'     => array(
		'font-family'    => 'Raleway'
	),
	'output' => array(
		array(
			'element' => array('body'),
		),
	),
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'typography',
	'settings'    => 'secondary_typography',
	'label'       => esc_attr__( 'Secondary Typography', 'monde' ),
	'description' => esc_attr__( 'Select the secondary typography options.', 'monde' ),
	'help'        => esc_attr__( 'The typography options you set here apply to text.', 'monde' ),
	'section'     => 'typography',
	'default'     => array(
		'font-family'    => 'Georgia,Times,"Times New Roman",serif',
	),
	'output' => array(
		array(
			'element' => array( 'textarea', 'select', 'input:not([type="submit"])', 'p' ),
		),
	),
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'typography',
	'settings'    => 'tertiary_typography',
	'label'       => esc_attr__( 'Tertiary Typography', 'monde' ),
	'description' => esc_attr__( 'Select the tertiary typography options.', 'monde' ),
	'help'        => esc_attr__( 'The typography options you set here apply to pieces of text like "Read More".', 'monde' ),
	'section'     => 'typography',
	'default'     => array(
		'font-family'    => 'Nothing You Could Do',
		'variant'        => '400',
	),
	'output' => array(
		array(
			'element' => array( '.delicious-author-signature' ),
		),
	),
) );

/**
 * Add the Social section
 */
Monde_Kirki::add_section( 'social', array(
	'title'      => esc_attr__( 'Social', 'monde' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'rss',
	'label'       => esc_attr__( 'RSS Feed address', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'facebook',
	'label'       => esc_attr__( 'Facebook page/profile URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'twitter',
	'label'       => esc_attr__( 'Twitter URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'pinterest',
	'label'       => esc_attr__( 'Pinterest URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'instagram',
	'label'       => esc_attr__( 'Instagram URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'heart',
	'label'       => esc_attr__( 'Bloglovin URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'youtube',
	'label'       => esc_attr__( 'YouTube URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'flickr',
	'label'       => esc_attr__( 'Flickr URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'google',
	'label'       => esc_attr__( 'Google URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'dribbble',
	'label'       => esc_attr__( 'Dribbble URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'linkedin',
	'label'       => esc_attr__( 'LinkedIn URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'skype',
	'label'       => esc_attr__( 'Skype Username', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'github',
	'label'       => esc_attr__( 'Github URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'vimeo',
	'label'       => esc_attr__( 'Vimeo URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'tumblr',
	'label'       => esc_attr__( 'Tumblr URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'behance',
	'label'       => esc_attr__( 'Behance URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'vk',
	'label'       => esc_attr__( 'VK URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'xing',
	'label'       => esc_attr__( 'Xing URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'soundcloud',
	'label'       => esc_attr__( 'SoundCloud URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'codepen',
	'label'       => esc_attr__( 'Codepen URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'yelp',
	'label'       => esc_attr__( 'Yelp URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'slideshare',
	'label'       => esc_attr__( 'Slideshare URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => '500px',
	'label'       => esc_attr__( '500px URL', 'monde' ),
	'section'     => 'social',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'text',
	'settings'    => 'houzz',
	'label'       => esc_attr__( 'Houzz URL', 'monde' ),
	'section'     => 'social',
) );


/**
 * Add the Footer section
 */
Monde_Kirki::add_section( 'footer', array(
	'title'      => esc_attr__( 'Footer', 'monde' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );
Monde_Kirki::add_field( 'monde_theme', array(
	'type'        => 'textarea',
	'settings'    => 'monde_copyright_text',
	'label'       => esc_attr__( 'Footer Copyright Text', 'monde' ),
	'section'     => 'footer',
	'default'	  => 'Copyright &copy; Monde. All Rights Reserved',
) );