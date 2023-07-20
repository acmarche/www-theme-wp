<?php
/**
 * Template Name: Home-Page-Eco
 */

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Menu;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use AcSort;


get_header();
$wpRepository = new WpRepository();

$catNewsId = 258;
$news = $wpRepository->getPostsByCategory($catNewsId, get_current_blog_id());
$category_order = get_term_meta($catNewsId, 'acmarche_category_sort', true);
if ($category_order == 'manual') {
    $news = AcSort::getSortedItems($catNewsId, $news);
}

$blodId = get_current_blog_id();
$color  = Theme::getColorBlog($blodId);

$cat_ID      = get_queried_object_id();
$description = category_description($cat_ID);
$menu     = new Menu();
$children = $menu->getItems(get_current_blog_id());
array_map(
    function ($item) {
        $item->name = $item->title;
    },
    $children
);
unset($children[0]);//remove accueil

Twig::rendPage(
    'eco/eco.html.twig',
    [
        'actus'       => $news,
        'title'       => 'Economie marchoise',
        'color'       => $color,
        'children'    => $children,
        'description' => $description,
        'posts'       => [],
    ]
);

get_footer();
