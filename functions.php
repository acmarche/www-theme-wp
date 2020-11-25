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
