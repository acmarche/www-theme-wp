<?php

namespace AcMarche\Theme\Inc;

class AssetsLoad
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'marchebeScripts']);
        add_action('wp_enqueue_scripts', [$this, 'marchebeLeaft']);
    }

    /**
     * Enqueue scripts and styles.
     */
    function marchebeScripts()
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

    function marchebeLeaft()
    {
        if (is_single()) {
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
    }

}
