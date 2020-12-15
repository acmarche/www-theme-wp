<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRepository;

get_header();

$twig            = Twig::LoadTwig();
$hadesRepository = new HadesRepository();
$events          = $hadesRepository->getEvents();

$content = $twig->render(
    'agenda/index.html.twig',
    [
        'events' => $events,
    ]
);
echo $content;
get_footer();