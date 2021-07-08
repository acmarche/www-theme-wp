<?php


namespace AcMarche\Theme\Lib;


use AcMarche\Theme\Inc\Theme;
use AcMarche\UrbaWeb\UrbaWeb;

class Urba
{
    /**
     * @param int $enqueteId
     *
     * @return \AcMarche\UrbaWeb\Entity\Permis|string
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function checkPermis(int $enqueteId)
    {
        $urbaweb = new UrbaWeb();
        $twig    = Twig::LoadTwig();
        $result  = $urbaweb->searchPermis(['numeroPermis' => $enqueteId]);
        $permis  = null;
        if (count($result) > 0) {
            $permisId = $result[0];
            $permis   = WpRepository::getEnquetePublique($permisId);
        }
        if ( ! $permis) {
            return $twig->render(
                'errors/404.html.twig',
                [
                    'title'     => 'Enquête publique non trouvée',
                    'tags'      => [],
                    'color'     => Theme::getColorBlog(Theme::TOURISME),
                    'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                    'relations' => [],
                ]
            );
        }

        if ( ! $urbaweb->isPublic($permis)) {
            return $twig->render(
                'errors/500.html.twig',
                [
                    'title'     => 'Enquête publique non publique',
                    'message'   => 'Erreur de lecture de l\'enquête',
                    'tags'      => [],
                    'color'     => Theme::getColorBlog(Theme::TOURISME),
                    'blogName'  => Theme::getTitleBlog(Theme::TOURISME),
                    'relations' => [],
                ]
            );
        }

        return $permis;
    }
}
