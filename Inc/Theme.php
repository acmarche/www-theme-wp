<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Common\MarcheConst;

class Theme
{
    const PAGE_ALERT = 9570;
    const PAGE_CARTO = 000;

    static function isHomePage(): bool
    {
        global $post;
        $currentBlog = get_current_blog_id();
        if ($currentBlog == 1 && $post !== null && $post->ID == 1840) {
            return true;
        }

        return false;
    }

    static function getColorBlog(int $blodId)
    {
        return MarcheConst::COLORS[$blodId];
    }

    static function getPathBlog(int $blodId)
    {
        if ($blodId === 1) {
            return '';
        } else {
            return get_blog_details($blodId)->path;
        }
    }

    static function getTitleBlog(int $blodId)
    {
        return get_blog_details($blodId)->blogname;
    }

}
