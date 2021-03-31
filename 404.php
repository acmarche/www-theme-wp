<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Theme\Lib\Twig;
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
$url = Router::getCurrentUrl();
Mailer::sendError("404 page: ", $url.' \n ');
get_footer();
