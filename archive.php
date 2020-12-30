<?php


namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();

if (have_posts()) :
    Twig::rendPage(
        'category/_articles_line.html.twig',
        [
            'title' => 'archive.php',

        ]
    );
else :
    Twig::rendPage(
        'article/empty.html.twig',
        [
            'title' => 'archive.php',
        ]
    );
endif;
get_footer();
