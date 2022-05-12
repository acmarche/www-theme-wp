<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Bottin\Elasticsearch\Searcher;
use AcMarche\Theme\Inc\Theme;
use \Exception;

get_header();
global $s;

$searcher = new Searcher();
$keyword  = get_search_query();
$resultat = [];
try {
    $searching = $searcher->search($keyword);
    $results   = $searching->getResults();
    $count     = $searching->count();
    foreach ($results as $result) {
        $hit        = $result->getHit();
        $resultat[] = $hit['_source'];
    }
} catch (Exception $e) {
    Mailer::sendError("wp error search", $e->getMessage());

    Twig::rendPage(
        'errors/500.html.twig',
        [
            'message'   => $e->getMessage(),
            'title'     => 'Erreur lors de la recherche',
            'tags'      => [],
            'color'     => Theme::getColorBlog(1),
            'blogName'  => Theme::getTitleBlog(1),
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
        'hits'    => $resultat,
        'count'   => $count,
    ]
);

get_footer();
