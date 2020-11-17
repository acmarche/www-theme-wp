<?php

//use AcMarche\Theme\Lib\Menu;

/**
 * Remove word "Category"
 *
 * @param $title
 *
 * @return string|void
 */
function prefix_category_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    }

    return $title;
}

add_filter('get_the_archive_title', 'prefix_category_title');

add_action('wp_head', 'show_template');
/**
 * for debug
 * @global string $template
 */
function show_template()
{
    if (true === WP_DEBUG) {
        //	if (current_user_can('administrator')) {
        global $template;
        //		var_dump($template);
        //	}
    }
}

if ( ! function_exists('marchebe_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function marchebe_setup()
    {
        // Add default posts and comments RSS feed links to head.
        //add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('slideshow', 480, 210, true);
        set_post_thumbnail_size(1568, 9999);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-top' => esc_html__('Menu top', 'marchebe'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');
    }
endif;
add_action('after_setup_theme', 'marchebe_setup');


/**
 * Enqueue scripts and styles.
 */
function marchebe_scripts()
{
    wp_enqueue_style(
        'marchebe-base-style',
        get_template_directory_uri().'/assets/css/base.css',
        array(),
        wp_get_theme()->get('Version')
    );

  //  if (is_home()) {
        wp_enqueue_style('marchebe-home-style', get_template_directory_uri().'/assets/css/home.css', array());
  //  }

//	wp_style_add_data( 'marchebe-style', 'rtl', 'replace' );

    // Print styles.
    /*	wp_enqueue_style( 'marchebe-print-style',
            get_template_directory_uri() . '/assets/css/print.css',
            array(),
            wp_get_theme()->get( 'Version' ),
            'print' );
            wp_enqueue_script( 'marchebe-navigation',
                get_template_directory_uri() . '/js/navigation.js',
                array(),
                _S_VERSION,
                true );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }*/
}

add_action('wp_enqueue_scripts', 'marchebe_scripts');


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function marchebe_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'marchebe'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'marchebe'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}

add_action('widgets_init', 'marchebe_widgets_init');
