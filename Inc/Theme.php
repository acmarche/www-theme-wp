<?php


namespace AcMarche\Theme\Inc;

use Symfony\Component\HttpFoundation\Request;

class Theme
{
    const CITOYEN = 1;
    const ADMINISTRATION = 2;
    const ECONOMIE = 3;
    const TOURISME = 4;
    const CULTURE = 12;

    const SITES = [
        self::CITOYEN        => 'citoyen',
        self::ADMINISTRATION => 'administration',
        self::ECONOMIE       => 'economie',
        self::TOURISME       => 'tourisme',
        5                    => 'sport',
        6                    => 'sante',
        7                    => 'social',
        8                    => 'marchois',
        11                   => 'culture',
        self::CULTURE        => 'roman',
        13                   => 'noel',
        14                   => 'enfance',
    ];
    const COLORS = [
        self::CITOYEN        => 'color-cat-cit',
        self::ADMINISTRATION => 'color-cat-adm',
        self::ECONOMIE       => 'color-cat-eco',
        self::TOURISME       => 'color-cat-tou',
        5                    => 'color-cat-spo',
        6                    => 'color-cat-san',
        7                    => 'color-cat-soc',
        self::CULTURE        => 'color-cat-cul',//=>roman
        11                   => 'color-cat-cul',
        14                   => 'color-cat-enf',
    ];
    const PAGE_ALERT = 5087;
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
        return self::COLORS[$blodId];
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
