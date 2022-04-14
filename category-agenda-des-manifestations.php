<?php

namespace AcMarche\Theme;

use AcMarche\Pivot\DependencyInjection\Kernel;
use AcMarche\Pivot\Repository\PivotRepository;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Lib\Twig;

get_header();
try {
    $env = WP_DEBUG ? 'dev': 'prod';
    $kernel = new Kernel($env, WP_DEBUG);
    $kernel->boot();
    $container = $kernel->getContainer();

    $loader = $container->get('dotenv');
    $loader->loadEnv('.env');
    /**
     * @var PivotRepository $pivotRepository
     */
    $pivotRepository = $container->get('pivotRepository');
    $events = $pivotRepository->getEvents();

    RouterMarche::setRouteEvents($events);
} catch (\Exception $e) {
    Twig::rendPage(
        'errors/500.html.twig',
        [
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
    ]
);

get_footer();
