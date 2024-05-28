<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Issep\Indice\IndiceEnum;
use AcMarche\Issep\Indice\IndiceUtils;
use AcMarche\Issep\Repository\StationRemoteRepository;
use AcMarche\Issep\Repository\StationRepository;
use AcMarche\Issep\Utils\FeuUtils;
use AcMarche\Common\Env;

class Capteur
{
    private StationRepository $stationRepository;
    private IndiceUtils $indiceUtils;

    public function __construct()
    {
        $this->stationRepository = new StationRepository(new StationRemoteRepository());
        $this->indiceUtils       = new IndiceUtils($this->stationRepository);
    }

    public function getCapteurs(): array
    {
        Env::loadEnv();
        $stations = $this->stationRepository->getStations();
        $indices  = $this->stationRepository->getIndices();
        $this->indiceUtils->setIndices($stations, $indices);
        foreach ($stations as $station) {
            $station->color = FeuUtils::colorGrey();
            if ($station->last_indice) {
                $station->color = IndiceEnum::colorByIndice($station->last_indice->aqi_value);
            }
        }

        return $stations;
    }
}
