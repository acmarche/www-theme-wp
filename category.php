<?php


namespace AcMarche\Theme;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\Repository\WpRepository;
use AcMarche\Common\Twig;

get_header();

global $wp_query;
$twig        = Twig::LoadTwig();
$cat_ID      = get_queried_object_id();
$description = category_description($cat_ID);
$title       = single_cat_title('', false);

$posts = $wp_query->get_posts();

$args     = ['parent' => $cat_ID, 'hide_empty' => false];
$children = get_categories($args);

$bottinRepository = new BottinRepository();
WpRepository::set_table_meta();

array_map(
    function ($post) use ($bottinRepository) {
        if ($post->post_type == 'bottin_fiche') {
            $idfiche = get_metadata(WpRepository::DATA_TYPE, $post->ID, 'id', true);
            $fiche   = $bottinRepository->getFicheById($idfiche);
            if ($fiche) {
                $post->fiche      = $fiche;
                $post->excerpt    = Bottin::getExcerpt($fiche);
                $post->permalink = get_permalink($post->ID);
                $post->permalink = '/bottin/fiche/'.$fiche->slug;
            }
        } else {
            $post->excerpt   = $post->post_excerpt;
            $post->permalink = get_permalink($post->ID);
        }
    },
    $posts
);

$content = $twig->render(
    'category/category.html.twig',
    [
        'title'       => $title,
        'description' => $description,
        'children'    => $children,
        'posts'       => $posts,
    ]
);
echo $content;
get_footer();
