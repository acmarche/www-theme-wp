<?php
namespace AcMarche\Theme;

use AcMarche\Common\Twig;

$twig = Twig::LoadTwig();
$content = $twig->render(
    'footer/footer.html.twig'
);
echo $content;
wp_footer();
$content = $twig->render(
    'footer/_closte_tags.html.twig'
);
echo $content;
