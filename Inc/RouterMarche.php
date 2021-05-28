<?php


namespace AcMarche\Theme\Inc;

use AcMarche\Common\Router;
use AcMarche\Pivot\Entities\Categorie;
use AcMarche\Pivot\Entities\OffreInterface;

/**
 * Ajouts des routes pour les articles virtuels du bottin et de l'agenda
 * https://roots.io/routing-wp-requests/
 * https://developer.wordpress.org/reference/functions/add_rewrite_rule/#user-contributed-notes
 * Class Router
 * @package AcMarche\Theme\Inc
 */
class RouterMarche extends Router
{
    const PARAM_EVENT = 'codecgt';
    const PARAM_OFFRE = 'codeoffre';
    const OFFRE_URL = 'offre';
    const EVENT_URL = 'manifestation/';
    const PARAM_ENQUETE = 'enquete';

    public function __construct()
    {
        $this->addRouteEvent();
        $this->addRouteOffre();
        $this->addRouteEnquete();
        //add_action('init', [$this, 'custom_rewrite_tag'], 10, 0);
        //    $this->flushRoutes();
    }

    public static function getUrlEventCategory(Categorie $categorie): string
    {
        return self::getBaseUrlSite(Theme::TOURISME).self::EVENT_URL.$categorie->id;
    }

    public static function getUrlEvent(OffreInterface $offre): string
    {
        return '/tourisme/agenda-des-manifestations/'.self::EVENT_URL.$offre->id;
    }

    public static function getUrlOffre(OffreInterface $offre, int $categoryId): string
    {
        return get_category_link($categoryId).self::OFFRE_URL.'/'.$offre->id;
    }

    public static function getUrlWww(): string
    {
        $current = preg_replace("#www.marche.be#", "www.marche.be", RouterMarche::getCurrentUrl());

        return $current;
    }

    public function addRouteEvent()
    {
          add_action(
            'init',
            function () {
                add_rewrite_rule(
                    'agenda-des-manifestations/'.self::EVENT_URL.'([a-zA-Z0-9-]+)[/]?$',
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
                global $wp_rewrite;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }
                if (get_query_var(self::PARAM_EVENT) == false ||
                    get_query_var(self::PARAM_EVENT) == '') {
                    return $template;
                }

                return get_template_directory().'/single-event.php';
            }
        );
    }

    public function addRouteOffre()
    {
        //Setup a rule
        add_action(
            'init',
            function () {
                $taxonomy     = get_taxonomy('category');
                $categoryBase = $taxonomy->rewrite['slug'];

                //^= depart, $ fin string, + one or more, * zero or more, ? zero or one, () capture
                // [^/]* => veut dire tout sauf /
                //url parser: /category/sorganiser/sejourner/offre/86/
                //attention si pas sous categorie
                //https://regex101.com/r/guhLuX/1
                add_rewrite_rule(
                    '^'.$categoryBase.'/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?',
                    'index.php?category_name=$matches[1]/$matches[2]&'.self::PARAM_OFFRE.'=$matches[4]',
                    'top'
                );
            }
        );
        //Whitelist the query param
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_OFFRE;

                return $query_vars;
            }
        );
        //Add a handler to send it off to a template file
        add_action(
            'template_include',
            function ($template) {
                global $wp_query;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }
                if (get_query_var(self::PARAM_OFFRE) == false ||
                    get_query_var(self::PARAM_OFFRE) == '') {
                    return $template;
                }

                return get_template_directory().'/single-offre.php';
            }
        );
    }

    public function addRouteEnquete()
    {
        //Setup a rule
        add_action(
            'init',
            function () {
                $taxonomy     = get_taxonomy('category');
                $categoryBase = $taxonomy->rewrite['slug'];

                //^= depart, $ fin string, + one or more, * zero or more, ? zero or one, () capture
                // [^/]* => veut dire tout sauf /
                //https://regex101.com/r/guhLuX/1
                add_rewrite_rule(
                    '^/administration/(?:([a-zA-Z0-9_-]+)/){1,3}enquete/(\d+)/?$',
                    'index.php?cat=$matches[1]&'.self::PARAM_ENQUETE.'=$matches[2]',
                    'top'
                );
            }
        );
        //Whitelist the query param
        add_filter(
            'query_vars',
            function ($query_vars) {
                $query_vars[] = self::PARAM_ENQUETE;

                return $query_vars;
            }
        );
        //Add a handler to send it off to a template file
        add_action(
            'template_include',
            function ($template) {
                global $wp_query;
                if (is_admin() || ! $wp_query->is_main_query()) {
                    return $template;
                }
                if (get_query_var(self::PARAM_ENQUETE) == false ||
                    get_query_var(self::PARAM_ENQUETE) == '') {
                    return $template;
                }

                return get_template_directory().'/single-enquete.php';
            }
        );
    }

    public function custom_rewrite_tag()
    {
        add_rewrite_tag('%offre%', '([^&]+)');//utilite?
    }

    public static function setRouteEvents(array $events)
    {
        array_map(
            function ($event) {
                $event->url = self::getUrlEvent($event);
            },
            $events
        );
    }
}
