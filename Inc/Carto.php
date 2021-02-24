<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Bottin\Repository\BottinRepository;
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
            'environnement'   => [
                'name'     => 'Environnement',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'bulles_verres'    => ['name' => 'Bulles à verres', 'source' => 'bottin', 'id' => 513],
                    'bulles_vetements' => ['name' => 'Bulles à vêtements', 'source' => 'kml', 'id' => 'seniors'],
                ],
            ],
            'mobilite'        => [
                'name'     => 'Mobilité',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'travaux'      => ['name' => 'Travaux', 'source' => 'bottin', 'id' => 513],
                    'parking'      => ['name' => 'Parking', 'source' => 'bottin', 'id' => 513],
                    'pistes_cyclo' => ['name' => 'Pistes cyclables', 'source' => 'bottin', 'id' => 513],
                ],
            ],
            'enfance'         => [
                'name'     => 'Enfance',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    ['name' => 'Milieux d\'acceuil', 'source' => 'bottin', 'id' => 513],
                    ['name' => 'Aires de jeux, parcs', 'source' => 'bottin', 'id' => 513],
                ],
            ],
            'infrastructures' => [
                'name'     => 'Infrastructures',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    ['name' => 'Salles communales', 'source' => 'bottin', 'id' => 513],
                    ['name' => 'Cimetières', 'source' => 'bottin', 'id' => 513],
                    ['name' => 'Infrastructures sportives', 'source' => 'bottin', 'id' => 513],
                ],
            ],
            'culture'         => [
                'name'     => 'Culture',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    ['name' => 'Musées', 'source' => 'bottin', 'id' => 513],
                    ['name' => 'Bibliothèques', 'source' => 'bottin', 'id' => 513],
                ],
            ],
        ];
    }

    public function seniors()
    {
        $url     = 'https://www.google.com/maps/d/u/1/kml?forcekml=1&mid=1M3CBWAF0BQ7BqLB33xFr3tu10o0';
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
                $data = $this->seniors();
                break;
            default:

                break;
        }

        return $data;
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
            'url'       => Router::getUrlFicheBottin($object),
        ];
    }

}
