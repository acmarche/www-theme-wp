<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Theme;

get_header();
global $post;

$categories  = get_the_category($post->ID);
$url         = get_permalink($post->ID);
$image       = null;
$blodId      = get_current_blog_id();

$path     = Theme::getPathBlog($blodId);
$blogName = Theme::getTitleBlog($blodId);
$color    = Theme::getColorBlog($blodId);

if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $image = $images[0];
    }
}
Twig::rendPage(
    'article/page.html.twig',
    [
        'image'    => $image,
        'title'    => $post->post_title,
        'post'     => $post,
        'url'      => $url,
        'tags'     => $categories,
        'content'  => $post->post_content,
        'blogName' => $blogName,
        'color'    => $color,
        'path'     => $path,
    ]
);
get_footer();
