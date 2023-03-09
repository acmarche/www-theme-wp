<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\Repository\WpBottinRepository;
use AcMarche\Bottin\RouterBottin;
use AcMarche\Common\Cache;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

global $wp_query;
$cache = Cache::instance();
$blodId = get_current_blog_id();
$slugFiche = $wp_query->get(RouterBottin::PARAM_BOTTIN_FICHE, null);
$code = 'bottin-fiche-'.$blodId.'-'.$slugFiche;

get_header();

echo $cache->get(
    $code,
    function () use ($slugFiche, $blodId, $wp_query) {

        $twig = Twig::LoadTwig();
        $bottinRepository = new BottinRepository();

        if ($slugFiche) {
            $fiche = $bottinRepository->getFicheBySlug($slugFiche);
        } elseif ($post = $wp_query->post) {
            WpBottinRepository::set_table_meta();
            $idfiche = get_metadata(WpBottinRepository::DATA_TYPE, $post->ID, 'id', true);
            $fiche = $bottinRepository->getFicheById($idfiche);
        }

        $blodId = get_current_blog_id();
        $color = Theme::getColorBlog($blodId);
        $path = Theme::getPathBlog($blodId);
        $blogName = Theme::getTitleBlog($blodId);

        if (!$fiche) {
            $object = new \stdClass();
            $object->slug = $path;
            $route = RouterBottin::getUrlCategoryBottin($object);

            return $twig->render(
                'fiche/not_found.html.twig',
                [
                    'title' => 'Fiche non trouvée',
                    'tags' => [],
                    'content' => '',
                    'urlBack' => '/',
                    'nameBack' => 'Accueil',
                    'color' => $color,
                    'blogName' => $blogName,
                    'relations' => [],
                    'url' => $route,
                ]
            );
        }

        $categories = $bottinRepository->getCategoriesOfFiche($fiche->id);
        $classementPrincipal = $bottinRepository->getCategoriePrincipale($fiche);
        $urlBack = null;
        if ($classementPrincipal) {
            $urlBack = RouterBottin::getUrlCategoryBottin($classementPrincipal);
        }
        $currentCategory = get_category_by_slug(get_query_var('category_name'));
        $urlBack = get_category_link($currentCategory);

        $images = $bottinRepository->getImagesFiche($fiche->id);
        $documents = $bottinRepository->getDocuments($fiche->id);
        $isCentreVille = $bottinRepository->isCentreVille($fiche->id);
        $logo = $bottinRepository->getLogo($fiche->id);
        if ($logo) {
            unset($images[0]);
        }
        array_map(
            function ($category) {
                $category->url = RouterBottin::getUrlCategoryBottin($category);
            },
            $categories
        );

        $relations = $bottinRepository->getRelations($fiche->id, $categories);

        return $twig->render(
            'fiche/show.html.twig',
            [
                'fiche' => $fiche,
                'title' => $fiche->societe,
                'tags' => $categories,
                'isCentreVille' => $isCentreVille,
                'logo' => $logo,
                'images' => $images,
                'documents' => $documents,
                'url_base' => Bottin::getUrlBottin().$fiche->id.DIRECTORY_SEPARATOR,
                'url_doc' => Bottin::getUrlDocument().DIRECTORY_SEPARATOR,
                'latitude' => $fiche->latitude,
                'longitude' => $fiche->longitude,
                'blogName' => $blogName,
                'color' => $color,
                'path' => $path,
                'content' => '',
                'relations' => $relations,
                'readspeaker' => true,
                'urlBack' => $urlBack,
            ]
        );
    }
);

get_footer();
