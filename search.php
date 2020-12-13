<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Twig;
use AcMarche\Elasticsearch\Searcher;
use Elastica\Exception\InvalidException;

get_header();
global $s;
$twig     = Twig::LoadTwig();
$searcher = new Searcher();

$keyword = get_search_query();

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
