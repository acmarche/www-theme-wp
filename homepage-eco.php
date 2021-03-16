<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

/**
 * Template Name: Home-Page-Eco
 */
get_header();
$wpRepository = new WpRepository();

$news = $wpRepository->getPostsByCategory(258, get_current_blog_id());

$children = $wpRepository->getRootCategories();

$blodId   = get_current_blog_id();
$color    = Theme::getColorBlog($blodId);

Twig::rendPage(
    'eco/eco.html.twig',
    [
        'actus'       => $news,
        'title'       => 'Economie marchoise',
        'color'       => $color,
        'children'    => $children,
        'description' => '',
        'posts'       => [],
    ]
);

get_footer();
