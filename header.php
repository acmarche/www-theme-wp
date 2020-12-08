<?php

namespace AcMarche\Theme;

use AcMarche\Common\Menu;
use AcMarche\Common\Twig;
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<meta name="keywords" content=""> | TODO -->
        <meta name="author" content="Studio Tartine">
        <title>
            <?php
            wp_title('|', true, 'right');
            bloginfo('name');

            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page())) {
                echo " | $site_description";
            }
            ?> | Ville de Marche-en-Famenne
        </title>
        <!--FAVICON-->
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/rsc/favicon.png"/>
        <?php wp_head(); ?>
    </head>
<body <?php body_class('bg-white'); ?>>
    <?php
wp_body_open();

$twig = Twig::LoadTwig();
$menu = new Menu();
$data = $menu->getAllItems();
//$form = get_search_form(false);

if (is_front_page()) {
    $content = $twig->render(
        'header/_top_bar_home.html.twig',
        [
            'data' => $data,
        ]
    );
} else {
    $content = $twig->render(
        'header/_top_bar.html.twig',
        [
            'data' => $data,
        ]
    );
}

echo $content;