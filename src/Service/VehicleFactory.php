<?php

namespace Framework\Service;

use Doctrine\Common\Collections\Collection;
use Framework\Exception\VehicleNotAvailableException;
use Framework\Factory\AbstractVehicleFactory;
use Framework\Vehicle\VehicleInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class VehicleFactory
 * @package Framework\Service
 */
class VehicleFactory extends AbstractVehicleFactory
{
    /**
     * @param array $names
     * @return Collection
     */
    public function processVehicles(array $names): Collection
    {
        $this->vehicles->clear();

        foreach ($names as $name) {
            $vehicleObj = $this->processVehicle($name);
            $this->vehicles->add($vehicleObj);
        }

        return $this->vehicles;
    }

    /**
     * @param string $name
     * @return VehicleInterface
     * @throws VehicleNotAvailableException
     */
    protected function processVehicle(string $name): VehicleInterface
    {
        try {
            return $this->getContainer()->get($name . '.vehicle');
        } catch(ServiceNotFoundException $e) {
            throw new VehicleNotAvailableException($name . '.vehicle');
        }
    }

}
