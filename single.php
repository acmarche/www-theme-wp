<?php


namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

get_header();
global $post;

$image = null;
if (has_post_thumbnail()) {
    $images = wp_get_attachment_image_src(get_post_thumbnail_id(), 'original');
    if ($images) {
        $image = $images[0];
    }
}


$blodId = get_current_blog_id();

$path     = Theme::getPathBlog($blodId);
$blogName = Theme::getTitleBlog($blodId);
$color    = Theme::getColorBlog($blodId);

$tags      = WpRepository::getTags($post->ID);
$relations = WpRepository::getRelations($post->ID);

$currentCategory = get_category_by_slug(get_query_var('category_name'));
$urlBack         = get_category_link($currentCategory);

$content = get_the_content(null, null, $post);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

Twig::rendPage(
    'article/show.html.twig',
    [
        'post'        => $post,
        'tags'        => $tags,
        'image'       => $image,
        'title'       => $post->post_title,
        'blogName'    => $blogName,
        'color'       => $color,
        'path'        => $path,
        'relations'   => $relations,
        'urlBack'     => $urlBack,
        'content'     => $content,
        'readspeaker' => true,
    ]
);
get_footer();
