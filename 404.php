<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

get_header();

Twig::rendPage(
    'errors/404.html.twig',
    [

    ]
);
get_footer();
