<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Pivot\Entity\Event;
use AcMarche\Theme\Lib\Pivot\Repository\PivotRepository;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

global $wp_query;
$twig = Twig::LoadTwig();
$codeCgt = $wp_query->get(RouterMarche::PARAM_EVENT);

get_header();

if (!str_contains($codeCgt, "EVT")) {
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement non trouvé (EVT)',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
            'hits' => [],
        ]
    );

    get_footer();

    return;
}

$pivotRepository = new PivotRepository();
try {
    $event = $pivotRepository->loadOneEvent($codeCgt, parse: true, purgeCache: WP_DEBUG);
} catch (\JsonException $e) {
    Twig::renderErrorPage($e);
    get_footer();

    return;
}

if ($event == null) {
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement non trouvé 404',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );

    get_footer();

    return;
}
if (count($event->dates) === 0) {
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement expiré',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
            'hits' => [],
        ]
    );

    get_footer();

    return;
}
$image = null;
$images = $event->images;
if (count($images) > 0) {
    $image = $images[0];
}
$tags = [];
$urlCategoryAgenda = get_category_link(WpRepository::getCategoryAgenda());

foreach ($event->tags as $category) {
    $tags[] = [
        'name' => $category->labelByLanguage('fr'),
        'url' => $urlCategoryAgenda.'?filtre='.$category->urn,
    ];
}
try {
    $events = $pivotRepository->loadEvents(skip: true);
} catch (\Exception|\Throwable  $e) {
    $events = [];
}

$recommandations = array_slice($events, 0, 3);
array_map(fn(Event $event) => $event->name = $event->nom, $recommandations);

try {
    echo $twig->render(
        'agenda/show.html.twig',
        [
            'event' => $event,
            'title' => $event->nom,
            'image' => $image,
            'tags' => $tags,
            'images' => $images,
            'latitude' => $event->latitude ?? null,
            'longitude' => $event->longitude ?? null,
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => $recommandations,
            'readspeaker' => true,
        ]
    );
} catch (LoaderError|SyntaxError|RuntimeError $e) {
    echo $twig->render(
        'errors/500.html.twig',
        [
            'title' => 'Erreur de chargement de la page',
            'message' => $e->getMessage(),
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );
}

get_footer();
