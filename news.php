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
    'news/show.html.twig',
    [
        'actus' => $posts,
    ]
);
echo $content;
get_footer();
