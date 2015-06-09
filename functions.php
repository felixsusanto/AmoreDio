<?php
/**
 * amoredio functions and definitions
 *
 * @package amoredio
 */

/*GRUNT + LIVERELOAD*/
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
  wp_enqueue_script('livereload');
}

/*BOOTSTRAP MENU WALKER*/
require_once('wp_bootstrap_navwalker.php');


/*CUSTOM SHORTCODE*/
function permalink_thingy($atts) {
  extract(shortcode_atts(array(
    'id' => 1,
    'class'=>"",
    'text' => "",  // default value if none supplied
    'hash' => ""
    ), $atts));
    
    if ($text) {
        $url = get_permalink($id);
        return "<a class='$class' href='$url$hash'>$text</a>";
    } else {
     return get_permalink($id);
  }
}
add_shortcode('permalink', 'permalink_thingy');

function fasil_content($atts, $content) {
  extract(shortcode_atts(array(
    'class'=>"facil",
    'text' => $content  // default value if none supplied
    ), $atts));

    if ($text) {
        $url = get_permalink($id);
        return "<div class='$class' href='$url'>$text</a>";
    } else {
     return get_permalink($id);
  }
}
add_shortcode('fasil', 'fasil_content');

add_filter('widget_text', 'do_shortcode');



/**
 * Conditionally Override Yoast SEO Breadcrumb Trail
 * http://plugins.svn.wordpress.org/wordpress-seo/trunk/frontend/class-breadcrumbs.php
 * -----------------------------------------------------------------------------------
 */

add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    if ( is_singular( 'songbook' ) ) {
        $breadcrumb[] = array(
            'url' => get_permalink( get_page_by_title( 'Song Book' ) ),
            'text' => 'Song Book',
        );

        array_splice( $links, 1, -2, $breadcrumb );
    } elseif( is_singular( 'cg-reading' ) ){
        $breadcrumb[] = array(
            'url' => get_permalink( get_page_by_title( 'Cell Group Readings' ) ),
            'text' => 'CG Readings',
        );

        array_splice( $links, 1, -2, $breadcrumb );
    } 

    return $links;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 640; /* pixels */
}

if ( ! function_exists( 'amoredio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function amoredio_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on amoredio, use a find and replace
   * to change 'amoredio' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'amoredio', get_template_directory() . '/languages' );

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
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  //add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'amoredio' ),
    'secondary' => esc_html__('Secondary Menu', 'amoredio'),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'amoredio_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // amoredio_setup
add_action( 'after_setup_theme', 'amoredio_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function amoredio_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'amoredio' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
  register_sidebar(array(
    'name'=> esc_html__( 'SidebarBlog', 'amoredio' ),
    'id' => 'sidebar-2',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ));
}
add_action( 'widgets_init', 'amoredio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function amoredio_scripts() {
  //Register JS
  wp_register_script('amoredio-js-vendor', get_template_directory_uri() . '/js/lib.js', false, filemtime( get_stylesheet_directory().'/js/lib.js' ), true);
  wp_register_script('amoredio-js-songbook', get_template_directory_uri() . '/js/songbook.js', false, filemtime( get_stylesheet_directory().'/js/songbook.js' ), true);
  wp_register_script('amoredio-js-frontpage', get_template_directory_uri() . '/js/frontpage.js', false, filemtime( get_stylesheet_directory().'/js/frontpage.js' ), true);
  wp_register_script('amoredio-js-pagecontact', get_template_directory_uri() . '/js/page-contact.js', false, filemtime( get_stylesheet_directory().'/js/page-contact.js' ), true);
  wp_register_script('amoredio-js-single-cg-reading', get_template_directory_uri() . '/js/single-cg-reading.js', false, filemtime( get_stylesheet_directory().'/js/single-cg-reading.js' ), true);

  //Global CSS Style and JS to be added
  wp_enqueue_style('amoredio-style-global', get_template_directory_uri() . '/css/global.css', false, filemtime(get_stylesheet_directory() . '/css/global.css'));
  wp_enqueue_script('amoredio-js-vendor');

  //Conditional CSS to be added on certain page or custom post type
  //on Front Page
  if(is_front_page()){
    wp_enqueue_style('amoredio-style-frontpage', get_template_directory_uri() . '/css/front-page.css', false, filemtime(get_stylesheet_directory() . '/css/front-page.css'));
    wp_enqueue_script('amoredio-js-frontpage');
  } 
  //on single songbook
  elseif('songbook' == get_post_type()){
    wp_enqueue_style('amoredio-style-transposer', get_template_directory_uri() . '/css/jquery.transposer.css', false, filemtime(get_stylesheet_directory() . '/css/jquery.transposer.css'));
    wp_enqueue_script('amoredio-js-songbook');
  }
  //on page contact
  elseif(is_page( 18 )){
    wp_enqueue_script('amoredio-js-pagecontact');
  }
  elseif('cg-reading' == get_post_type()){
    wp_enqueue_style('amoredio-style-cg-reading', get_template_directory_uri() . '/css/single-cg-reading.css', false, filemtime(get_stylesheet_directory() . '/css/single-cg-reading.css'));
    wp_enqueue_script('amoredio-js-single-cg-reading');
  }

  //Consider to remove this 2 lines if it's not used - legacy from underscores_me theme
  //wp_enqueue_script( 'amoredio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
  //wp_enqueue_script( 'amoredio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
  
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'amoredio_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
