<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Inc\Theme;
use Symfony\Component\HttpFoundation\Request;

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

$request = Request::createFromGlobals();
$url = $request->getUri();
Mailer::sendError("Error page author.php", "url: $url");
get_footer();
