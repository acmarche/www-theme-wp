<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();
$twig = Twig::LoadTwig();

$content = $twig->render(
    'article/empty.html.twig',
    [
        'title' => 'archive.php',

    ]
);
echo $content;

get_footer();
