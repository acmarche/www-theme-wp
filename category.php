<?php


namespace AcMarche\Theme;

use AcMarche\Common\TemplateRender;

get_header();

global $wp_query;

echo TemplateRender::renderCategory($wp_query);
//echo do_shortcode('[example_react_app]');

get_footer();
