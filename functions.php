<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\AssetsLoad;
use AcMarche\Theme\Inc\QueryAlter;
use AcMarche\Theme\Inc\SecurityConfig;
use AcMarche\Theme\Inc\WidgetLoad;

new AssetsLoad();
new WidgetLoad();
new QueryAlter();
new SecurityConfig();

//pivot_add_rewrite_rules();
add_action(
    'init',
    function () {
        add_rewrite_rule('myparamname/([a-z0-9-]+)[/]?$', 'index.php?myparamname=$matches[1]', 'top');
    }
);
add_filter(
    'query_vars',
    function ($query_vars) {
        $query_vars[] = 'myparamname';

        return $query_vars;
    }
);
add_action(
    'template_include',
    function ($template) {
        if (get_query_var('myparamname') == false || get_query_var('myparamname') == '') {
            return $template;
        }

        return get_template_directory().'/single-event.php';
    }
);
