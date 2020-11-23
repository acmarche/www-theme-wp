<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\PivotRemoteRepository;

get_header();

$twig            = Twig::LoadTwig();
$pivotRepository = new PivotRemoteRepository();

$events = $pivotRepository->getAllEvents();

$content = $twig->render(
    'agenda/agenda.html.twig',
    [
        'events' => $events,
    ]
);
echo $content;
get_footer();
