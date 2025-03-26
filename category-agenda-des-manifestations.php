<?php

namespace AcMarche\Theme;

use AcMarche\Common\Mailer;
use AcMarche\Pivot\DependencyInjection\PivotContainer;
use AcMarche\Pivot\Entity\TypeOffre;
use AcMarche\Theme\Inc\Theme;
use AcMarche\Theme\Lib\Twig;
use AcMarche\Theme\Lib\WpRepository;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Cache\InvalidArgumentException;

get_header();

$filterSelected = $_GET['filtre'] ?? null;

$wpRepository = new WpRepository();
$filtre = null;
if ($filterSelected) {
    $typeOffreRepository = PivotContainer::getTypeOffreRepository(WP_DEBUG);
    try {
        $filtre = $typeOffreRepository->findOneByUrn($filterSelected);
    } catch (NonUniqueResultException $e) {

    }
    if ($filtre instanceof TypeOffre) {
        //$nameBack = $translator->trans('agenda.title');
        //$categorName = $category->name.' - '.$filtre->labelByLanguage($language);
    }
}

try {
    $events = $wpRepository->getEvents($filtre,removeOlder: true);
} catch (NonUniqueResultException|InvalidArgumentException $e) {
    Mailer::sendError('error marche.be', "page ".$e->getMessage());
}

Twig::rendPage(
    'agenda/index.html.twig',
    [
        'events' => $events,
        'color' => Theme::getColorBlog(Theme::TOURISME),
    ]
);

get_footer();
