<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

Twig::rendPage(
    'errors/500.html.twig',
    [
        'message'   => 'Page vide',
        'title'     => 'Error 500',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);

get_footer();
