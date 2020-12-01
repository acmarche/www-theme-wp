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

$path = get_blog_details(get_current_blog_id())->path;

array_map(
    function ($child) use ($path) {
        $child->permalink = $path.'bwp/categorie/'.$child->slug;
    },
    $children
);

array_map(
    function ($fiche) use ($bottinRepository,$path) {
        $fiche->post_title = $fiche->societe;
        $fiche->excerpt    = Bottin::getExcerpt($fiche);
        $fiche->permalink  = $path.'bottin/fiche/'.$fiche->slug;
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
