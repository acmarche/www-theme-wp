<?php

namespace AcMarche\Theme;


use AcMarche\Common\Mailer;
use AcMarche\Theme\Inc\RouterMarche;

use AcMarche\Theme\Lib\Twig;

/**
 * This page is called by symfony @file  functions.php
 */
//$statusCode;  $statusText;
//get_header();
//todo header et body sur meme ligne, si header pas en fixed ca va
Twig::rend500Page("failed");
get_footer();

try {
    Mailer::sendError('error marche.be', "page ".RouterMarche::getCurrentUrl());

} catch (\Exception $exception) {

}