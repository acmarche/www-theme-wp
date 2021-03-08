<?php


namespace AcMarche\Theme\Inc;

use Symfony\Component\HttpFoundation\Request;

class Theme
{
    const AGENDA_FULL = 'agenda_full';
    const CITOYEN = 1;
    const ADMINISTRATION = 2;
    const TOURISME = 4;
    const SITES = [
        1                    => 'citoyen',
        self::ADMINISTRATION => 'administration',
        3                    => 'economie',
        4                    => 'tourisme',
        5                    => 'sport',
        6                    => 'sante',
        7                    => 'social',
        8                    => 'marchois',
        11                   => 'culture',
        12                   => 'roman',
        13                   => 'noel',
        14                   => 'enfance',
    ];
    const COLORS = [
        1                    => 'color-cat-cit',
        self::ADMINISTRATION => 'color-cat-adm',
        3                    => 'color-cat-eco',
        4                    => 'color-cat-tou',
        5                    => 'color-cat-spo',
        6                    => 'color-cat-san',
        7                    => 'color-cat-soc',
        12                   => 'color-cat-cul',//=>roman
        11                   => 'color-cat-cul',
        14                   => 'color-cat-enf',
    ];
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
