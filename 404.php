<?php

namespace AcMarche\Theme;

use AcMarche\Common\MarcheConst;
use AcMarche\Common\Twig;
use AcMarche\Theme\Inc\Theme;

get_header();

Twig::rendPage(
    'errors/404.html.twig',
    [
        'title'     => 'Page non trouvée',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);
get_footer();
