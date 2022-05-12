<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

get_header();
$filtreParam = $_GET['filtre'] ?? null;
$events      = WpRepository::getEvents();
if ($filtreParam) {
    $data = [];
    foreach ($events as $event) {
        if (in_array($filtreParam, array_column($event->categories, 'id'))) {
            $data[] = $event;
        }
    }
    $events = $data;
}

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
        'color'  => Theme::getColorBlog(Theme::TOURISME),
    ]
);

get_footer();
