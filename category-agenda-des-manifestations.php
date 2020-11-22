<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Pivot\HadesWpRepository;

get_header();

$twig            = Twig::LoadTwig();
$hadesRepository = new HadesWpRepository();
$posts           = $hadesRepository->getEvents();

$content = $twig->render(
    'agenda/agenda.html.twig',
    [
        'posts' => $posts,
    ]
);
echo $content;
get_footer();
