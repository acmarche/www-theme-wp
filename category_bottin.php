<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\RouterBottin;
use AcMarche\Common\Cache;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

global $wp_query;
$cache  = Cache::instance();
$blodId = get_current_blog_id();
$slug   = $wp_query->get(RouterBottin::PARAM_BOTTIN_CATEGORY, null);
$code   = 'category-bottin-'.$blodId.'-'.$slug;

echo $cache->get(
    $code,
    function () use ($slug, $blodId) {

        $twig             = Twig::LoadTwig();
        $bottinRepository = new BottinRepository();

        $category = null;
        if ($slug) {
            $category = $bottinRepository->getCategoryBySlug($slug);
        }

        $color    = Theme::getColorBlog($blodId);
        $blogName = Theme::getTitleBlog($blodId);
        $path     = Theme::getPathBlog($blodId);

        if ( ! $category) {
            return $twig->render(
                'errors/404.html.twig',
                [
                    'title'    => 'Page non trouvée',
                    'tags'     => [],
                    'color'    => $color,
                    'blogName' => $blogName,
                ]
            );
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
            $urlBack  = RouterBottin::getUrlCategoryBottin($parent);
        }
        array_map(
            function ($child) {
                $child->url = RouterBottin::getUrlCategoryBottin($child);
            },
            $children
        );

        array_map(
            function ($fiche) use ($bottinRepository) {
                $idSite            = $bottinRepository->findSiteFiche($fiche);
                $fiche->post_title = $fiche->societe;
                $fiche->excerpt    = Bottin::getExcerpt($fiche);
                $fiche->url        = RouterBottin::getUrlFicheBottin($idSite, $fiche);
            },
            $fiches
        );

        return $twig->render(

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
    }
);

get_footer();
