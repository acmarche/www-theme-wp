<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\Repository\WpRepository;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Router;

get_header();
global $wp_query;

$twig             = Twig::LoadTwig();
$bottinRepository = new BottinRepository();

$slugFiche = $wp_query->get(Router::PARAM_BOTTIN_FICHE, null);

if ($slugFiche) {
    $fiche = $bottinRepository->getFicheBySlug($slugFiche);
} elseif ($post = $wp_query->post) {
    WpRepository::set_table_meta();
    $idfiche = get_metadata(WpRepository::DATA_TYPE, $post->ID, 'id', true);
    $fiche   = $bottinRepository->getFicheById($idfiche);
}

if ( ! $fiche) {
    echo $twig->render('fiche/not_found.html.twig');
    get_footer();

    return;
}

$categories    = $bottinRepository->getCategoriesOfFiche($fiche->id);
$images        = $bottinRepository->getImagesFiche($fiche->id);
$documents     = $bottinRepository->getDocuments($fiche->id);
$isCentreVille = $bottinRepository->isCentreVille($fiche->id);
$logo          = $bottinRepository->getLogo($fiche->id);
if ($logo) {
    unset($images[0]);
}
array_map(
    function ($category) {
        $category->url = Router::getUrlCategoryBottin($category);
    },
    $categories
);

$content = $twig->render(
    'fiche/show.html.twig',
    [
        'fiche'         => $fiche,
        'nom'           => $fiche->societe,
        'tags'          => $categories,
        'isCentreVille' => $isCentreVille,
        'logo'          => $logo,
        'images'        => $images,
        'documents'     => $documents,
        'url_base'      => Bottin::getUrlBottin().$fiche->id.DIRECTORY_SEPARATOR,
        'url_doc'       => Bottin::getUrlDocument().DIRECTORY_SEPARATOR,
        'latitude'      => $fiche->latitude,
        'longitude'     => $fiche->longitude,
    ]
);
echo $content;
get_footer();
