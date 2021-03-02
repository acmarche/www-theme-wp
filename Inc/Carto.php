<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Bottin\Repository\BottinRepository;
use AcMarche\Bottin\RouterBottin;
use Symfony\Component\HttpClient\HttpClient;

class Carto
{
    /**
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function filtres(): array
    {
        return [
            'culture'         => [
                'name'     => 'Culture',
                'icone'    => 'fas fa-book',
                'elements' => [
                    'biblio'  => ['name' => 'Bibliothèques', 'source' => 'bottin', 'id' => 674],
                    'cinema'  => ['name' => 'Cinéma', 'source' => 'bottin', 'id' => 675],
                    'musees'  => ['name' => 'Musées', 'source' => 'bottin', 'id' => 673],
                    'statues' => ['name' => 'Statues et sculptures', 'source' => 'kml', 'id' => 'statues'],
                ],
            ],
            'enfance'         => [
                'name'     => 'Enfance',
                'icone'    => 'fas fa-baby-carriage',
                'elements' => [
                    'accueillantes' => ['name' => 'Accueillantes', 'source' => 'bottin', 'id' => 672],
                    'jeux'          => ['name' => 'Aires de jeux, parcs', 'source' => 'kml', 'id' => 'jeux'],
                ],
            ],
            'enseignement'    => [
                'name'     => 'Enfance',
                'icone'    => 'fas fa-baby-carriage',
                'elements' => [
                    'enseignement_artistique' => ['name' => 'Artistique', 'source' => 'bottin', 'id' => 682],
                    'enseignement_maternelle' => ['name' => 'Maternel et primaire', 'source' => 'bottin', 'id' => 669],
                    'enseignement_secondaire' => ['name' => 'Secondaire', 'source' => 'bottin', 'id' => 668],
                    'enseignement_superieur'  => ['name' => 'Supérieur', 'source' => 'bottin', 'id' => 670],
                ],
            ],
            'environnement'   => [
                'name'     => 'Environnement',
                'icone'    => 'fas fa-leaf',
                'elements' => [
                    'bulles_verres'    => ['name' => 'Bulles à verres', 'source' => 'bottin', 'id' => 677],
                    'bulles_vetements' => ['name' => 'Bulles à vêtements', 'source' => 'bottin', 'id' => 678],
                ],
            ],
            'horeca'          => [
                'name'     => 'Horéca',
                'icone'    => 'fas fa-cookie',
                'elements' => [
                    'brasseries'  => ['name' => 'Brasseries-Bar', 'source' => 'bottin', 'id' => 522],
                    'camping'     => ['name' => 'Camping', 'source' => 'bottin', 'id' => 652],
                    'chambres'    => ['name' => 'Chambres d\'hôtes', 'source' => 'bottin', 'id' => 651],
                    'friteries'   => ['name' => 'Friterie - Snack - sandwicherie', 'source' => 'bottin', 'id' => 523],
                    'gites'       => ['name' => 'Gîtes et meublés de tourisme', 'source' => 'bottin', 'id' => 650],
                    'glaciers'    => ['name' => 'Glaciers - Tea room', 'source' => 'bottin', 'id' => 524],
                    'hotels'      => ['name' => 'Hôtels', 'source' => 'bottin', 'id' => 649],
                    'restaurants' => ['name' => 'Restaurants', 'source' => 'bottin', 'id' => 521],
                ],
            ],
            'infrastructures' => [
                'name'     => 'Infrastructures',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'cimetieres'   => ['name' => 'Cimetières', 'source' => 'bottin', 'id' => 0],
                    'salles_commu' => ['name' => 'Salles communales', 'source' => 'bottin', 'id' => 680],
                ],
            ],
            'mobilite'        => [
                'name'     => 'Mobilité',
                'icone'    => 'fas fa-bus',
                'elements' => [
                    'balade_pieds'        => [
                        'name'   => 'Balade des petits pieds',
                        'source' => 'kml',
                        'id'     => 'balades',
                    ],
                    'parking_centre'      => [
                        'name'   => 'Parkings centre-véhicules ',
                        'source' => 'bottin',
                        'id'     => 679,
                    ],
                    'pistes_cyclo'        => ['name' => 'Pistes cyclables', 'source' => 'kml', 'id' => 'cyclos'],
                    'travaux'             => ['name' => 'Travaux', 'source' => 'kml', 'id' => 'travaux'],
                    'velos_stationnement' => [
                        'name'   => 'Parkings vélos',
                        'source' => 'kml',
                        'id'     => 'velos_stationnement',
                    ],
                ],
            ],

            'sante' => [
                'name'     => 'Santé',
                'icone'    => 'far fa-hospital',
                'elements' => [
                    'dentistes'    => ['name' => 'Dentistes', 'source' => 'bottin', 'id' => 383],
                    'hopital'      => ['name' => 'Hôpital', 'source' => 'bottin', 'id' => 681],
                    'kines'        => ['name' => 'Kinésithérapeutes', 'source' => 'bottin', 'id' => 385],
                    'medecins'     => ['name' => 'Médecine générale', 'source' => 'bottin', 'id' => 370],
                    'mutuelles'    => ['name' => 'Mutuelles', 'source' => 'bottin', 'id' => 411],
                    'pharmacies'   => ['name' => 'Pharmacies', 'source' => 'bottin', 'id' => 390],
                    'veterinaires' => ['name' => 'Vétérinaires', 'source' => 'bottin', 'id' => 588],
                ],
            ],
            'sport' => [
                'name'     => 'Sport',
                'icone'    => 'far fa-hospital',
                'elements' =>
                    $this->getElements(486),
            ],
            'wifi'  => [
                'name'     => 'Wifi gratuit',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'wifi' => ['name' => 'Réseau Wifi4EU', 'source' => 'kml', 'id' => 'wifi'],
                ],
            ],
        ];
    }

    public function fetchKml(string $url)
    {
        $request = $this->httpClient->request(
            'GET',
            $url,
            [

            ]
        );

        $content = $request->getContent();

        return $content;
    }


    public function foundSource(string $keySearch): array
    {
        foreach ($this->filtres() as $filtre) {
            foreach ($filtre['elements'] as $key => $element) {
                if ($keySearch == $key) {
                    return $element;
                }
            }
        }

        return [];
    }

    public function loadKml(string $keyword): string
    {
        switch ($keyword) {
            case 'seniors':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1M3CBWAF0BQ7BqLB33xFr3tu10o0';
                break;
            case 'statues':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1Za10EtAUa8zrOqdw2eSdUWL0nVU';
                break;
            case 'jeux':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1TwhxZiIAnzdvAEeUZp08BEQlU88';
                break;
            case 'wifi':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1NABWReYEqCBUaOjd3x5TmyTQEZw6PIfp';
                break;
            case 'travaux':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1kfhp1xhZcusuTMBxkDK5agYS5cQKAlrL';
                break;
            case 'parkings':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1-509jyExlQqn7c1ijeYxrkLVOa8';
                break;
            case 'cyclos':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1-509jyExlQqn7c1ijeYxrkLVOa8';
                break;
            case 'balades':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1eC0t63jFfVhLAjGuWTkIkfHHYqc';
                break;
            case 'velos_stationnement':
                $url = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1A403qynTGRgt3FigLEqpIcRL4CGtazUJ';
                break;
            default:
                $url = false;
                break;
        }

        if ($url) {
            return $this->fetchKml($url);
        }

        return '';
    }

    public function getFichesBottin(int $id): array
    {
        $bottinRepository = new BottinRepository();
        $data             = [];
        $fiches           = $bottinRepository->getFichesByCategories([$id]);
        foreach ($fiches as $fiche) {
            $data[] = $this->formatSocieteData($fiche);
        }

        return $data;
    }

    public function getElements(int $id): array
    {
        $bottinRepository = new BottinRepository();
        $data             = [];
        $rubriques        = $bottinRepository->getCategories($id);
        foreach ($rubriques as $rubrique) {
            $data[$rubrique->slug] = ['name' => $rubrique->name, 'source' => 'bottin', 'id' => $rubrique->id];
        }

        return $data;
    }

    public function formatSocieteData($object): array
    {
        return [
            'nom'       => $object->societe,
            'latitude'  => $object->latitude,
            'longitude' => $object->longitude,
            'telephone' => $object->telephone.' '.$object->gsm,
            'email'     => $object->email,
            'rue'       => $object->rue.', '.$object->numero,
            'localite'  => $object->cp.' '.$object->localite,
            'url'       => RouterBottin::getUrlFicheBottin($object),
        ];
    }

}
