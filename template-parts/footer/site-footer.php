<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

$twig = Twig::LoadTwig();
$content = $twig->render(
    'footer/footer.html.twig',
    [
        'template_dir' => Twig::getTemplateDirectoryUri(),
    ]
);
echo $content;
?>
