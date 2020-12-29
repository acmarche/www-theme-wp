<?php


namespace AcMarche\Theme\Inc;

/**
 * Enregistrement des routes pour les api pour les composants react
 * Class Api
 * @package AcMarche\Theme\Inc
 */
class Api
{
    public function __construct()
    {
        if ( ! is_admin()) {
            $this->registerCateogry();
            $this->registerEvent();
            $this->registerBottin();
            $this->registerSearch();
        }
    }

    public function registerEvent()
    {
        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'ca/v1',
                    'events',
                    [
                        'methods'  => 'GET',
                        'callback' => ['ApiData', 'ca_events'],
                    ]
                );
            }
        );
    }

    public function registerBottin()
    {
        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'ca/v1',
                    'bottinsocieteid',
                    [
                        'methods'  => 'GET',
                        'callback' => ['ApiData', 'ca_bottinSocieteId'],

                    ]
                );
            }
        );

        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'ca/v1',
                    'bottin/(?P<ficheId>.*+)',
                    [
                        'methods'  => 'GET',
                        'callback' => ['ApiData', 'ca_bottin'],

                    ]
                );
            }
        );
    }

    public function registerCateogry()
    {
        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'ca/v1',
                    'all/(?P<catParent>.*+)',
                    [
                        'methods'  => 'GET',
                        'callback' => ['ApiData', 'ca_categories'],

                    ]
                );
            }
        );
    }

    public function registerSearch()
    {
        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'jfs/v1',
                    'search/(?P<keyword>.*+)',
                    [
                        'methods'  => 'GET',
                        'callback' => array('ApiData', 'search'),
                    ]
                );
            }
        );
    }

}
