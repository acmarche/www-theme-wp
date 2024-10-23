<?php

namespace AcMarche\Theme\Lib;

use AcMarche\Common\Env;
use AcMarche\Issep\Indice\IndiceUtils;
use AcMarche\Issep\Repository\StationRemoteRepository;
use AcMarche\Issep\Repository\StationRepository;
use AcMarche\Issep\Repository\StationsEnum;

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

        $this->removeObjectById($stations, StationsEnum::SINSIN);

        return $stations;
    }

    function removeObjectById(&$array, $id)
    {
        foreach ($array as $key => $object) {
            if ($object->id == $id) {
                unset($array[$key]);
                // Reindex
                $array = array_values($array);
                break;
            }
        }
    }

}
