<?php
/**
 * Template Name: React template
 */

namespace AcMarche\Theme;

use AcMarche\Common\MarcheConst;
use AcMarche\Common\Twig;

get_header();

wp_enqueue_script(
    'react-app',
    get_locale_stylesheet_uri().'/assets/build/category.js',
    array('wp-element'),
    time(),
    true
);//For production use wp_get_theme()->get('Version')

$cat_ID      = get_queried_object_id();
$cat_ID      = 8;
$category    = get_category($cat_ID);
$description = $category->description;
$title       = $category->name;
$blodId      = get_current_blog_id();
if ($blodId === 1) {
    $siteSlug = 'Citoyen';
    $path     = '';
} else {
    $siteSlug = $path = get_blog_details($blodId)->path;
}
$color = MarcheConst::COLORS[$blodId];
Twig::rendPage(
    'category/react.html.twig',
    [
        'title'    => $title,
        'category' => $category,
        'siteSlug' => $siteSlug,
        'color'    => $color,
        'path'     => $path,
        'subTitle' => 'Tout',
    ]
);
get_footer();
