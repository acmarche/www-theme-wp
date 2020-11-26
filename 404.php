<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();

global $wp_rewrite;
var_dump(2222222222222222);

$twig = Twig::LoadTwig();

$content = $twig->render(
    'article/404.html.twig',
    [

    ]
);
echo $content;

get_footer();
