<?php

namespace AcMarche\Theme;

/**
 * Template Name: Events
 */

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;

get_header();

$posts = WpRepository::getAllNews();
Twig::rendPage(
    'news/index.html.twig',
    [
        'actus' => $posts,
    ]
);
get_footer();
