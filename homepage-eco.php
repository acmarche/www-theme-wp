<?php
/**
 * Template Name: Home-Page-Eco
 */

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Menu;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;


get_header();
$wpRepository = new WpRepository();

$news = $wpRepository->getPostsByCategory(258, get_current_blog_id());

$blodId = get_current_blog_id();
$color  = Theme::getColorBlog($blodId);

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
        'description' => '',
        'posts'       => [],
    ]
);

get_footer();
