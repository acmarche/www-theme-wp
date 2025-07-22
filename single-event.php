<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\PostUtils;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Psr\Cache\InvalidArgumentException;
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
            'title' => 'Évènement non trouvé',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );

    get_footer();

    return;
}

$wpRepository = new WpRepository();
try {
    $offre = $wpRepository->getOffreByCgtAndParse($codeCgt);
} catch (\Exception|InvalidArgumentException $exception) {
    Mailer::sendError("error show event", $exception->getMessage());
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement non trouvé',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );

    get_footer();

    return;
}
if ($offre == null) {
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement non trouvé',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );

    get_footer();

    return;
}
if (count($offre->datesEvent) === 0) {
    echo $twig->render(
        'errors/404.html.twig',
        [
            'title' => 'Évènement expiré',
            'tags' => [],
            'color' => Theme::getColorBlog(Theme::TOURISME),
            'blogName' => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );

    get_footer();

    return;
}
$image = null;
$images = $offre->images;
if (count($images) > 0) {
    $image = $images[0];
}
$tags = [];
$urlCategoryAgenda = get_category_link(WpRepository::getCategoryAgenda());

$postUtils = new PostUtils();
$postUtils->tagsOffre($offre, 'fr', $urlCategoryAgenda);

foreach ($offre->tags as $category) {
    $tags[] = [
        'name' => $category->labelByLanguage('fr'),
        'url' => $urlCategoryAgenda.'?filtre='.$category->urn,
    ];
}

$recommandations = $wpRepository->recommandationsByOffre($offre, WpRepository::getCategoryAgenda(), 'fr');
$relations = [];
/*
RouterMarche::setRouteEvents($recommandations);

foreach ($recommandations as $item) {
    if ($offre->codeCgt == $item->codeCgt) {
        continue;
    }
    $relations[] = [
        'title' => $item->nom,
        'url' => $item->url,
        'image' => $item->firstImage(),
        'categories' => $item->categories,
    ];
}*/

try {
    echo $twig->render(
        'agenda/show.html.twig',
        [
            'event' => $offre,
            'title' => $offre->nom,
            'image' => $image,
            'tags' => $tags,
            'images' => $images,
            'latitude' => $offre->getAdresse()->latitude ?? null,
            'longitude' => $offre->getAdresse()->longitude ?? null,
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
