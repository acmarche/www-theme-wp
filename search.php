<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\DependencyInjection\BottinContainer;
use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use Exception;

get_header();

$searcher = BottinContainer::getSearchMeili(WP_DEBUG);
$keyword = get_search_query();
try {
    $searching = $searcher->doSearch($keyword);
    $hits = $searching->getHits();
    $count = $searching->count();
} catch (Exception $e) {
    Mailer::sendError("wp error search", $e->getMessage());

    Twig::rendPage(
        'errors/500.html.twig',
        [
            'message' => $e->getMessage(),
            'title' => 'Erreur lors de la recherche',
            'tags' => [],
            'color' => Theme::getColorBlog(1),
            'blogName' => Theme::getTitleBlog(1),
            'relations' => [],
        ]
    );
    get_footer();

    return;
}

wp_enqueue_script(
    'react-app',
    get_template_directory_uri().'/assets/js/build/search.js',
    array('wp-element'),
    wp_get_theme()->get('Version'),
    true
);

Twig::rendPage(
    'search/index.html.twig',
    [
        'keyword' => $keyword,
        'hits' => $hits,
        'count' => $count,
    ]
);

get_footer();
