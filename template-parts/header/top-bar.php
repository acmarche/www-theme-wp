<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;
use AcMarche\Theme\Lib\Menu;

$blog = get_current_blog_id();
$twig    = Twig::LoadTwig();
$menu    = new Menu();
$data    = $menu->getAllItems();
$content = $twig->render(
    'header/_top_bar.html.twig',
    [
        'data'         => $data,
    ]
);
switch_to_blog($blog);
echo $content;
?>
