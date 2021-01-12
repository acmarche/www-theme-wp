<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRepository;
use AcMarche\Theme\Inc\Router;

get_header();

global $wp_query;
$codeCgt = $wp_query->get(Router::PARAM_EVENT);

$hadesRepository = new HadesRepository();
$events          = $hadesRepository->getEvents();
///$event = $pivotRepository->getDetailOffer($codeCgt);
$event = null;
foreach ($events as $element) {
    if ($codeCgt == $element['id']) {
        $event = $element;
        break;
    }
}

$logo   = null;
$images = $event['images'];
if (count($images) > 0) {
    $logo = $images[0];
}

$url = get_site_url();
Twig::rendPage(
    'agenda/show.html.twig',
    [
        'event'     => $event,
        'title'     => $event['nom'],
        'url'       => $url,
        'logo'      => $logo,
        'tags'      => [],
        'images'    => $images,
        'latitude'  => $event['latitude'],
        'longitude' => $event['longitude'],
    ]
);
get_footer();
