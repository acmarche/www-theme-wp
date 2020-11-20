<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;
use AcMarche\Hades\HadesWpRepository;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$twig            = Twig::LoadTwig();
$news            = WpRepository::getAllNews(6);
$hadesRepository = new HadesWpRepository();
$events          = $hadesRepository->getEvents(10);
$content         = $twig->render(
    'home/home_content.html.twig',
    [
        'news'   => $news,
        'events' => $events,
    ]
);
echo $content;
get_footer();
