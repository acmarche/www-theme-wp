<?php

namespace AcMarche\Theme;

use AcMarche\Pivot\DependencyInjection\PivotContainer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

try {
    $pivotRepository = PivotContainer::getRepository();
    $events          = $pivotRepository->getEvents(true);

    RouterMarche::setRouteEvents($events);
} catch (\Exception $e) {
    Twig::rendPage(
        'errors/500.html.twig',
        [
            'title' => 'Erreur',
            'message' => 'Impossible de charger les évènements: '.$e->getMessage(),
        ]
    );
    get_footer();

    return;
}

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
        'color'     => Theme::getColorBlog(Theme::TOURISME),
    ]
);

get_footer();
