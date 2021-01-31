<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\Repository\HadesRemoteRepository;
use AcMarche\Pivot\Repository\HadesRepository;
use AcMarche\Theme\Inc\SettingsPage;
use DOMDocument;

//get_header();

$hadesRepository = new HadesRepository();
//$events          = $hadesRepository->getEvents();
$react = SettingsPage::isReactActivate();

$hadesRemoteRepository = new HadesRemoteRepository();
$domdoc                = new DOMDocument();
$domdoc->loadXML($hadesRemoteRepository->getEvents());
$root     = $domdoc->documentElement;//root
$xml      = "<livre><titre>PHP 5</titre><auteur>E. D</auteur><auteur>C.
PdG</auteur></livre>";
$document = new DomDocument();
$document->loadXML($xml);
$livre = $document->documentElement;
//Affichage des fils de $livre
foreach ($livre->childNodes as $node) {
    if ($node->nodeType == XML_ELEMENT_NODE) {
        echo 'Balise <b>', $node->tagName, '</b><br>';
        echo 'Contenu : <b>';
        echo utf8_decode($node->firstChild->nodeValue), '</b><br>';
    }
}

foreach ($domdoc->getElementsByTagName('offres')->item(0)->childNodes as $offre) {
    if ($offre->nodeType === XML_ELEMENT_NODE) {
        // dump($offre->nodeName);
        $idOffre = $offre->getAttributeNode('id');
        dump("ID: ".$idOffre->nodeValue);
        $child = $offre->firstChild; //DomText
        // dump($child);
        // dump($offre->childNodes->length);
        // dump($offre->tagName);//offre

        $cateogires = $offre->getElementsByTagName('categories');
        foreach ($offre->childNodes as $child) {
            //   dump($child->attributes);
            //    dump($child->tagName);
            if ($child->nodeType == XML_ELEMENT_NODE) {
                $tagName = $child->tagName;
                if ($tagName == 'titre') {
                    dump($child->tagName);
                    $lg = $child->getAttributeNode('lg');
                    dump($lg->nodeValue);
                    dump($child->firstChild->nodeValue);
                }
            }
        }
    }
    echo 'iiiiiii';
}

function getTitre() {

}

return;
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
