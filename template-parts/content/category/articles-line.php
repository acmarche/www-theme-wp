<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

global $wp_query;
$twig    = Twig::LoadTwig();
$posts = $wp_query->get_posts();
$content = $twig->render(
    'category/_articles_line.html.twig',
    [
        'posts' => $posts,
    ]
);
echo $content;
