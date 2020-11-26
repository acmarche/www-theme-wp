<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\AssetsLoad;
use AcMarche\Theme\Inc\QueryAlter;
use AcMarche\Theme\Inc\Router;
use AcMarche\Theme\Inc\SecurityConfig;
use AcMarche\Theme\Inc\WidgetLoad;

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

//pivot_add_rewrite_rules();

