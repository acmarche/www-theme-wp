<?php


namespace AcMarche\Theme\Inc;


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
                    'bulles_verres'    => 'Bulles à verres',
                    'bulles_vêtements' => 'Bulles à vêtements',
                ],
            ],
            'mobilite'        => [
                'name'     => 'Mobilité',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'travaux'      => 'Travaux',
                    'parking'      => 'Parking',
                    'pistes_cyclo' => 'Pistes cyclables',
                ],
            ],
            'enfance'         => [
                'name'     => 'Enfance',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'Milieux d\'acceuil',
                    'Aires de jeux, parcs',
                ],
            ],
            'infrastructures' => [
                'name'     => 'Infrastructures',
                'icone'    => 'fas fa-briefcase',
                'elements' => [
                    'Salles communales',
                    'Cimetières',
                    'Infrastructures sportives',
                ],
            ],
            'culture'         => [
                'name'     => 'Culture',
                'icone'    => 'fas fa-briefcase',
                'elements' => ['Musées', 'Bibliothèques'],
            ],
        ];
    }

    public function travaux()
    {

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

}
