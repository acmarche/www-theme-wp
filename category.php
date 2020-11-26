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

$key              = WpRepository::DATA_TYPE;
$bottinRepository = new BottinRepository();
$single           = true;
WpRepository::set_table_meta();

array_map(
    function ($post) use ($key, $single, $bottinRepository) {
        if ($post->post_type == 'bottin_fiche') {
            $idfiche = get_metadata($key, $post->ID, 'id', $single);
            $fiche   = $bottinRepository->getFiche($idfiche);
            if ($fiche) {
                $post->fiche   = $fiche;
                $post->excerpt = Bottin::getExcerpt($fiche);
            }
        } else {
            $post->excerpt = $post->post_excerpt;
        }
    },
    $posts
);

$content = $twig->render(
    'category/category.html.twig',
    [
        'title'       => $title,
        'description' => $description,
        'children'  => $children,
        'posts'       => $posts,
    ]
);
echo $content;
get_footer();
