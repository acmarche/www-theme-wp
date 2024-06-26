<?php


namespace AcMarche\Theme\Inc;

use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\RouterBottin;
use AcMarche\Common\Router;
use AcMarche\Theme\Lib\WpRepository;

/**
 * todo https://github.com/joshbuchea/HEAD
 * Class Seo
 * @package AcMarche\Theme\Inc
 */
class Seo
{
    static private $metas = ['title' => '', 'keywords' => '', 'description' => ''];

    public function __construct()
    {
        add_action('wp_head', [$this, 'assignMetaInfo']);
    }

    static function assignMetaInfo(): void
    {
        if (Theme::isHomePage()) {
            self::metaBottinHomePage();
        }

        $cat_id = get_query_var('cat');
        if ($cat_id) {
            self::metaCategory($cat_id);
        }

        $postId = get_query_var('p');
        if ($postId) {
            if ($postId == Theme::PAGE_CARTO) {
                self::metaCartographie();
            } else {
                self::metaPost($postId);
            }
        }

        $slugFiche = get_query_var(RouterBottin::PARAM_BOTTIN_FICHE);
        if ($slugFiche) {
            self::metaBottinFiche($slugFiche);
        }

        $slugCategory = get_query_var(RouterBottin::PARAM_BOTTIN_CATEGORY);
        if ($slugCategory) {
            self::metaBottinCategory($slugCategory);
        }

        $codeCgt = get_query_var(RouterMarche::PARAM_EVENT);
        if ($codeCgt) {
            self::metaHadesEvent($codeCgt);
        }

        echo '<title>'.self::$metas['title'].'</title>';

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
        $fiche = $bottinRepository->getFicheBySlug($slugFiche);
        if ($fiche) {
            $cats = '';
            $categories = $bottinRepository->getCategoriesOfFiche($fiche->id);
            $comment = $fiche->comment1.' '.$fiche->comment2;
            self::$metas['title'] = $fiche->societe.' | ';
            foreach ($categories as $category) {
                $cats .= $category->name;
            }
            self::$metas['keywords'] = $cats;
            self::$metas['description'] = $comment;
        }
    }

    private static function metaBottinCategory($slug)
    {
        $bottinRepository = new BottinRepository();
        $category = $bottinRepository->getCategoryBySlug($slug);

        if ($category) {
            self::$metas['title'] = $category->name;
            self::$metas['description'] = $category->description;
            $children = $bottinRepository->getCategories($category->id);
            $cats = array_map(
                function ($category) {
                    return $category->name;
                },
                $children
            );
            self::$metas['keywords'] = join(',', $cats);
        }
    }

    private static function metaHadesEvent(string $codeCgt)
    {  //todo
        self::$metas['title'] = self::baseTitle("Page d'accueil");
        self::$metas['description'] = get_bloginfo('description', 'display');
        self::$metas['keywords'] = 'Commune, Ville, Marche, Marche-en-Famenne, Famenne, Administration communal';

        $wpRepository = new WpRepository();
        try {
            $offre = $wpRepository->getOffreByCgtAndParse($codeCgt);
        } catch (\Exception $exception) {
            $base = self::baseTitle('');
            self::$metas['title'] = "Error 500 ".$base;

            return;
        }
        $language = 'fr';
        if (null !== $offre) {
            $base = self::baseTitle('| Agenda des manifestations');
            $label = $offre->typeOffre->labelByLanguage($language);
            self::$metas['title'] = $offre->nameByLanguage($language).' '.$label.' '.$base;
            $description = implode(
                ',',
                array_map(
                    fn($description) => $description->value,
                    $offre->descriptionsByLanguage($language)
                )
            );
            if ($description) {
                self::$metas['description'] = self::cleanString($description);
            }
            $keywords = array_map(
                fn($tag) => $tag->labelByLanguage($language),
                $offre->tags
            );
            self::$metas['keywords'] = implode(',', $keywords);
            self::$metas['image'] = $offre->firstImage();
            self::$metas['updated_time'] = $offre->dateModification;
            self::$metas['published_time'] = $offre->dateCreation;
            self::$metas['modified_time'] = $offre->dateModification;
        }
    }

    private static function metaBottinHomePage()
    {
        self::$metas['title'] = self::baseTitle("Page d'accueil");
        self::$metas['description'] = get_bloginfo('description', 'display');
        self::$metas['keywords'] = 'Commune, Ville, Marche, Marche-en-Famenne, Famenne, Administration communal';
    }

    private static function metaCategory(int $cat_id)
    {
        $category = get_category($cat_id);
        $url = Router::getCurrentUrl();
        if (!$category) {
            self::$metas['title'] = self::baseTitle("");

            return;
        }
        self::$metas['title'] = self::baseTitle("");
        if ($category->description) {
            self::$metas['description'] = self::cleanString($category->description);
        }
        $wpRepository = new WpRepository();
        $children = $wpRepository->getChildrenOfCategory($category->cat_ID);
        $tags = [];
        foreach ($children as $child) {
            $tags[] = $child->name;
        }
        $parent = $wpRepository->getParentCategory($category->cat_ID);
        if ($parent) {
            $tags[] = $parent->name;
        }
        self::$metas['keywords'] = join(',', $tags);
    }

    private static function metaPost(int $postId)
    {
        $post = get_post($postId);
        if ($post) {
            self::$metas['title'] = self::baseTitle("");
            self::$metas['description'] = $post->post_excerpt;
            $tags = get_the_category($post->ID);
            self::$metas['keywords'] = join(
                ',',
                array_map(
                    function ($tag) {
                        return $tag->name;
                    },
                    $tags
                )
            );
        } else {
            self::$metas['title'] = 'Page non trouvée'.self::baseTitle("");
            self::$metas['description'] = 'Cette page n\'existe plus';
        }
    }

    private static function metaCartographie()
    {
        //todo
    }

    private static function cleanString(string $description): string
    {
        $description = trim(strip_tags($description));
        $description = preg_replace("#\"#", "", $description);

        return $description;
    }

    public function isGoole()
    {
        global $is_lynx;
    }

    public static function baseTitle(string $begin)
    {
        $base = wp_title('|', false, 'right');

        $nameSousSite = get_bloginfo('name', 'display');
        if ($nameSousSite != 'Citoyen') {
            $base .= $nameSousSite.' | ';
        }
        $base .= ' Ville de Marche-en-Famenne';

        return $begin.' '.$base;
    }

}
