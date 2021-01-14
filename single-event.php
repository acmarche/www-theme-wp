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
///$event = $hadesRepository->getDetailEvent($codeCgt);
$event = null;
foreach ($events as $element) {
    if ($codeCgt == $element['id']) {
        $event = $element;
        break;
    }
}

$image  = null;
$images = $event['images'];
if (count($images) > 0) {
    $image = $images[0];
}

Twig::rendPage(
    'agenda/show.html.twig',
    [
        'event'     => $event,
        'title'     => $event['nom'],
        'image'     => $image,
        'tags'      => [],
        'images'    => $images,
        'latitude'  => $event['latitude'] ?? null,
        'longitude' => $event['longitude'] ?? null,
    ]
);
get_footer();
