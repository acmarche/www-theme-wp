<?php

namespace AcMarche\Theme\Lib;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use AcMarche\Common\Twig;

class Menu
{
    const MENU_NAME = 'top-menu';

    function getMenu(int $id_site): string
    {
        $cache = new FilesystemAdapter();
        switch_to_blog($id_site);

        //   if (false === ($items_serialize = get_transient("menu__$id_site"))) {
        $menu = wp_get_nav_menu_object(self::MENU_NAME);

        $args = array(
            'order'                  => 'ASC',
            'orderby'                => 'menu_order',
            'post_type'              => 'nav_menu_item',
            'post_status'            => 'publish',
            'output'                 => ARRAY_A,
            'output_key'             => 'menu_order',
            'nopaging'               => true,
            'update_post_term_cache' => false,
        );

        $items = wp_get_nav_menu_items($menu, $args);

        $twig = Twig::LoadTwig();

        $content = $twig->render(
            'menu/menu_top.html.twig',
            [
                'items' => $items,
            ]
        );

        return $content;
    }
}
