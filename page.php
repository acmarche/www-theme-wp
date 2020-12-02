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
$url         = get_permalink($post->ID);
$logo        = null;
if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $logo = $images[0];
    }
}
$content = $twig->render(
    'article/show.html.twig',
    [
        'post' => $post,
        'url'  => $url,
        'tags' => $categories,
        'logo' => $logo,
        'nom'  => $post->post_title,
    ]
);

echo $content;
get_footer();
