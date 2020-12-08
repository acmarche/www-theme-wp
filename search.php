<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Elasticsearch\Searcher;

get_header();
global $s;
$twig     = Twig::LoadTwig();
$searcher = new Searcher();

$keyword = get_search_query();

$results = $searcher->search($keyword);

/*
foreach ($results->getResults() as $result) {
    $hit = $result->getHit();
    dump($result->getDocument());
}*/

$content = $twig->render(
    'search/index.html.twig',
    [
        'keyword' => $keyword,
        'hits'    => $results->getResults(),
        'count'   => $results->count(),
    ]
);
echo $content;
get_footer();
