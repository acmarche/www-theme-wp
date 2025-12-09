<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Pivot\Repository\PivotRepository;
use AcMarche\Theme\Lib\Twig;

get_header();

$pivotRepository = new PivotRepository();
try {
    $events = $pivotRepository->loadEvents();
} catch (\Exception|\Throwable  $e) {
    Twig::renderErrorPage($e);

    get_footer();

    return;
}

$defaultImage = 'https://www.visitmarche.be/wp-content/uploads/2021/02/bg_events.png';

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
        'color' => Theme::getColorBlog(Theme::TOURISME),
        'defaultImage' => $defaultImage,
    ]
);

get_footer();
