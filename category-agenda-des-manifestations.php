<?php

namespace AcMarche\Theme;

use AcMarche\Pivot\DependencyInjection\Kernel;
use AcMarche\Pivot\Repository\PivotRepository;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Lib\Twig;
use Psr\Cache\InvalidArgumentException;

get_header();

$kernel = new Kernel('dev', true);
$kernel->boot();
$container = $kernel->getContainer();

$loader = $container->get('dotenv');
$loader->loadEnv('.env');

/**
 * @var PivotRepository $pivot
 */
$pivot = $container->get('pivotRepository');
$codeCgt = "EVT-A1-0016-2D6U";
$data = $pivot->offreByCgt($codeCgt, date('Y-m-d H:m:s'));
dd($data->getOffre()->codeCgt);

$events          = [];
try {
    $events = $pivotRepository->getEvents();
    RouterMarche::setRouteEvents($events);
} catch (InvalidArgumentException $e) {
    Twig::rendPage(
        'errors/500.html.twig',
        [
            'message' => 'Impossible de charger les évènements: '.$e->getMessage(),
        ]
    );
    get_footer();

    return;
}

wp_enqueue_script(
    'react-app',
    get_template_directory_uri().'/assets/js/build/agenda.js',
    array('wp-element'),
    wp_get_theme()->get('Version'),
    true
);

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
    ]
);

get_footer();
