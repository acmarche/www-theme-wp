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
$twig            = Twig::LoadTwig();

$news   = WpRepository::getAllNews(6);
$events = $hadesRepository->getEvents();

$content = $twig->render(
    'home/show.html.twig',
    [
        'actus'  => $news,
        'events' => $events,
    ]
);
echo $content;
get_footer();