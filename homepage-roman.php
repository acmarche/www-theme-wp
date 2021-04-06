<?php
/**
 * Template Name: Home-Page-Roman
 */
namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Menu;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;


get_header();
$wpRepository = new WpRepository();
$page = get_queried_object();
$news = $wpRepository->getPostsByCategory(258, get_current_blog_id());

$blodId   = get_current_blog_id();
$color    = Theme::getColorBlog($blodId);
$posts    = $wpRepository->getPostsAndFiches(6);

$menu  = new Menu();
$items = $menu->getItems(get_current_blog_id());
array_map(
    function ($item) {
        $item->name = $item->title;
    },
    $items
);
unset($items[0]);//remove accueil

Twig::rendPage(
    'roman/index.html.twig',
    [
        'actus'       => $news,
        'title'       => $page->post_title,
        'color'       => $color,
        'children'    => $items,
        'description' => $page->post_content,
        'posts'       => $posts,
    ]
);

get_footer();
