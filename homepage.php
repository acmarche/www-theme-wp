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

$news      = WpRepository::getAllNews(6);
$events    = $hadesRepository->getEvents();
$pageAlert = WpRepository::getPageAlert();

Twig::rendPage(
    'homepage/index.html.twig',
    [
        'actus'  => $news,
        'events' => $events,
        'alert'  => $pageAlert,
    ]
);

get_footer();
