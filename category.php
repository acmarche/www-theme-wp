<?php

namespace AcMarche\Theme;

use AcMarche\Common\Cache;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use AcSort;
use SortLink;

$cat_ID = get_queried_object_id();
$cache = Cache::instance();
$blodId = get_current_blog_id();
$code = Cache::generateCodeCategory($blodId, $cat_ID);
get_header();

$cache->delete($code);
$wpRepository = new WpRepository();
$children = $wpRepository->getChildrenOfCategory($cat_ID);
dd(count($children));
$isReact = count($children) > 0;

echo $cache->get(
    $code,
    function () use ($cat_ID, $wpRepository, $children, $isReact) {

        $category = get_category($cat_ID);
        $description = category_description($cat_ID);
        $title = single_cat_title('', false);

        $blodId = get_current_blog_id();
        $path = Theme::getPathBlog($blodId);
        $siteSlug = Theme::getTitleBlog($blodId);
        $color = Theme::getColorBlog($blodId);
        $blogName = Theme::getTitleBlog($blodId);

        $posts = $wpRepository->getPostsAndFiches($cat_ID);
        $parent = $wpRepository->getParentCategory($cat_ID);
        $urlBack = $path;
        $nameBack = $blogName;

        if ($parent) {
            $urlBack = get_category_link($parent->term_id);
            $nameBack = $parent->name;
        }
        if ($urlBack == '') {
            $urlBack = '/';//bug if blog citoyen
            $nameBack = 'l\'accueil';
        }

        $sortLink = SortLink::linkSortArticles($cat_ID);
        $category_order = get_term_meta($cat_ID, 'acmarche_category_sort', true);
        if ($category_order == 'manual') {
            $posts = AcSort::getSortedItems($cat_ID, $posts);
        }
        $twig = Twig::LoadTwig();

        return $twig->render(
            'category/index.html.twig',
            [
                'title' => $title,
                'category' => $category,
                'siteSlug' => $siteSlug,
                'color' => $color,
                'blogName' => $blogName,
                'path' => $path,
                'subTitle' => 'Tout',
                'description' => $description,
                'children' => $children,
                'posts' => $posts,
                'category_id' => $cat_ID,
                'urlBack' => $urlBack,
                'nameBack' => $nameBack,
                'sortLink' => $sortLink,
                'isReact' => $isReact,
            ]
        );
    }
);

if ($isReact) {
    wp_enqueue_script(
        'react-app',
        get_template_directory_uri().'/assets/js/build/category.js',
        array('wp-element'),
        wp_get_theme()->get('Version'),
        true
    );
}


get_footer();
