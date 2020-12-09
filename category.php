<?php


namespace AcMarche\Theme;

use AcMarche\Common\TemplateRender;
use AcMarche\Common\Twig;

wp_enqueue_script(
    'react-app',
    get_template_directory_uri().'/../../mu-plugins/wordpressmarche-react-plugin/build/index.js',
    array('wp-element'),
    time(),
    true
);

get_header();

global $wp_query;

$category_id = get_queried_object_id();
$blodId      = get_current_blog_id();
$site_slug   = get_blog_details($blodId)->path;
$name        = get_bloginfo('name');
//echo TemplateRender::renderCategory($wp_query);
$twig    = Twig::LoadTwig();
$content = $twig->render(
    'category/category.html.twig',
    [
        'title'       => $name,
        'category_id' => $category_id,
        'site_slug'   => $site_slug,
    ]
);
echo $content;
get_footer();
