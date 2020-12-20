<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRepository;

get_header();

$twig            = Twig::LoadTwig();
$hadesRepository = new HadesRepository();
$events          = $hadesRepository->getEvents();
wp_enqueue_script('react-app', get_locale_stylesheet_uri().'/../assets/build/agenda.js', array('wp-element'), time(), true);//For production use wp_get_theme()->get('Version')

$content = $twig->render(
    'agenda/index_react.html.twig',
    [
        'events' => $events,
    ]
);
echo $content;
get_footer();
