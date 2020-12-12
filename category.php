<?php


namespace AcMarche\Theme;

use AcMarche\Common\TemplateRender;

get_header();

echo TemplateRender::renderCategory();
//echo do_shortcode('[example_react_app]');

get_footer();
