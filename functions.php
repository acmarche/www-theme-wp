<?php

namespace AcMarche\Theme;

use AcMarche\Bottin\RouterBottin;
use AcMarche\Theme\Inc\AdminBar;
use AcMarche\Theme\Inc\AdminPage;
use AcMarche\Theme\Inc\Api;
use AcMarche\Theme\Inc\AssetsLoad;
use AcMarche\Theme\Inc\BlockRender;
use AcMarche\Theme\Inc\EventWpSubscriber;
use AcMarche\Theme\Inc\Filter;
use AcMarche\Theme\Inc\OpenGraph;
use AcMarche\Theme\Inc\QueryAlter;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\SecurityConfig;
use AcMarche\Theme\Inc\Seo;
use AcMarche\Theme\Inc\SetupTheme;
use AcMarche\Theme\Inc\ShortCodes;
use AcMarche\Theme\Inc\WidgetLoad;

/**
 * Initialisation du thème
 */
new SetupTheme();
/**
 * Chargement css, js
 */
new AssetsLoad();
/**
 * Déclaration des zones a widgets
 */
new WidgetLoad();
/**
 * Altération de la requete principale
 */
new QueryAlter();
/**
 * Un peu de sécurité
 */
new SecurityConfig();
/**
 * Ajout de routage pour pivot et bottin
 */
new RouterBottin();
new RouterMarche();
/**
 * Balises pour le référencement
 */
//new Seo();
/**
 * Actions sur les filtres de wp
 */
new Filter();
/**
 * Add routes for api
 */
new Api();
/**
 * Short codes
 */
new ShortCodes();
/**
 *
 */
new BlockRender();
/**
 * Actions events
 */
new EventWpSubscriber();
/**
 * OpenGraph
 */
new OpenGraph();
/**
 * Admin bar edit
 */
new AdminBar();
/**
 * Admin pages
 */
new AdminPage();
