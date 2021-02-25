<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Router;
use AcMarche\Theme\Inc\Theme;

get_header();

global $wp_query;

$bottinRepository = new BottinRepository();

$slug     = $wp_query->get(Router::PARAM_BOTTIN_CATEGORY, null);
$category = null;
if ($slug) {
    $category = $bottinRepository->getCategoryBySlug($slug);
}

$blodId   = get_current_blog_id();
$color    = Theme::getColorBlog($blodId);
$blogName = Theme::getTitleBlog($blodId);
$path     = Theme::getPathBlog($blodId);

if ( ! $category) {
    Twig::rendPage(
        'errors/404.html.twig',
        [
            'title'    => 'Page non trouvée',
            'tags'     => [],
            'color'    => $color,
            'blogName' => $blogName,
        ]
    );
    get_footer();

    return;
}

$description = $category->description;
$title       = $category->name;
$siteSlug    = Theme::getTitleBlog($blodId);
$fiches      = $bottinRepository->getFichesByCategory($category->id);
$children    = $bottinRepository->getCategories($category->id);
$parent      = $bottinRepository->getCategory($category->parent_id);
$urlBack     = $path;
$nameBack    = $blogName;
if ($parent) {
    $nameBack = $parent->name;
    $urlBack  = Router::getUrlCategoryBottin($parent);
}
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

Twig::rendPage(
    'category/index_bottin.html.twig',
    [
        'title'       => $title,
        'description' => $description,
        'children'    => $children,
        'parent'      => $parent,
        'posts'       => $fiches,
        'category_id' => $category->id,
        'site_slug'   => $siteSlug,
        'color'       => $color,
        'blogName'    => $blogName,
        'urlBack'     => $urlBack,
        'nameBack'    => $nameBack,
        'category'    => $category,
        'path'        => $path,
        'subTitle'    => 'Tout',
    ]
);
get_footer();
