<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Common\WpRepository;
use AcMarche\Pivot\Repository\HadesRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$hadesRepository = new HadesRepository();

$news      = WpRepository::getAllNews(6);
$events    = $hadesRepository->getEvents();
$pageAlert = WpRepository::getPageAlert();
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

Twig::rendPage(
    'homepage/index.html.twig',
    [
        'actus'     => $news,
        'events'    => $events,
        'pageAlert' => $pageAlert,
        'contentAlert' => $contentAlert,
    ]
);

get_footer();
