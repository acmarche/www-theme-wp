<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

$twig    = Twig::LoadTwig();
$content = $twig->render(
    'home/home_content.html.twig',
    [

    ]
);
echo $content;
