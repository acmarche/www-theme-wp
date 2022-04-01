<?php

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();
global $post;

$categories = get_the_category($post->ID);
$url        = get_permalink($post->ID);
$image      = null;
$blodId     = get_current_blog_id();

$path     = Theme::getPathBlog($blodId);
$blogName = Theme::getTitleBlog($blodId);
$color    = Theme::getColorBlog($blodId);

if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $image = $images[0];
    }
}

$content   = get_the_content(null, null, $post);
$content   = apply_filters('the_content', $content);
$content   = str_replace(']]>', ']]&gt;', $content);
$relations = [];
$urlBack   = '/';
$nameBack  = 'Retour à l\'accueil';

Twig::rendPage(
    'article/notification.html.twig',
    [
        'image'       => $image,
        'title'       => $post->post_title,
        'post'        => $post,
        'url'         => $url,
        'tags'        => $categories,
        'blogName'    => $blogName,
        'color'       => $color,
        'path'        => $path,
        'relations'   => $relations,
        'urlBack'     => $urlBack,
        'nameBack'    => $nameBack,
        'content'     => $content,
        'readspeaker' => true,
    ]
);

wp_enqueue_script(
    'marchebe-notificationPermission',
    get_template_directory_uri().'/assets/js/build/notificationPermission.js',
    ['wp-element'],
    wp_get_theme()->get('Version'),
    true
);

wp_enqueue_script(
    'marchebe-notification',
    get_template_directory_uri().'/assets/js/build/notification.js',
    ['wp-element'],
    wp_get_theme()->get('Version'),
    true
);

get_footer();