<?php


namespace AcMarche\Theme\Lib;

use function add_image_size;
use function add_theme_support;
use function get_template_directory_uri;
use function is_category;
use function register_nav_menus;
use function register_sidebar;
use function set_post_thumbnail_size;
use function wp_enqueue_style;
use function wp_get_theme;

class Setup
{
    public static function get_instance()
    {
        static $instance = null;

        if ($instance == null) {
            $instance = new self();
        }

        return $instance;
    }

    function wporg_add_custom_post_types($query)
    {
        if ($query->is_main_query()) {
            $query->set('post_type', array('post', 'page', 'bottin_fiche'));
        }

        return $query;
    }

    public static function show_template(): string
    {
        if (true === WP_DEBUG) {
            //	if (current_user_can('administrator')) {
            global $template;

            return 'template: '.$template;
            //	}
        }

        return '';
    }

    /**
     * Remove word "Category"
     *
     * @param $title
     *
     * @return string|void
     */
    public static function prefix_category_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        }

        return $title;
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public static function marchebe_setup()
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
                Menu::MENU_NAME => esc_html__('Menu top', 'marchebe'),
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

    /**
     * Enqueue scripts and styles.
     */
    public static function marchebe_scripts()
    {
        wp_enqueue_style(
            'marchebe-bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css',
            array(),
            wp_get_theme()->get('Version')
        );

        wp_enqueue_style(
            'marchebe-fontawesome',
            'https://use.fontawesome.com/releases/v5.4.2/css/all.css',
            array(),
            wp_get_theme()->get('Version')
        );

        wp_enqueue_style(
            'marchebe-base-style',
            get_template_directory_uri().'/assets/css/base.css',
            array(),
            wp_get_theme()->get('Version')
        );

        if (is_front_page()) {
            wp_enqueue_style('marchebe-home-style', get_template_directory_uri().'/assets/css/home.css', array());
        }

        wp_enqueue_style(
            'marchebe-leaflet',
            'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css',
            array(),
            wp_get_theme()->get('Version')
        );

        wp_enqueue_script(
            'marchebe-leaflet-js',
            'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js',
            array(),
            wp_get_theme()->get('Version')
        );
    }

    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    public static function marchebe_widgets_init()
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
}
