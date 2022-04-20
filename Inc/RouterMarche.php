<?php


namespace AcMarche\Theme\Inc;

use AcMarche\Common\Router;
use AcMarche\Pivot\Entities\Category;
use AcMarche\Pivot\Entities\Event\Event;
use AcMarche\Pivot\Entities\Offre\Offre;
use AcMarche\Theme\Lib\WpRepository;

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
    const PARAM_ENQUETE = 'numenquete';

    public function __construct()
    {
        $this->addRouteEvent();
        //     $this->addRouteOffre();
        $this->addRouteEnquete();
       //   $this->flushRoutes();
    }

    public static function getUrlEventCategory(Category $categorie): string
    {
        return self::getBaseUrlSite(Theme::TOURISME).self::EVENT_URL.$categorie->id;
    }

    public static function getUrlEvent(Event $offre): string
    {
        return '/tourisme/agenda-des-manifestations/'.self::EVENT_URL.$offre->codeCgt;
    }

    public static function getUrlOffre(Offre $offre, int $categoryId): string
    {
        return get_category_link($categoryId).self::OFFRE_URL.'/'.$offre->codeCgt;
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

    public static function getUrlEnquete(string $id):string
    {
        $category = WpRepository::getCategoryEnquete();

        return get_category_link($category).self::PARAM_ENQUETE.'/'.$id;
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
                    'publications-communales/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?',
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
                //'^/administration/(?:([a-zA-Z0-9_-]+)/){1,2}([a-zA-Z0-9_-]+)/num/(\d+)/?$',
                add_rewrite_rule(
                    'publications-communales/([a-zA-Z0-9_-]+)/'.self::PARAM_ENQUETE.'/([a-zA-Z0-9_-]+)/?$',
                    'index.php?category_name=$matches[1]&'.self::PARAM_ENQUETE.'=$matches[2]',
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
