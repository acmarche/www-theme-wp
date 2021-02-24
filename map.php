<?php
/*
 * Template Name: Map
 */

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Carto;

get_header();
$carto   = new Carto();
        $element = $carto->foundSource('s');
        //dump($element);

wp_enqueue_script(
    'react_map_plugin',
    get_template_directory_uri().'/assets/js/build/map.js',
    array('wp-element'),
    time(),
    true
);//For production use wp_get_theme()->get('Version')

Twig::rendPage(
    'map/index.html.twig',
    [

    ]
);
get_footer();
