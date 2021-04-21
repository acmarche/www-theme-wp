<?php

namespace AcMarche\Theme;

use AcMarche\Pivot\Repository\HadesRepository;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

global $wp_query;
$codeCgt = $wp_query->get(RouterMarche::PARAM_EVENT);

$hadesRepository = new HadesRepository();
$event           = $hadesRepository->getOffre($codeCgt);

if ( ! $event) {
    Twig::rendPage(
        'errors/404.html.twig',
        [
            'title'     => 'Evènement non trouvé',
            'tags'      => [],
            'color'     => Theme::getColorBlog(Theme::TOURISME),
            'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );
    get_footer();

    return;
}

$image  = null;
$images = $event->medias;
if (count($images) > 0) {
    $image = $images[0]->url;
}
$tags = [];
foreach ($event->categories as $category) {
    $tags[] = ['name' => $category->getLib('fr'), 'url' => RouterMarche::getUrlEventCategory($category)];
}

$currentCategory = RouterMarche::getCategoryAgenda();
$offres          = $hadesRepository->getOffresSameCategories($event);
$relations = [];
foreach ($offres as $item) {
    if ($event->id == $item->id) {
        continue;
    }
    $url               = RouterMarche::getUrlOffre($item, $currentCategory->cat_ID);
    $relations[] = [
        'title'      => $item->getTitre('fr'),
        'url'        => $url,
        'image'      => $item->firstImage(),
        'categories' => $item->categories,
    ];
}

Twig::rendPage(
    'agenda/show.html.twig',
    [
        'event'       => $event,
        'title'       => $event->getTitre('fr'),
        'image'       => $image,
        'tags'        => $tags,
        'images'      => $images,
        'latitude'    => $event->geocode->latitude() ?? null,
        'longitude'   => $event->geocode->longitude() ?? null,
        'color'       => Theme::getColorBlog(Theme::TOURISME),
        'blogName'    => Theme::getTitleBlog(Theme::TOURISME),
        'relations'   => $relations,
        'readspeaker' => true,
    ]
);
get_footer();
