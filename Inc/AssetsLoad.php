<?php

namespace AcMarche\Theme\Inc;

class AssetsLoad
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'marchebeScripts']);
        //todo set condition
        add_action('wp_enqueue_scripts', [$this, 'marchebeLeaft']);
        add_action('wp_enqueue_scripts', [$this, 'readSpeaker']);
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
            get_template_directory_uri().'/assets/tartine/css/base.css',
            array(),
            wp_get_theme()->get('Version')
        );

        wp_enqueue_script(
            'marchebe-bootstrap-js',
            'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            wp_get_theme()->get('Version'),
            true
        );

        global $post;
        $currentBlog = get_current_blog_id();
        if ($currentBlog ==1 && $post !== null && $post->ID = 1840) {

            wp_enqueue_style(
                'marchebe-home-style',
                get_template_directory_uri().'/assets/tartine/css/home.css',
                array()
            );
        }
    }

    function marchebeLeaft()
    {
        if ( ! is_category() && ! is_search() && ! is_front_page()) {
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

    function readSpeaker()
    {
        if (is_single()) {
            wp_enqueue_script(
                'marchebe-readspeaker-js',
                '//cdn1.readspeaker.com/script/11982/webReader/webReader.js?pids=wr',
                array(),
                wp_get_theme()->get('Version')
            );
        }
    }

}
