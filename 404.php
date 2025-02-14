<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\DependencyInjection\BottinContainer;
use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use Exception;

get_header();

global $wp_query;

$queries = $wp_query->query;
$queryString = join(' ', $queries);
$queryString = preg_replace("#-#", " ", $queryString);
$queryString = preg_replace("#/#", " ", $queryString);
$queryString = strip_tags($queryString);

if ($queryString != '') {
    $searcher = BottinContainer::getSearchMeili(WP_DEBUG);
    try {
        $searching = $searcher->doSearch($queryString);
        $hits = $searching->getHits();
        $count = $searching->count();
        $twig = Twig::LoadTwig();
        $twig->render(
            'search/_results.html.twig',
            [
                'keyword' => $queryString,
                'hits' => $hits,
                'count' => $count,
            ],
        );
    } catch (Exception $e) {
        Mailer::sendError("wp error search query 404", $e->getMessage());
    }
}
Twig::rendPage(
    'errors/404.html.twig',
    [
        'title' => 'Page non trouvée',
        'tags' => [],
        'color' => Theme::getColorBlog(1),
        'blogName' => Theme::getTitleBlog(1),
        'relations' => [],
        'hits' => [],
    ],
);
//$url = Router::getCurrentUrl();
//Mailer::sendError("404 page: ", $url.' \n ');
get_footer();
