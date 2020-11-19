<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\Repository\WpRepository;
use AcMarche\Common\Twig;

get_header();
global $post;

$twig = Twig::LoadTwig();

$categories  = get_the_category($post->ID);
$post_ID     = $post->ID;
$titre       = $post->post_title;
$description = strip_tags($post->post_excerpt);
$url         = get_site_url()."/?p=$post_ID";
//get_the_posts_pagination();
$single           = true;
$key              = WpRepository::DATA_TYPE;
$bottinRepository = new BottinRepository();

WpRepository::set_table_meta();

$idfiche = get_metadata($key, $post->ID, 'id', $single);

$fiche = $bottinRepository->getFiche($idfiche);

if ( ! $fiche) {
    echo $twig->render('fiche/not_found.html.twig');
    get_footer();

    return;
}

$images        = $bottinRepository->getImagesFiche($idfiche);
$documents     = $bottinRepository->getDocuments($idfiche);
$isCentreVille = $bottinRepository->isCentreVille($idfiche);

$categories = array_map(
    function ($idcategory) {
        $link            = get_category_link($idcategory);
        $data            = get_category($idcategory);
        $data->permalink = $link;

        return $data;
    },
    wp_get_post_categories($post->ID)
);
$logo       = $bottinRepository->getLogo($idfiche);
if ($logo) {
    unset($images[0]);
}

$content = $twig->render(
    'fiche/show.html.twig',
    [
        'post'       => $post,
        'fiche'      => $fiche,
        'url'        => $url,
        'categories' => $categories,
    ]
);
echo $content;
get_footer();
