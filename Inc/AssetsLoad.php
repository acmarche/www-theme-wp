<?php

namespace AcMarche\Theme\Inc;

class AssetsLoad
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'marchebeAssets']);

        if (Theme::isHomePage()) {
            add_action('wp_enqueue_scripts', [$this, 'marchebeHome']);
        }

        if ( ! is_category() && ! is_search() && ! is_front_page()) {
            add_action('wp_enqueue_scripts', [$this, 'marchebeLeaft']);
            add_action('wp_enqueue_scripts', [$this, 'marchebeLightGallery']);
            add_action('wp_enqueue_scripts', [$this, 'readSpeaker']);
        }
    }

    function marchebeAssets()
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
    }

    function marchebeHome()
    {
        wp_enqueue_style(
            'marchebe-home-style',
            get_template_directory_uri().'/assets/tartine/css/home.css',
            array()
        );

        wp_enqueue_script(
            'marchebe-close-js',
            get_template_directory_uri().'/assets/js/utils/closeNavigation.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );

        wp_enqueue_style(
            'marchebe-lightSlider-style',
            get_template_directory_uri().'/assets/js/lightslider/css/lightslider.css',
            array()
        );

        wp_enqueue_script(
            'marchebe-lightSlider-js',
            get_template_directory_uri().'/assets/js/lightslider/js/lightslider.js',
            array('jquery'),
            wp_get_theme()->get('Version'),
            true
        );
    }

    function marchebeLightGallery()
    {
        wp_enqueue_style(
            'marchebe-lightSlider-style',
            get_template_directory_uri().'/assets/js/lightGallery/dist/css/lightgallery.min.css',
            array()
        );

        wp_enqueue_script(
            'marchebe-lightGallery-js',
            get_template_directory_uri().'/assets/js/lightGallery/dist/js/lightgallery.min.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );
        wp_enqueue_script(
            'marchebe-lightGallery-zoom-js',
            get_template_directory_uri().'/assets/js/lightGallery/modules/lg-zoom.min.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );
        wp_enqueue_script(
            'marchebe-lightGallery-mouse-js',
            get_template_directory_uri().'/assets/js/lightGallery/lib/jquery.mousewheel.min.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );
        wp_enqueue_script(
            'marchebe-lightGallery-full-js',
            get_template_directory_uri().'/assets/js/lightGallery/modules/lg-fullscreen.min.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );
    }

    function marchebeLeaft()
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

    function readSpeaker()
    {
        wp_enqueue_script(
            'marchebe-readspeaker-js',
            '//cdn1.readspeaker.com/script/11982/webReader/webReader.js?pids=wr',
            array(),
            wp_get_theme()->get('Version')
        );
        wp_enqueue_script(
            'marchebe-zoom-js',
            get_template_directory_uri().'/assets/js/utils/zoom.js',
            array(),
            wp_get_theme()->get('Version')
        );
    }

}
