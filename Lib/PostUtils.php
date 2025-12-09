<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Lib\Pivot\Entity\Event;
use WP_Post;

class PostUtils
{
    /**
     * @param WP_Post $post
     * @return array|Tag[]
     */
    public static function tagsPost(WP_Post $post): array
    {
        $tags = [];
        return $tags;
        foreach (get_the_category($post) as $category) {
            $label = new Label();
            $label->lang = 'fr';
            $label->value = $category->name;
            $tag = new Tag('urn', [$label]);
            $tag->name = $category->name;
            $tag->url = get_category_link($category);
            $tags[] = $tag;
        }

        $post->tags = $tags;
        $post->tagsFormatted = $tags;

        return $tags;
    }

    public static function getImage(WP_Post $post): ?string
    {
        if (has_post_thumbnail($post)) {
            $images = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'original');
            if ($images) {
                return $images[0];
            }
        }

        return null;
    }

    /**
     * @param array|Event[] $offres
     * @param int $categoryId
     * @param string $language
     * @return void
     */
    public static function setLinkOnOffres(array $offres, int $categoryId, string $language)
    {
        array_map(
            function ($offre) use ($categoryId, $language) {
                $offre->url = RouterMarche::getUrlEvent($offre);
            },
            $offres
        );
    }
}
