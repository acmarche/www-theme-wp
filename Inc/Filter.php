<?php


namespace AcMarche\Theme\Inc;


class Filter
{
    public function __construct()
    {
        // Stop WP adding extra <p> </p> to your pages' content
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
    }
}