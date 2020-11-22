<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;
use AcMarche\Pivot\HadesWpRepository;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$twig            = Twig::LoadTwig();
$news            = WpRepository::getAllNews(6);
$hadesRepository = new HadesWpRepository();
$events          = $hadesRepository->getEvents(10);
dump('aaaaaaaaa'.count($events));
$content         = $twig->render(
    'home/home_content.html.twig',
    [
        'news'   => $news,
        'events' => $events,
    ]
);
echo $content;
get_footer();
