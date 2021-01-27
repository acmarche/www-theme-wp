<?php


namespace AcMarche\Theme;

use AcMarche\Common\MarcheConst;
use AcMarche\Common\TemplateRender;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\SettingsPage;
use AcMarche\Theme\Inc\Theme;

get_header();

$react = SettingsPage::isReactActivate();
if ($react == false) {
    TemplateRender::renderCategory();
    get_footer();

    return;
}

$cat_ID      = get_queried_object_id();
$category    = get_category($cat_ID);
$description = $category->description;
$title       = $category->name;

$blodId = get_current_blog_id();

$path     = Theme::getPathBlog($blodId);
$siteSlug = Theme::getTitleBlog($blodId);
$color    = Theme::getColorBlog($blodId);
$blogName = Theme::getTitleBlog($blodId);

wp_enqueue_script(
    'react-app',
    get_template_directory_uri().'/assets/js/build/category.js',
    array('wp-element'),
    time(),
    true
);//For production use wp_get_theme()->get('Version')

Twig::rendPage(
    'category/index_react.html.twig',
    [
        'title'    => $title,
        'category' => $category,
        'siteSlug' => $siteSlug,
        'color'    => $color,
        'blogName'  => $blogName,
        'path'     => $path,
        'subTitle' => 'Tout',
    ]
);

get_footer();
