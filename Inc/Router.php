<?php


namespace AcMarche\Theme\Inc;


class Router
{
    const PARAM_EVENT = 'codecgt';
    const PARAM_BOTTIN = 'slugfiche';

    public function __construct()
    {
        $this->addRouteEvent();
        $this->addRouteBottin();
    }

    public function addRouteEvent()
    {
        add_action(
            'init',
            function () {
                add_rewrite_rule(
                    'manifestation/([a-zA-Z0-9-]+)[/]?$',
                    'index.php?'.self::PARAM_EVENT.'=$matches[1]',
                    'top'
                );
            }
        );
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_EVENT;

                return $query_vars;
            }
        );
        add_action(
            'template_include',
            function ($template) {
                if (get_query_var(self::PARAM_EVENT) == false || get_query_var(self::PARAM_EVENT) == '') {
                    return $template;
                }

                return get_template_directory().'/single-event.php';
            }
        );
    }

    public function addRouteBottin()
    {
        add_action(
            'init',
            function () {
                add_rewrite_rule(
                    'bottin/fiche/([a-zA-Z0-9-]+)[/]?$',
                    'index.php?'.self::PARAM_BOTTIN.'=$matches[1]',
                    'top'
                );
            }
        );
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_BOTTIN;

                return $query_vars;
            }
        );
        add_action(
            'template_include',
            function ($template) {
                if (get_query_var(self::PARAM_BOTTIN) == false || get_query_var(self::PARAM_BOTTIN) == '') {
                    return $template;
                }

                return get_template_directory().'/single-bottin_fiche.php';
            }
        );
    }

}
