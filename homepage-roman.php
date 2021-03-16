<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

/**
 * Template Name: Home-Page-Roman
 */
get_header();
$wpRepository = new WpRepository();
$page = get_queried_object();
$news = $wpRepository->getPostsByCategory(258, get_current_blog_id());

$children = $wpRepository->getRootCategories();

$blodId   = get_current_blog_id();
$color    = Theme::getColorBlog($blodId);
$posts    = $wpRepository->getPostsAndFiches(6);

Twig::rendPage(
    'roman/index.html.twig',
    [
        'actus'       => $news,
        'title'       => $page->post_title,
        'color'       => $color,
        'children'    => $children,
        'description' => $page->post_content,
        'posts'       => $posts,
    ]
);

get_footer();
