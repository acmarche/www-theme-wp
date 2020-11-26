<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();

$twig = Twig::LoadTwig();

$content = $twig->render(
    'article/404.html.twig',
    [

    ]
);
echo $content;

get_footer();
