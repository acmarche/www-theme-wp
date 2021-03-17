<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Inc\Carto;
use AcMarche\Theme\Lib\KmlParser;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Inc\Theme;

get_header();
$carto  = new Carto();
$kml    = $carto->loadKml('statues');
$kmlParser = new KmlParser();
$domdoc = $kmlParser->parse($kml);
$places = $kmlParser->getPlacesMark();
dump($places);

foreach ($places as $place) {
    // dump($offre);
    if ($place instanceof \DOMElement) {
        $nodeName    = $place->nodeName;
        $placeName       = $kmlParser->getValueByTagName($place,'name');
        $point       = $kmlParser->getElementsByTagName($place,'Point');
        $description = $kmlParser->getValueByTagName($place,'description');
        dump($nodeName);
        dump($placeName);
        dump($point);
        dump($description);
        $coordinates = $kmlParser->getValueByTagName($point,'coordinates');
        dump($coordinates);
        foreach ($place->childNodes as $child) {
            //      dump($child);
        }
    }
}

Twig::rendPage(
    'errors/404.html.twig',
    [
        'title'     => 'Page non trouvée',
        'tags'      => [],
        'color'     => Theme::getColorBlog(1),
        'blogName'  => Theme::getTitleBlog(1),
        'relations' => [],
    ]
);
get_footer();
