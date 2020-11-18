<?php

namespace AcMarche\Theme;

use AcMarche\Common\Twig;

$cat_ID = get_queried_object_id();
if (is_category($cat_ID)) {
    $args       = ['parent' => $cat_ID, 'hide_empty' => false];
    $categories = get_categories($args);
    $twig    = Twig::LoadTwig();
    $content = $twig->render(
        'category/_children.html.twig',
        [
            'categories'   => $categories,
        ]
    );
    echo $content;
}
