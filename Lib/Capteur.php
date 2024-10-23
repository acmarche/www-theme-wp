<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Common\Env;
use AcMarche\Issep\Indice\IndiceUtils;
use AcMarche\Issep\Repository\StationRemoteRepository;
use AcMarche\Issep\Repository\StationRepository;

class Capteur
{
    private StationRepository $stationRepository;
    private IndiceUtils $indiceUtils;

    public function __construct()
    {
        $this->stationRepository = new StationRepository(new StationRemoteRepository());
        $this->indiceUtils = new IndiceUtils($this->stationRepository);
    }

    public function getStations(): array
    {
        Env::loadEnv();
        $stations = $this->stationRepository->getStations();
        $this->indiceUtils->setIndices($stations);

        return $stations;
    }
}
