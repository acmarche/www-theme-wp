<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Common\MarcheConst;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Router;

get_header();

global $wp_query;

$twig             = Twig::LoadTwig();
$bottinRepository = new BottinRepository();

$slug     = $wp_query->get(Router::PARAM_BOTTIN_CATEGORY, null);
$category = null;
if ($slug) {
    $category = $bottinRepository->getCategoryBySlug($slug);
}

if ( ! $category) {
    $content = $twig->render('errors/404.html.twig');
    echo $content;
    get_footer();
    return;
}

$description = $category->description;
$title       = $category->name;

$blodId = get_current_blog_id();
if ($blodId === 1) {
    $siteSlug = 'Citoyen';
} else {
    $siteSlug = get_blog_details($blodId)->path;
}
$color = MarcheConst::COLORS[$blodId];

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
        'category_id' => $category->id,
        'site_slug'   => $siteSlug,
        'color'       => $color,
    ]
);
echo $content;
get_footer();
