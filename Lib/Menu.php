<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Common\Cache;
use AcMarche\Common\Twig;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Twig\Environment;

class Menu
{
    const MENU_NAME = 'top-menu';
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct()
    {
        $this->twig  = Twig::LoadTwig();
        $this->cache = Cache::instance();
    }

    function getItems(int $id_site): array
    {
        switch_to_blog($id_site);

        return $this->cache->get(
            'menu_cache_'.$id_site.time(),
            function (ItemInterface $item) {
                $item->expiresAfter(3600);

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
        );
    }

    public function getAllItems(): array
    {
        return $this->cache->get(
            'menu_all'.time(),
            function (): array {
                $blog = get_current_blog_id();
                $data = [];
                foreach (Setup::SITES as $idSite => $site) {
                    $data[$idSite]['name']  = $site;
                    $data[$idSite]['items'] = $this->getItems($idSite);
                }
                switch_to_blog($blog);

                return $data;
            }
        );
    }
}
