<?php

namespace AcMarche\Theme;

use AcMarche\Common\Menu;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Theme;

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Studio Tartine">
        <meta name="author" content="Nucleïd">
        <meta name="author" content="Cst">
        <title>
            <?php
            wp_title('|', true, 'right');
            $nameSousSite = get_bloginfo('name', 'display');
            if ($nameSousSite != 'Citoyen') {
                echo ' | '.$nameSousSite;
            }
            ?> | Ville de Marche-en-Famenne
        </title>
        <!--FAVICON-->
        <link rel="icon" type="image/png"
              href="<?php echo get_template_directory_uri() ?>/assets/tartine/rsc/favicon.png"/>
        <?php wp_head(); ?>
    </head>
    <body class="bg-white">
    <?php
wp_body_open();

$menu = new Menu();
$data = $menu->getAllItems();
//$form = get_search_form(false);

if (Theme::isHomePage()) {
    Twig::rendPage(
        'header/_header_home.html.twig',
        [
            'data' => $data,
        ]
    );
} else {
    Twig::rendPage(
        'header/_header.html.twig',
        [
            'data' => $data,
        ]
    );
}
