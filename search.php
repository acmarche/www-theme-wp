<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Twig;
use AcMarche\Elasticsearch\Searcher;
use AcMarche\Theme\Inc\SettingsPage;
use Elastica\Exception\InvalidException;

get_header();
global $s;

$react = SettingsPage::isReactActivate();

$searcher = new Searcher();
$keyword  = get_search_query();

try {
    $results = $searcher->search($keyword);
} catch (InvalidException $e) {
    Mailer::sendError("wp error search", $e->getMessage());
    $results = [];
}

/*
foreach ($results->getResults() as $result) {
    $hit = $result->getHit();
    dump($result->getDocument());
}*/
if ($react) {
    wp_enqueue_script(
        'react-app',
        get_template_directory_uri().'/assets/js/build/search.js',
        array('wp-element'),
        time(),
        true
    );//For production use wp_get_theme()->get('Version')
    Twig::rendPage(
        'search/index_react.html.twig',
        [
            'keyword' => $keyword,
            'hits'    => $results->getResults(),
            'count'   => $results->count(),
        ]
    );
} else {
    Twig::rendPage(
        'search/index.html.twig',
        [
            'keyword' => $keyword,
            'hits'    => $results->getResults(),
            'count'   => $results->count(),
        ]
    );
}
get_footer();
