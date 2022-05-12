<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Bottin\Elasticsearch\Searcher;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Inc\Theme;
use Exception;

get_header();

global $wp_query;

$queries      = $wp_query->query;
$queryString  = join(' ', $queries);
$queryString  = preg_replace("#-#", " ", $queryString);
$queryString  = preg_replace("#/#", " ", $queryString);
$queryString  = strip_tags($queryString);
$resultSearch = '';
if ($queryString != '') {
    $searcher = new Searcher();
    $resultat = [];
    try {
        $searching = $searcher->search($queryString);
        $results   = $searching->getResults();
        $count     = $searching->count();
        foreach ($results as $result) {
            $hit        = $result->getHit();
            $resultat[] = $hit['_source'];
        }
        $twig         = Twig::LoadTwig();
        $resultSearch = $twig->render(
            'search/_results.html.twig',
            [
                'keyword' => $queryString,
                'hits'    => $resultat,
                'count'   => $count,
            ]
        );
    } catch (Exception $e) {
        Mailer::sendError("wp error search query 404", $e->getMessage());
    }
    $url     = Router::getCurrentUrl();
    $referer = Router::getReferer();
 //   Mailer::sendError("404 page: ", $url.' \n query search: '.$queryString. ' referer: '.$referer);
}
Twig::rendPage(
    'errors/404.html.twig',
    [
        'title'     => 'Page non trouvée',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
        'result'    => $resultSearch,
    ]
);
//$url = Router::getCurrentUrl();
//Mailer::sendError("404 page: ", $url.' \n ');
get_footer();
