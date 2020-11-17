<?php

namespace AcMarche\Theme\Lib;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use AcMarche\Common\Twig;

class Menu
{
    const MENU_NAME = 'top-menu';
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var FilesystemAdapter
     */
    private $cache;

    public function __construct()
    {
        $this->twig  = Twig::LoadTwig();
        $this->cache = new FilesystemAdapter();
    }

    function getItems(int $id_site): array
    {
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

        return wp_get_nav_menu_items($menu, $args);
    }

    public function renderAll()
    {
        $data = [];
        foreach (Setup::SITES as $idSite => $site) {
            $data[$idSite]['name']   = $site;
            $data[$idSite]['items'] = $this->getItems($idSite);
        }

        $content = $this->twig->render(
            'menu/menu_top.html.twig',
            [
                'data' => $data,
            ]
        );

        return $content;
    }
}
