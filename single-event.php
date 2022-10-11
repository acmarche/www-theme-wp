<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Pivot\DependencyInjection\PivotContainer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

get_header();
global $wp_query;
$twig            = Twig::LoadTwig();
$codeCgt         = $wp_query->get(RouterMarche::PARAM_EVENT);
$pivotRepository = PivotContainer::getPivotRepository();

get_header();
$event = null;
if ( ! str_starts_with($codeCgt, "EVT")) {
    $event = $pivotRepository->getEventByIdHades($codeCgt);
}


if ( ! $event) {
    try {
        $event = $pivotRepository->getEvent($codeCgt);
    } catch (Exception $e) {
        echo $twig->render(
            'errors/404.html.twig',
            [
                'title'     => 'Evènement non trouvé',
                'tags'      => [],
                'color'     => Theme::getColorBlog(Theme::TOURISME),
                'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                'relations' => [],
            ]
        );

        get_footer();

        return;
    }
}

if ( ! $event) {
    try {
        echo $twig->render(
            'errors/404.html.twig',
            [
                'title'     => 'Evènement non trouvé',
                'tags'      => [],
                'color'     => Theme::getColorBlog(Theme::TOURISME),
                'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                'relations' => [],
            ]
        );
    } catch (LoaderError|SyntaxError|RuntimeError $e) {
        Mailer::sendError("error show event", $e->getMessage());
    }
    get_footer();

    return;
}

$image  = null;
$images = $event->images;
if (count($images) > 0) {
    $image = $images[0];
}
$tags              = [];
$urlCategoryAgenda = get_category_link(WpRepository::getCategoryAgenda());
foreach ($event->categories as $category) {
    $tags[] = [
        'name' => $category->labelByLanguage('fr'),
        'url'  => $urlCategoryAgenda.'?filtre='.$category->id,
    ];
}

$offres    = $pivotRepository->getSameEvents($event);
$relations = [];

RouterMarche::setRouteEvents($offres);

foreach ($offres as $item) {
    if ($event->codeCgt == $item->codeCgt) {
        continue;
    }
    $relations[] = [
        'title'      => $item->nom,
        'url'        => $item->url,
        'image'      => $item->firstImage(),
        'categories' => $item->categories,
    ];
}

try {
    echo $twig->render(
        'agenda/show.html.twig',
        [
            'event'       => $event,
            'title'       => $event->nom,
            'image'       => $image,
            'tags'        => $tags,
            'images'      => $images,
            'latitude'    => $event->getAdresse()->latitude ?? null,
            'longitude'   => $event->getAdresse()->longitude ?? null,
            'color'       => Theme::getColorBlog(Theme::TOURISME),
            'blogName'    => Theme::getTitleBlog(Theme::TOURISME),
            'relations'   => $relations,
            'readspeaker' => true,
        ]
    );
} catch (LoaderError|SyntaxError|RuntimeError $e) {
    echo $twig->render(
        'errors/500.html.twig',
        [
            'title'     => 'Erreur de chargement de la page',
            'message'   => $e->getMessage(),
            'tags'      => [],
            'color'     => Theme::getColorBlog(Theme::TOURISME),
            'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );
}

get_footer();
