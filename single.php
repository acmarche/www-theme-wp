<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();
global $post;

$tags = get_the_category($post->ID);
//get_the_posts_pagination();
$image = null;
if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $image = $images[0];
    }
}

Twig::rendPage(
    'article/show.html.twig',
    [
        'post'  => $post,
        'tags'  => $tags,
        'image' => $image,
        'title' => $post->post_title,
    ]
);
get_footer();
