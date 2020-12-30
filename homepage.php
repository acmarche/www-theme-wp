<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;
use AcMarche\Pivot\Repository\HadesRepository;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$hadesRepository = new HadesRepository();

$news   = WpRepository::getAllNews(6);
$events = $hadesRepository->getEvents();

Twig::rendPage(
    'home/show.html.twig',
    [
        'actus'  => $news,
        'events' => $events,
    ]
);

get_footer();
