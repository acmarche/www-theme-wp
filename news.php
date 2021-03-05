<?php

namespace AcMarche\Theme;

/**
 * Template Name: News
 */

use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

get_header();

$posts = WpRepository::getAllNews();
Twig::rendPage(
    'news/index.html.twig',
    [
        'actus' => $posts,
    ]
);
get_footer();
