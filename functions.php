<?php
/**
 * my-simone functions and definitions
 *
 * @package my-simone
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600; /* pixels */
}

if ( ! function_exists( 'my_simone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_simone_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on my-simone, use a find and replace
	 * to change 'my-simone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'my-simone', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-simone' ),
		'social' => __( 'Social Menu', 'my-simone'),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside') );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'my_simone_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // my_simone_setup
add_action( 'after_setup_theme', 'my_simone_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function my_simone_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'my-simone' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'my_simone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_simone_scripts() {
	wp_enqueue_style( 'my-simone-style', get_stylesheet_uri() );

	wp_enqueue_style( 'my-simone-content-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css' );

	wp_enqueue_style( 'my-simone-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,400,700,900,400italic,900italic|PT+Serif:400,700,400italic,700italic' );

	wp_enqueue_style( 'my-simone-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

    wp_enqueue_script( 'my-simone-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20140902', true );

    wp_enqueue_script( 'my-simone-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('my-simone-superfish'), '20140902', true );

	wp_enqueue_script( 'my-simone-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'my-simone-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_simone_scripts' );

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
