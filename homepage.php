<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use SortLink;
use Symfony\Component\HttpFoundation\Request;

/**
 * Template Name: Home-Page-Principal
 */
get_header();

$events = [];
$news = WpRepository::getAllNews(6);
try {
   // $events = WpRepository::getEvents();
} catch (\Exception $exception) {
    Mailer::sendError('error marche.be', "page ".$exception->getMessage());
}

$pageAlert = WpRepository::getPageAlert();
$contentAlert = null;
$dateAlert = null;

if ($pageAlert) {
    $request = Request::createFromGlobals();
    $dateAlert = preg_replace("#(\D)#", "", $pageAlert->post_modified);
    $close = (bool)$request->cookies->get('closeAlert'.$dateAlert);
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
    '/wp-content/themes/marchebe/assets/images/home/fond3.jpg',
    '/wp-content/themes/marchebe/assets/images/home/fond42.jpg',
    '/wp-content/themes/marchebe/assets/images/home/fond5.jpg',
    '/wp-content/themes/marchebe/assets/images/home/marche-bg.jpg',
];

$imageBg = $imagesBg[4];
$date = new \DateTime();
$heure = $date->format('H');
if ($heure > 16 || $heure <= 7) {
    $imageBg = $imagesBg[0];
}

$sortLink = SortLink::linkSortNews();

Twig::rendPage(
    'homepage/index.html.twig',
    [
        'actus' => $news,
        'events' => $events,
        'pageAlert' => $pageAlert,
        'contentAlert' => $contentAlert,
        'imageBg' => $imageBg,
        'dateAlert' => $dateAlert,
        'sortLink' => $sortLink,
    ]
);

get_footer();
