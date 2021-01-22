<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRemoteRepository;
use AcMarche\Pivot\Repository\HadesRepository;
use AcMarche\Theme\Inc\SettingsPage;
use DOMDocument;

get_header();

$hadesRepository = new HadesRepository();
$events          = $hadesRepository->getEvents();
$react           = SettingsPage::isReactActivate();
/*
$hadesRemoteRepository = new HadesRemoteRepository();
$domdoc = new DOMDocument();
$domdoc->loadXML($hadesRemoteRepository->getEvents());
foreach($domdoc->childNodes as $node) {
 dump($node);
}*/

if ($react) {
    wp_enqueue_script(
        'react-app',
        get_template_directory_uri().'/assets/js/build/agenda.js',
        array('wp-element'),
        time(),
        true
    );//For production use wp_get_theme()->get('Version')

    Twig::rendPage(
        'agenda/index_react.html.twig',
        [
            'events' => $events,
        ]
    );
} else {
    Twig::rendPage(
        'agenda/index.html.twig',
        [
            'events' => $events,
        ]
    );
}
get_footer();
