<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Router;

get_header();

global $wp_query;

$twig             = Twig::LoadTwig();
$bottinRepository = new BottinRepository();

$slug = $wp_query->get(Router::PARAM_BOTTIN_CATEGORY, null);
if ($slug) {
    $category = $bottinRepository->getCategoryBySlug($slug);
}

$description = $category->description;
$title       = $category->name;

$fiches   = $bottinRepository->getFichesByCategory($category->id);
$children = $bottinRepository->getCategories($category->id);

array_map(
    function ($child) {
        $child->permalink = Router::getUrlCategoryBottin($child);
    },
    $children
);

array_map(
    function ($fiche) use ($bottinRepository) {
        $fiche->post_title = $fiche->societe;
        $fiche->excerpt    = Bottin::getExcerpt($fiche);
        $fiche->permalink  = Router::getUrlFicheBottin($fiche);
    },
    $fiches
);

$content = $twig->render(
    'category/category.html.twig',
    [
        'title'       => $title,
        'description' => $description,
        'children'    => $children,
        'posts'       => $fiches,
    ]
);
echo $content;
get_footer();
