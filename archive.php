<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\DependencyInjection\BottinContainer;
use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use Exception;

get_header();

global $wp_query;
$tag = $wp_query->get('tag', null);
if ($tag) {
    $tag = preg_replace("#-#", " ", $tag);
    $searcher = BottinContainer::getSearchMeili(WP_DEBUG);
    try {
        $searching = $searcher->doSearch($tag);
        $hits = $searching->getHits();
        $count = $searching->count();
        Twig::rendPage(
            'search/index_no_react.html.twig',
            [
                'keyword' => $tag,
                'hits' => $hits,
                'count' => $count,
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
        'title' => 'Archive non trouvée',
        'tags' => [],
        'color' => Theme::getColorBlog(1),
        'blogName' => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);

$url = Router::getCurrentUrl();
Mailer::sendError("archive page: ", $url.' \n ');
get_footer();
