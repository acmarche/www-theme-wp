<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Theme\Lib\Menu;

$twig = Twig::LoadTwig();
$menu = new Menu();
$menu = $menu->renderAll();
$content = $twig->render(
    'header/_top_bar.html.twig',
    [
        'template_dir' => Twig::getTemplateDirectoryUri(),
        'menu'         => $menu,
    ]
);
echo $content;
?>
