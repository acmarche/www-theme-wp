<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;
use AcMarche\Pivot\Repository\HadesWpRepository;
use AcMarche\Pivot\Repository\PivotRemoteRepository;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$hadesRepository = new HadesWpRepository();
$pivotRepository = new PivotRemoteRepository();
$twig            = Twig::LoadTwig();

$news   = WpRepository::getAllNews(6);
$events = $hadesRepository->getEvents(10);
$eventsPivot = $pivotRepository->getAllEvents();

$content = $twig->render(
    'home/home_content.html.twig',
    [
        'news'   => $news,
        'events' => $events,
        'eventsPivot' => $eventsPivot,
    ]
);
echo $content;
get_footer();
