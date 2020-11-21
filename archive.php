<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();
$twig = Twig::LoadTwig();

if (have_posts()) :


    $content = $twig->render(
        'category/_articles_line.html.twig',
        [
            'title' => 'archive.php',

        ]
    );


else :

    $content = $twig->render(
        'article/empty.html.twig',
        [
            'title' => 'archive.php',

        ]
    );

endif;


echo $content;

get_footer();
