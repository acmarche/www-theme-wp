<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRepository;
use AcMarche\Pivot\Repository\PivotRemoteRepository;
use Sabre\Xml\Service;

get_header();

$twig            = Twig::LoadTwig();
$pivotRepository = new PivotRemoteRepository();
$hadesRepository = new HadesRepository();
$eventsXml       = $hadesRepository->getEvents();

$service = new Service();
$events  = [];
$result  = $service->parse($eventsXml);
foreach ($result as $data) {
    $event = [];
    foreach ($data['value'] as $row) {
        $name  = $row['name'];
        $value = $row['value'];

        if ($name == '{}eve_titre_fr') {
            $event['nom'] = $value;
        }
        if ($name == '{}eve_date_affichage') {
            $event['dateRange'] = $value;
        }
        if ($name == '{}eve_date_debut') {
            list($event['year'], $event['month'], $event['day']) = explode("-", $value);
        }
        if ($name == '{}loc_nom') {
            $event['localite'] = $value;
        }
        $images = [];
        if ($name == '{}photo') {
            $images[] = $value;
        }
        $event['url']    = 'iti';
        $event['images'] = $images;
    }
    $events[] = $event;
}

//$events = $pivotRepository->getAllEvents();

$content = $twig->render(
    'agenda/index.html.twig',
    [
        'events' => $events,
    ]
);
echo $content;
get_footer();
