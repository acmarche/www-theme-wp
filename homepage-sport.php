<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

/**
 * Template Name: Home-Page-Sport
 */
get_header();

$wpRepository = new WpRepository();
$news         = $wpRepository->getPostsByCategory(71, get_current_blog_id());
$events       = $wpRepository->getPostsByCategory(81, get_current_blog_id());

array_map(
    function ($post) {
        $date = get_post_meta($post->ID, "acmarche_date", true);
        if ( ! $date) {
            $date = '0000-00-00';
        }
        $data = [];
        list($data['year'], $data['month'], $data['day']) = explode('-', $date);
        $post->date     = $data;
        $post->titre    = $post->post_title;
        $post->localite = 'Marche';
    },
    $events
);

Twig::rendPage(
    'sport/index.html.twig',
    [
        'actus'  => $news,
        'events' => $events,
    ]
);

get_footer();
