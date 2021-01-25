<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Pivot\Repository\HadesRepository;

class Seo
{
    static private $metas = ['title' => '', 'keywords' => '', 'description' => ''];

    public function __construct()
    {
        add_filter('wp_title', [$this, 'metaTitle']);
        add_action('wp_head', [$this, 'assignMetaInfo']);
    }

    static function metaTitle($data): string
    {
        global $post;
        $currentBlog = get_current_blog_id();
        if ($currentBlog == 1 && $post !== null && $post->ID = 1840) {
            return "Page d'accueil".$data;
        }

        $slugFiche = get_query_var(Router::PARAM_BOTTIN_FICHE);

        if ($slugFiche) {
            self::metaBottinFiche($slugFiche);

            return self::$metas['title'];
        }

        $slugCategory = get_query_var(Router::PARAM_BOTTIN_CATEGORY);
        if ($slugCategory) {
            self::metaBottinCategory($slugCategory);

            return self::$metas['title'];
        }

        $codeCgt = get_query_var(Router::PARAM_EVENT);
        if ($codeCgt) {
            self::metaBottinEvent($codeCgt);

            return self::$metas['title'];
        }


        return $data;
    }

    static function assignMetaInfo(): void
    {
        global $post;
        $currentBlog = get_current_blog_id();
        if ($currentBlog == 1 && $post !== null && $post->ID = 1840) {
            self::metaBottinHomePage();
        }

        $slugFiche = get_query_var(Router::PARAM_BOTTIN_FICHE);
        if ($slugFiche) {
            self::metaBottinFiche($slugFiche);
        }

        $slugCategory = get_query_var(Router::PARAM_BOTTIN_CATEGORY);
        if ($slugCategory) {
            self::metaBottinCategory($slugCategory);
        }

        $codeCgt = get_query_var(Router::PARAM_EVENT);
        if ($codeCgt) {
            self::metaBottinEvent($codeCgt);
        }

        if (self::$metas['description'] != '') {
            echo '<meta name="description" content="'.self::$metas['description'].'" />';
        }

        if (self::$metas['keywords'] != '') {
            echo '<meta name="keywords" content="'.self::$metas['keywords'].'" />';
        }
    }

    /**
     * @param string $slugFiche
     */
    private static function metaBottinFiche(string $slugFiche)
    {
        $bottinRepository = new BottinRepository();
        $fiche            = $bottinRepository->getFicheBySlug($slugFiche);
        if ($fiche) {
            $cats                 = '';
            $categories           = $bottinRepository->getCategoriesOfFiche($fiche->id);
            $comment              = $fiche->comment1.' '.$fiche->comment2;
            self::$metas['title'] = $fiche->societe.' | ';
            foreach ($categories as $category) {
                $cats .= $category->name;
            }
            self::$metas['keywords']    = $cats;
            self::$metas['description'] = $comment;
        }
    }

    private static function metaBottinCategory($slug)
    {
        $bottinRepository = new BottinRepository();
        $category         = $bottinRepository->getCategoryBySlug($slug);

        if ($category) {
            self::$metas['title']       = $category->name;
            self::$metas['description'] = $category->description;
            $children                   = $bottinRepository->getCategories($category->id);
            $cats                       = array_map(
                function ($category) {
                    return $category->name;
                },
                $children
            );
            self::$metas['keywords']    = join(',', $cats);
        }
    }

    private static function metaBottinEvent($codeCgt)
    {
        $hadesRepository = new HadesRepository();

        $event = $hadesRepository->getEvent($codeCgt);
        if ($event) {
            $description          = '';
            self::$metas['title'] = $event['nom'].' | Agenda des manifestations ';
            if (count($event['description1']) > 0) {
                $description .= $event['description1'][0];
            }
            if (count($event['description']) > 0) {
                $description .= ' '.$event['description'][0];
            }
            self::$metas['description'] = $description;
            //todo get categories event
            //self::$metas['keywords']    = join(',', $cats);
        }
    }

    private static function metaBottinHomePage()
    {
        self::$metas['description'] =  get_bloginfo('description', 'display');
        self::$metas['keywords']    = 'Commune, Ville, Marche, Marche-en-Famenne, Famenne, Administration communal';
    }

    public function isGoole()
    {
        global $is_lynx;
    }

}
