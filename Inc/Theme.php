<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Common\MarcheConst;
use Symfony\Component\HttpFoundation\Request;

class Theme
{
    const PAGE_ALERT = 9570;
    const PAGE_CARTO = 20644;//tourisme

    static function isHomePage(): bool
    {
        $request = Request::createFromGlobals();
        $uri     = $request->getRequestUri();
        if ($uri === '/') {
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
