<?php


namespace AcMarche\Theme;

use AcMarche\Common\Cache;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\Urba;
use AcMarche\Theme\Lib\WpRepository;
use AcMarche\UrbaWeb\Entity\Permis;

global $wp_query;
$cache    = Cache::instance();
$blodId   = get_current_blog_id();
$permisId = $wp_query->get(RouterMarche::PARAM_ENQUETE, null);
$code     = 'enquete-'.$blodId.'-'.$permisId;

get_header();

$cache->delete($code);

echo $cache->get(
    $code.time(),
    function () use ($blodId, $permisId) {

        $permis = Urba::checkPermis($permisId);
        if ( ! $permis instanceof Permis) {
            return $permis;
        }

        $image = null;

        $path     = Theme::getPathBlog($blodId);
        $blogName = Theme::getTitleBlog($blodId);
        $color    = Theme::getColorBlog($blodId);

        $tags = [WpRepository::getCategoryEnquete()];
        array_map(
            function ($tag) {
                $tag->url = get_category_link($tag->cat_ID);
            },
            $tags
        );

        $relations = WpRepository::getEnquetesPubliques();
        array_map(
            function ($relation) {
                $demandeur       = $relation->demandeurs[0];
                $relation->title = $demandeur->civilite.' '.$demandeur->nom.' '.$demandeur->prenom.' à '.$relation->adresseSituation->localite;
                $relation->url   = RouterMarche::getUrlEnquete($relation->id);
            },
            $relations
        );

        $catSlug         = get_query_var('category_name');
        $currentCategory = get_category_by_slug($catSlug);

        $urlBack  = get_category_link($currentCategory);
        $nameBack = $currentCategory->name;

        $content = '';

        $twig = Twig::LoadTwig();

        return $twig->render(
            'enquete/show.html.twig',
            [
                'permis'      => $permis,
                'enquete'     => $permis->enquete,
                'annonce'     => $permis->annonce,
                'documents'   => $permis->documents,
                'tags'        => $tags,
                'image'       => $image,
                'title'       => 'titile ici',
                'blogName'    => $blogName,
                'color'       => $color,
                'path'        => $path,
                'relations'   => $relations,
                'urlBack'     => $urlBack,
                'nameBack'    => $nameBack,
                'content'     => $content,
                'readspeaker' => true,
                'latitude'    => false,
                'longitude'   => false,
            ]
        );
    }
);

get_footer();
