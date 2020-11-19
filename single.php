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
//get_the_posts_pagination();
$logo = null;
if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $logo = $images[0];
    }
}

$content = $twig->render(
    'article/show.html.twig',
    [
        'post'       => $post,
        'url'        => $url,
        'categories' => $categories,
        'logo'       => $logo,
    ]
);
echo $content;
get_footer();
