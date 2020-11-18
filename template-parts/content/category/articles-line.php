<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

global $wp_query;
if ($wp_query->post_count === 0) {
    return;
}
$posts = $wp_query->get_posts();
$twig    = Twig::LoadTwig();
$content = $twig->render(
    'category/_articles_line.html.twig',
    [
        'posts' => $posts,
    ]
);
echo $content;
