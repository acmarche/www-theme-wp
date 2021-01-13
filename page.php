<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();
global $post;

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
Twig::rendPage(
    'article/page.html.twig',
    [
        'title'   => $titre,
        'post'    => $post,
        'url'     => $url,
        'tags'    => $categories,
        'logo'    => $logo,
        'content' => $post->post_content,
    ]
);
get_footer();
