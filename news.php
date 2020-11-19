<?php

namespace AcMarche\Theme;

/**
 * Template Name: Events
 */

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;

get_header();

$twig = Twig::LoadTwig();

$posts = WpRepository::getAllNews();

$content = $twig->render(
    'news/news.html.twig',
    [
        'posts' => $posts,
    ]
);
echo $content;
get_footer();
