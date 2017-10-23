<?php
/**
 * Pinwheel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pinwheel
 */

if ( ! function_exists( 'pinwheel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pinwheel_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Pinwheel, use a find and replace
	 * to change 'pinwheel' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pinwheel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* Enable support for Custom Logo. */
	add_theme_support( 'custom-logo' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pinwheel-slider-thumb', 1350, 562, true );
	add_image_size( 'pinwheel-feature-thumb', 290, 218, true );
	add_image_size( 'pinwheel-popular-thumb', 314, 256, true );
	add_image_size( 'pinwheel-news-thumb', 320, 233, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'pinwheel' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(

		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pinwheel_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'pinwheel_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pinwheel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pinwheel_content_width', 640 );
}
add_action( 'after_setup_theme', 'pinwheel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pinwheel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pinwheel' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pinwheel' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( ' Footer Sidebar', 'pinwheel' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'pinwheel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="col-md-4 col-sm-12 footer-info adress-section">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	//Register the front page widgets
	if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
		register_widget( 'Pinwheel_CTA' );
		register_widget( 'Pinwheel_Services' );
		register_widget( 'Pinwheel_Team' );
		register_widget( 'Pinwheel_Features' );
		register_widget( 'Pinwheel_Slider' );
		register_widget('Pinwheel_About');
	
	}
}
add_action( 'widgets_init', 'pinwheel_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
	require get_template_directory() . "/inc/widgets/pinwheel-call-to-action.php";
	require get_template_directory() . "/inc/widgets/pinwheel-services.php";
	require get_template_directory() . "/inc/widgets/pinwheel-team.php";
	require get_template_directory() . "/inc/widgets/pinwheel-features.php";
	require get_template_directory() . "/inc/widgets/pinwheel-slider.php";
	require get_template_directory() . "/inc/widgets/pinwheel-about.php";

	
}


/**
 * Enqueue scripts and styles.
 */
function pinwheel_scripts() {

	wp_enqueue_style( 'pinwheel-bootstrap', get_template_directory_uri() . '/css/bootstrap.css','1.0',true );
	wp_enqueue_style( 'pinwheel-animate', get_template_directory_uri() . '/css/animate.css','1.0',true );
	wp_enqueue_style( 'pinwheel-font-awesome', get_template_directory_uri() . '/css/font-awesome.css','1.0',true );
	wp_enqueue_style( 'pinwheel-nav-icon', get_template_directory_uri() . '/css/nav-icon.css','1.0',true );
	wp_enqueue_style( 'pinwheel-owl.theme', get_template_directory_uri() . '/css/owl.theme.css','1.0',true );
	wp_enqueue_style( 'pinwheel-owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css','1.0',true );	
	wp_enqueue_style( 'pinwheel-responsive', get_template_directory_uri() . '/css/responsive.css','1.0',true );
	wp_enqueue_style( 'pinwheel-superfish-css', get_template_directory_uri() . '/css/superfish.css','1.0',true );

	wp_enqueue_style( 'pinwheel-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery');	
	wp_enqueue_script( 'pinwheel-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '20151215', true );	
	wp_enqueue_script( 'pinwheel-owl.carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '20151215', true );
	wp_enqueue_script( 'pinwheel-slide', get_template_directory_uri() . '/js/slide.js', array(), '1.0', true );
	
	wp_enqueue_script( 'pinwheel-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
	
	wp_enqueue_script( 'pinwheel-superfish-js', get_template_directory_uri() . '/js/superfish
		.js', array(), '1.0', true );

	wp_enqueue_script( 'pinwheel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
		wp_enqueue_style( 'pinwheel-components', get_template_directory_uri() . '/css/components.css','1.0',true );
	}

	
}
add_action( 'wp_enqueue_scripts', 'pinwheel_scripts' );

function pinwheel_admin_script($hook){
	if($hook == 'post.php'){
		wp_enqueue_script( 'pinwheel-admin-script', get_template_directory_uri() . '/js/admin-script.js', array(), '1.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'pinwheel_admin_script' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 *TGM Plugin activation.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';


// Load custom pinwheel
require get_template_directory() . '/inc/custom-pinwheel.php';

// Load custom hook
require get_template_directory() . '/inc/hook/custom.php';

// Load custom hook
require get_template_directory() . '/inc/hook/basic.php';






