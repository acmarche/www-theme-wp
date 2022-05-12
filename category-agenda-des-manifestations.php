<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

get_header();

$events = WpRepository::getEvents();

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
        'color'  => Theme::getColorBlog(Theme::TOURISME),
    ]
);

get_footer();
