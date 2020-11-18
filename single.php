<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();
global $post;

$twig = Twig::LoadTwig();

$categories  = get_the_category($post->ID);
$post_ID     = $post->ID;
$titre       = $post->post_title;
$description = strip_tags($post->post_excerpt);
$url         = get_site_url()."/?p=$post_ID";

$content = $twig->render(
    'article/show.html.twig',
    [
        'post'       => $post,
        'url'        => $url,
        'categories' => $categories,
    ]
);
echo $content;
get_footer();
