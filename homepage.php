<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use AcMarche\Pivot\Repository\HadesRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$hadesRepository = new HadesRepository();

$news = WpRepository::getAllNews(6);
try {
    $events = $hadesRepository->getEvents();
    RouterMarche::setRouteEvents($events);
} catch (\Exception $exception) {
    $events = [];
    Mailer::sendError("Erreur de chargement de l'agenda", $exception->getMessage());
}

$pageAlert    = WpRepository::getPageAlert();
$contentAlert = null;

if ($pageAlert) {
    $request = Request::createFromGlobals();
    $close   = (bool)$request->cookies->get('closeAlert');
    if ($close) {
        $pageAlert = null;
    } else {
        $contentAlert = get_the_content(null, null, $pageAlert);
        $contentAlert = apply_filters('the_content', $contentAlert);
        $contentAlert = str_replace(']]>', ']]&gt;', $contentAlert);
    }
}

$imagesBg = [
    '/wp-content/themes/marchebe/assets/tartine/rsc/img/bg_home.jpg',
    '/wp-content/themes/marchebe/assets/images/home/fond1.jpg',
    '/wp-content/themes/marchebe/assets/images/home/fond2.jpg',
];
$imageBg  = $imagesBg[array_rand($imagesBg, 1)];
Twig::rendPage(
    'homepage/index.html.twig',
    [
        'actus'        => $news,
        'events'       => $events,
        'pageAlert'    => $pageAlert,
        'contentAlert' => $contentAlert,
        'imageBg'        => $imageBg,
    ]
);

get_footer();
