<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRepository;

get_header();

$hadesRepository = new HadesRepository();
$events          = $hadesRepository->getEvents();
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
get_footer();
