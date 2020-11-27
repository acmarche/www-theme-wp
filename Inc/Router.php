<?php


namespace AcMarche\Theme\Inc;

/**
 * https://roots.io/routing-wp-requests/
 * https://developer.wordpress.org/reference/functions/add_rewrite_rule/#user-contributed-notes
 * Class Router
 * @package AcMarche\Theme\Inc
 */
class Router
{
    const PARAM_EVENT = 'codecgt';
    const PARAM_BOTTIN_FICHE = 'slugfiche';
    const PARAM_BOTTIN_CATEGORY = 'slugcategory';

    public function __construct()
    {
        $this->addRouteEvent();
        $this->addRouteBottin();
        $this->addRouteBottinCategory();
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
                global $wp_query;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }
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
                    'index.php?'.self::PARAM_BOTTIN_FICHE.'=$matches[1]',
                    'top'
                );
            }
        );
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_BOTTIN_FICHE;

                return $query_vars;
            }
        );
        add_action(
            'template_include',
            function ($template) {
                global $wp_query;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }

                if (get_query_var(self::PARAM_BOTTIN_FICHE) == false || get_query_var(self::PARAM_BOTTIN_FICHE) == '') {
                    return $template;
                }

                return get_template_directory().'/single-bottin_fiche.php';
            }
        );
    }

    public function addRouteBottinCategory()
    {
        add_action(
            'init',
            function () {
                add_rewrite_rule(
                    'bwp/categorie/([a-zA-Z0-9-]+)[/]?$',
                    'index.php?'.self::PARAM_BOTTIN_CATEGORY.'=$matches[1]',
                    'top'
                );
            }
        );
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_BOTTIN_CATEGORY;

                return $query_vars;
            }
        );
        add_action(
            'template_include',
            function ($template) {
                global $wp_query;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }

                if (get_query_var(self::PARAM_BOTTIN_CATEGORY) == false || get_query_var(
                                                                               self::PARAM_BOTTIN_CATEGORY
                                                                           ) == '') {
                    return $template;
                }

                return get_template_directory().'/category_bottin.php';
            }
        );
    }

}
