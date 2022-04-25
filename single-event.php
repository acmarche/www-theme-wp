<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Pivot\DependencyInjection\PivotContainer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Exception;

get_header();

global $wp_query;
$twig            = Twig::LoadTwig();
$codeCgt         = $wp_query->get(RouterMarche::PARAM_EVENT);
$pivotRepository = PivotContainer::getRepository();

get_header();

if ( ! str_starts_with($codeCgt, "EVT")) {
    $event = $pivotRepository->getEventByIdHades($codeCgt);
}

if ( ! $event) {
    try {
        $event = $pivotRepository->getEvent($codeCgt);
    } catch (Exception $e) {
        echo $twig->render(
            'errors/500.html.twig',
            [
                'message'   => $e->getMessage(),
                'title'     => 'Erreur lors du chargement de l\'évènement',
                'tags'      => [],
                'color'     => Theme::getColorBlog(Theme::TOURISME),
                'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                'relations' => [],
            ]
        );
        Mailer::sendError("Error loading event", $e->getMessage()." ".$codeCgt);

        return;
    }
}

if ( ! $event) {
    return $twig->render(
        'errors/404.html.twig',
        [
            'title'     => 'Evènement non trouvé',
            'tags'      => [],
            'color'     => Theme::getColorBlog(Theme::TOURISME),
            'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );
}

$image  = null;
$images = $event->images;
if (count($images) > 0) {
    $image = $images[0];
}
$tags = [];
foreach ($event->categories as $category) {
    $urlCat = RouterMarche::getUrlEventCategory($category);
    $tags[] = [
        'name' => $category->labelByLanguage('fr'),
        'url'  => $category->id,
    ];
}
$currentCategory = WpRepository::getCategoryAgenda();
$offres          = $pivotRepository->getSameEvents($event);
$relations       = [];

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

get_footer();
