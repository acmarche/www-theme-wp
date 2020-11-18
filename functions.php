<?php


namespace AcMarche\Theme;

use AcMarche\Theme\Lib\Setup;

add_filter('get_the_archive_title', [Setup::get_instance(), 'prefix_category_title']);
add_action('after_setup_theme', [Setup::get_instance(), 'marchebe_setup']);
add_action('wp_enqueue_scripts', [Setup::get_instance(), 'marchebe_scripts']);
add_action('widgets_init', [Setup::get_instance(), 'marchebe_widgets_init']);
//add_action('wp_head', [Setup::get_instance(), 'show_template']);
