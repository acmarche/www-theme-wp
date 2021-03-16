<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

/**
 * Template Name: Home-Page-Eco
 */
get_header();
$wpRepository = new WpRepository();

$news   = $wpRepository->getPostsByCategory(258, get_current_blog_id());

Twig::rendPage(
    'eco/index.html.twig',
    [
        'actus'  => $news,
    ]
);

get_footer();
