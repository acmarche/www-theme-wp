<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\PivotRemoteRepository;

get_header();

global $wp_query;
//var_dump($wp_query);
$vars    = $wp_query->query_vars;
$codeCgt = $vars['codecgt'];
$codeCgt = 'EVT-01-0AVZ-0UN1';
$twig    = Twig::LoadTwig();

$pivotRepository = new PivotRemoteRepository();

///$event = $pivotRepository->getDetailOffer($codeCgt);
$event  = null;
$events = $pivotRepository->getAllEvents();
foreach ($events as $element) {
    if ($codeCgt == $element->codeCgt) {
        $event = $element;
        break;
    }
}

$logo   = null;
$images = $event->images;
if (count($event->images) > 0) {
    $logo = $images[0];
}

$url     = get_site_url();
$content = $twig->render(
    'agenda/show.html.twig',
    [
        'event'     => $event,
        'nom'       => $event->nom,
        'url'       => $url,
        'logo'      => $logo,
        'tags'      => [],
        'images'    => $images,
        'latitude'  => $event->latitude,
        'longitude' => $event->longitude,
    ]
);
echo $content;
get_footer();
