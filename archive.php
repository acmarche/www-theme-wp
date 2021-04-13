<?php


namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Elasticsearch\Searcher;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use Exception;

get_header();

global $wp_query;
$tag = $wp_query->get('tag', null);
if ($tag) {
    $tag      = preg_replace("#-#", " ", $tag);
    $searcher = new Searcher();
    $resultat = [];
    try {
        $searching = $searcher->search($tag);
        $results   = $searching->getResults();
        $count     = $searching->count();
        foreach ($results as $result) {
            $hit        = $result->getHit();
            $resultat[] = $hit['_source'];
        }
        Twig::rendPage(
            'search/index_no_react.html.twig',
            [
                'keyword' => $tag,
                'hits'    => $resultat,
                'count'   => $count,
            ]
        );
    } catch (Exception $e) {
        Mailer::sendError("wp error search tag", $e->getMessage());

    }
    get_footer();

    return;
}

Twig::rendPage(
    'errors/404.html.twig',
    [
        'title'     => 'Archive non trouvée',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);

$url = Router::getCurrentUrl();
Mailer::sendError("archive page: ", $url.' \n ');
get_footer();
