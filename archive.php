<?php


namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;

get_header();

Twig::rendPage(
    'errors/404.html.twig',
    [
        'title'     => 'Archive non trouvée',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);

$url = Router::getCurrentUrl();
Mailer::sendError("archive page: ", $url.' \n ');
get_footer();
