<?php


namespace AcMarche\Theme;

use AcMarche\Common\Cache;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;

global $post;
$cache  = Cache::instance();
$blodId = get_current_blog_id();
$code   = 'post-'.$blodId.'-'.$post->ID;

get_header();
global $wp_query;

$enqueteId = $wp_query->get(RouterMarche::PARAM_ENQUETE, null);

$cache->delete($code);

echo $cache->get(
    $code.time(),
    function () use ($post, $blodId, $enqueteId) {

        $twig    = Twig::LoadTwig();
        $enquete = WpRepository::getEnquetePublique($enqueteId);
        if ( ! $enquete) {
            return $twig->render(
                'errors/404.html.twig',
                [
                    'title'     => 'Enquête non trouvée',
                    'tags'      => [],
                    'color'     => Theme::getColorBlog(Theme::TOURISME),
                    'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                    'relations' => [],
                ]
            );
        }

        $image = null;

        $path     = Theme::getPathBlog($blodId);
        $blogName = Theme::getTitleBlog($blodId);
        $color    = Theme::getColorBlog($blodId);

        $tags      = WpRepository::getTags($post->ID);
        $relations = WpRepository::getRelations($post->ID);

        $catSlug         = get_query_var('category_name');
        $currentCategory = get_category_by_slug($catSlug);

        $urlBack  = get_category_link($currentCategory);
        $nameBack = $currentCategory->name;

        $content = $enquete->description;

        $twig = Twig::LoadTwig();

        return $twig->render(
            'enquete/show.html.twig',
            [
                'enquete'     => $enquete,
                'tags'        => $tags,
                'image'       => $image,
                'title'       => $enquete->categorie,
                'blogName'    => $blogName,
                'color'       => $color,
                'path'        => $path,
                'relations'   => $relations,
                'urlBack'     => $urlBack,
                'nameBack'    => $nameBack,
                'content'     => $content,
                'readspeaker' => true,
                'latitude'    => $enquete->latitude,
                'longitude'   => $enquete->longitude,
            ]
        );
    }
);

get_footer();
