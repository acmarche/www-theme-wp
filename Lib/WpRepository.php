<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Bottin\Bottin;
use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\RouterBottin;
use AcMarche\Common\SortUtil;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\UrbaWeb\Entity\Permis;
use AcMarche\UrbaWeb\UrbaWeb;
use AcSort;
use BottinCategoryMetaBox;
use WP_Post;
use WP_Query;

class WpRepository
{
    public static function getPageAlert(): ?WP_Post
    {
        switch_to_blog(1);
        $query = new WP_Query(array("page_id" => Theme::PAGE_ALERT, "post_status" => 'publish', 'post_type' => 'page'));
        $post  = $query->get_posts();
        if (count($post) > 0) {
            return $post[0];
        }

        return null;
    }

    /**
     * @param int $max
     *
     * @return WP_Post[]
     */
    public static function getAllNews(int $max = 50): array
    {
        $sites = Theme::SITES;
        $news  = array();

        foreach ($sites as $siteId => $name) :
            switch_to_blog($siteId);

            $args = array(
                'category_name' => 'actualites-principales',
                'orderby'       => 'title',
                'post_status'   => 'publish',
                'order'         => 'ASC',
            );

            if ($siteId == 1) {
                $args = array(
                    'category_name' => 'actualites',
                    'orderby'       => 'title',
                    'post_status'   => 'publish',
                    'order'         => 'ASC',
                );
            }

            $querynews = new WP_Query($args);

            while ($querynews->have_posts()) :

                $post = $querynews->next_post();
                $id   = $post->ID;

                if (has_post_thumbnail($id)) {
                    $attachment_id      = get_post_thumbnail_id($id);
                    $images             = wp_get_attachment_image_src($attachment_id, 'original');
                    $post_thumbnail_url = $images[0];
                } else {
                    $post_thumbnail_url = get_template_directory_uri().'/assets/images/404.jpg';
                }

                $post->post_thumbnail_url = $post_thumbnail_url;

                $permalink = get_permalink($id);
                $post->url = $permalink;

                $post->blog_id = $siteId;
                $post->blog    = $name;
                $post->color   = Theme::COLORS[$siteId];

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
        $categories      = get_the_category($postId);
        $args            = array(
            'category__in' => array_map(
                function ($category) {
                    return $category->cat_ID;
                },
                $categories
            ),
            'post__not_in' => [$postId],
            'orderby'      => 'title',
            'order'        => 'ASC',
        );
        $query           = new \WP_Query($args);
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
                'url'   => get_permalink($post->ID),
                'image' => $image,
                'tags'  => self::getTags($post->ID),
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
                'url'  => get_category_link($category),
            ];
        }

        return $tags;
    }

    public function getChildrenOfCategory(int $cat_ID): array
    {
        $args     = ['parent' => $cat_ID, 'hide_empty' => false];
        $children = get_categories($args);
        array_map(
            function ($category) {
                $category->url = get_category_link($category->term_id);
                $category->id  = $category->term_id;
            },
            $children
        );

        return $children;
    }

    public function getRootCategories(): array
    {
        $args     = ['parent' => 0, 'hide_empty' => false];
        $children = get_categories($args);
        array_map(
            function ($category) {
                $category->url = get_category_link($category->term_id);
                $category->id  = $category->term_id;
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
            'cat'         => $catId,
            'numberposts' => 5000,
            'orderby'     => 'post_title',
            'order'       => 'ASC',
            'post_status' => 'publish',
        );

        $querynews = new WP_Query($args);
        $posts     = [];
        while ($querynews->have_posts()) {
            $post          = $querynews->next_post();
            $post->excerpt = $post->post_excerpt;
            $post->url     = get_permalink($post->ID);
            $posts[]       = $post;
        }

        $fiches           = [];
        $categoryBottinId = get_term_meta($catId, BottinCategoryMetaBox::KEY_NAME, true);
        if ($categoryBottinId) {
            $bottinRepository = new BottinRepository();
            $fiches           = $bottinRepository->getFichesByCategory($categoryBottinId);
        }

        array_map(
            function ($fiche) {
                $fiche->fiche        = true;
                $fiche->excerpt      = Bottin::getExcerpt($fiche);
                $fiche->post_excerpt = Bottin::getExcerpt($fiche);
                $fiche->url          = RouterBottin::getUrlFicheBottin($fiche);
                $fiche->post_title   = $fiche->societe;
            },
            $fiches
        );

        $all = array_merge($posts, $fiches);

        if (get_current_blog_id(
            ) === Theme::ADMINISTRATION && ($catId == Theme::ENQUETE_DIRECTORY || $catId == Theme::PUBLICATIOCOMMUNAL_CATEGORY)) {
            $permis = self::getEnquetesPubliques();
            $data   = [];
            foreach ($permis as $permi) {
                $demandeur = $permi->demandeurs[0];
                $enquete         = $permi->enquete;
                list($yearD, $monthD, $dayD) = explode('-', $enquete->dateDebut);
                $dateDebut = $dayD.'-'.$monthD.'-'.$yearD;
                list($yearF, $monthF, $dayF) = explode('-', $enquete->dateFin);
                $dateFin         = $dayF.'-'.$monthF.'-'.$yearF;
                $t               = new \stdClass();
                $t->ID           = $permi->numeroPermis;
                $t->excerpt      = $permi->nature->libelle.'<br /> Du '.$dateDebut.' au '.$dateFin;
                $t->post_excerpt = $permi->typePermis->libelle.'<br />';
                $t->url          = RouterMarche::getUrlEnquete($permi->numeroPermis);
                $t->post_title   = $demandeur->civilite.' '.$demandeur->nom.' '.$demandeur->prenom.' à '.$permi->adresseSituation->localite;
                $data[]          = $t;
            }
            $all = array_merge($all, $data);
        }

        $all = SortUtil::sortPosts($all);

        return $all;
    }

    public function getPostsByCategory(int $catId, int $siteId): array
    {
        $args = array(
            'cat'         => $catId,
            'numberposts' => 5000,
            'orderby'     => 'post_title',
            'order'       => 'ASC',
            'post_status' => 'publish',
        );

        $query = new WP_Query($args);
        $posts = [];
        while ($query->have_posts()) :
            $post = $query->next_post();
            $id   = $post->ID;

            if (has_post_thumbnail($id)) {
                $attachment_id      = get_post_thumbnail_id($id);
                $images             = wp_get_attachment_image_src($attachment_id, 'original');
                $post_thumbnail_url = $images[0];
            } else {
                $post_thumbnail_url = get_template_directory_uri().'/assets/images/404.jpg';
            }

            $post->post_thumbnail_url = $post_thumbnail_url;

            $permalink = get_permalink($id);
            $post->url = $permalink;

            $post->blog_id = $siteId;
            $post->blog    = Theme::getTitleBlog($siteId);
            $post->color   = Theme::COLORS[$siteId];

            $posts[] = $post;
        endwhile;

        $all = SortUtil::sortPosts($posts);

        return $all;
    }

    public static function getCategoryAgenda(): object
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
        $category = get_category(Theme::ENQUETE_DIRECTORY);

        switch_to_blog($currentBlog);

        return $category;
    }

    /**
     * @return Permis[]
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public static function getEnquetesPubliques(): array
    {
        $urbaweb   = new UrbaWeb();
        $permisIds = $urbaweb->searchAdvancePermis(
            [
                'debutAffichageEnqueteDe' => '2021-05-19',
                'debutAffichageEnqueteA'  => '2021-07-01',
            ]
        );
        $permis    = [];
        foreach ($permisIds as $permisId) {
            $permi             = $urbaweb->informationsPermis((int)$permisId);
            $permi->demandeurs = $urbaweb->demandeursPermis($permi->id);
            $permi->documents  = $urbaweb->documentsPermis($permi->id);
            $permi->enquete    = $urbaweb->informationsEnquete($permi->id);
            $permis[]          = $permi;
           // break;
        }

        return $permis;


        return $enquetes;
        $content  = file_get_contents('https://extranet.marche.be/enquete/api/');
        $enquetes = json_decode($content);

        return $enquetes;
    }

    public static function getEnquetePublique(string $numeroPermis): ?Permis
    {
        $urbaweb = new UrbaWeb();
        $permiss = $urbaweb->searchPermis(
            [
                'numeroPermis' => $numeroPermis,
            ]
        );

        $enquete = $urbaweb->informationsPermis($permiss[0]->id);

        return $enquete;
    }

    public static function getEnquetePubliqueold(int $enqueteId): ?\stdClass
    {
        $enquetes = self::getEnquetesPubliques();
        foreach ($enquetes as $enquete) {
            if ($enquete->id == $enqueteId) {
                return $enquete;
            }
        }

        return null;
    }
}
