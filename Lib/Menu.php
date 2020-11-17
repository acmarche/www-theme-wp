<?php

namespace AcMarche\Theme\Lib;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use AcMarche\Common\Twig;
use Twig\Environment;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class Menu
{
    const MENU_NAME = 'top-menu';
    /**
     * @var Environment
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

        $cache = new ApcuAdapter(

        // a string prefixed to the keys of the items stored in this cache
            $namespace = '',

            // the default lifetime (in seconds) for cache items that do not define their
            // own lifetime, with a value 0 causing items to be stored indefinitely (i.e.
            // until the APCu memory is cleared)
            $defaultLifetime = 0,

            // when set, all keys prefixed by $namespace can be invalidated by changing
            // this $version string
            $version = null
        );

        // The callable will only be executed on a cache miss.
        $value = $cache->get(
            'menu_cache_'.$id_site,
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

        return $value;
    }

    public function renderAll()
    {
        $data = [];
        foreach (Setup::SITES as $idSite => $site) {
            $data[$idSite]['name']  = $site;
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
