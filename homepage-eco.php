<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use AcMarche\Pivot\Repository\HadesRepository;

/**
 * Template Name: Home-Page-Eco
 */
get_header();

$hadesRepository = new HadesRepository();

$news = WpRepository::getAllNews(6);
try {
    $events = $hadesRepository->getEvents();
    RouterMarche::setRouteEvents($events);
} catch (\Exception $exception) {
    $events = [];
    Mailer::sendError("Erreur de chargement de l'agenda", $exception->getMessage());
}

Twig::rendPage(
    'sport/index.html.twig',
    [
        'actus'        => $news,
        'events'       => $events,
    ]
);

get_footer();
