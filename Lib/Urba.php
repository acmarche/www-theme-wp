<?php


namespace AcMarche\Theme\Lib;


use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use AcMarche\UrbaWeb\Entity\Permis;
use AcMarche\UrbaWeb\UrbaWeb;

class Urba
{
    /**
     * @param int $enqueteId
     *
     * @return Permis|string
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function checkPermis(int $enqueteId)
    {
        $urbaweb = new UrbaWeb(false);
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

    public static function permisToPost(Permis $permis): \stdClass
    {
        $demandeur = count($permis->demandeurs) > 0 ? $permis->demandeurs[0] : null;
        list($yearD, $monthD, $dayD) = explode('-', $permis->dateDebutAffichage());
        $dateDebut = $dayD.'-'.$monthD.'-'.$yearD;
        list($yearF, $monthF, $dayF) = explode('-', $permis->dateFinAffichage());
        $dateFin            = $dayF.'-'.$monthF.'-'.$yearF;
        $post               = new \stdClass();
        $post->ID           = $permis->numeroPermis;
        $nature             = $permis->nature ? $permis->nature->libelle : '';
        $post->excerpt      = $nature.'<br /> Du '.$dateDebut.' au '.$dateFin;
        $post->post_excerpt = '';
        $type               = $permis->typePermis ? $permis->typePermis->libelle : '';
        $post->post_excerpt = $type.'<br />';
        if ( ! $permis->numeroPermis) {
            $permis->numeroPermis = 'rr';
        }
        $post->url = RouterMarche::getUrlEnquete($permis->numeroPermis);
        $localite  = $permis->adresseSituation ? $permis->adresseSituation->localite : '';
        if ($demandeur) {
            $post->post_title = $demandeur->civilite.' '.$demandeur->nom.' '.$demandeur->prenom.' à '.$localite;
        } else {
            $post->post_title = '';
        }

        return $post;
    }
}
