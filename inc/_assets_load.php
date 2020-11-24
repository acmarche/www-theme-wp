<?php

add_action('wp_enqueue_scripts', 'marchebe_scripts');
add_action('wp_enqueue_scripts', 'marchebe_leaft');

/**
 * Enqueue scripts and styles.
 */
function marchebe_scripts()
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
}

function marchebe_leaft()
{
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

