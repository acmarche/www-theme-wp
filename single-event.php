<?php

namespace AcMarche\Theme;

use AcMarche\Common\Cache;
use AcMarche\Pivot\DependencyInjection\Kernel;
use AcMarche\Pivot\Entities\Event\Event;
use AcMarche\Pivot\Parser\PivotParser;
use AcMarche\Pivot\Repository\PivotRepository;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Exception;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\ErrorHandler\Debug;

get_header();

global $wp_query;
$codeCgt = $wp_query->get(RouterMarche::PARAM_EVENT);
if (WP_DEBUG) {
    Debug::enable();
}
$env    = WP_DEBUG ? 'dev' : 'prod';
$kernel = new Kernel($env, WP_DEBUG);
$kernel->boot();
$container = $kernel->getContainer();

$loader = $container->get('dotenv');
$loader->loadEnv('.env');
/**
 * @var PivotRepository $pivotRepository
 */
$pivotRepository = $container->get('pivotRepository');
/**
 * @var Event $event
 */
try {
    $event = $pivotRepository->getEvent($codeCgt);
} catch (Exception $e) {
    dd($e);
}

get_header();

$twig = Twig::LoadTwig();

if ( ! $event) {
    return $twig->render(
        'errors/404.html.twig',
        [
            'title'     => 'Evènement non trouvé',
            'tags'      => [],
            'color'     => Theme::getColorBlog(Theme::TOURISME),
            'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
            'relations' => [],
        ]
    );
}

$image  = null;
$images = $event->images;
if (count($images) > 0) {
    $image = $images[0];
}
$tags = [];
foreach ($event->categories as $category) {
    $tags[] = ['name' => $category, 'url' => 'cc'];//RouterMarche::getUrlEventCategory($category)];
}

$currentCategory = WpRepository::getCategoryAgenda();
//$offres          = $hadesRepository->getOffresSameCategories($event);
$offres    = [];
$relations = [];
foreach ($offres as $item) {
    if ($event->codeCgt == $item->codeCgt) {
        continue;
    }
    $url         = RouterMarche::getUrlOffre($item, $currentCategory->cat_ID);
    $relations[] = [
        'title'      => $item->getTitre('fr'),
        'url'        => $url,
        'image'      => $item->firstImage(),
        'categories' => $item->categories,
    ];
}
dump($event);
echo $twig->render(
    'agenda/show.html.twig',
    [
        'event'       => $event,
        'title'       => $event->nom,
        'image'       => $image,
        'tags'        => $tags,
        'images'      => $images,
        'latitude'    => $event->getAdresse()->latitude ?? null,
        'longitude'   => $event->getAdresse()->longitude ?? null,
        'color'       => Theme::getColorBlog(Theme::TOURISME),
        'blogName'    => Theme::getTitleBlog(Theme::TOURISME),
        'relations'   => $relations,
        'readspeaker' => true,
    ]
);

get_footer();
