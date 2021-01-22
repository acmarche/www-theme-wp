<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Api;
use AcMarche\Theme\Inc\AssetsLoad;
use AcMarche\Theme\Inc\Filter;
use AcMarche\Theme\Inc\QueryAlter;
use AcMarche\Theme\Inc\Router;
use AcMarche\Theme\Inc\SecurityConfig;
use AcMarche\Theme\Inc\Seo;
use AcMarche\Theme\Inc\SettingsPage;
use AcMarche\Theme\Inc\SetupTheme;
use AcMarche\Theme\Inc\WidgetLoad;



/**
 *
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
new Router();
/**
 * Balises pour le référencement
 */
new Seo();
/**
 * Actions sur les filtres de wp
 */
new Filter();
/**
 * Add routes for api
 */
new Api();
/**
 * Activer ou pas react
 */
new SettingsPage();
