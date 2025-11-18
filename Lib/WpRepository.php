<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\RouterBottin;
use AcMarche\Common\SortUtil;
use AcMarche\Pivot\DependencyInjection\PivotContainer;
use AcMarche\Pivot\Entities\Offre\Offre;
use AcMarche\Pivot\Spec\UrnList;
use AcMarche\Pivot\Utils\CacheUtils;
use AcMarche\Theme\Entity\CommonItem;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcSort;
use BottinCategoryMetaBox;
use Carbon\Carbon;
use Psr\Cache\InvalidArgumentException;
use WP_Post;
use WP_Query;
use WP_Term;

class WpRepository
{
    public static function getPageAlert(): ?WP_Post
    {
        switch_to_blog(1);
        $query = new WP_Query(array("page_id" => Theme::PAGE_ALERT, "post_status" => 'publish', 'post_type' => 'page'));
        $post = $query->get_posts();
        if (count($post) > 0) {
            return $post[0];
        }

        return null;
    }

    public static function getPublications(int $wpCategoryId): array
    {
        global $wpdb;

        $category = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM publication.category WHERE publication.category.wpCategoryId = %d",
                $wpCategoryId
            ),
            OBJECT
        );

        if (empty($category)) {
            return [];
        }

        $categoryId = $category[0]->id ?? null;
        if (!$categoryId) {
            return [];
        }

        $results = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM publication.publication WHERE publication.publication.category_id = %d ORDER BY createdAt DESC",
                $categoryId
            ),
            OBJECT
        );

        if (!$results) {
            return [];
        }

        foreach ($results as $ordonnance) {
            $ordonnance->ID = $ordonnance->id;
            $ordonnance->excerpt = "";
            $ordonnance->post_excerpt = "";
            $ordonnance->post_title = $ordonnance->title;
        }

        return $results;
    }

    /**
     * @return Offre[]
     * @throws InvalidArgumentException
     */
    public function getEvents(bool $removeOlder = false): array
    {
        $cacheUtils = new CacheUtils();
        $cache = $cacheUtils->instance();
        $today = new \DateTime();

        $cacheKey = 'events_pivot_'.$today->format('Y-m-d').$removeOlder;

        $cacheKey = $cacheUtils->generateKey($cacheKey);

        return $cache->get($cacheKey, function () use ($removeOlder, $today) {

            $pivotRepository = PivotContainer::getPivotRepository(WP_DEBUG);
            $filtres = $this->getChildrenEvents(true);
            $events = $pivotRepository->fetchEvents(typeOffres: $filtres);
            $data = [];
            if (count($events) > 0) {
                RouterMarche::setRouteEvents($events);
            }
            foreach ($events as $event) {
                $event->locality = $event->getAdresse()->localite[0]->get('fr');
                $event->shortCutDateEvent = [
                    'year' => $event->firstDate()->format('Y'),
                    'month' => $event->firstDate()->format('m'),
                    'day' => $event->firstDate()->format('d'),
                ];
                if (count($event->images) == 0) {
                    $event->images = ['https://www.visitmarche.be/wp-content/uploads/2021/02/bg_events.png'];
                }
                if ($removeOlder) {
                    if (Carbon::parse($event->firstRealDate())->diffInMonths($today) < 1) {
                        $data[] = $event;
                    }
                } else {
                    $data[] = $event;
                }
            }

            return $data;

        });
    }

    private static function getChildrenEvents(bool $filterCount): array
    {
        $filtreRepository = PivotContainer::getTypeOffreRepository(WP_DEBUG);
        $parents = $filtreRepository->findByUrn(UrnList::EVENT_CINEMA->value);

        return $filtreRepository->findByParent($parents[0]->parent->id, $filterCount);
    }

    /**
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getOffreByCgtAndParse(string $codeCgt): ?Offre
    {
        $pivotRepository = PivotContainer::getPivotRepository(WP_DEBUG);

        return $pivotRepository->fetchOffreByCgtAndParse($codeCgt);
    }

    /**
     * @param Offre $offerRefer
     * @param WP_Term $category
     * @param string $language
     * @return array|CommonItem[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function recommandationsByOffre(Offre $offerRefer, WP_Term $category, string $language): array
    {
        $cacheKey = 'recom-'.$offerRefer->codeCgt;

        if ($recommandations = get_transient($cacheKey)) {
            return $recommandations;
        }

        if (count($offerRefer->see_also)) {
            $offres = $offerRefer->see_also;
        } else {
            $pivotRepository = PivotContainer::getPivotRepository();
            $offres = $pivotRepository->fetchSameOffres($offerRefer, 10);
        }
        PostUtils::setLinkOnOffres($offres, $category->term_id, $language);
        $recommandations = PostUtils::convertRecommandationsToArray($offres, $language);
        $count = count($recommandations);
        $data = [];

        if ($count === 0) {
            return $data;
        }

        if ($count > 3) {
            $count = 3;
        }

        $keys = array_rand($recommandations, $count);

        if (is_array($keys)) {
            foreach ($keys as $key) {
                $data[] = $recommandations[$key];
            }
        }

        return $data;
    }


    /**
     * @param int $max
     *
     * @return WP_Post[]
     */
    public static function getAllNews(int $max = 50): array
    {
        $news = array();

        foreach (Theme::SITES as $siteId => $name) :
            switch_to_blog($siteId);

            $args = array(
                'category_name' => 'actualites-principales',
                'orderby' => 'title',
                'post_status' => 'publish',
                'order' => 'ASC',
            );

            if ($siteId == 1) {
                $args = array(
                    'category_name' => 'actualites',
                    'orderby' => 'title',
                    'post_status' => 'publish',
                    'order' => 'ASC',
                );
            }

            $querynews = new WP_Query($args);

            while ($querynews->have_posts()) :

                $post = $querynews->next_post();
                $id = $post->ID;

                if (has_post_thumbnail($id)) {
                    $attachment_id = get_post_thumbnail_id($id);
                    $images = wp_get_attachment_image_src($attachment_id, 'original');
                    $post_thumbnail_url = $images[0];
                } else {
                    $post_thumbnail_url = get_template_directory_uri().'/assets/images/404.jpg';
                }

                $post->post_thumbnail_url = $post_thumbnail_url;

                $permalink = get_permalink($id);
                $post->url = $permalink;

                $post->blog_id = $siteId;
                $post->blog = ucfirst($name);
                $post->color = Theme::COLORS[$siteId];
                $post->colorTailwind = 'text-'.Theme::SITES[$siteId];

                $news[] = $post;
            endwhile;
        endforeach;

        switch_to_blog(1);
        wp_reset_postdata();

        $news = AcSort::trieNews($news);

        if (count($news) > $max) {
            $news = array_slice($news, 0, $max);
        }

        return $news;
    }

    public static function getRelations(int $postId): array
    {
        $categories = get_the_category($postId);
        $args = array(
            'category__in' => array_map(
                function ($category) {
                    return $category->cat_ID;
                },
                $categories
            ),
            'post__not_in' => [$postId],
            'orderby' => 'title',
            'order' => 'ASC',
        );
        $query = new \WP_Query($args);
        $recommandations = [];
        foreach ($query->posts as $post) {
            $image = null;
            if (has_post_thumbnail($post)) {
                $images = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'original');
                if ($images) {
                    $image = $images[0];
                }
            }
            $recommandations[] = [
                'title' => $post->post_title,
                'name' => $post->post_title,
                'url' => get_permalink($post->ID),
                'image' => $image,
                'tags' => self::getTags($post->ID),
            ];

        }

        return $recommandations;
    }

    public static function getCategoryBySlug(string $slug)
    {
        return get_category_by_slug($slug);
    }

    public static function getTags(int $postId): array
    {
        $tags = [];
        foreach (get_the_category($postId) as $category) {
            $tags[] = [
                'name' => $category->name,
                'url' => get_category_link($category),
                'id' => $category->cat_ID,
            ];
        }

        return $tags;
    }

    public function getChildrenOfCategory(int $cat_ID): array
    {
        $args = ['parent' => $cat_ID, 'hide_empty' => false];
        $children = get_categories($args);
        array_map(
            function ($category) {
                $category->url = get_category_link($category->term_id);
                $category->id = $category->term_id;
            },
            $children
        );

        return $children;
    }

    public function getRootCategories(): array
    {
        $args = ['parent' => 0, 'hide_empty' => false];
        $children = get_categories($args);
        array_map(
            function ($category) {
                $category->url = get_category_link($category->term_id);
                $category->id = $category->term_id;
            },
            $children
        );

        return $children;
    }

    public function cleanHomeCategories(array $children): array
    {
        return array_filter(
            $children,
            function ($values, $key) use ($children) {
                if (preg_match('#principal#', $values->name)) {
                    return false;
                }
                if (preg_match('#Non classé#', $values->name)) {
                    return false;
                }

                return true;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @param int $cat_ID
     *
     * @return array|object|\WP_Error|null
     */
    public function getParentCategory(int $cat_ID)
    {
        $category = get_category($cat_ID);

        if ($category) {
            if ($category->parent < 1) {
                return null;
            }

            return get_category($category->parent);
        }

        return null;

    }

    public function getPostsAndFiches(int $catId): array
    {
        $args = array(
            'cat' => $catId,
            'numberposts' => 5000,
            'orderby' => 'post_title',
            'order' => 'ASC',
            'post_status' => 'publish',
        );

        $querynews = new WP_Query($args);
        $posts = [];
        while ($querynews->have_posts()) {
            $post = $querynews->next_post();
            $post->excerpt = $post->post_excerpt;
            $post->url = get_permalink($post->ID);
            $posts[] = $post;
        }

        $fiches = [];
        $categoryBottinId = get_term_meta($catId, BottinCategoryMetaBox::KEY_NAME, true);
        $bottinRepository = new BottinRepository();
        if ($categoryBottinId) {
            $fiches = $bottinRepository->getFichesByCategory($categoryBottinId);
        }

        array_map(
            function ($fiche) use ($bottinRepository) {
                $idSite = $bottinRepository->findSiteFiche($fiche);
                $fiche->fiche = true;
                $fiche->excerpt = Bottin::getExcerpt($fiche);
                $fiche->post_excerpt = Bottin::getExcerpt($fiche);
                $fiche->url = RouterBottin::getUrlFicheBottin($idSite, $fiche);
                $fiche->post_title = $fiche->societe;
            },
            $fiches
        );

        $all = array_merge($posts, $fiches);

        if (get_current_blog_id(
            ) === Theme::ADMINISTRATION && ($catId == Theme::ENQUETE_DIRECTORY_URBA || $catId == Theme::PUBLICATIOCOMMUNAL_CATEGORY)) {

            /*$permis = Urba::getEnquetesPubliques();
            $data   = [];
            foreach ($permis as $permi) {
                $post   = Urba::permisToPost($permi);
                $data[] = $post;
            }
            $all = array_merge($all, $data);*/

            $enquetes = self::getEnquetesPubliques($catId);
            array_map(
                function ($enquete) {
                    list($yearD, $monthD, $dayD) = explode('-', $enquete->date_debut);
                    $dateDebut = $dayD.'-'.$monthD.'-'.$yearD;
                    list($yearF, $monthF, $dayF) = explode('-', $enquete->date_fin);
                    $dateFin = $dayF.'-'.$monthF.'-'.$yearF;
                    $enquete->ID = $enquete->id;
                    $enquete->excerpt = $enquete->demandeur.' à '.$enquete->localite.'<br /> Affichate: du '.$dateDebut.' au '.$dateFin;
                    $enquete->post_excerpt = $enquete->demandeur.' à '.$enquete->localite.'<br /> Affichate: du '.$dateDebut.' au '.$dateFin;
                    $enquete->url = RouterMarche::getUrlEnquete($enquete->id);
                    $enquete->post_title = $enquete->intitule.' à '.$enquete->localite;
                },
                $enquetes
            );
            $all = array_merge($all, $enquetes);
        }

        if (get_current_blog_id() === Theme::ADMINISTRATION) {
            $publications = self::getPublications($catId);
            if (count($publications) > 0) {
                $all = array_merge($all, $publications);
            }
        }

        return SortUtil::sortPosts($all);
    }

    public function getPostsByCategory(int $catId, int $siteId): array
    {
        $args = array(
            'cat' => $catId,
            'numberposts' => 5000,
            'orderby' => 'post_title',
            'order' => 'ASC',
            'post_status' => 'publish',
        );

        $query = new WP_Query($args);
        $posts = [];
        while ($query->have_posts()) :
            $post = $query->next_post();
            $id = $post->ID;

            if (has_post_thumbnail($id)) {
                $attachment_id = get_post_thumbnail_id($id);
                $images = wp_get_attachment_image_src($attachment_id, 'original');
                $post_thumbnail_url = $images[0];
            } else {
                $post_thumbnail_url = get_template_directory_uri().'/assets/images/404.jpg';
            }

            $post->post_thumbnail_url = $post_thumbnail_url;

            $permalink = get_permalink($id);
            $post->url = $permalink;

            $post->blog_id = $siteId;
            $post->blog = Theme::getTitleBlog($siteId);
            $post->color = Theme::COLORS[$siteId];

            $posts[] = $post;
        endwhile;

        $all = SortUtil::sortPosts($posts);

        return $all;
    }

    public static function getCategoryAgenda(): bool|object
    {
        $currentBlog = get_current_blog_id();
        switch_to_blog(Theme::TOURISME);
        $categoryAgenda = get_category_by_slug('agenda-des-manifestations');

        switch_to_blog($currentBlog);

        return $categoryAgenda;
    }

    public static function getCategoryEnquete(): object
    {
        $currentBlog = get_current_blog_id();
        switch_to_blog(Theme::ADMINISTRATION);
        $category = get_category(Theme::ENQUETE_DIRECTORY_URBA);

        switch_to_blog($currentBlog);

        return $category;
    }

    public static function getEnquetesPubliques(?int $catId = null)
    {
        $content = file_get_contents('https://extranet.marche.be/enquete/api/');

        $enquetes = json_decode($content);
        if ($catId == null) {
            return $enquetes;
        }

        return array_filter($enquetes, function ($enquete) use ($catId) {
            return $enquete->categoriewp == $catId;
        });
    }

    public static function getEnquetePublique(int $enqueteId): ?\stdClass
    {
        $enquetes = self::getEnquetesPubliques();
        foreach ($enquetes as $enquete) {
            if ($enquete->id == $enqueteId) {
                return $enquete;
            }
        }

        return null;
    }

    /**
     * Get the category breadcrumb trail as an array of WP_Term objects.
     *
     * This function starts from a given category and traverses up the hierarchy
     * to the top-level parent, returning an ordered array of category objects.
     *
     * @param int|null $category_id The ID of the starting category. If null, it will automatically
     *                              try to get the current category from the main WordPress query
     *                              (e.g., when on a category archive page).
     * @return WP_Term[] An array of WP_Term objects, ordered from the top-level parent to the
     *                   current category. Returns an empty array if the category is not found
     *                   or if not on a category archive page (and no ID is provided).
     */
    public static function get_category_breadcrumb_array($category_id = null)
    {
        // Initialize an empty array to store the breadcrumb trail.
        $breadcrumb = [];

        $current_category = null;

        // 1. Determine the starting category.
        if ($category_id) {
            // If a specific category ID is provided, get that term object.
            $current_category = get_term($category_id, 'category');
        } elseif (is_category()) {
            // If no ID is given, check if we are on a category archive page.
            // get_queried_object() returns the current category object on its archive page.
            $current_category = get_queried_object();
        }

        // If we couldn't find a valid category object, exit and return the empty array.
        if (!$current_category || is_wp_error($current_category)) {
            return $breadcrumb;
        }

        // 2. Traverse up the hierarchy from the current category.
        while ($current_category && !is_wp_error($current_category)) {
            // Add the current category object to our breadcrumb array.
            $breadcrumb[] = $current_category;

            // Check if the current category has a parent.
            if ($current_category->parent > 0) {
                // If it has a parent, get the parent term object for the next loop iteration.
                $current_category = get_term($current_category->parent, 'category');
            } else {
                // If parent is 0, we've reached the top-level category, so we can stop.
                break;
            }
        }

        // 3. Reverse the array.
        // The array is currently in [child, parent, grandparent] order.
        // We need to reverse it to get the correct breadcrumb order [grandparent, parent, child].
        return array_reverse($breadcrumb);
    }

    /**
     * Generates an array of breadcrumb items.
     *
     * @return array An array of breadcrumb items, each with 'title' and 'url'. The current item has a null URL.
     */
    public static function get_breadcrumb_items(int $postId)
    {
        $items = [];
        // 1. Home Page
        $items[] = [
            'title' => esc_html__('Home', 'your-text-domain'),
            'url' => get_home_url(),
        ];

        // 2. Blog Posts (single.php)
        if (is_singular('post')) {
            $categories = get_the_category($postId);
            if (!empty($categories)) {
                // Use the first category. You could add more complex logic here if needed.
                $category = $categories[0];
                $items[] = [
                    'title' => esc_html($category->name),
                    'url' => esc_url(get_category_link($category->term_id)),
                ];
            }
            // Add the current post title (no URL)
            $items[] = ['title' => get_the_title($postId), 'url' => null];
        } // 3. Pages (page.php)
        elseif (is_page()) {
            $ancestors = get_post_ancestors($postId);
            if ($ancestors) {
                // Get ancestors in the correct order
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor_id) {
                    $items[] = [
                        'title' => get_the_title($ancestor_id),
                        'url' => get_permalink($ancestor_id),
                    ];
                }
            }
            // Add the current page title (no URL)
            $items[] = ['title' => get_the_title($postId), 'url' => null];
        } // 4. Category Archives (category.php)
        elseif (is_category()) {
            $current_cat = get_queried_object();
            // Check for parent category
            if ($current_cat->parent != 0) {
                $parent_cats = get_ancestors($current_cat->term_id, 'category');
                $parent_cats = array_reverse($parent_cats);
                foreach ($parent_cats as $parent_id) {
                    $parent = get_term($parent_id, 'category');
                    $items[] = [
                        'title' => esc_html($parent->name),
                        'url' => esc_url(get_term_link($parent)),
                    ];
                }
            }
            // Add the current category name (no URL)
            $items[] = ['title' => single_cat_title('', false), 'url' => null];
        }

        // Add other conditions like is_tag(), is_author(), is_search(), is_404() as needed

        return $items;
    }

}
